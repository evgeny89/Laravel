<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $data;

    public function __construct() {
        $this->data['menu'] = Data::getMenu();
    }

    public function index()
    {
        $this->data['title'] = 'новости';
        $this->data['news'] = Data::GetAllNews();

        return view('news', $this->data);
    }

    public function getNews($id)
    {
        $this->data['news'] = Data::getNews($id);
        $this->data['title'] = $this->data['news']['title'];

        return view('single', $this->data);
    }

    public function getCategories()
    {
        $this->data['title'] = 'категории';
        $this->data['categories'] = Data::getCategories();

        return view('categories', $this->data);
    }

    public function getCategory($id)
    {
        $category = Data::getCategory($id);

        $this->data['title'] = $category['name'];
        $this->data['news'] = Data::getNewsInCategory($category['id']);

        return view('category', $this->data);
    }
}
