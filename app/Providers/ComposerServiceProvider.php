<?php

namespace App\Providers;

use App\Models\General\Menu;
use App\Models\General\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        View::composer('admin.partials.right_side', function ($view) {
            $minutes = 4320; // 3 day
            $key = auth()->id() . auth()->user()->level_id;


            $menu = Cache::remember($key, $minutes, function () {
                return auth()->user()->modules()->toArray();
            });
            $view->with(compact('menu'));
        });

        View::composer(getSiteBladePath('layouts.master'), function ($view) {
            $nav_menu = Menu::with('patentItems.children')->find(7);


            $contactUs = Menu::with('items')->find(6);
            $aboutMeFooter = Menu::with('items')->find(11);
            $infoFooter = Menu::with('items')->find(12);


            $view->with([
                'nav_menu' => $nav_menu,
                'contactUs' => $contactUs,
                'aboutMeFooter' => $aboutMeFooter,
                'infoFooter' => $infoFooter,
                'last_articles' => [],
                'last_news' => [],
                'last_products' => [],
                'cart' => [],
            ]);
        });


    }
}
