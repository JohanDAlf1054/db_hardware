<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Creación de la variable donde guarda la información de los usuarios registrados en el sistema.
    $usuarios = User::all();

    // Barra de búsqueda
    $filtervalue = $request->input('filtervalue');

    $usuarioBusqueda = User::query()
        ->when($filtervalue, function($query) use ($filtervalue){
            return $query->where('identification_number','like','%'.$filtervalue.'%');
        })
        ->orWhere('name','like','%' .$filtervalue. '%')
        ->orWhere('email','like','%' .$filtervalue. '%')
        ->paginate();

    return view('admin.usuarios.index', [
        'usuarios' => $usuarioBusqueda, 
    ])->with('i', (request()->input('page', 1) -1) * $usuarioBusqueda->perPage());
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
