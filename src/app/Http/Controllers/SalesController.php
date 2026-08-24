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
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SalesController extends Controller
{
    public function index(): View
    {
        $query = Sales::with(['user', 'products'])->latest();

        if (! auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }

        $sales = $query->paginate(15);

        return view('sales.index', compact('sales'));
    }

    public function create(): View
    {
        $products = Product::where('status', 'active')
            ->where('stock', '>', 0)
            ->orderBy('name')
            ->get();

        return view('sales.create', compact('products'));
    }

    public function list(): JsonResponse
    {
        $query = Sales::with(['user', 'products'])->latest();

        if (! auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }

        return response()->json($query->get());
    }

    public function store(StoreSalesRequest $request): RedirectResponse|JsonResponse
    {
        try {
            $sale = DB::transaction(function () use ($request) {
                $productIds = array_keys($request->products);
                $products = Product::whereIn('id', $productIds)
                    ->where('status', 'active')
                    ->lockForUpdate()
                    ->get();

                if ($products->count() !== count($productIds)) {
                    throw ValidationException::withMessages([
                        'products' => 'Uno o más productos no están disponibles.',
                    ]);
                }

                $total = 0;

                $sale = Sales::create([
                    'user_id' => auth()->id(),
                    'status' => 'pending',
                    'total_amount' => 0,
                ]);

                foreach ($products as $product) {
                    $quantity = (int) ($request->products[$product->id] ?? 1);

                    if ($quantity < 1) {
                        continue;
                    }

                    if ($product->stock < $quantity) {
                        throw ValidationException::withMessages([
                            'products' => "Stock insuficiente para {$product->name} (disponible: {$product->stock}).",
                        ]);
                    }

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

                    $product->decrement('stock', $quantity);
                }

                if ($total <= 0) {
                    throw ValidationException::withMessages([
                        'products' => 'Seleccioná al menos un producto con cantidad mayor a 0.',
                    ]);
                }

                $sale->update(['total_amount' => $total]);

                return $sale->load('products');
            });
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'result' => false,
                    'mje' => collect($e->errors())->flatten()->first(),
                    'errors' => $e->errors(),
                ], 422);
            }

            throw $e;
        }

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
        if (! auth()->user()->isAdmin() && $sales->user_id !== auth()->id()) {
            abort(403);
        }

        $sales->load(['user', 'products', 'payments']);

        return view('sales.show', ['sale' => $sales]);
    }

    public function update(UpdateSalesRequest $request, Sales $sales): RedirectResponse|JsonResponse
    {
        $sales->update($request->validated());

        if ($request->expectsJson()) {
            return response()->json([
                'result' => true,
                'mje' => 'Venta actualizada correctamente',
                'data' => $sales,
            ]);
        }

        return back()->with('success', 'Estado de la venta actualizado.');
    }

    public function destroy(Sales $sales): JsonResponse
    {
        if (! auth()->user()->isAdmin() && $sales->user_id !== auth()->id()) {
            abort(403);
        }

        $sales->delete();

        return response()->json([
            'result' => true,
            'mje' => 'Venta eliminada correctamente',
        ]);
    }
}
