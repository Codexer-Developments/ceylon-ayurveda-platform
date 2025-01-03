<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatments extends Model
{
    /** @use HasFactory<\Database\Factories\TreatmentsFactory> */
    use HasFactory;
    protected $fillable = [
        'treatment_name',
        'description',
        'status',
    ];
}
