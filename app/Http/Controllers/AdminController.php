<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsAddRequest;
use App\Http\Requests\SaveUserDataRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'news' => News::withTrashed()
                ->with('category')
                ->with('author')
                ->orderBy('status')
                ->orderByDesc('updated_at')
                ->paginate(parent::PAGINATION_VALUE)
        ]);
    }

    public function addNews()
    {
        return view('admin.addNews', [
            'categories' => Category::get(),
            'author_id' => \Auth::id()
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
            ->with('status', __('messages.saved'));
    }

    public function saveCategory(Request $request): RedirectResponse
    {
        if ($request->request->get('name')) {
            Category::create([
                'name' => $request->name
            ]);

            return redirect()
                ->action([AdminController::class, 'category'])
                ->with('status', __('messages.saved'));
        }

        return back()->withInput();
    }

    public function saveEditNews(NewsAddRequest $request, News $news): RedirectResponse
    {
        $news->update($request->all());

        return redirect()
            ->action([AdminController::class, 'index'])
            ->with('status', __('messages.changed'));
    }

    public function editNews(News $news)
    {
        return view('admin.edit', [
            'categories' => Category::get(),
            'news' => $news,
            'author_id' => Auth::id()
        ]);
    }

    public function publish(News $news, $status = 0): RedirectResponse
    {
        News::publishNews($news, $status);

        return redirect()
            ->action([AdminController::class, 'index'])
            ->with('status', __('messages.status.changed'));
    }

    public function restore(News $news): RedirectResponse
    {
        $news->restore();

        return redirect()
            ->action([AdminController::class, 'index'])
            ->with('status', __('messages.restored'));
    }

    public function restoreCategory(Category $category): RedirectResponse
    {
        $category->restore();

        News::restoreNewsInCategory($category);

        return redirect()
            ->action([AdminController::class, 'category'])
            ->with('status', __('messages.category.restored', ['name' => $category->name]));
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

    public function getUsers()
    {
        $result = User::getUsers(self::PAGINATION_VALUE);

        return view('admin.users', $result);
    }

    public function saveUser(User $user, SaveUserDataRequest $request): RedirectResponse
    {
        $user->update($request->all());

        return redirect()
            ->route('users')
            ->with('status', __('messages.updated'));
    }

    public function saveUserPassword(User $user, Request $request): RedirectResponse
    {
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()
            ->route('users')
            ->with('status', __('messages.passwordChanged'));
    }

    public function delUser(User $user): RedirectResponse
    {
        $user->forceDelete();

        return redirect()
            ->route('users')
            ->with('status', __('messages.userDeleted'));
    }
}
