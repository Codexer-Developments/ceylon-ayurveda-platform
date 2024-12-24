<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    /** @use HasFactory<\Database\Factories\PatientsFactory> */
    use HasFactory;
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'address',
        'phone_number',
        'email',
        'tex_id',
        'insurance_id',
        'insurance_name',
        'insurance_group',
        'insurance_type',
        'blood_group',
        'dob',
    ];
}
