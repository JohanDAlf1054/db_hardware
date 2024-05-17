<?php

namespace App\Http\Controllers;

use App\Exports\CreditNoteExport;
use App\Exports\ProductsExport;
use App\Exports\CreditNoteSaleExport;
use App\Exports\PeopleExport;
use App\Models\CategoryProduct;
use App\Models\DetalleVenta;
use App\Models\Product;
use App\Models\Person;
use App\Models\Sale;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SaleExport;
use Google\Service\VMwareEngine\Credentials;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function index_informes()
    {
        return view('reports.export');
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'Productos.xlsx');
    }

    public function report(Request $request)
    {
        $ventas = DetalleVenta::all();
        return view('reports.reportProduct', compact('ventas'));
    }

    public function show(Sale $sale)
    {
        return view('sales.show',compact('sale'));
    }

    public function exportperson()
    {
        return Excel::download(new PeopleExport('all'), 'Personas.xlsx');
    }

    public function exportsupplier()
    {
        return Excel::download(new PeopleExport('supplier'),'Proveedores.xlsx');
    }

    public function exportcustomer()
    {
        return Excel::download(new PeopleExport('customer'),'Clientes.xlsx');
    }

    public function exportcreditnotesale()
    {
        return Excel::download(new CreditNoteExport('credit_note_sales'),'Notas credito Ventas.xlsx');
    }


    public function exportsale()
    {
        return Excel::download(new SaleExport('sale'),'Ventas.xlsx');
    }

   


}
