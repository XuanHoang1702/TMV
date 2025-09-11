<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'order',
        'is_active',
        'type'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    // Parent relationship
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Children relationship
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('order');
    }

    // Recursive children (all descendants)
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    // Get all ancestors
    public function ancestors()
    {
        $ancestors = collect();
        $category = $this;

        while ($category->parent) {
            $ancestors->push($category->parent);
            $category = $category->parent;
        }

        return $ancestors->reverse();
    }

    // Check if category is root (no parent)
    public function isRoot()
    {
        return is_null($this->parent_id);
    }

    // Check if category has children
    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    // Get depth level
    public function getDepth()
    {
        return $this->ancestors()->count();
    }

    // Scope for active categories
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for root categories
    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id');
    }

    // Scope for specific type
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Generate slug automatically
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // Get full path (for breadcrumbs)
    public function getPath()
    {
        $path = $this->ancestors()->pluck('name')->push($this->name);
        return $path->implode(' > ');
    }

    // Get nested tree structure
    public static function getTree($type = null)
    {
        $query = self::with('children');

        if ($type) {
            $query->ofType($type);
        }

        return $query->roots()->active()->orderBy('order')->get();
    }
}
