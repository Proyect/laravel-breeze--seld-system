<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    public function create(): JsonResponse
    {
        return response()->json(Product::all());
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::create($this->prepareProductData($request));

        return response()->json([
            'result' => true,
            'mje' => 'Producto creado correctamente',
            'data' => $product,
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $product->update($this->prepareProductData($request, $product));

        return response()->json([
            'result' => true,
            'mje' => 'Producto actualizado correctamente',
            'data' => $product->fresh(),
        ]);
    }

    public function destroy(Product $product): JsonResponse
    {
        $this->deleteProductImages($product);
        $product->delete();

        return response()->json([
            'result' => true,
            'mje' => 'Producto eliminado correctamente',
            'data' => Product::all(),
        ]);
    }

    private function prepareProductData(Request $request, ?Product $product = null): array
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $images = $product?->images ?? [];
            $images[] = Storage::url($path);
            $data['images'] = $images;
        }

        unset($data['image']);

        return $data;
    }

    private function deleteProductImages(Product $product): void
    {
        foreach ($product->images ?? [] as $url) {
            $path = str_replace('/storage/', '', parse_url($url, PHP_URL_PATH) ?? '');
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }
}
