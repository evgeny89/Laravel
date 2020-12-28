<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
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
        $res = DB::table('menu')
            ->whereNull('access')
            ->get()
            ->toArray();
        $menu = array_reduce($res, function ($result, $item) {
            if(!$item->parent_id) {
                $result[$item->id] = $item;
            } else {
                $result[$item->parent_id]->child[$item->id] = $item;
            }
            return $result;
        }, []);

        View::share(['menu' => $menu, 'request' => Request::class]);
    }
}
