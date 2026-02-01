<?php 

namespace App\Repositories;

use App\Models\StockItem;
use App\Repositories\Interfaces\StockItemInterface;


class StockItemRepository implements StockItemInterface
{
   
public function getAllStockItemsByCompanyId(int $companyId)
    {
        return StockItem::where('company_id', $companyId)->get();
    }
}