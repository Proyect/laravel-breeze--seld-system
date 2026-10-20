<?php

namespace App\Services\Sales;

use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesDetail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CreateSaleService
{
    public function execute(array $products, int $userId, ?string $idempotencyKey = null): Sales
    {
        if ($idempotencyKey) {
            $cachedId = Cache::get("create_sale:{$idempotencyKey}");

            if ($cachedId) {
                $sale = Sales::find($cachedId);

                if ($sale) {
                    return $sale->load('products');
                }
            }
        }

        $sale = DB::transaction(function () use ($products, $userId) {
            $productIds = array_keys($products);

            $models = Product::whereIn('id', $productIds)
                ->where('status', 'active')
                ->lockForUpdate()
                ->get();

            if ($models->count() !== count($productIds)) {
                throw ValidationException::withMessages([
                    'products' => 'Uno o más productos no están disponibles.',
                ]);
            }

            $record = Sales::create([
                'user_id' => $userId,
                'status' => 'pending',
                'total_amount' => 0,
            ]);

            $total = 0;

            foreach ($models as $product) {
                $quantity = (int) ($products[$product->id] ?? 1);

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

                $record->products()->attach($product->id, [
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                ]);

                SalesDetail::create([
                    'sales_id' => $record->id,
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

            $record->update(['total_amount' => $total]);

            return $record;
        });

        if ($idempotencyKey) {
            Cache::put("create_sale:{$idempotencyKey}", $sale->id, now()->addDay());
        }

        return $sale->load('products');
    }
}
