<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(User $user)
    {
        if (!$user->id && Auth::id()) {
            $user = Auth::user();
        }

        if(!$user->id) {
            abort(404);
        }

        return view('user', ['user' => $user]);
    }

    public function setUserLocale($lang): \Illuminate\Http\RedirectResponse
    {
        session(['locale' => $lang]);

        return back();
    }
}
