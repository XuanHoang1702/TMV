<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $fillable = [
        'title',
        'content',
        'images',
        'list_items',
        'position',
        'order',
        'is_active',
    ];

    protected $casts = [
        'images' => 'array',
        'list_items' => 'array',
        'is_active' => 'boolean',
    ];
}
