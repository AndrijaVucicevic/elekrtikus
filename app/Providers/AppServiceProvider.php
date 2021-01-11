<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('inc.productArea', 'trending');
        Blade::component('inc.mostPopular', 'hot');
        Blade::component('inc.blog', 'blog');
        Blade::component('inc.shopHomeList', 'advert');
        Blade::component('inc.productShop', 'shop');
    }
}
