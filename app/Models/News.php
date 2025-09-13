<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'images', // JSON column for multiple images
        'category_id',
        'is_featured',
        'published_at',
        'is_active',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
        'images' => 'array', // cast images as array
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getLinkAttribute()
    {
        return Route::has($this->route)
            ? route($this->route)
            : url($this->route);
    }
}
