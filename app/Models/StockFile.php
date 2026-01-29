<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockFile extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'company_id',
        'file_name',
        'file_path',
        'status'
    ];

    public function company(): BelongsTo{
        return $this->belongsTo(Company::class);
    }
}
