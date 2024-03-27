<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

/**
 * Class PersonController
 * @package App\Http\Controllers
 */
class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Barra de busqueda
        $filtervalue = $request->input('filtervalue');

        $people = Person::query()
            ->when($filtervalue, function($query) use ($filtervalue) {
                return $query->where('identification_number','like','%'.$filtervalue.'%');
            })
            ->orWhere('first_name','like','%'.$filtervalue.'%')
            ->orWhere('surname','like','%'.$filtervalue.'%')
            ->orWhere('email_address','like','%'.$filtervalue.'%')
            ->orWhere('company_name','like','%'.$filtervalue.'%')
            ->paginate();


            return view('person.index',[
                'people' => $people,
            ])->with('i', (request()->input('page', 1) - 1) * $people->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $person = new Person();
        return view('person.create', compact('person'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        request()->validate(Person::$rules);

        //Validacion de acuerdo a la seleccion de Persona natural o juridica

        if($request->input('person_type') === 'Persona natural'){
            Person::$rules['first_name'] = 'required|string';
            Person::$rules['other_name'] = 'nullable|string';
            Person::$rules['surname'] = 'required|string';
            Person::$rules['second_surname'] = 'nullable|string';
            Person::$rules['company_name'] = 'nullable|string';
        }elseif($request->input('person_type') === 'Persona jurídica'){
            Person::$rules['company_name'] = 'required|string';
            Person::$rules['first_name'] = 'nullable|string';
            Person::$rules['other_name'] = 'nullable|string';
            Person::$rules['surname'] = 'nullable|string';
            Person::$rules['second_surname'] = 'nullable|string';
        }

        $request->validate((Person::$rules));

        $person = Person::create($request->all());
        Session::flash('notificacion', [
            'tipo' => 'exito',
            'titulo' => 'Éxito!',
            'descripcion' => 'La persona se ha creado exitosamente.',
            'autoCierre' => 'true'
        ]);

        // Obtener el tipo de tercero seleccionado
        $tipo_tercero = $request->input('rol');

        // Redireccionar al índice correspondiente
        if ($tipo_tercero === 'Cliente') {
            return redirect()->route('customer.index');
            Session::flash('notificacion', [
                'tipo' => 'exito',
                'titulo' => 'Éxito!',
                'descripcion' => 'La persona se ha creado exitosamente.',
                'autoCierre' => 'true'
            ]);
        } elseif ($tipo_tercero === 'Proveedor') {
            return redirect()->route('supplier.index');
            Session::flash('notificacion', [
                'tipo' => 'exito',
                'titulo' => 'Éxito!',
                'descripcion' => 'La persona se ha creado exitosamente.',
                'autoCierre' => 'true'
            ]);
        } else {
            return redirect()->route('person.index');
            Session::flash('notificacion', [
                'tipo' => 'exito',
                'titulo' => 'Éxito!',
                'descripcion' => 'La persona se ha creado exitosamente.',
                'autoCierre' => 'true'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $person = Person::find($id);

        return view('person.show', compact('person'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = Person::find($id);

        return view('person.edit', compact('person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Person $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        request()->validate(Person::$rules);

        $person->update($request->all());

        Session::flash('notificacion', [
            'tipo' => 'exito',
            'titulo' => 'Éxito!',
            'descripcion' => 'La persona se ha modificado exitosamente.',
            'autoCierre' => 'true'
        ]);

        return redirect()->route('person.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */

    // Esta funcion ya se encuentra en el controlador de cliente y proveedores.
    public function destroy($id)
    {
        $person = Person::find($id);

        if ($person->status == true) {
            Person::where('id', $person->id)
                ->update([
                    'status' => false,
                ]);
        } else {
            Person::where('id', $person->id)
                ->update([
                    'status' => true,
                ]);
        }

        Session::flash('notificacion', [
            'tipo' => 'error',
            'titulo' => 'Atencion!',
            'descripcion' => 'La persona se ha inactivado.',
            'autoCierre' => 'true'
        ]);

        return redirect()->route('person.index');
    }
}
