<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
public function getRouteKeyName()
    {
        return 'route';  // Bind dựa trên cột 'route' thay vì 'id'
    }
    /**
     * Get the child menus for this menu.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }
}
