<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centers extends Model
{
    /** @use HasFactory<\Database\Factories\CentersFactory> */
    use HasFactory;

    protected $fillable = [
        'center_name',
        'description',
        'address',
        'phone',
        'email',
        'slug',
        'status',
        'owner_id'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function doctors()
    {
        return $this->hasMany(User::class, 'center_id')->where('role', 'doctor');
    }

    public function appointments()
    {
        return $this->hasMany(DoctorAppointment::class, 'center_id');
    }

    public function sales()
    {
        return $this->hasMany(SalesOrder::class, 'center_id');
    }

    public function goodReceiveNotes()
    {
        return $this->hasMany(GoodsReceivedNote::class, 'center_id');
    }
}
