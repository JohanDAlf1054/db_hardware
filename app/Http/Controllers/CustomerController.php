<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        // Barra de busqueda
        $filtervalue = $request->input('filtervalue');

        $clientes = Person::query()
            ->when($filtervalue, function($query) use ($filtervalue) {
                return $query->where('identification_number','like','%'.$filtervalue.'%');
            })
            ->orWhere('first_name','like','%'.$filtervalue.'%')
            ->orWhere('surname','like','%'.$filtervalue.'%')
            ->orWhere('email_address','like','%'.$filtervalue.'%')
            ->orWhere('company_name','like','%'.$filtervalue.'%')
            ->paginate();

            return view('customer.index',[
                'clientes' => $clientes
            ])->with('i', (request()->input('page', 1)-1)* $clientes->perPage());

        $clientes = Person::where('rol','Cliente')->get();
        return view('customer.index', compact('clientes'));
    }

    public function edit($id)
    {
        $person = Person::find($id);

        return view('person.edit', compact('person'));
    }

    public function update(Request $request, Person $person)
    {
        request()->validate(Person::$rules);

        $person->update($request->all());

        return redirect()->route('customer.index')
            ->with('success', 'Persona modificada exitosamente.');
    }

    // Revisar esta funcion de inactivar porque solo esta sirviendo el de personController
    public function destroy($id)
    {
        $clientes = Person::find($id);

        if ($clientes->status == true) {
            Person::where('id', $clientes->id)
                ->update([
                    'status' => false,
                ]);
        } else {
            Person::where('id', $clientes->id)
                ->update([
                    'status' => true,
                ]);
        }

        return redirect()->route('customer.index')
            ->with('success', 'Se ha inactividado a la persona.');
    }
}