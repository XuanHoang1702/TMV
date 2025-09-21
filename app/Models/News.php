<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Casts\Attribute;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'images', // JSON column for multiple images
        'related_news', // JSON column for related news IDs
        'category_id',
        'is_featured',
        'published_at',
        'is_active',
        'meta_title',
        'meta_description',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $casts = [

        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
        'images' => 'array', // cast images as array
       'related_news' => 'array'
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

    /**
     * Get related news articles
     */
    public function getRelatedNews()
    {
        // First, try to get manually selected related news
        if ($this->related_news && is_array($this->related_news) && !empty($this->related_news)) {
            $relatedNews = self::whereIn('id', $this->related_news)
                ->where('is_active', true)
                ->whereNotNull('published_at')
                ->where('id', '!=', $this->id)
                ->orderBy('published_at', 'desc')
                ->get();

            // Return manually selected related news if any exist
            if ($relatedNews->count() > 0) {
                return $relatedNews;
            }
        }

        // Otherwise, get related news by category
        return self::where('category_id', $this->category_id)
            ->where('is_active', true)
            ->whereNotNull('published_at')
            ->where('id', '!=', $this->id)
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();
    }

    protected function relatedNews(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                // Nếu đã là array thì trả về luôn
                if (is_array($value)) {
                    return $value;
                }

                // Nếu là string JSON thì decode
                if (is_string($value)) {
                    return json_decode($value, true) ?? [];
                }

                // Default case
                return [];
            },
            set: function ($value) {
                // Luôn lưu dưới dạng JSON string
                if (is_array($value)) {
                    return json_encode($value);
                }

                // Nếu là string, kiểm tra xem có phải JSON không
                if (is_string($value) && json_decode($value) !== null) {
                    return $value;
                }

                // Default JSON array rỗng
                return json_encode([]);
            }
        );
    }
}
