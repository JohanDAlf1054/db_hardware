<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryProductController;
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
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsuariosController;
use App\Http\Controllers\CreditNoteSalesController;
use App\Http\Controllers\BackupController;


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

Route::get('/home', [HomeController::class,'index'])->name('home');

Route::get('/logout', [LogoutController::class,'logout']);

//Rutas y funciones para el login y recuperar contraseña

// Formulario donde el usuario pone su email para que le enviemos el email de resetear la contraseña
Route::get('/formulario-recuperar-contrasenia', [AuthController::class, 'formularioRecuperarContrasenia'])->name('formulario-recuperar-contrasenia');

// Función que se ejecuta al enviar el formulario y que enviará el email al usuario
Route::post('/enviar-recuperar-contrasenia', [AuthController::class, 'enviarRecuperarContrasenia'])->name('enviar-recuperacion');

// Formulario donde se modificará la contraseña
Route::get('/reiniciar-contrasenia/{token}', [AuthController::class, 'formularioActualizacion'])->name('formulario-actualizar-contrasenia');

// Función que actualiza la contraseña del usuario
Route::post('/actualizar-contrasenia', [AuthController::class, 'actualizarContrasenia'])->name('actualizar-contrasenia');

//Rutas para la vista de administrador
Route::resource('usuarios', UsuariosController::class)->only(['index', 'edit', 'update'])->names('admin.usuarios');



// Funcion de Productos
Route::resource('products', ProductController::class);
Route::resource('category', CategoryProductController::class);
Route::resource('brand', BrandController::class);
Route::resource('units', MeasurementUnitController::class);
Route::resource('categorySub', SubCategoryController::class);
Route::resource('sales', SalesController::class);
Route::resource('credit-note-sales', CreditNoteSalesController::class);
Route::resource('person', PersonController::class);
Route::resource('customer', CustomerController::class);
Route::resource('supplier', SupplierController::class);
Route::get('/obtener-detalle-venta', [CreditNoteSalesController::class, 'obtenerDetalleVenta']);
Route::get('/indexAll',[SubCategoryController::class, 'indexAll'])->name('indexAll');


//Funcion Importar
Route::post('/importbrands',[BrandController::class, 'importbrands'])->name('importbrands');
Route::post('/importCategory',[CategoryProductController::class, 'importCategory'])->name('importCategory');
Route::post('/importPerson', [PersonController::class, 'importPerson'])->name('importPerson');


//Funcion Export Informes
Route::get('export_index', [ExportController::class, 'index_informes'])->name('index_informes');
Route::get('/export', [ExportController::class, 'export'])->name('export');
Route::get('/export_person', [ExportController::class, 'exportperson'])->name('export.person');
Route::get('/export_sale', [ExportController::class, 'exportsale'])->name('export.sale');
Route::get('/export_creditnotesale', [ExportController::class, 'exportcreditnotesale'])->name('export.creditnotesale');
Route::get('/export_supplier', [ExportController::class, 'exportsupplier'])->name('export.supplier');
Route::get('/export_customer', [ExportController::class, 'exportcustomer'])->name('export.customer');
Route::get('/report', [ExportController::class,'report'])->name('report');
//rutas de historial de movimientos No Tocar y brayitan es mi hijo
Route::post('/buscar-historial', [App\Http\Controllers\HistorialMovimientoController::class, 'buscarMovimientos'])->name('buscar.historial');
Route::get('/historial', [App\Http\Controllers\HistorialMovimientoController::class, 'historialMovimientos'])->name('historial');
Route::get('/filtrar_por_fechas', 'HistorialMovimientoController@buscarMovimientos')->name('filtrar_por_fechas');
Route::get('/limpiar', [App\Http\Controllers\HistorialMovimientoController::class, 'limpiar'])->name('limpiar');
//Rutas de historial de precios
Route::get('/reportPriceHistoryProducts', [ExportController::class,'reportPriceHistoryProducts'])->name('reportPriceHistoryProducts');
Route::get('/reportPriceHistoryProductsPurchase', [ExportController::class,'reportPriceHistoryProductsPurchase'])->name('reportPriceHistoryProductsPurchase');


//Funcion de generar PDF
Route::get('Customer/pdf', [CustomerController::class, 'pdf'])->name('customer.pdf');
Route::get('Supplier/pdf', [SupplierController::class, 'pdf'])->name('supplier.pdf');
Route::get('Person/pdf', [PersonController::class, 'pdf'])->name('person.pdf');

//Funciones De Compras
Route::resource('purchase_supplier', App\Http\Controllers\PurchaseSupplierController::class);
Route::resource('detail-purchases', App\Http\Controllers\DetailPurchaseController::class);
Route::resource('debit-note-supplier', App\Http\Controllers\DebitNoteSupplierController::class);

// Descarga de template importar
Route::get('/downloadFile',[TemplateController::class, 'downloadFile'])->name('downloadFile');
Route::get('/downloadFileCategory',[TemplateController::class, 'downloadFileCategory'])->name('downloadFileCategory');
Route::get('/downloadFileBrands',[TemplateController::class, 'downloadFileBrands'])->name('downloadFileBrands');
Route::get('/downloadFileUnits',[TemplateController::class, 'downloadFileUnits'])->name('downloadFileUnits');



//Ruta para traer la informacion de las subcategorias
Route::get('/products/create/categoryProduct/{categoryProduct}/subCategories', [CategoryProductController::class,'subCategories']);
Route::get('/products/{id}/edit/categoryProduct/{categoryProduct}/subCategories', [CategoryProductController::class,'subCategoriesEdit']);

//Ruta para la gestion de usuario con el rol de Administrador
Route::resource('usuarios', UsuariosController::class)->only(['index', 'edit', 'update'])->names('admin.usuarios');

Route::get('/seleccionar-producto', [ExportController::class, 'report'])->name('seleccionar-producto');
Route::get('/historial-precios', [ExportController::class, 'report'])->name('historial-precios');

//Rutas para generar los backups
Route::get('/backup/create', [BackupController::class, 'backup'])->name('backup-create');
Route::get('/backup/system', [BackupController::class, 'backupSystem'])->name('backup-system');
Route::get('/restore/backup', [BackupController::class, 'restoreBackup'])->name('restore-backup');

//Filtrar historial de precios
Route::get('/filtrar/precios', [ExportController::class, 'filtrar'])->name('filtrar_por_fechas');
Route::get('/filtrar/precios/purchase', [ExportController::class, 'filtrarPurchase'])->name('filtrarPurchase');
