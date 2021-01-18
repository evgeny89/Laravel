<?php

namespace App\Http\Controllers;

use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        return view('index', [
            'news' => News::getNews()
                ->with('category')
                ->with('author')
                ->limit(5)
                ->get()
        ]);
    }
}
