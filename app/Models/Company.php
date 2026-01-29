<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'address',
        'email',
        'phone',
    ];

    public function stock_items(){
        return $this->hasMany(StockItem::class);
    }   
    
    public function stock_files(){
        return $this->hasMany(StockFile::class);
    }
}
