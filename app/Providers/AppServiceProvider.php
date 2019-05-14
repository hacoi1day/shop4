<?php

namespace App\Providers;

use App\Cart;
use App\CategoryGlobal;
use App\Shop;
use function foo\func;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('layouts.components.navbar', function($view) {
            // total product in cart
            $products = Cart::where('user_id', Auth::id())->get()->pluck('quantity')->toArray();
            $total_product = 0;
            foreach($products as $product)
            {
                $total_product += $product;
            }
            $view->with('total_product', $total_product);
            // category global
            $categoryG = CategoryGlobal::all();
            $view->with('category_globals', $categoryG);

        });
        //
        view()->composer('seller.components.left-nav', function($view) {
            // avatar shop
            $shop_avatar = Shop::where('user_id', Auth::id())->first()->shop_avatar;
            $view->with('shop_avatar', $shop_avatar);
        });
        //
    }
}
