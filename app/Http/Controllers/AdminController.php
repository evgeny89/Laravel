<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $pagination_value = 5;

    public function index($msg = null)
    {
        return view('admin.index', [
            'news' => News::withTrashed()
                ->with('category')
                ->orderBy('status')
                ->orderByDesc('updated_at')
                ->paginate($this->pagination_value),
            'status' => $msg
        ]);
    }

    public function addNews($msg = null)
    {
        return view('admin.addNews', [
            'categories' => Category::get(),
            'status' => $msg,
            'author_id' => rand(1, 10)
        ]);
    }

    public function addCategory($msg = null)
    {
        return view('admin.addCategory', [
            'categories' => Category::withCount('news')->get(),
            'status' => $msg
        ]);
    }

    public function saveNews(Request $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->request->get('title') && $request->request->get('description')) {
            News::create($request->all());

            return redirect()->action([AdminController::class, 'index'], ['msg' => 'Сохранено']);
        }

        return back()->withInput();
    }

    public function saveCategory(Request $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->request->get('name')) {
            Category::create([
                'name' => $request->name
            ]);

            return redirect()->action([AdminController::class, 'addCategory'], ['msg' => 'Сохранено']);
        }

        return back()->withInput();
    }

    public function saveEditNews(Request $request, News $news): \Illuminate\Http\RedirectResponse
    {
        $news->update($request->all());

        return redirect()->action([AdminController::class, 'index'], ['msg' => 'Изменено']);
    }

    public function editNews(News $news)
    {
        return view('admin.edit', [
           'categories' => Category::get(),
           'news' => $news
        ]);
    }

    public function publish(News $news, $status = 0): \Illuminate\Http\RedirectResponse
    {
        News::publishNews($news, $status);

        return redirect()->action([AdminController::class, 'index'], ['msg' => 'Статус изменен']);
    }

    public function restore(News $news): \Illuminate\Http\RedirectResponse
    {
        $news->restore();

        return redirect()->action([AdminController::class, 'index'], ['msg' => 'Востановлено']);
    }

    public function delNews(News $news, $type = 0): \Illuminate\Http\RedirectResponse
    {
        $msg = News::deleteNews($news, $type);

        return redirect()->action([AdminController::class, 'index'], ['msg' => $msg]);
    }

    public function delCategory(Category $category, $type = 0): \Illuminate\Http\RedirectResponse
    {
        $msg = Category::deleteCategory($category, $type);

        return redirect()->action([AdminController::class, 'addCategory'], ['msg' => $msg]);
    }
}
