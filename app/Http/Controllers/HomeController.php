<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    //
    public function index(Request $request, User $usuario){
        $users = User::all();
        $productos = count(Product::all());
        $sales = count(Sale::all());
        $dataSales = Sale::all();
        $person = count(Person::all());
        $rolesUsuario = $users->first()->roles()->pluck('name')->all();
        $roles = Role::all();
        return view('home.index',compact('users', 'productos', 'sales', 'person', 'dataSales', 'roles', 'rolesUsuario'));
    }


}
