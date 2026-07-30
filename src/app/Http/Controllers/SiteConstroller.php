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
        return view('site.index', [
            'site' => $site,
        ]);
    }

    public function search(Request $request)
    {
        $data = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
        ]);

        return response()->json([
            'query' => $data['q'] ?? '',
            'results' => [],
        ]);
    }
}
