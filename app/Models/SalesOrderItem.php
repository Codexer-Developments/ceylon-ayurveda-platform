<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\SalesOrderItemFactory> */
    use HasFactory;

    protected $table = 'sales_order_items';



    protected $fillable = [
        'sales_order_id',
        'product_id',
        'center_id',
        'quantity',
        'price',
        'cost_price',
        'total_amount'
    ];

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }
}
