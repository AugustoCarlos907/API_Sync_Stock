<?php 

namespace App\Services;

use App\Models\StockItem;

class AlertService{


    // public function __construct(public int  $item){}

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


}