<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreditNotePostRequest;
use App\Models\credit_note_sales;
use App\Models\DetalleVenta;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CreditNoteSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('credit-note-sales.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Sale $sale)
    {
        $sales = Sale::all();
        return view('credit-note-sales.create', compact('sales','sale'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreditNotePostRequest $request)
    {
        try {
            // Procesar la solicitud aquí
            $validatedData = $request->validated();
            // Aquí puedes realizar cualquier operación adicional, como guardar en la base de datos

            // Si todo va bien, puedes redirigir al usuario a otra página
            return redirect()->route('credit-note-sales.create');

        } catch (\Exception $e) {
            // Manejar la excepción aquí
            Log::error('Error al procesar la solicitud: ' . $e->getMessage());
            // Puedes redirigir al usuario a una página de error o simplemente volver a cargar la página anterior
            return back()->withInput()->withErrors(['error' => 'Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo más tarde.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(credit_note_sales $credit_note_sales)
    {
        //
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
    public function destroy(credit_note_sales $credit_note_sales)
    {
        //
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