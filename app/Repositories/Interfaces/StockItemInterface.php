<?php 


namespace App\Repositories\Interfaces;

interface StockItemInterface 
{
   
public function getAllStockItemsByCompanyId(int $companyId);

}