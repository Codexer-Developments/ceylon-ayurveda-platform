<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductManagement extends Model
{
    /** @use HasFactory<\Database\Factories\ProductManagementFactory> */
    use HasFactory;
    protected $fillable = [
        'product_id',
        'center_id',
        'price',
        'quantity',
        'status',
        'cost_price',
        'user_id',
        'status',
    ];


    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

}
