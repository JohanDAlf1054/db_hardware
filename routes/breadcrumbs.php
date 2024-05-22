<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\credit_note_sales;
use App\Models\DebitNoteSupplier;
use App\Models\DetailPurchase;
use App\Models\Person;
use App\Models\Product;
use App\Models\PurchaseSupplier;
use App\Models\Sale;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home');
});

// Productos
Breadcrumbs::for('products', function (BreadcrumbTrail $trail) {
    $trail->push('Productos', route('products.index'));
});

// Productos > Crear productos
Breadcrumbs::for('product.create', function (BreadcrumbTrail $trail) {
    $trail->parent('products');
    $trail->push('Crear producto', route('products.create'));
});

//Productos > Editar producto
Breadcrumbs::for('product.edit', function (BreadcrumbTrail $trail, Product $producto) {
    $trail->parent('products');
    $trail->push('Editar');
    $trail->push($producto->name_product, route('products.edit', $producto));
});

//Productos > Ver producto
Breadcrumbs::for('product.show', function (BreadcrumbTrail $trail, Product $producto) {
    $trail->parent('products');
    $trail->push('Ver');
    $trail->push($producto->name_product, route('products.show', $producto));
});

//Productos > Crear categoria
Breadcrumbs::for('category.index', function (BreadcrumbTrail $trail) {
    $trail->parent('products');
    $trail->push('Crear categoría', route('category.index'));
});

//Productos > Craer categoria > Crear sub categorria
Breadcrumbs::for('sub-category.index', function (BreadcrumbTrail $trail) {
    $trail->parent('category.index');
    $trail->push('Crear Subcategoría', route('categorySub.index'));
});

//Productos > Crear marca
Breadcrumbs::for('brand.index', function (BreadcrumbTrail $trail) {
    $trail->parent('products');
    $trail->push('Crear marca', route('brand.index'));
});

//Productos > Crear unidad
Breadcrumbs::for('units.index', function (BreadcrumbTrail $trail) {
    $trail->parent('products');
    $trail->push('Crear unidad', route('units.index'));
});

//Compras
Breadcrumbs::for('compras.index', function (BreadcrumbTrail $trail) {
    $trail->push('Compras', route('purchase_supplier.index'));
});

//Compras > Mostrar
Breadcrumbs::for('compras.show', function (BreadcrumbTrail $trail, PurchaseSupplier $purchaseSupplier) {
    $trail->parent('compras.index');
    $trail->push('Mostrar');
    $trail->push($purchaseSupplier->id);
});

//Compras > Editar
Breadcrumbs::for('compras.edit', function (BreadcrumbTrail $trail, PurchaseSupplier $purchaseSupplier) {
    $trail->parent('compras.index');
    $trail->push('Editar');
    $trail->push($purchaseSupplier->id);
});

//Compras > Mostrar detalle de compras
Breadcrumbs::for('detail.purchase', function (BreadcrumbTrail $trail) {
    $trail->parent('compras.index');
    $trail->push('Crear compra', route('detail-purchases.index'));
});

//Compras > Mostrar detalle de compras >Crear detalle de compra
Breadcrumbs::for('detail.purchase.create', function (BreadcrumbTrail $trail) {
    $trail->parent('detail.purchase');
    $trail->push('Crear detalle de la compra');
});

//Compras > Mostrar detalle de compra > Mostrar
Breadcrumbs::for('detail.purchase.show', function (BreadcrumbTrail $trail, DetailPurchase $detailPurchase) {
    $trail->parent('detail.purchase');
    $trail->push('Mostrar');
    $trail->push($detailPurchase->id);
});


//Compras > Mostrar nota debito
Breadcrumbs::for('debit-note-supplier.index', function (BreadcrumbTrail $trail) {
    $trail->parent('compras.index');
    $trail->push('Mostrar nota debito', route('debit-note-supplier.index'));
});

//Compras > Mostrar nota debito > Crear nota debito
Breadcrumbs::for('debit.note.supplier.create', function (BreadcrumbTrail $trail) {
    $trail->parent('debit-note-supplier.index');
    $trail->push('Crear nota debito');
});

