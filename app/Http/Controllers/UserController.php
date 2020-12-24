<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($name = 'Guest')
    {
        return view('user', ['name' => $name]);
    }

    public function login(Request $request)
    {
        if($request->request->get('login')) {
            return redirect()->route('user', ['name' => $request->request->get('login')]);
        }
        return view('login');
    }
}
