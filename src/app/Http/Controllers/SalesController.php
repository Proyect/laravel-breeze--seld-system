<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalesRequest;
use App\Http\Requests\UpdateSalesRequest;
use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SalesController extends Controller
{
    public function index(): View
    {
        $query = Sales::with(['user', 'products'])->latest();

        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }

        $sales = $query->get();

        return view('sales.index', compact('sales'));
    }

    public function list(): JsonResponse
    {
        $query = Sales::with(['user', 'products'])->latest();

        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }

        return response()->json($query->get());
    }

    public function store(StoreSalesRequest $request): RedirectResponse|JsonResponse
    {
        $sale = DB::transaction(function () use ($request) {
            $products = Product::whereIn('id', array_keys($request->products))->get();
            $total = 0;

            $sale = Sales::create([
                'user_id' => auth()->id(),
                'status' => 'pending',
                'total_amount' => 0,
            ]);

            foreach ($products as $product) {
                $quantity = (int) ($request->products[$product->id] ?? 1);
                $unitPrice = $product->price;
                $subtotal = $unitPrice * $quantity;
                $total += $subtotal;

                $sale->products()->attach($product->id, [
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                ]);

                SalesDetail::create([
                    'sales_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'subtotal' => $subtotal,
                ]);
            }

            $sale->update(['total_amount' => $total]);

            return $sale->load('products');
        });

        if ($request->expectsJson()) {
            return response()->json([
                'result' => true,
                'mje' => 'Venta creada correctamente',
                'data' => $sale,
            ]);
        }

        return redirect()->route('sales.show', $sale)->with('success', 'Venta creada correctamente');
    }

    public function show(Sales $sales): View
    {
        if (auth()->user()->role !== 'admin' && $sales->user_id !== auth()->id()) {
            abort(403);
        }

        $sales->load(['user', 'products', 'payments']);

        return view('sales.show', ['sale' => $sales]);
    }

    public function update(UpdateSalesRequest $request, Sales $sales): JsonResponse
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $sales->update($request->validated());

        return response()->json([
            'result' => true,
            'mje' => 'Venta actualizada correctamente',
            'data' => $sales,
        ]);
    }

    public function destroy(Sales $sales): JsonResponse
    {
        if (auth()->user()->role !== 'admin' && $sales->user_id !== auth()->id()) {
            abort(403);
        }

        $sales->delete();

        return response()->json([
            'result' => true,
            'mje' => 'Venta eliminada correctamente',
        ]);
    }
}
