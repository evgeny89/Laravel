<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    public static function buildMenu($role)
    {
        return self::where('min_access', '<=', $role)
            ->where('max_access', '>=', $role)
            ->whereNull('parent_id')
            ->with('child')
            ->get();
    }

    public function child()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
