<?php

namespace App\Http\Controllers;

use App\Models\DoctorAppointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    public function getAppointments(Request $request)
    {
        // Validate input
        $request->validate([
            'year' => 'required|integer|min:1900|max:2100',
            'month' => 'required|integer|min:1|max:12',
        ]);

        $year = $request->input('year');
        $month = $request->input('month');

        // Fetch appointments from the database
        $appointments = DoctorAppointment::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get()
            ->groupBy(function ($appointment) {
                return date('Y-m-d', strtotime($appointment->date)); // Group by date only (no time)
            })
            ->map(function ($appointments) {
                return $appointments->pluck('description')->toArray(); // Extract descriptions
            });

        return response()->json($appointments);
    }

    public function store(Request $request)
    {
       $doctor =  DoctorAppointment::create([
            'description' => $request->input('description'),
            'status' => 'pending',
            'date' => $request->input('date'),
            'patient_id' => $request->input('patient_id_doc_appointment'),
            'center_id' => $request->input('center_id'),
            'doctor_id' => $request->input('doctor_id'),
        ]);

        return back()->with('success', 'Appointment created successfully!');
    }
}
