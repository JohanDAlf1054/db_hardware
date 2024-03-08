<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    //
    public function show(){
        if (Auth::check()) {
            return redirect('/home');
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        $credentials = $request->getCredentials();
        // //Validacion si el correo electronico existen en la BD
        // $user = \App\Models\User::where('email', $request->email)->first();
        // if (!$user) {
        //     throw ValidationException::withMessages([
        //         'email' => __('auth.failed'),
        //     ]);
        // }

        if(!Auth::validate($credentials)){
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
                'password' => __('auth.password')
            ]);
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return $this->authenticated($request, $user);
    }
    public function authenticated(Request $request, $user){
        return redirect('/home');
    }
}
