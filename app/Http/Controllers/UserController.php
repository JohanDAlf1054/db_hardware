<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{

    public function register(Request $request){
        //Validar los datos
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        Auth::login($user);

        return redirect(route('privada'));
    }

    public function login(Request $request){

    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }

    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone_number' => 'required|string|max:15',
        'document_type' => 'required|string|max:3',
        'identification_number' => 'required|unique:users,identification_number,' . $user->id,
        'password' => 'nullable|min:8|confirmed'
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone_number = $request->phone_number;
    $user->document_type = $request->document_type;
    $user->identification_number = $request->identification_number;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    Session::flash('notificacion', [
        'tipo' => 'exito',
        'titulo' => 'Exito!',
        'descripcion' => 'La Informacion del perfil se ha actualizado exitosamente.',
        'autoCierre' => 'true'
    ]);

    return redirect()->route('profile.index');
}


public function showChangePasswordForm()
{
    return view('profile.change_password');
}

public function changePassword(Request $request)
{
    // Validar los campos
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|string|min:8|confirmed',
    ]);

    $user = Auth::user();

    // Verificar la contraseña actual
    if (!Hash::check($request->current_password, $user->password)) {

        // return back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
        Session::flash('notificacion', [
            'tipo' => 'error',
            'titulo' => 'Atencion!',
            'descripcion' => 'La contraseña actual no es correcta.',
            'autoCierre' => 'true'
        ]);
        return redirect()->route('profile.index');
    }

    // Guardar la nueva contraseña
    $user->password = $request->new_password;
    $user->save();

    Session::flash('notificacion', [
        'tipo' => 'exito',
        'titulo' => 'Exito!',
        'descripcion' => 'Contraseña actualizada exitosamente.',
        'autoCierre' => 'true'
    ]);

    return redirect()->route('profile.index');
}

}
