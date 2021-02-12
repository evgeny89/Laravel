<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditUserData
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, User $user, Closure $next)
    {
        if($request->role_id >= Auth::user()->role_id || $user->role_id >= Auth::user()->role_id) {
            return back()->withInput()->with('status', __('messages.admin.failAccessUser'));
        }

        return $next($request);
    }
}
