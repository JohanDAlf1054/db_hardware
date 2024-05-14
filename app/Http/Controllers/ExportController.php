<?php

namespace App\Http\Controllers;
use App\Exports\ProductsExport;
use App\Models\CategoryProduct;
use App\Models\DetalleVenta;
use App\Models\Product;
use App\Models\Sale;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function index_informes()
    {
        return view('reports.export');
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
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
}
