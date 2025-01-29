<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function patient(Patients $patient)
    {
        return view('profiles.patient', compact('patient'));
    }
}
