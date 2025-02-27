<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAppointment extends Model
{
    /** @use HasFactory<\Database\Factories\DoctorAppointmentFactory> */
    use HasFactory;
    protected $fillable = [
        'description',
        'status',
        'date',
        'patient_id',
        'center_id',
        'doctor_id',
        'created_by',
        'updated_by',
    ];


    public function patient()
    {
        return $this->belongsTo(Patients::class, 'patient_id');
    }

    // Define the relationship with DoctorAppointment

}
