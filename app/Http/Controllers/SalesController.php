<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalesRequest;
use App\Models\Person;
use App\Models\Product;
use App\Models\Sale;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Sale::all();
        return view('sales.index',compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Person::all();
        $products = Product::all();
        return view('sales.create', compact('clients','products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalesRequest $request)
    {
        try{
            DB::beginTransaction();
            
        $venta = Sale::create($request->validated());

        $arrayProducto_id = $request->get('arrayidproducto');
        $arrayReferencia = $request->get('arrayname');
        $arrayCantidad = $request->get('arraycantidad');
        $arrayPrecioVenta = $request->get('arrayprecioventa');
        $arrayDescuento = $request->get('arraydescuento');
        $arrayImpuesto = $request->get('arrayimpuesto');

        $siseArray = count($arrayProducto_id);
            $cont = 0;

        while($cont < $siseArray){
            $venta->productos()->syncWithoutDetaching([
                $arrayProducto_id[$cont] => [
                    'references' => $arrayReferencia[$cont],
                    'amount' => $arrayCantidad[$cont],
                    'selling_price' => $arrayPrecioVenta[$cont],
                    'discounts' => $arrayDescuento[$cont],
                    'tax' => $arrayImpuesto[$cont]
                ]
             ]);

                $producto = Product::find($arrayProducto_id[$cont]);
                $stockActual = $producto->stock;
                $cantidad = intval($arrayCantidad[$cont]);
            
                DB::table('products')
                ->where('id',$producto->id)
                ->update([
                    'stock' => $stockActual - $cantidad
                ]);

                $cont++;
        }

            DB::commit();
    }catch(Exception $e){
        DB::rollBack();
    }


        return redirect()->route('sales.index')->with('success','Venta exitosa');
            
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return view('sales.show',compact('sale'));
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
    }
}