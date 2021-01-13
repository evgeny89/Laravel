<?php

namespace App\Http\Controllers;

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
        return view('index', ['news' => $this->data->getLastThreeNews()]);
    }
}
