<?php
use App\Http\Controllers\PosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestingController;
Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', [TestingController::class, 'index'])->name('test');

Route::get('/pos/{centers}',[PosController::class, 'pos'])->name('pos');
Route::get('invoice/{centers}/{salesorder}',[PosController::class, 'invoicePos'])->name('patient.invoice');


Route::get('api/products/{centers}',[PosController::class, 'getProducts'])->name('product.get');

Route::get('api/patients',[PosController::class, 'getPatients'])->name('patient.get');

Route::post('post-order',[PosController::class, 'postOrder'])->name('patient.postOder');

Route::get('pos-portal',[PosController::class, 'posPortal'])->name('patient.posPortal');

Route::post('product-barcode',[PosController::class, 'productBarcode'])->name('product.barcode');
Route::get('product-barcode-print/{product}/{qty}',[PosController::class, 'productBarcodePrint'])->name('product.print-barcode');




