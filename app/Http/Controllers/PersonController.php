<?php

namespace App\Http\Controllers;

use App\Exports\PeopleExport;
use App\Imports\PersonImport;
use App\Models\Person;
use App\Models\Municipality;
use App\Exports\PersonTemplateExport;
use App\Models\Country;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

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
            ->orWhere('identification_number','like','%'.$filtervalue.'%')
            ->orWhere('first_name','like','%'.$filtervalue.'%')
            ->orWhere('other_name','like','%'.$filtervalue.'%')
            ->orWhere('surname','like','%'.$filtervalue.'%')
            ->orWhere('second_surname','like','%'.$filtervalue.'%')
            ->orWhere('email_address','like','%'.$filtervalue.'%')
            ->orWhere('company_name','like','%'.$filtervalue.'%')
            ->orWhere('city','like','%'.$filtervalue.'%')
            ->orWhere('phone','like','%'.$filtervalue.'%')
            ->paginate();

        // Retorna la vista con la lista de personas

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
        $table = 'person';
        $municipalities = Municipality::with('department.country')->get();
        $people = Person::with('municipality')->get();

        return view('person.create', compact('person', 'municipalities', 'people', 'table'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $rules = Person::staticRules($request->all());

        //Validacion de acuerdo a la seleccion de Persona natural o juridica
        if ($request->input('person_type') === 'Persona natural') {
            // Hacer que los campos relacionados con la persona jurídica sean opcionales
            unset($rules['company_name']);
        } elseif ($request->input('person_type') === 'Persona jurídica') {
            // Hacer que los campos relacionados con la persona natural sean opcionales
            unset($rules['first_name']);
            unset($rules['other_name']);
            unset($rules['surname']);
            unset($rules['second_surname']);
        }

        $request->validate($rules);

        // Crear validación adicional para evitar la repetición de company_name
        if ($request->input('person_type') === 'Persona jurídica') {
            $existingCompanyNames = Person::where('company_name', $request->input('company_name'))->count();
            if ($existingCompanyNames > 0) {
                return redirect()->back()->withInput()->withErrors(['company_name' => 'El nombre de la compañía ya está en uso.']);
            }
        }

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
        } elseif ($tipo_tercero === 'Proveedor') {
            return redirect()->route('supplier.index');
        } else {
            return redirect()->route('person.index');
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
        $table = 'person';
        return view('person.show', compact('person','table'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = Person::with('municipality')->findOrFail($id);
        $municipalities = Municipality::with('department.country')->get();

        return view('person.edit', compact('person', 'municipalities'));

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
        $data = $request->all();
        $data['id'] = $person->id;

        $rules = Person::staticRules($data);

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $person->update($request->all());

        Session::flash('notificacion', [
            'tipo' => 'exito',
            'titulo' => 'Éxito!',
            'descripcion' => 'La persona se ha modificado exitosamente.',
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

    public function importPerson(Request $request)
    {
        try {
            $request->validate([
                'import_filePerson' => 'required|file|mimes:xlsx,xls,csv',
            ]);

            $file = $request->file('import_filePerson');
            Excel::import(new PersonImport, $file);

            Session::flash('notificacion', [
                'tipo' => 'exito',
                'titulo' => 'Éxito!',
                'descripcion' => 'Datos de personas importados de forma exitosa.',
                'autoCierre' => 'true'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errores = $e->validator->errors()->all();
            $descripcion = implode(' ', $errores);

            Session::flash('notificacion', [
                'tipo' => 'error',
                'titulo' => 'Atención!',
                'descripcion' => $descripcion,
                'autoCierre' => 'true'
            ]);

        } catch (\Exception $e) {
            Session::flash('notificacion', [
                'tipo' => 'error',
                'titulo' => 'Atención!',
                'descripcion' => 'Ocurrió un error al importar el archivo. Por favor, asegúrate de que el archivo esté en el formato correcto y vuelve a intentarlo.',
                'autoCierre' => 'true'
            ]);
        }

        return redirect()->route('person.index');
    }

    public function pdf()
    {
        $people = Person::all();

        $pdf = Pdf::loadView('person.pdf', ['people' => $people])
                    ->setPaper('a4','landscape');

        // Funcion para devolver una vista del pdf en el navegador
        return $pdf->stream('Personas.pdf');

        //Descargar el pdf directamente
        // return $pdf->download('Informe de Personas.pdf');
    }



}
