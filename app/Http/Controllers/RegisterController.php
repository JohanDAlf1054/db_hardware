<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    //

    public function show(){
        if (Auth::check()) {
            return redirect('/home');
        }
        return view('auth.login');
    }

    public function register(RegisterRequest $request){
        try {
            $user = User::create($request->validated());
            return redirect('/login')->with('Exitoso', 'Usuario creado correctamente');
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
