<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;

class NewsController extends Controller
{
    private $pagination_value = 5;

    public function index()
    {
        return view('news.news', [
            'news' => News::getNews()->with('category')->paginate($this->pagination_value)
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
                ->paginate($this->pagination_value)
        ]);
    }
}
