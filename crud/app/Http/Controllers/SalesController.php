<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSalesRequest;
use App\Http\Requests\UpdateSalesRequest;
use App\Models\Sale;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::all();
        return view('sales.index', $sales)->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalesRequest $request)
    {
        $sale = Sales::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'total_amount' => $request->total_amount
        ]);
    
        // Agregar productos al carrito
        $sale->products()->attach($request->products);
    
        // Redirigir o devolver respuesta
        return redirect()->route('sales.show', $sale);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalesRequest $request)
    {
        $sales = Sale::get($request);
        if ($sales->save()) {
            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sales $sales)
    {
        //
    }
}
