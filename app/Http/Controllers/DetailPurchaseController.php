<?php

namespace App\Http\Controllers;

use App\Models\DetailPurchase;
use App\Models\Person;
use App\Models\People;
use App\Models\PurchaseSupplier;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\DB;



/**
 * Class DetailPurchaseController
 * @package App\Http\Controllers
 */
class DetailPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $filtervalue = $request->get('filtervalue');
    $status = $filtervalue == 'activo' ? 1 : ($filtervalue == 'inactivo' ? 0 : null);

    $uniqueDetailPurchaseIds = DB::table('detail_purchase')
        ->select(DB::raw('MAX(id) as id'))
        ->groupBy('purchase_suppliers_id')
        ->pluck('id');

    $detailPurchases = DetailPurchase::whereIn('id', $uniqueDetailPurchaseIds)
        ->when($status !== null, function($query) use ($status) {
            return $query->where('status', $status);
        })
        ->when($filtervalue, function($query) use ($filtervalue) {
            return $query->where('description','like','%'.$filtervalue.'%')
                ->orWhere('price_unit','like','%'.$filtervalue.'%')
                ->orWhere('product_tax',$filtervalue)
                ->orWhereHas('product', function($query) use ($filtervalue){
                    if($filtervalue){
                        return $query->where('name_product','like','%'.$filtervalue.'%');
                    }
                });
        })
        ->paginate(4);

    return view('detail-purchase.index', compact('detailPurchases'))
        ->with('i', (request()->input('page', 1) - 1) * $detailPurchases->perPage());
}

    

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detailPurchase = new DetailPurchase();
        $people = Person::where('rol', 'Proveedor')->get();
        $products = Product::where('status', '1')->get();
        $users=User::all();
        $purchase_suppliers = PurchaseSupplier::all();
    
        return view('detail-purchase.create', compact('detailPurchase', 'people', 'products', 'purchase_suppliers','users'));
    }

    /**
     * Almacena una nueva compra en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Inicia una transacción de base de datos
    DB::beginTransaction();

    try {
        // Crear el PurchaseSupplier
        $purchaseSupplier = new PurchaseSupplier;
        $purchaseSupplier->invoice_number_purchase = $request->input('invoice_number_purchase');
        $purchaseSupplier->date_invoice_purchase = $request->input('fecha');
        $purchaseSupplier->code = $request->input('code');
        $purchaseSupplier->people_id = $request->input('people_id');
        $purchaseSupplier->users_id = $request->input('user_id');
        $purchaseSupplier->save();

        // Recuperar los arrays
        $arrayIdProducto = $request->get('arrayidproducto');
        $arrayImpuesto = $request->get('arrayimpuesto');
        $arrayDescripcion = $request->get('arrayprecioventa');
        $arrayCantidad = $request->get('arraycantidad');
        $arrayPrecioCompra = $request->get('arraypreciocompra');
        $arrayPrecioVenta = $request->get('arrayprecioventa');
        //dd($request);
        if (!$arrayIdProducto || !$arrayImpuesto || !$arrayDescripcion || !$arrayCantidad || !$arrayPrecioCompra || !$arrayPrecioVenta) {
            // Aquí puedes manejar el caso en que uno de los arrays sea null
            return redirect()->back()->withInput()->withErrors(['error' => 'Faltan datos en el formulario.']);
        }
        

        // Realizar el llenado
        $sizeArray = count($arrayIdProducto);
        $cont = 0;
        while($cont < $sizeArray){
            $input = [];
            $input['purchase_suppliers_id'] = $purchaseSupplier->id;
            $input['products_id'] = $arrayIdProducto[$cont];
            $input['quantity_units'] = $arrayCantidad[$cont];
            $input['price_unit'] = $arrayPrecioCompra[$cont];
            $input['description'] = $arrayDescripcion[$cont];
            $input['product_tax'] = $arrayImpuesto[$cont];
            $input['date_purchase'] = $request->input('fecha');
            $input['form_of_payment'] = $request->input('form_of_payment');
            $input['method_of_payment'] = $request->input('method_of_payment');
            $input['discount_total'] = $request->input('discount_total');
            $input['gross_total'] = $input['quantity_units'] * $input['price_unit'];
            $input['total_tax'] = $input['gross_total'] * ($input['product_tax'] / 100);
            $input['net_total'] = $input['gross_total'] + $input['total_tax'];
            $input['total_value'] = $input['net_total'] - $input['discount_total'];

            $validatedData = Validator::make($input, [
                'description'=>'required|string',
                'price_unit' => 'required|numeric',
                'product_tax' => 'required|numeric|between:0,19',
                'quantity_units'=>'required|numeric',
                'date_purchase'=>'required|date',
                'form_of_payment'=>'required|in:tarjeta,efectivo',
                'method_of_payment' => 'required|in:cuotas,contado',
                'discount_total' => 'required|numeric',
                'gross_total' => 'required|numeric',
                'total_tax' => 'required|numeric',
                'net_total' => 'required|numeric',
                'total_value' => 'required|numeric',
                'products_id' => 'required|exists:products,id',
                'purchase_suppliers_id' => 'required|exists:purchase_suppliers,id',
            ])->validate();

            $detailPurchase = DetailPurchase::create($validatedData);

          
            // Actualizar el stock
                $producto = Product::find($arrayIdProducto[$cont]);
                $stockActual = $producto->stock;
                $stockNuevo = intval($arrayCantidad[$cont]);
                DB::table('products') // Aquí cambiamos 'productos' por 'products'
                    ->where('id', $producto->id)
                    ->update([
                        'stock' => $stockActual + $stockNuevo
                    ]);


            $cont++;
        }

        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        // Aquí es donde puedes manejar el error
        return redirect()->back()->withInput()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
    }
    Session::flash('notificacion', [
        'tipo' => 'exito',
        'titulo' => 'Éxito!',
        'descripcion' => 'Compra Creada Exitosamente',
        'autoCierre' => 'true'
    ]);
    return redirect()->route('detail-purchases.index');
    
}




    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    $detailPurchase = DetailPurchase::with('purchaseSupplier.user')->find($id);
    $product = Product::find($detailPurchase->products_id);
    $users=User::all();   

    $purchaseSupplierId = $detailPurchase->purchase_suppliers_id;
    $detailPurchases = DetailPurchase::where('purchase_suppliers_id', $purchaseSupplierId)->get();

    return view('detail-purchase.show', compact('detailPurchases', 'detailPurchase', 'product','users'));
}





    

    
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detailPurchase = DetailPurchase::find($id);
        $people = Person::all(); // Cambiado de People a Person
        $products = Product::all();
        $purchase_suppliers = PurchaseSupplier::all();
        $users=User::all();
        return view('detail-purchase.edit', compact('detailPurchase','people','products','purchase_suppliers','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  DetailPurchase $detailPurchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetailPurchase $detailPurchase)
{
    // Renombrar 'precio_compra' a 'price_unit', 'cantidad' a 'quantity_units' y 'fecha' a 'date_purchase'
    $input = $request->all();
    $input['price_unit'] = $input['precio_compra'];
    $input['quantity_units'] = $input['cantidad'];
    $input['date_purchase'] = $input['fecha'];

    // Calcular 'gross_total', 'total_tax', 'net_total' y 'total_value'
    $input['gross_total'] = $input['quantity_units'] * $input['price_unit'];
    $input['total_tax'] = $input['gross_total'] * ($input['product_tax'] / 100);
    $input['net_total'] = $input['gross_total'] + $input['total_tax'];
    $input['total_value'] = $input['net_total'] - $input['discount_total'];
    $input['products_id'] = $input['producto_id'];
    $input['purchase_suppliers_id'] = $input['people_id'];

    // Buscar el 'purchaseSupplier' correspondiente al número de factura y asignar su 'id' a 'purchase_suppliers_id'
    $purchaseSupplier = PurchaseSupplier::where('invoice_number_purchase', $input['factura'])->first();
    if ($purchaseSupplier) {
        $input['purchase_suppliers_id'] = $purchaseSupplier->id;
    }

    $validatedData = Validator::make($input, [
        'price_unit' => 'required|numeric',
        'gross_total' => 'required|numeric',
        'total_tax' => 'required|numeric',
        'product_tax' => 'required|numeric|between:0,19',
        'net_total' => 'required|numeric',
        'total_value' => 'required|numeric',
        'quantity_units'=>'required|numeric',
        'date_purchase'=>'required|date',
        'form_of_payment'=>'required|in:tarjeta,efectivo',
        'discount_total' => 'required|numeric',
        'method_of_payment' => 'required|in:cuotas,contado',
        'products_id' => 'required|exists:products,id',
        'purchase_suppliers_id' => 'required|exists:purchase_suppliers,id',
    ])->validate();

    $detailPurchase->fill($validatedData);

    $detailPurchase->save();

    return redirect()->route('detail-purchases.index')->with('success', 'Compra actualizada con éxito.');
}


    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detailPurchase = DetailPurchase::find($id);
    
        if ($detailPurchase) {
            if ($detailPurchase->status == 1) {
                DetailPurchase::where('id', $detailPurchase->id)
                ->update([
                    'status' => 0
                ]);
    
                // Cambia el estado del purchase supplier asociado
                PurchaseSupplier::where('id', $detailPurchase->purchase_suppliers_id)
                ->update([
                    'status' => 0
                ]);
    
                Session::flash('notificacion', [
                    'tipo' => 'error',
                    'titulo' => 'Atencion!',
                    'descripcion' => 'La Compra se ha inactivado.',
                    'autoCierre' => 'true'
                ]);
            } else {
                DetailPurchase::where('id', $detailPurchase->id)
                ->update([
                    'status' => 1
                ]);
    
                // Cambia el estado del purchase supplier asociado
                PurchaseSupplier::where('id', $detailPurchase->purchase_suppliers_id)
                ->update([
                    'status' => 1
                ]);
    
                Session::flash('notificacion', [
                    'tipo' => 'exito',
                    'titulo' => 'Éxito!',
                    'descripcion' => 'La compra se ha vuelto a activar.',
                    'autoCierre' => 'true'
                ]);
            }
        }
    
        return redirect()->route('detail-purchases.index');
    }
    

    
} 
