<?php

namespace App\Http\Controllers;

use App\Models\NewsModel;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $data;

    public function __construct() {
        $this->data = new NewsModel();
    }

    public function index()
    {
        return view('news.news', ['news' => $this->data->getAllNews()]);
    }

    public function getNews($id)
    {
        return view('news.single', ['news' => $this->data->getNews($id)]);
    }

    public function getCategories()
    {
        return view('news.categories', ['categories' => $this->data->data->getCategories()]);
    }

    public function getCategory($id)
    {
        $category = $this->data->getCategory($id);

        return view('news.category', [
            'name' => $category['name'],
            'news' => $this->data->getNewsInCategory($category['id'])
        ]);
    }
}
