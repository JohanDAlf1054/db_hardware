<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CategoryProductsSubController;
use App\Http\Controllers\CategorySubController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\MeasurementUnitController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Funcion de Productos
Route::resource('products', ProductController::class);
Route::resource('category', CategoryProductController::class);
Route::resource('brand', BrandController::class);
Route::resource('units', MeasurementUnitController::class);
Route::resource('categorySub', SubCategoryController::class);
Route::resource('sales', SalesController::class);
Route::resource('person', PersonController::class);

//Funcion Export Informes
Route::get('export_index', [ExportController::class, 'index_informes'])->name('index_informes');
Route::get('/export', [ExportController::class, 'export'])->name('export');