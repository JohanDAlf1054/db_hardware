<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $proveedores = Person::where('rol','Proveedor')->get();
        return view('supplier.index', compact('proveedores'));
    }
}
