<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Expr\Cast\Object_;
use Illuminate\Http\Request;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\News[] $news
 * @property-read int|null $news_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public static function deleteCategory(Request $request, Category $category, $type)
    {
        News::deleteNewsInCategory($category, $type);

        if ($type) {
            $category->forceDelete();
            $msg = __('messages.category.deletedHard');
        } else {
            $category->delete();
            $msg = __('messages.category.deleted', ['name' => $category->name]);
        }
        $request->session()->flash('status', $msg);
    }

    public function news(): object
    {
        return $this->hasMany(News::class, 'category_id')
            ->where('status','published');
    }
}
