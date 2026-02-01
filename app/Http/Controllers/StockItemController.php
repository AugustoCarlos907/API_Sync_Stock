<?php

namespace App\Http\Controllers;

use App\Services\StockItemService;
use Illuminate\Http\Request;

class StockItemController extends Controller
{
    public function __construct( public StockItemService $service )
    {}

    public function index (){
        $companyId = auth()->user()->id;
        $stockItems = $this->service->getAllStockItemsByCompanyId($companyId);

        return response()->json([
            'stock_items' => $stockItems
        ], 200);
    }
}
