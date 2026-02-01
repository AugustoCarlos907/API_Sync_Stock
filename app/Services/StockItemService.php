<?php 

namespace App\Services;

use App\Repositories\Interfaces\StockItemInterface;

class StockItemService 
{
 
    public function __construct(public StockItemInterface $repository){}

    public function getAllStockItemsByCompanyId(int $companyId)
    {
        return $this->repository->getAllStockItemsByCompanyId($companyId);
    }
}