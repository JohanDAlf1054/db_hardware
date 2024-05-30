<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

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
            ->orWhere('first_name','like','%'.$filtervalue.'%')
            ->orWhere('identification_number','like','%'.$filtervalue.'%')
            ->orWhere('first_name','like','%'.$filtervalue.'%')
            ->orWhere('other_name','like','%'.$filtervalue.'%')
            ->orWhere('surname','like','%'.$filtervalue.'%')
            ->orWhere('second_surname','like','%'.$filtervalue.'%')
            ->orWhere('email_address','like','%'.$filtervalue.'%')
            ->orWhere('company_name','like','%'.$filtervalue.'%')
            ->orWhere('phone','like','%'.$filtervalue.'%');
        })
        ->paginate();

    return view('supplier.index', [
        'proveedores' => $proveedores
    ])->with('i', (request()->input('page', 1) - 1) * $proveedores->perPage());


        $proveedores = Person::where('rol','Proveedor')->get();
        return view('supplier.index', compact('proveedores'));
    }

    public function edit($id)
{
    $person = Person::with('municipality')->findOrFail($id);
    $municipalities = Municipality::with('department.country')->get();
    $table = 'supplier';

    return view('person.edit', compact('person', 'municipalities', 'table'));
}

public function show($id)
{
    $person = Person::findOrFail($id);
    $table = 'supplier';
    return view('person.show', compact('person', 'table'));
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
            Session::flash('notificacion', [
                'tipo' => 'error',
                'titulo' => 'Atención!',
                'descripcion' => 'La persona se ha inactivado.',
                'autoCierre' => 'true'
            ]);
        } else {
            Person::where('id', $proveedores->id)
                ->update([
                    'status' => true,
                ]);
            Session::flash('notificacion', [
                'tipo' => 'exito',
                'titulo' => 'Exito!',
                'descripcion' => 'La persona se  ha activado.',
                'autoCierre' => 'true'
            ]);
        }


        return redirect()->route('supplier.index');
    }

    public function pdf()
    {
        $proveedores = Person::where('rol','Proveedor')->get();

        $pdf = Pdf::loadView('supplier.pdf', ['proveedores' => $proveedores])
        ->setPaper('a4','landscape');

        // Funcion para devolver una vista del pdf en el navegador
        return $pdf->stream('Proveedores.pdf');

        //Descargar el pdf directamente
        // return $pdf->download('Informe de Proveedores.pdf');
    }
}
