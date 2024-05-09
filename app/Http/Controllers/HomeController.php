<?php

namespace App\Http\Controllers;

use App\Models\DetailPurchase;
use App\Models\Person;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use App\Models\PurchaseSupplier;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    //
    public function index(Request $request, User $usuario){
        $users = User::all();
        $productos = count(Product::all());
        $sales = count(Sale::all());
        $purchase = count(PurchaseSupplier::all());
        $salesToday = Sale::whereDate('created_at', Carbon::today())->paginate(5);
        $purchaseToday = DetailPurchase::whereDate('created_at', Carbon::today())->paginate(5);
        $dataProduct = Product::where('stock', '<', 5)->paginate(4);
        $person = count(Person::all());
        $rolesUsuario = $users->first()->roles()->pluck('name')->all();
        $roles = Role::all();
        return view('home.index',compact('salesToday','purchaseToday','users', 'productos', 'sales', 'purchase', 'person', 'dataProduct', 'roles', 'rolesUsuario'));
    }


}
