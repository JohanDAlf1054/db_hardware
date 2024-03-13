<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        // Barra de busqueda
        $filtervalue = $request->input('filtervalue');

        $proveedores = Person::query()
        ->where('rol', 'Proveedor')
        ->where(function ($query) use ($filtervalue) {
            $query->where('first_name', 'like', '%' . $filtervalue . '%')
                ->orWhere('surname', 'like', '%' . $filtervalue . '%')
                ->orWhere('email_address', 'like', '%' . $filtervalue . '%')
                ->orWhere('company_name', 'like', '%' . $filtervalue . '%');
        })
        ->paginate();

    return view('supplier.index', [
        'proveedores' => $proveedores
    ])->with('i', (request()->input('page', 1) - 1) * $proveedores->perPage());


        $proveedores = Person::where('rol','Proveedor')->get();
        return view('supplier.index', compact('proveedores'));
    }

    // Funcion para inactivar un proveedor
    public function destroy($id)
    {
        $proveedores = Person::find($id);

        if ($proveedores->status == true) {
            Person::where('id', $proveedores->id)
                ->update([
                    'status' => false,
                ]);
        } else {
            Person::where('id', $proveedores->id)
                ->update([
                    'status' => true,
                ]);
        }


        return redirect()->route('supplier.index')
            ->with('success', 'Se ha inactividado a la persona.');
    }
}
