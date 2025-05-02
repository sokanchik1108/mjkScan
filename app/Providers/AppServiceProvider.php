<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use App\Models\Category;
use Illuminate\Support\Facades\View;

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
    public function boot()
{
    if (app()->environment('local')) {
        URL::forceScheme('https');
    }


    View::composer('*', function ($view) {
        $categories = Category::with('types')->get(); // загрузка типов вместе с категориями
        $view->with('categories', $categories);
    });
    
}





}
