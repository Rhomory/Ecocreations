<?php

namespace App\Providers;

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        View::composer('partials.navbar', function ($view) {
            $view->with('cartCount', CartController::contarUnidades());
        });
    }
}
