<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteConstroller extends Controller
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
        $query = trim($request->input('q', ''));

        return view('page.search', [
            'query' => $query,
            'search' => [],
        ]);
    }
}
