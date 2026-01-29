<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    protected $fillable = [
        'stock_file_id',
        'company_id',
        'item_name',
        'quantity',
        'sku',
        'price',
        'active'
    ];

    public function stockFile(){
        return $this->belongsTo(StockFile::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
