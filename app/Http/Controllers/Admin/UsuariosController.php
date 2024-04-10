<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;

class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.usuarios.index')->only('index');
        $this->middleware('can:admin.usuarios.edit')->only('edit','update');
    }

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
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //Traer el usuario por medio del id
        $usuario = User::findOrFail($id);

        //Traer losroles pormedio del modelo y gurdarlos en la variable
        $roles = Role::all();
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario)
    {
    $usuario->roles()->sync($request->roles);

    Session::flash('notificacion', [
        'tipo' => 'exito',
        'titulo' => 'Éxito!',
        'descripcion' => 'Se asignaron los roles correctamente.',
        'autoCierre' => 'true'
    ]);
    return redirect()->route('admin.usuarios.index', $usuario);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
