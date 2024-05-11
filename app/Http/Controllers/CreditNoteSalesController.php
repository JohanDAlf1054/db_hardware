<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreditNotePostRequest;
use App\Models\credit_note_sales;
use App\Models\DetalleVenta;
use App\Models\Sale;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreditNoteSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ventas = credit_note_sales::all();
        if ($request->filled('filtervalue')) {
            // Obtener el valor del campo de búsqueda
            $filtro = $request->input('filtervalue');
            // Filtrar las ventas por el número de factura
            $ventas = $ventas->filter(function ($venta) use ($filtro) {
                return stripos($venta->bill_numbers, $filtro) !== false;
            });
        }
    
        // Verificar si el checkbox de ventas activas está marcado
        if ($request->has('check')) {
            // Filtrar solo las ventas activas
            $ventas = $ventas->filter(function ($venta) {
                return $venta->status === 1;
            });
        }
    
        // Convertir la colección de ventas filtradas en una matriz
        $ventasFiltradas = $ventas->values()->all();
    
        // Devolver la vista con las ventas filtradas
        return view('credit-note-sales.index', compact('ventasFiltradas','ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Sale $sale)
    {
        $sales = Sale::where('status', 1)->get();
        return view('credit-note-sales.create', compact('sales','sale'));
        
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreditNotePostRequest $request)
    {
        try{
            DB::beginTransaction();
            
        $venta = credit_note_sales::create($request->validated());

        $arrayProducto_id = $request->get('arrayidproducto');
        $arrayReferencia = $request->get('arrayreference');
        $arrayCantidad = $request->get('amount');
        $arrayPrecioVenta = $request->get('selling_price');
        $arrayDescuento = $request->get('discounts');
        $arrayImpuesto = $request->get('tax');

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

                $cont++;
        }

            DB::commit();
    }catch(Exception $e){
        dd($e);
        DB::rollBack();
    }
    Session::flash('notificacion', [
        'tipo' => 'exito',
        'titulo' => 'Éxito!',
        'descripcion' => 'Nota Credito Creada Exitosamente',
        'autoCierre' => 'true'
    ]);

        return redirect()->route('credit-note-sales.index')->with('success','Nota exitosa');
            
    }

    /**
     * Display the specified resource.
     */
    public function show(credit_note_sales $credit_note_sale)
    {
        return view('credit-note-sales.show',compact('credit_note_sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(credit_note_sales $credit_note_sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, credit_note_sales $credit_note_sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sale =credit_note_sales::find($id);
        if ($sale->status == 1) {
            credit_note_sales::where('id', $sale->id)
            ->update([
                'status' => 0
            ]);
        } else {
            credit_note_sales::where('id', $sale->id)
            ->update([
                'status' => 1
            ]);
        }
        return redirect()->route('credit-note-sales.index')->with('success','Nota crédito inactivada');
    }

    public function obtenerDetalleVenta(Request $request)
    {
        // Obtener el ID de la venta del parámetro sale_id enviado desde la solicitud AJAX
        $saleId = $request->input('sale_id');
    
        // Obtener los detalles de la venta correspondientes al ID de la venta
        $detallesVenta = DetalleVenta::where('sale_id', $saleId)->with('producto')->get();
    
        // Devolver los detalles de la venta en formato JSON
        return response()->json(['detallesVenta' => $detallesVenta]);
    }
}