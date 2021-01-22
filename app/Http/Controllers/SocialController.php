<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function indexLogin($name)
    {
        return Socialite::driver($name)->redirect();
    }

    public function redirect($name, Request $request)
    {
        return User::socialRegistrationUser($name, $request);
    }
}
