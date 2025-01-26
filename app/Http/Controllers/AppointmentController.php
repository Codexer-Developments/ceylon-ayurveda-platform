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

        // Example: Simulating fetching appointments from a database
        $appointments = [
            '2025-01-01' => ['Meeting with John', 'Doctor Appointment'],
            '2025-01-05' => ['Team Lunch'],
            '2025-01-12' => ['Project Deadline'],
        ];

        // Filter appointments for the requested year and month
        $filteredAppointments = array_filter($appointments, function ($date) use ($year, $month) {
            return date('Y', strtotime($date)) == $year && date('n', strtotime($date)) == $month;
        }, ARRAY_FILTER_USE_KEY);

        return response()->json($filteredAppointments);
    }

    public function store(Request $request)
    {
        DoctorAppointment::create([
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'date' => $request->input('date'),
            'patient_id' => $request->input('patient_id_doc_appointment'),
            'center_id' => $request->input('center_id'),
            'doctor_id' => $request->input('doctor_id'),
        ]);
    }
}
