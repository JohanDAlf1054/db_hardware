<?php

namespace App\Http\Controllers;
use App\Exports\ProductsExport;
use App\Models\CategoryProduct;
use App\Models\Product;
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
        $categoryId = $request->input('category_filter');
        $productID = $request->input('product_filter');
        
        $categories = CategoryProduct::all();
        $products = Product::all();
        return view('reports.reportProduct',  compact('categories', 'products'));
    }
}
