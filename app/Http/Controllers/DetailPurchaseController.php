<?php

namespace App\Http\Controllers;

use App\Models\DetailPurchase;
use App\Models\Person;
use App\Models\People;
use App\Models\PurchaseSupplier;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 


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
    public function index()
    {
        $detailPurchases = DetailPurchase::paginate();

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
        $products = Product::all();
        $purchase_suppliers = PurchaseSupplier::all();
    
        return view('detail-purchase.create', compact('detailPurchase', 'people', 'products', 'purchase_suppliers'));
    }

    /**
     * Almacena una nueva compra en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
   
    $input = $request->all();
$input['price_unit'] = $input['precio_compra'];
$input['quantity_units'] = $input['cantidad'];
$input['date_purchase'] = $input['fecha'];
$input['description'] = $input['precio_venta'];

$input['gross_total'] = $input['quantity_units'] * $input['price_unit'];
$input['total_tax'] = $input['gross_total'] * ($input['product_tax'] / 100);
$input['net_total'] = $input['gross_total'] + $input['total_tax'];
$input['discount_total_value'] = $input['net_total'] * ($input['discount_total'] / 100);

$input['total_value'] = $input['net_total'] - $input['discount_total_value'];
$input['products_id'] = $input['producto_id'];
$input['purchase_suppliers_id'] = $input['people_id'];

    
    $purchaseSupplier = PurchaseSupplier::where('invoice_number_purchase', $input['factura'])->first();
    if ($purchaseSupplier) {
        $input['purchase_suppliers_id'] = $purchaseSupplier->id;
    }

    $validatedData = Validator::make($input, [
        'description'=>'required|string',
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

    $detailPurchase = DetailPurchase::create($validatedData);
    $product = Product::find($input['products_id']);
    $product->stock += $input['quantity_units'];
    $product->save();

    return redirect()->route('detail-purchases.index')->with('success', 'Compra realizada con éxito.');
}
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    $detailPurchase = DetailPurchase::find($id);
    $people = People::where('rol', 'Proveedor')->get();
    $products = Product::all();
    $readonly = true;
    $purchase_suppliers = PurchaseSupplier::all();
    return view('detail-purchase.show', compact('detailPurchase', 'people', 'products', 'readonly','purchase_suppliers'));
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
        $people = People::all();
        $products = Product::all();
        $purchase_suppliers = PurchaseSupplier::all();
        return view('detail-purchase.edit', compact('detailPurchase','people','products','purchase_suppliers'));
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
        $detailPurchase = DetailPurchase::find($id)->delete();

        return redirect()->route('detail-purchases.index')
            ->with('success', 'DetailPurchase deleted successfully');
    }
}
