<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        return view('blog.index', [
            'articulos' => config('blog.articulos', []),
        ]);
    }

    public function show(string $slug): View
    {
        $articulos = config('blog.articulos', []);

        if (! isset($articulos[$slug])) {
            abort(404);
        }

        return view('blog.show', [
            'articulo' => $articulos[$slug],
            'slug' => $slug,
        ]);
    }
}
