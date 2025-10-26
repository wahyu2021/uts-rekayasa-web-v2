<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Import View facade

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Share cart count with the navbar view
        View::composer('components.navbar', function ($view) {
            $cart = session()->get('cart', []);
            $cartCount = array_sum(array_column($cart, 'quantity'));
            $view->with('cartCount', $cartCount);
        });
    }
}
