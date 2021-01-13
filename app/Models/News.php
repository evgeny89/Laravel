<?php

namespace App\Models;

use App\Http\Controllers\AdminController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\News
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $author_id
 * @property string|null $source
 * @property string|null $attach_media
 * @property int $category_id
 * @property mixed $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|News whereAttachMedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'author_id',
        'source',
        'attach_media',
        'category_id',
        'status'
    ];

    public static function getNews()
    {
        return News::query()
            ->where('status','published')
            ->orderByDesc('updated_at');
    }

    public static function deleteNews(News $news, $type = 0): string
    {
        if ($type) {
            $news->forceDelete();
            $msg = 'Удалено полностью';
        } else {
            $news->delete();
            $msg = 'Удалено';
        }

        return $msg;
    }

    public static function deleteNewsInCategory(Category $category, $type = 0): string
    {
        $newsList = News::whereCategoryId($category->id);

        if ($type) {
            $newsList->forceDelete();
        } else {
            $newsList->delete();
        }
    }

    public static function publishNews(News $news, $status)
    {
        $status = $status ? 'added' : 'published';

        $news->update(['status' => $status]);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
