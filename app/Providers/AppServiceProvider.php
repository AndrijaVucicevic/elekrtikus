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
        Blade::aliasComponent('inc.productArea', 'trending');
        Blade::aliasComponent('inc.mostPopular', 'hot');
        Blade::aliasComponent('inc.productShop', 'shop');
        Blade::aliasComponent('inc.shopHomeList', 'advert');
        Blade::aliasComponent('inc.blog', 'blog');
    }
}
