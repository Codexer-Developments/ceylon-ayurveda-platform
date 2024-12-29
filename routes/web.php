<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\PosController;
Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', [TestingController::class, 'index'])->name('test');

Route::get('/pos/{centers}',[PosController::class, 'pos'])->name('pos');

Route::get('api/products/{centers}',[PosController::class, 'getProducts'])->name('product.get');

Route::get('api/patients',[PosController::class, 'getPatients'])->name('patient.get');


