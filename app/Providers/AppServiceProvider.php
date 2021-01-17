<?php

namespace App\Providers;

use App\Models\Menu;
use http\Client\Curl\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use \Illuminate\Support\Facades\View;
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
        //\Auth::attempt(['id' => '1', 'password' => '20031989']);
        //session()->regenerate();
        $menu = Menu::buildMenu(\Auth::user());

        View::share(['menu' => $menu, 'request' => Request::class]);
    }
}
