<?php

namespace App\Jobs;

use App\Models\StockFile;
use App\Models\StockItem;
use App\Services\AlertService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SplFileObject;

class ParseStockCsvJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    public function __construct(public StockFile $stockFile)
    {}

    public function handle(): void
    {
        try {
            $this->stockFile->update(['status' => 'processing']);

            $path = storage_path('app/' . $this->stockFile->file_path);

            if (!file_exists($path)) {
                \Log::error('Arquivo CSV não encontrado: ' . $path);
                $this->stockFile->update(['status' => 'FAILED']);
                return;
            }

            $file = new SplFileObject($path);
            $file->setFlags(
                SplFileObject::READ_CSV |
                SplFileObject::SKIP_EMPTY |
                SplFileObject::DROP_NEW_LINE
            );

            // Cabeçalho esperado
            $expectedHeader = ['sku', 'name', 'quantity', 'price', 'active'];

            // Lê o cabeçalho
            $header = $file->fgetcsv();
            
            if ($header === false || $header === null || !is_array($header)) {
                throw new Exception('CSV vazio ou inválido');
            }

            $header = array_map('trim', $header);
            // Remove BOM se existir
            $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]);

            // Verifica se o header tem o número correto de colunas
            if (count($header) !== count($expectedHeader)) {
                throw new Exception('CSV com número de colunas inválido. Esperado: ' . 
                    count($expectedHeader) . ', Recebido: ' . count($header));
            }

            if ($header !== $expectedHeader) {
                throw new Exception('CSV com estrutura inválida. Esperado: ' . 
                    json_encode($expectedHeader) . ', Recebido: ' . json_encode($header));
            }

            $rows = [];
            $lineNumber = 1;
            
            // Processar linhas do CSV
            while (!$file->eof()) {
                $lineNumber++;
                $row = $file->fgetcsv();
                
                // Verificação robusta da linha
                if ($row === false || $row === null) {
                    continue;
                }
                
                if (!is_array($row)) {
                    continue;
                }
                
                // Se a linha for o cabeçalho repetido, pular
                if (count($row) > 0 && in_array(trim($row[0]), ['sku', 'SKU'])) {
                    continue;
                }
                
                // Filtrar valores nulos e strings vazias
                $row = array_map(function($value) {
                    return $value === '' ? null : $value;
                }, $row);
                
                // Se após filtrar estiver vazio, pular
                if (empty(array_filter($row, function($value) {
                    return $value !== null;
                }))) {
                    continue;
                }
                
                // Se tiver menos de 5 colunas, pode ser uma linha incompleta
                if (count($row) < 5) {
                    continue;
                }

                // Extrair valores com segurança
                $sku = isset($row[0]) ? trim($row[0]) : '';
                $name = isset($row[1]) ? trim($row[1]) : '';
                $quantity = isset($row[2]) ? $row[2] : 0;
                $price = isset($row[3]) ? $row[3] : null;
                $active = isset($row[4]) ? $row[4] : '0';

                // Validação básica - SKU é obrigatório
                if (empty($sku)) {
                    continue;
                }

                // Validação de preço - não pode ser null/empty
                // Se o preço for inválido, definir um valor padrão (0.00)
                if ($price === null || $price === '' || !is_numeric($price)) {
                    $price = '0.00';
                }

                $rows[] = [
                    'stock_file_id' => $this->stockFile->id,
                    'company_id' => $this->stockFile->company_id,
                    'sku' => $sku,
                    'item_name' => $name,
                    'quantity' => is_numeric($quantity) ? (int)$quantity : 0,
                    'price' => is_numeric($price) ? number_format((float)$price, 2, '.', '') : '0.00',
                    'active' => ($active === '1' || strtolower($active) === 'true' || $active === 'ativo') ? '1' : '0',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            \Log::info("Total de linhas válidas processadas: " . count($rows));

            if (!empty($rows)) {
                // Verificar se todos os preços são válidos antes de inserir
                foreach ($rows as $index => $row) {
                    if ($row['price'] === null || $row['price'] === '') {
                        \Log::warning("Linha {$index} tem preço inválido, definindo como 0.00", $row);
                        $rows[$index]['price'] = '0.00';
                    }
                }
                
                // Inserir em chunks
                collect($rows)->chunk(500)->each(function($chunk) {
                    try {
                        StockItem::insert($chunk->toArray());
                    } catch (\Exception $e) {
                        \Log::error('Erro ao inserir chunk: ' . $e->getMessage());
                        \Log::error('Dados do chunk com erro:', $chunk->toArray());
                        throw $e;
                    }
                });
            } else {
                throw new Exception('Nenhuma linha válida encontrada no CSV');
            }

            $this->stockFile->update([
                'status' => 'extracted',
                'processed_at' => now(),
            ]);


            app(AlertService::class)->checkLowPriceItems();

            
            \Log::info("Processamento concluído com sucesso para arquivo ID: " . $this->stockFile->id);

        } catch (\Exception $e) {
            $this->stockFile->update(['status' => 'failed']);
            \Log::error('Erro ao processar CSV: ' . $e->getMessage());
            \Log::error('Trace completo:', ['trace' => $e->getTraceAsString()]);
            throw $e;
        }
    }
}