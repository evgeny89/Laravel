<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $data;

    public function __construct() {
        $this->data['menu'] = Data::getMenu();
    }

    public function index()
    {
        $this->data['title'] = 'главная';
        $this->data['news'] = Data::getLastThreeNews();

        return view('index', $this->data);
    }
}
