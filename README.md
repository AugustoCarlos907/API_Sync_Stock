## API_SYNC_STOCK 

API backend desenvolvida em Laravel, focada na importação, processamento e monitorização automática de stock através de ficheiros CSV, utilizando processamento assíncrono, arquitetura orientada a eventos e envio inteligente de notificações por email.

Este projeto foi pensado para cenários reais de empresas, ERPs e sistemas de inventário, onde grandes volumes de dados precisam ser processados sem impactar a performance da aplicação.

O Que Este Sistema Faz : 

✔ Upload de ficheiros CSV de stock
✔ Processa grandes volumes de dados de forma assíncrona
✔ Extrai e armazena os dados em background
✔ Analisa produtos com quantidade ou preço abaixo de um limite
✔ Agrupa produtos por empresa
✔ Envia apenas 1 email por empresa com todos os produtos em alerta
✔ Tudo sem bloquear requisições HTTP


CSV Upload
↓
Job de Processamento
↓
Análise de Stock
↓
Agrupamento por Empresa
↓
Event (StockLow)
↓
Job de Envio de Email


## Estrutura do Ficheiro CSV Exigida
 ['sku', 'name', 'quantity', 'price', 'active']

## Ambiente de Testes de Email

👉 Todos os testes de envio de email foram feitos utilizando o `Mailtrap `, garantindo:

1- Nenhum email real enviado acidentalmente

2- Ambiente seguro de desenvolvimento

3- Visualização completa do conteúdo do email

# Como executar o projecto : `API_SYNC_STOCK`

# Clonar o repositório
git clone https://github.com/AugustoCarlos907/API_Sync_Stock.git

# Entrar no projeto
cd API_Sync_Stock

# Instalar dependências
composer install

# Criar ficheiro de ambiente
cp .env.example .env

# Gerar chave
php artisan key:generate

# Configurar base de dados e Mailtrap no .env

# Rodar migrations
php artisan migrate

# Iniciar filas
php artisan queue:work

# Iniciar servidor
php artisan serve

👨‍💻 Autor

Augusto Carlos`
FULLSTACK Developer | Laravel | APIs | Arquitetura de Software