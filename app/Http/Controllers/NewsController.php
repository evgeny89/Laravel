<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.news', [
            'news' => News::getNews()->with('category')->paginate(parent::PAGINATION_VALUE)
        ]);
    }

    public function getNews(News $news)
    {
        return view('news.single', ['news' => $news]);
    }

    public function getCategories()
    {
        return view('news.categories', ['categories' => Category::withCount('news')->get()]);
    }

    public function getCategory(Category $category)
    {
        return view('news.category', [
            'category' => $category,
            'news' => News::getNews()
                ->with('category')
                ->where('category_id', $category->id)
                ->paginate(parent::PAGINATION_VALUE)
        ]);
    }
}
