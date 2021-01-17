<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    public static function buildMenu(User $user = null)
    {
        return self::where('min_access', '<=', $user->role_id ?? 1)
            ->where('max_access', '>=', $user->role_id ?? 1)
            ->whereNull('parent_id')
            ->get();
    }

    public function child()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
