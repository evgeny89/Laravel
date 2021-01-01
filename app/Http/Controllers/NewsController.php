<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.news', [
            'news' => News::query()
                ->where('status','published')
                ->get()
        ]);
    }

    public function getNews($id)
    {
        return view('news.single', [
            'news' => News::query()
                ->where('status','published')
                ->find($id)
        ]);
    }

    public function getCategories()
    {
        return view('news.categories', ['categories' => Category::query()->get()]);
    }

    public function getCategory($id)
    {
        return view('news.category', [
            'category' => Category::query()
                ->find($id),
            'news' => News::query()
                ->where('status','published')
                ->where('category_id', $id)
                ->get()
        ]);
    }
}
