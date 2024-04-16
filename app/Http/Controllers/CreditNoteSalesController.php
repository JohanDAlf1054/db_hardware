<?php

namespace App\Http\Controllers;

use App\Models\credit_note_sales;
use Illuminate\Http\Request;

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
    public function create()
    {
        return view('credit-note-sales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
}
