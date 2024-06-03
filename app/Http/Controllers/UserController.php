<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
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

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone_number' => 'required|digits:10',
        'document_type' => 'required|string|max:3',
        'identification_number' => 'required|digits_between:7,20|unique:users,identification_number,' . $user->id,
        'password' => 'nullable|min:8|confirmed'
    ], [], [
        'name' => 'Nombre',
        'email' => 'Correo electrónico',
        'phone_number' => 'Número de teléfono',
        'document_type' => 'Tipo de documento',
        'identification_number' => 'Número de identificación',
        'password' => 'Contraseña'
    ]);

    if ($validator->fails()) {
        $errores = $validator->errors()->all();
        foreach ($errores as $error) {
            Session::flash('notificacion', [
                'tipo' => 'error',
                'titulo' => 'Error!',
                'descripcion' => $error,
                'autoCierre' => 'true'
            ]);
        }
        return redirect()->route('profile.edit')->withErrors($validator)->withInput();
    }

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
        'descripcion' => 'La Información del perfil se ha actualizado exitosamente.',
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
    ], [
        'new_password.confirmed' => 'La confirmacion de la nueva contraseña no coincide.'
    ]);

    $user = Auth::user();

    // Verificar la contraseña actual
    if (!Hash::check($request->current_password, $user->password)) {
        Session::flash('notificacion', [
            'tipo' => 'error',
            'titulo' => 'Atencion!',
            'descripcion' => 'La contraseña actual no es correcta.',
            'autoCierre' => 'true'
        ]);
        return redirect()->route('profile.index');
    }

    //Verificar la confirmacion de la nueva contraseña
    if ($request->new_password !== $request->new_password_confirmation) {
        Session::flash('notificacion', [
            'tipo' => 'error',
            'titulo' => 'Atención!',
            'descripcion' => 'La confirmación de la nueva contraseña no coincide.',
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
