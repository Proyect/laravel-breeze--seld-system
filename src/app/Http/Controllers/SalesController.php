<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalesRequest;
use App\Http\Requests\UpdateSalesRequest;
use App\Models\Product;
use App\Models\Sales;
use App\Services\Sales\CreateSaleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SalesController extends Controller
{
    public function __construct(private CreateSaleService $createSaleService)
    {
    }

    public function index(): View
    {
        $this->authorize('viewAny', Sales::class);

        $query = Sales::with(['user', 'products'])->latest();

        if (! auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }

        $sales = $query->paginate(15);

        return view('sales.index', compact('sales'));
    }

    public function create(): View
    {
        $this->authorize('create', Sales::class);

        $products = Product::where('status', 'active')
            ->where('stock', '>', 0)
            ->orderBy('name')
            ->get();

        return view('sales.create', compact('products'));
    }

    public function list(): JsonResponse
    {
        $this->authorize('viewAny', Sales::class);

        $query = Sales::with(['user', 'products'])->latest();

        if (! auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }

        return response()->json($query->paginate(15));
    }

    public function store(StoreSalesRequest $request): RedirectResponse|JsonResponse
    {
        $this->authorize('create', Sales::class);

        try {
            $sale = $this->createSaleService->execute(
                $request->validated()['products'],
                auth()->id(),
                $request->validated()['idempotency_key'] ?? null,
            );
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
        $this->authorize('view', $sales);

        $sales->load(['user', 'products', 'payments']);

        return view('sales.show', ['sale' => $sales]);
    }

    public function update(UpdateSalesRequest $request, Sales $sales): RedirectResponse|JsonResponse
    {
        $this->authorize('update', $sales);

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
        $this->authorize('delete', $sales);

        $sales->delete();

        return response()->json([
            'result' => true,
            'mje' => 'Venta eliminada correctamente',
        ]);
    }
}
