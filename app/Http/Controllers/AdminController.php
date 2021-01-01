<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index($msg = null)
    {
        return view('admin.index', [
            'news' => News::withTrashed()
                ->orderByDesc('status')
                ->orderByDesc('updated_at')
                ->get(),
            'status' => $msg
        ]);
    }

    public function addNews($msg = null)
    {
        return view('admin.addNews', [
            'categories' => Category::query()->get(),
            'status' => $msg
        ]);
    }

    public function addCategory($msg = null)
    {
        return view('admin.addCategory', [
            'categories' => Category::query()->get(),
            'status' => $msg
        ]);
    }

    public function saveNews(Request $request, $data = []): \Illuminate\Http\RedirectResponse
    {
        if ($request->request->get('title') && $request->request->get('news')) {
            $news = $request->request->all();

            News::query()->create([
                'category_id' => $news['category'],
                'source' => $news['source'],
                'title' => $news['title'],
                'description' => $news['news'],
                'author_id' => 1,
            ]);

            return redirect()->action([AdminController::class, 'index'], ['msg' => 'Сохранено']);
        } else {
            return back()->withInput();
        }
    }

    public function saveCategory(Request $request, $data = []): \Illuminate\Http\RedirectResponse
    {
        if ($request->request->get('name')) {
            Category::query()->create([
                'name' => $request->name
            ]);

            return redirect()->action([AdminController::class, 'addCategory'], ['msg' => 'Сохранено']);
        } else {
            return back()->withInput();
        }
    }

    public function saveEditNews(Request $request, $id)
    {
        $news = News::query()->find($id);
        $news->update($request->all());

        return redirect()->action([AdminController::class, 'index'], ['msg' => 'Изменено']);
    }

    public function editNews($id)
    {
        return view('admin.edit', [
           'categories' => Category::query()->get(),
           'news' => News::query()->find($id)
        ]);
    }

    public function publish($id, $status = 0)
    {
        if($status) {
            $status = 'added';
        } else {
            $status = 'published';
        }
        News::query()->find($id)->update(['status' => $status]);
        return redirect()->action([AdminController::class, 'index'], ['msg' => 'Статус изменен']);
    }

    public function restore($id)
    {
        News::withTrashed()->find($id)->restore();
        return redirect()->action([AdminController::class, 'index'], ['msg' => 'Востановлено']);
    }

    public function delNews($id, $type = 0): \Illuminate\Http\RedirectResponse
    {
        if ($type) {
            $this->forceDeleteNews($id);
            $msg = 'Удалено полностью';
        } else {
            $this->softDeleteNews($id);
            $msg = 'Удалено';
        }

        return redirect()->action([AdminController::class, 'index'], ['msg' => $msg]);
    }

    public function delCategory($id, $type = 0): \Illuminate\Http\RedirectResponse
    {
        if ($type) {
            array_map(function ($item) {
                $this->forceDeleteNews($item['id']);
            }, Category::query()->find($id)->news->toArray());

            Category::query()->find($id)->forceDelete();
            $msg = 'Удалено полностью';
        } else {
            array_map(function ($item) {
                $this->softDeleteNews($item['id']);
            }, Category::query()->find($id)->news->toArray());

            Category::query()->find($id)->delete();
            $msg = 'Удалено';
        }
        return redirect()->action([AdminController::class, 'addCategory'], ['msg' => $msg]);
    }

    private function softDeleteNews($id): void
    {
        $news = News::query()->find($id);
        $news->delete();
    }

    private function forceDeleteNews($id)
    {
        $news = News::query()->find($id);
        $news->forceDelete();
    }
}
