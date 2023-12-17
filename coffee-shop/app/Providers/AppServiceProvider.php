<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);
        
        Blade::if('admin', function () {
            return auth()->user()?->is_admin;
        });

        Paginator::useBootstrap();

        Blade::directive('formatNumber', function ($expression) {
            return "<?php echo number_format($expression, 0, ',', '.') . ' ₫'; ?>";
        });
    }
}
