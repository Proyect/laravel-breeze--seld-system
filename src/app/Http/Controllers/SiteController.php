<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function index(): View
    {
        return view('site.index');
    }

    public function getSite(string $site): View
    {
        $view = 'page.'.$site;

        if (view()->exists($view)) {
            return view($view);
        }

        abort(404);
    }

    public function search(Request $request): View
    {
        $query = trim((string) $request->input('q', ''));
        $results = [];

        if ($query !== '') {
            $needle = mb_strtolower($query);

            foreach (config('servicios.servicios', []) as $slug => $servicio) {
                $haystack = mb_strtolower(
                    ($servicio['nombre'] ?? '').' '.
                    ($servicio['descripcion_corta'] ?? '').' '.
                    ($servicio['descripcion_larga'] ?? '')
                );

                if (str_contains($haystack, $needle)) {
                    $results[] = [
                        'title' => $servicio['nombre'] ?? $slug,
                        'descripcion' => $servicio['descripcion_corta'] ?? '',
                        'url' => route('servicios.detalle', $slug),
                        'tipo' => 'Servicio',
                    ];
                }
            }

            foreach (config('blog.articulos', []) as $slug => $articulo) {
                $haystack = mb_strtolower(
                    ($articulo['titulo'] ?? '').' '.
                    ($articulo['resumen'] ?? '').' '.
                    ($articulo['categoria'] ?? '')
                );

                if (str_contains($haystack, $needle)) {
                    $results[] = [
                        'title' => $articulo['titulo'] ?? $slug,
                        'descripcion' => $articulo['resumen'] ?? '',
                        'url' => route('blog.show', $slug),
                        'tipo' => 'Blog',
                    ];
                }
            }
        }

        return view('page.search', [
            'query' => $query,
            'search' => $results,
        ]);
    }
}
