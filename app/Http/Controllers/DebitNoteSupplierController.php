<?php

namespace App\Http\Controllers;

use App\Models\debitNoteSupplier;
use App\Models\PurchaseSupplier;
use App\Models\DetailPurchase;
use App\Models\Person;
use App\Models\People;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class debitNoteSupplierController
 * @package App\Http\Controllers
 */
class debitNoteSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $debitNoteSuppliers = debitNoteSupplier::paginate();

        return view('debit-note-supplier.index', compact('debitNoteSuppliers'))
            ->with('i', (request()->input('page', 1) - 1) * $debitNoteSuppliers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $debitNoteSupplier = new debitNoteSupplier();
        $people = Person::where('rol', 'Proveedor')->get();
        $products = Product::all();
        $detailPurchases = DetailPurchase::with('purchaseSupplier', 'product')->get();
        $detailPurchase = DetailPurchase::all();
        $users = User::all();
        $purchaseSuppliers = PurchaseSupplier::all();
    
        $detailPurchaseDates = $detailPurchases->mapWithKeys(function ($item) {
            return [$item->purchaseSupplier->id => $item->date_purchase];
        });
    
        $detailPurchaseProducts = $detailPurchases->mapWithKeys(function ($item) {
            return [$item->purchaseSupplier->id => $item->product->name_product];
        });
    
        $detailPurchaseData = [];
        foreach ($detailPurchases as $detailPurchase) {
            $purchaseSupplierId = $detailPurchase->purchaseSupplier->id;
            $detailPurchaseData[$purchaseSupplierId] = [
                'price_unit' => $detailPurchase->price_unit,
                'product_tax' => $detailPurchase->product_tax,
                'discount_total' => $detailPurchase->discount_total,
            ];
        }
    
        return view('debit-note-supplier.create', compact(
            'debitNoteSupplier',
            'purchaseSuppliers',
            'detailPurchases',
            'detailPurchase',
            'people',
            'products',
            'users',
            'detailPurchaseDates',
            'detailPurchaseProducts',
            'detailPurchaseData'
        ));
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'producto' => 'required',
        'cantidad' => 'required',
        'descripcion' => 'required',
        'precio_unitario' => 'required',
        'descuento' => 'required',
        'iva' => 'required',
        'totalNeto' => 'required',
        
        'gross_total' => 'required',
    ]);

    $purchaseSupplierId = $request->input('factura');

    $detailPurchase = DetailPurchase::where('purchase_suppliers_id', $purchaseSupplierId)->first();

    $debitNoteSupplier = new debitNoteSupplier;
    $debitNoteSupplier->debit_note_code = $request->input('debit_note_code');
    $debitNoteSupplier->date_invoice = $request->input('date_invoice');
    $debitNoteSupplier->users_id = $request->input('users_id');
    $debitNoteSupplier->description = $request->input('descripcion');
    $debitNoteSupplier->quantity = $request->input('cantidad');
    $debitNoteSupplier->total = $request->input('total');
    $debitNoteSupplier->net_total = $request->input('totalNeto');
    $debitNoteSupplier->gross_total = $request->input('gross_total');
    $debitNoteSupplier->updated_at = $request->input('updated_at');
    $debitNoteSupplier->created_at = $request->input('created_at');
    $debitNoteSupplier->purchase_suppliers_id = $purchaseSupplierId;
    
    if ($detailPurchase) {
        $debitNoteSupplier->detail_purchase_id = $detailPurchase->id;
    } else {
        return redirect()->back()->withErrors(['factura' => 'No se encontró un detailPurchase para esta factura.']);
    }

    $debitNoteSupplier->save();

    return redirect()->route('debit-note-supplier.index')
        ->with('success', 'debitNoteSupplier created successfully.');
}

    

    
    

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    $debitNoteSupplier = debitNoteSupplier::find($id);
    $detailPurchases = DetailPurchase::with('purchaseSupplier', 'product')->get();

    $detailPurchaseData = [];
    $detailPurchaseDates = [];
    $detailPurchaseProducts = [];
    foreach ($detailPurchases as $detailPurchase) {
        $purchaseSupplierId = $detailPurchase->purchaseSupplier->id;
        $detailPurchaseData[$purchaseSupplierId] = [
            'price_unit' => $detailPurchase->price_unit,
            'product_tax' => $detailPurchase->product_tax,
            'discount_total' => $detailPurchase->discount_total,
        ];
        $detailPurchaseDates[$purchaseSupplierId] = $detailPurchase->date_purchase;
        $detailPurchaseProducts[$purchaseSupplierId] = $detailPurchase->product->name_product;
    }

    if ($debitNoteSupplier !== null) {
        $detailPurchase = DetailPurchase::with('purchaseSupplier')->where('id', $debitNoteSupplier->detail_purchase_id)->first();
    }

    $people = Person::where('rol', 'Proveedor')->get();
    $products = Product::all();
    $detailPurchases = DetailPurchase::with('purchaseSupplier')->get();
    $users = User::all();
    $purchaseSuppliers = PurchaseSupplier::all();

    return view('debit-note-supplier.show', compact('debitNoteSupplier', 'detailPurchase', 'detailPurchases', 'people', 'products', 'users', 'purchaseSuppliers', 'detailPurchaseData', 'detailPurchaseDates', 'detailPurchaseProducts'));
}

    
    


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $debitNoteSupplier = debitNoteSupplier::find($id);
        $detailPurchases = DetailPurchase::with('purchaseSupplier', 'product')->get();
    
        $detailPurchaseData = [];
        $detailPurchaseDates = [];
        $detailPurchaseProducts = [];
        foreach ($detailPurchases as $detailPurchase) {
            $purchaseSupplierId = $detailPurchase->purchaseSupplier->id;
            $detailPurchaseData[$purchaseSupplierId] = [
                'price_unit' => $detailPurchase->price_unit,
                'product_tax' => $detailPurchase->product_tax,
                'discount_total' => $detailPurchase->discount_total,
            ];
            $detailPurchaseDates[$purchaseSupplierId] = $detailPurchase->date_purchase;
            $detailPurchaseProducts[$purchaseSupplierId] = $detailPurchase->product->name_product;
        }
    
        if ($debitNoteSupplier !== null) {
            $detailPurchase = DetailPurchase::with('purchaseSupplier')->where('id', $debitNoteSupplier->detail_purchase_id)->first();
        }
    
        $people = Person::where('rol', 'Proveedor')->get();
        $products = Product::all();
        $detailPurchases = DetailPurchase::with('purchaseSupplier')->get();
        $users = User::all();
        $purchaseSuppliers = PurchaseSupplier::all();
    
        return view('debit-note-supplier.edit', compact('debitNoteSupplier', 'detailPurchase', 'detailPurchases', 'people', 'products', 'users', 'purchaseSuppliers', 'detailPurchaseData', 'detailPurchaseDates', 'detailPurchaseProducts'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  debitNoteSupplier $debitNoteSupplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, debitNoteSupplier $debitNoteSupplier)
{
    $request->validate([
        'producto' => 'required',
        'cantidad' => 'required',
        'descripcion' => 'required',
        'precio_unitario' => 'required',
        'descuento' => 'required',
        'iva' => 'required',
        'net_total' => 'required',
        'gross_total' => 'required',
    ]);

    $purchaseSupplierId = $request->input('factura');

    $detailPurchase = DetailPurchase::where('purchase_suppliers_id', $purchaseSupplierId)->first();

    $debitNoteSupplier->debit_note_code = $request->input('debit_note_code');
    $debitNoteSupplier->date_invoice = $request->input('date_invoice');
    $debitNoteSupplier->users_id = $request->input('users_id');
    $debitNoteSupplier->description = $request->input('descripcion');
    $debitNoteSupplier->quantity = $request->input('cantidad');
    $debitNoteSupplier->total = $request->input('total');
    $debitNoteSupplier->net_total = $request->input('net_total');
    $debitNoteSupplier->gross_total = $request->input('gross_total');
    $debitNoteSupplier->updated_at = $request->input('updated_at');
    $debitNoteSupplier->created_at = $request->input('created_at');
    $debitNoteSupplier->purchase_suppliers_id = $purchaseSupplierId;
    
    if ($detailPurchase) {
        $debitNoteSupplier->detail_purchase_id = $detailPurchase->id;
    } else {
        return redirect()->back()->withErrors(['factura' => 'No se encontró un detailPurchase para esta factura.']);
    }

    $debitNoteSupplier->save();

    return redirect()->route('debit-note-supplier.index')
        ->with('success', 'debitNoteSupplier updated successfully.');
}


    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $debitNoteSupplier = debitNoteSupplier::find($id)->delete();

        return redirect()->route('debit-note-supplier.index')
            ->with('success', 'debitNoteSupplier deleted successfully');
    }
}
