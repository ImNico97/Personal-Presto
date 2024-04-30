<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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

        // Necessario per condividere le categorie in tutto il nostro progetto, se il record contiene una categoria allora viene mostrato

        if (Schema::hasTable('categories')) {
            
            View::share('categories', Category::all());
        }

        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
