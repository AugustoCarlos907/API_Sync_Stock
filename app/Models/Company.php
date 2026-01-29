<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
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
