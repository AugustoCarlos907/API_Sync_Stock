<?php 

namespace App\Services;

use App\Events\StockLowPriceDetected;
use App\Jobs\SendStockAlertEmailJob;
use App\Models\StockItem;
use Illuminate\Database\Eloquent\Collection;

class AlertService{


    // public function __construct(public StockItem  $stockItems){}

    public function AlertStockItems(  $item){

        if ($item->quantity === 0) {
            return response()->json([
                'alert' => 'Stock is OUT for item: ' . $item->item_name
            ], 200);
        }


        if ($item->quantity < 5) {
            return response()->json([
                'alert' => 'Stock is LOW for item: ' . $item->item_name
            ], 200);
        }

        return response()->json([
            'alert' => 'Stock is OK for item: ' . $item->item_name
        ], 200);
    }

    public function checkLowPriceItems(float $limit = 5): void
    {
       $items = StockItem::query()
            ->where('quantity', '<', $limit)
            ->where('active', '1')
            ->get()
            ->groupBy('company_id');

            foreach ($items as $companyItems) {
               SendStockAlertEmailJob::dispatch($companyItems); 
            }

    }


}