<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    /** @use HasFactory<\Database\Factories\SalesOrderFactory> */
    use HasFactory;

    protected $casts = [
        'order_note' => 'json'
    ];

    protected $fillable = [
        'center_id',
        'patient_id',
        'total_amount',
        'discount',
        'payment',
        'change',
        'status',
        'created_by',
        'updated_by',
        'user_id'
    ];

    public function items()
    {
        return $this->hasMany(SalesOrderItem::class);
    }

    public function center()
    {
        return $this->belongsTo(Centers::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patients::class);
    }
}
