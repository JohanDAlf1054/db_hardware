<?php

namespace App\Http\Controllers;

use App\Imports\UnitsImpot;
use App\Models\MeasurementUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;


/**
 * Class MeasurementUnitController
 * @package App\Http\Controllers
 */
class MeasurementUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $measurementUnits = MeasurementUnit::paginate();

        return view('measurement-unit.index', compact('measurementUnits'))
            ->with('i', (request()->input('page', 1) - 1) * $measurementUnits->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $measurementUnit = new MeasurementUnit();
        return view('measurement-unit.create', compact('measurementUnit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'import_file' => 'required|mimes:xlsx'
        ]);

        if ($validator->fails()) {
            Session::flash('notificacion', [
                'tipo' => 'error',
                'titulo' => 'Error!',
                'descripcion' => 'Archivo incorrecto, debe de ser de extensión xlsx.',
                'autoCierre' => 'true'
            ]);
            return redirect()->route('units.index');
        }
        try {
            $file = $request->file('import_file');

            Excel::import(new UnitsImpot, $file, 'xlsx');
            Session::flash('notificacion', [
                'tipo' => 'exito',
                'titulo' => 'Éxito!',
                'descripcion' => 'Unidades Agregadas!.',
                'autoCierre' => 'true'
            ]);
            return redirect()->route('units.index');
        } catch (\Exception $e){
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
        $measurementUnit = MeasurementUnit::find($id);

        return view('measurement-unit.show', compact('measurementUnit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $measurementUnit = MeasurementUnit::find($id);

        return view('measurement-unit.edit', compact('measurementUnit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  MeasurementUnit $measurementUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MeasurementUnit $measurementUnit)
    {
        request()->validate(MeasurementUnit::$rules);

        $measurementUnit->update($request->all());

        return redirect()->route('measurement-units.index')
            ->with('success', 'MeasurementUnit updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $measurementUnit = MeasurementUnit::find($id)->delete();

        return redirect()->route('measurement-units.index')
            ->with('success', 'MeasurementUnit deleted successfully');
    }

    public function import()
    {
        return view('measurement-unit.importUnits');
    }
}
