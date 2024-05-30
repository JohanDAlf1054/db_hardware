<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalesRequest;
use App\Models\Person;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ventas = Sale::query();
    
        if ($request->filled('filtervalue')) {
            $filtro = $request->input('filtervalue');
    
            // Realizar la búsqueda en todos los campos relevantes
            $ventas = $ventas->where(function($query) use ($filtro) {
                $query->where('id', 'like', "%{$filtro}%")
                      ->orWhere('dates', 'like', "%{$filtro}%")
                      ->orWhere('bill_numbers', 'like', "%{$filtro}%")
                      ->orWhere('gross_totals', 'like', "%{$filtro}%")
                      ->orWhere('taxes_total', 'like', "%{$filtro}%")
                      ->orWhere('total_discounts', 'like', "%{$filtro}%")
                      ->orWhere('net_total', 'like', "%{$filtro}%")
                      // Buscar por nombre de cliente
                      ->orWhereHas('cliente', function($query) use ($filtro) {
                          $query->where('company_name', 'like', "%{$filtro}%")
                                ->orWhere('first_name', 'like', "%{$filtro}%")
                                ->orWhere('other_name', 'like', "%{$filtro}%")
                                ->orWhere('surname', 'like', "%{$filtro}%")
                                ->orWhere('second_surname', 'like', "%{$filtro}%")
                                ->orWhere('identification_number', 'like', "%{$filtro}%");
                      });
            });
        }
    
        // Obtener los resultados de la consulta
        $ventasFiltradas = $ventas->get();
    
        // Devolver la vista con las ventas filtradas
        return view('sales.index', compact('ventasFiltradas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Person::where('status', 1)->get();
        $products = Product::where('status', 1)->get();
        $users = User::all();
        return view('sales.create', compact('clients', 'products','users'));
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
        $arrayimpuestoval = $request->get('arrayimpuestoval');

        $siseArray = count($arrayProducto_id);
            $cont = 0;

        while($cont < $siseArray){
            $venta->productos()->syncWithoutDetaching([
                $arrayProducto_id[$cont] => [
                    'amount' => $arrayCantidad[$cont],
                    'references' => $arrayReferencia[$cont],
                    'selling_price' => $arrayPrecioVenta[$cont],
                    'discounts' => $arrayDescuento[$cont],
                    'tax' => $arrayImpuesto[$cont],
                    'iva' =>  $arrayimpuestoval[$cont]
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

    Session::flash('notificacion', [
        'tipo' => 'exito',
        'titulo' => 'Éxito!',
        'descripcion' => 'Venta Creada Exitosamente',
        'autoCierre' => 'true'
    ]);

        return redirect()->route('sales.index');

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
        $sale = Sale::find($id);
        if ($sale->status == 1) {
            Sale::where('id', $sale->id)
            ->update([
                'status' => 0
            ]);
            Session::flash('notificacion', [
                'tipo' => 'error',
                'titulo' => 'Atencion!',
                'descripcion' => 'La venta se ha inactivado correctamente.',
                'autoCierre' => 'true'
            ]);
        } else {
            Sale::where('id', $sale->id)
            ->update([
                'status' => 1
            ]);
            Session::flash('notificacion', [
                'tipo' => 'exito',
                'titulo' => 'Éxito!',
                'descripcion' => 'La venta se ha vuelto a activar.',
                'autoCierre' => 'true'
            ]);
        }
        return redirect()->route('sales.index')->with('success','Venta inactivada');
    }

    public function pdf()
    {
        $ventas = Sale::with('cliente')->get();

        $pdf = Pdf::loadView('sales.pdf', ['ventas' => $ventas])
                    ->setPaper('a4','landscape');

        // Funcion para devolver una vista del pdf en el navegador
        return $pdf->stream('Ventas.pdf');

        //Descargar el pdf directamente
        // return $pdf->download('Informe de Personas.pdf');
    }
}
