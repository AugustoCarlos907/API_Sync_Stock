<?php

namespace App\Http\Controllers;

use App\Models\StockItem;
use App\Services\AlertService;
use Illuminate\Http\Request;

class AlertItemController extends Controller
{
    public function __construct(public AlertService $service)
    {}

    public function sendStockAlerts($itemId){
        $item = StockItem::find($itemId);

        event(new \App\Events\AlertStockEvent($item));

        return response()->json([
            'message' => 'Alert email sent for item: ' . $item->item_name
        ], 200);
    
    }
}