//Compras > Mostrar nota debito > Mostrar
Breadcrumbs::for('debit.note.supplie.show', function (BreadcrumbTrail $trail, DebitNoteSupplier $debitNoteSupplier) {
    $trail->parent('debit-note-supplier.index');
    $trail->push('Mostrar');
    $trail->push($debitNoteSupplier->id);
});


//Personas
Breadcrumbs::for('person.index', function (BreadcrumbTrail $trail) {
    $trail->push('Personas', route('person.index'));
});

//Personas > Crear
Breadcrumbs::for('person.create', function (BreadcrumbTrail $trail) {
    $trail->parent('person.index');
    $trail->push('Crear personas');
});

//Personas > Mostrar
Breadcrumbs::for('person.show', function (BreadcrumbTrail $trail, Person $person) {
    $trail->parent('person.index');
    $trail->push('Mostrar');
    $trail->push($person->identification_number);
});

// Personas > Proveedores
Breadcrumbs::for('supplier.index', function (BreadcrumbTrail $trail) {
    $trail->parent('person.index');
    $trail->push('Proveedores', route('supplier.index'));
});

// Personas > Clientes
Breadcrumbs::for('customer.index', function (BreadcrumbTrail $trail) {
    $trail->parent('person.index');
    $trail->push('Clientes', route('customer.index'));
});
// Personas > Proveedores > Editar
Breadcrumbs::for('supplier.edit', function (BreadcrumbTrail $trail, Person $person) {
    $trail->parent('supplier.index');
    $trail->push('Editar');
    $trail->push($person->identification_number);
});

// Personas > Proveedores > Mostrar
Breadcrumbs::for('supplier.show', function (BreadcrumbTrail $trail, Person $person) {
    $trail->parent('supplier.index');
    $trail->push('Mostrar');
    $trail->push($person->identification_number);
});

// Personas > Clientes > Editar
Breadcrumbs::for('customer.edit', function (BreadcrumbTrail $trail, Person $person) {
    $trail->parent('customer.index');
    $trail->push('Editar');
    $trail->push($person->identification_number);
});

//Personas > Clientes > Mostrar
Breadcrumbs::for('customer.show', function (BreadcrumbTrail $trail, Person $person) {
    $trail->parent('customer.index');
    $trail->push('Mostrar');
    $trail->push($person->identification_number);
});

//Ventas
Breadcrumbs::for('sales.index', function (BreadcrumbTrail $trail) {
    $trail->push('Ventas', route('sales.index'));
});
// Ventas > Mostrar
Breadcrumbs::for('sales.show', function (BreadcrumbTrail $trail, Sale $sale) {
    $trail->parent('sales.index');
    $trail->push('Mostrar');
    $trail->push($sale->id);
});

// Ventas > Crear
Breadcrumbs::for('sales.create', function (BreadcrumbTrail $trail) {
    $trail->parent('sales.index');
    $trail->push('Crear venta');
});

//Ventas > Notas credito
Breadcrumbs::for('credit.note.sales', function (BreadcrumbTrail $trail) {
    $trail->parent('sales.index');
    $trail->push('Notas crédito', route('credit-note-sales.index'));
});

//Ventas > Notas credito > Mostrar
Breadcrumbs::for('credit.note.sales.show', function (BreadcrumbTrail $trail, credit_note_sales $credit_note_sale) {
    $trail->parent('credit.note.sales');
    $trail->push('Mostrar');
    $trail->push($credit_note_sale->id);
});

//Ventas > Crear nota credito
Breadcrumbs::for('credit.note.sales.create', function (BreadcrumbTrail $trail) {
    $trail->parent('sales.index');
    $trail->push('Crear nota crédito');
});

//Administrador
Breadcrumbs::for('admin.index', function (BreadcrumbTrail $trail) {
    $trail->push('Usuarios', route('admin.usuarios.index'));
});

//Administrador -> roles
Breadcrumbs::for('admin.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Roles');
});

//Administrador -> Backup
Breadcrumbs::for('backup', function (BreadcrumbTrail $trail) {
    $trail->push('Copia de seguridad',route('backup-create'));
});
