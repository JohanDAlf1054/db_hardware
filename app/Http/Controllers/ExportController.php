<?php

namespace App\Http\Controllers;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function index_informes()
    {
        return view('product.export');
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
}
