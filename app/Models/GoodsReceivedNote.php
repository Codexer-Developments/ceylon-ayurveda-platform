<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsReceivedNote extends Model
{
    use HasFactory;

    protected $fillable = ['purchase_order_id', 'grn_number', 'received_date', 'total_amount', 'center_id'];
    protected $table = 'goods_received_notes';  // Explicitly define the table
    protected $primaryKey = 'id'; // Ensure this matches your actual primary key


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($grn) {
            if (empty($grn->grn_number)) {
                $grn->grn_number = 'GRN-' . str_pad(GoodsReceivedNote::max('id') + 1, 6, '0', STR_PAD_LEFT);
            }
        });
    }


    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function items()
    {
        return $this->hasMany(GoodsReceivedNoteItem::class);
    }
}
