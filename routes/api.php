<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;



Route::post('patients',[PosController::class, 'addPatients'])->name('patient.add');
