<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseRouteServiceProvider;

class RouteServiceProvider extends BaseRouteServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        $this->routes(function () {

            // ================= API ROUTES =================
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));

            // ================= WEB ROUTES =================
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
