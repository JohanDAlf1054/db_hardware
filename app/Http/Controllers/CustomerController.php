<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        // Barra de busqueda
        $filtervalue = $request->input('filtervalue');

        $clientes = Person::query()
            ->where('rol', 'Cliente')
            ->when($filtervalue, function ($query) use ($filtervalue) {
                return $query->where('identification_number', 'like', '%' . $filtervalue . '%')
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

        return view('customer.index', [
            'clientes' => $clientes
        ])->with('i', (request()->input('page', 1) - 1) * $clientes->perPage());


        $clientes = Person::where('rol','Cliente')->get();
        return view('customer.index', compact('clientes'));
    }

    public function edit($id)
    {
        $person = Person::findOrFail($id);
        $table = 'customer';
        return view('person.edit', compact('person', 'table'));
    }

    public function update(Request $request, Person $person)
    {
        $data = $request->all();
        $data['id'] = $person->id;

        $rules = Person::staticRules($data);

        $validator = Validator::make($data, $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // request()->validate(Person::staticRules($data));

        $person->update($request->all());

        Session::flash('notificacion', [
            'tipo' => 'exito',
            'titulo' => 'Éxito!',
            'descripcion' => 'La persona se ha modificado exitosamente.',
            'autoCierre' => 'true'
        ]);

        return redirect()->route('customer.index');
    }

    public function show($id)
    {
        $person = Person::findOrFail($id);
        $table = 'customer';
        return view('person.show', compact('person', 'table'));
    }

    public function destroy($id)
    {
        $clientes = Person::find($id);

        if ($clientes->status == true) {
            Person::where('id', $clientes->id)
                ->update([
                    'status' => false,
                ]);
            Session::flash('notificacion', [
                'tipo' => 'error',
                'titulo' => 'Atencion!',
                'descripcion' => 'La persona se ha inactivado.',
                'autoCierre' => 'true'
            ]);
        } else {
            Person::where('id', $clientes->id)
                ->update([
                    'status' => true,
                ]);
            Session::flash('notificacion', [
                'tipo' => 'exito',
                'titulo' => 'Exito!',
                'descripcion' => 'La persona se activado.',
                'autoCierre' => 'true'
            ]);
        }

        return redirect()->route('customer.index');
    }
    public function pdf()
    {
        $clientes = Person::where('rol','Cliente')->get();

        $pdf = Pdf::loadView('customer.pdf', ['clientes' => $clientes])
                    ->setPaper('a4','landscape');

        // Funcion para devolver una vista del pdf en el navegador
        return $pdf->stream('Clientes.pdf');

        //Descargar el pdf directamente
        // return $pdf->download('Informe de Clientes.pdf');
    }
}
