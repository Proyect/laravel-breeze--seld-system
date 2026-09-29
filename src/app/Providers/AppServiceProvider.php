<?php

namespace App\Providers;

use App\Models\Inquiry;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sales;
use App\Models\User;
use App\Policies\InquiryPolicy;
use App\Policies\PaymentPolicy;
use App\Policies\ProductPolicy;
use App\Policies\SalePolicy;
use App\Policies\UserPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Gate::policy(Sales::class, SalePolicy::class);
        Gate::policy(Payment::class, PaymentPolicy::class);
        Gate::policy(Product::class, ProductPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Inquiry::class, InquiryPolicy::class);
    }
}
