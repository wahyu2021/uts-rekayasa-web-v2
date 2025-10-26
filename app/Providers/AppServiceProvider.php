<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\CartController; // Tambahkan ini

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

        // Share cart count with all views that use it
        View::composer('components.navbar', function ($view) {
            // Gunakan method getCart() dari CartController untuk konsistensi
            $cart = CartController::getCart();
            $cartCount = $cart ? $cart->items()->sum('quantity') : 0;
            $view->with('cartCount', $cartCount);
        });
    }
}