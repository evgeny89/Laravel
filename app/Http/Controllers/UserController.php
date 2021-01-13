<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(User $user)
    {
        return view('user', ['user' => $user]);
    }

    public function login(Request $request)
    {
        if($request->request->get('login')) {
            return redirect()->route('user', ['name' => $request->request->get('login')]);
        }
        return view('login');
    }

    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('main');
    }
}
