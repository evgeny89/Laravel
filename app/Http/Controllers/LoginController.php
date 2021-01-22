<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        return view('login');
    }

    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        User::logout($request);
        return redirect('/');
    }

    public function registration(Request $request)
    {
        return view('reg');
    }

    public function regForm(RegistrationRequest $request)
    {
        if ($request->isMethod('POST')) {
            $user = User::registration($request);

            Auth::login($user);

            return redirect()
                ->route('user');
        }

        abort(400);
    }

    public function loginForm(LoginRequest $request)
    {
        if ($request->isMethod('POST')) {
           return User::login($request);
        }

        abort(400);
    }
}
