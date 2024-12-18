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
}
