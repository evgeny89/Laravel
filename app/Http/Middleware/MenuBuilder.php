<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class MenuBuilder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        View::share([
            'menu' => Menu::buildMenu(\Auth::user()->role_id ?? 1),
            'request' => \Illuminate\Support\Facades\Request::class
        ]);

        return $next($request);
    }
}
