<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sales;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $isAdmin = $user->isAdmin();

        $salesQuery = $isAdmin ? Sales::query() : Sales::where('user_id', $user->id);
        $paymentsQuery = $isAdmin ? Payment::query() : Payment::where('user_id', $user->id);

        $stats = [
            'sales_count' => (clone $salesQuery)->count(),
            'sales_pending' => (clone $salesQuery)->where('status', 'pending')->count(),
            'sales_total' => (clone $salesQuery)->sum('total_amount'),
            'payments_approved' => (clone $paymentsQuery)->where('payment_status', 'approved')->count(),
        ];

        if ($isAdmin) {
            $stats['products'] = Product::count();
            $stats['users'] = User::count();
            $stats['inquiries_pending'] = Inquiry::where('status', 'pending')->count();
        }

        $recentSales = (clone $salesQuery)->with('user')->latest()->limit(5)->get();

        return view('dashboard', compact('stats', 'recentSales', 'isAdmin'));
    }
}
