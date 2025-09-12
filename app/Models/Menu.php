<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Route;

class Menu extends Model
{
    protected $table = 'menus';
    protected $fillable = [
        'label',
        'icon',
        'route',
        'parent_id',
        'order',
        'type',
        'is_active',
    ];
    /**
     * Get the child menus for this menu.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }

    public function getLinkAttribute()
    {
        return Route::has($this->route)
            ? route($this->route)
            : url($this->route ?? '#');
    }

}
