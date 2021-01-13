<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $data;

    public function __construct() {
        $this->data = new News();
    }

    public function index()
    {
        return view('index', [
            'news' => News::query()
                ->where('status','published')
                ->get()
        ]);
    }
}
