<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.index');
    }

    public function getSite($site)
    {
        return view('site.detail', compact('site'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query', '');

        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->limit(20)
            ->get();

        return response()->json($products);
    }
}
