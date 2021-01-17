<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsAddRequest;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'news' => News::withTrashed()
                ->with('category')
                ->orderBy('status')
                ->orderByDesc('updated_at')
                ->paginate(parent::PAGINATION_VALUE)
        ]);
    }

    public function addNews()
    {
        return view('admin.addNews', [
            'categories' => Category::get(),
            'author_id' => rand(1, 10)
        ]);
    }

    public function category()
    {
        return view('admin.addCategory', [
            'categories' => Category::withTrashed()->withCount('news')->get()
        ]);
    }

    public function saveNews(NewsAddRequest $request): RedirectResponse
    {
        News::create($request->all());

        return redirect()
            ->action([AdminController::class, 'index'])
            ->with('status', 'Сохранено');
    }

    public function saveCategory(Request $request): RedirectResponse
    {
        if ($request->request->get('name')) {
            Category::create([
                'name' => $request->name
            ]);

            return redirect()
                ->action([AdminController::class, 'category'])
                ->with('status', 'Сохранено');
        }

        return back()->withInput();
    }

    public function saveEditNews(NewsAddRequest $request, News $news): RedirectResponse
    {
        $news->update($request->all());

        return redirect()
            ->action([AdminController::class, 'index'])
            ->with('status', 'Изменено');
    }

    public function editNews(News $news)
    {
        return view('admin.edit', [
            'categories' => Category::get(),
            'news' => $news
        ]);
    }

    public function publish(News $news, $status = 0): RedirectResponse
    {
        News::publishNews($news, $status);

        return redirect()
            ->action([AdminController::class, 'index'])
            ->with('status', 'Статус изменен');
    }

    public function restore(News $news): RedirectResponse
    {
        $news->restore();

        return redirect()
            ->action([AdminController::class, 'index'])
            ->with('status', 'Востановлено');
    }

    public function restoreCategory(Category $category): RedirectResponse
    {
        $category->restore();

        News::restoreNewsInCategory($category);

        return redirect()
            ->action([AdminController::class, 'category'])
            ->with('status', 'Категория '. $category->name .' Востановлена');
    }

    public function delNews(Request $request, News $news, $type = 0): RedirectResponse
    {
        News::deleteNews($request, $news, $type);

        return redirect()
            ->action([AdminController::class, 'index']);
    }

    public function delCategory(Request $request, Category $category, $type = 0): RedirectResponse
    {
        Category::deleteCategory($request, $category, $type);

        return redirect()
            ->action([AdminController::class, 'category']);
    }
}
