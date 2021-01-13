<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $data = [];

    public function __construct() {
        $this->data['news'] = new News();
    }

    public function index()
    {
        return view('admin.index');
    }

    public function addNews()
    {
        return view('admin.addNews');
    }

    public function addCategory()
    {
        return view('admin.addCategory');
    }

    public function saveNews(Request $request, $data = [])
    {
        if($request->request->get('title') && $request->request->get('news')) {
            $data = ['save' => 1];
        }
        return view('admin.addNews', $data);
    }

    public function saveCategory(Request $request, $data = [])
    {
        if($request->request->get('name')) {
           $data =  ['save' => 1];
        }
        return view('admin.addCategory', $data);
    }
}
