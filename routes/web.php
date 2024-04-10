<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CategoryProductsSubController;
use App\Http\Controllers\CategorySubController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MeasurementUnitController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseSupplierController;
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
    return view('auth.login');
});

//Rutas del login y registro
Route::get('/register', [RegisterController::class,'show']);
Route::post('/register', [RegisterController::class,'register']);

Route::get('/login', [LoginController::class,'show']);
Route::post('/login', [LoginController::class,'login']);

Route::get('/home', [HomeController::class,'index']);

Route::get('/logout', [LogoutController::class,'logout']);

Route::get('/People', function () {
    return view('people.index');
});


//Rutas y funciones para el login y recuperar contraseña

// Formulario donde el usuario pone su email para que le enviemos el email de resetear la contraseña
Route::get('/formulario-recuperar-contrasenia', [AuthController::class, 'formularioRecuperarContrasenia'])->name('formulario-recuperar-contrasenia');

// Función que se ejecuta al enviar el formulario y que enviará el email al usuario
Route::post('/enviar-recuperar-contrasenia', [AuthController::class, 'enviarRecuperarContrasenia'])->name('enviar-recuperacion');

// Formulario donde se modificará la contraseña
Route::get('/reiniciar-contrasenia/{token}', [AuthController::class, 'formularioActualizacion'])->name('formulario-actualizar-contrasenia');

// Función que actualiza la contraseña del usuario
Route::post('/actualizar-contrasenia', [AuthController::class, 'actualizarContrasenia'])->name('actualizar-contrasenia');


// Funcion de Productos
Route::resource('products', ProductController::class);
Route::resource('category', CategoryProductController::class);
Route::resource('brand', BrandController::class);
Route::resource('units', MeasurementUnitController::class);
Route::resource('categorySub', SubCategoryController::class);
Route::resource('sales', SalesController::class);
Route::resource('person', PersonController::class);
Route::resource('customer', CustomerController::class);
Route::resource('supplier', SupplierController::class);

//Funcion Export Informes
Route::get('export_index', [ExportController::class, 'index_informes'])->name('index_informes');
Route::get('/export', [ExportController::class, 'export'])->name('export');

//Funciones De Compras
Route::resource('purchase_supplier', App\Http\Controllers\PurchaseSupplierController::class);
Route::resource('detail-purchases', App\Http\Controllers\DetailPurchaseController::class);
Route::resource('debit-note-supplier', App\Http\Controllers\DebitNoteSupplierController::class);
Route::post('/guardar-datos', 'DatosController@guardarDatos');