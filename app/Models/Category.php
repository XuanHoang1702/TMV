<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'parent_id', 'order', 'is_active', 'type'
    ];

    // Quan hệ: Danh mục cha
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Quan hệ: Danh mục con
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Kiểm tra xem danh mục có danh mục con hay không
    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    // Scope để lấy danh mục gốc (root)
    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id');
    }

    // Scope để lấy danh mục theo type
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Scope để lấy danh mục đang hoạt động
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
  public function services()
{
    return $this->hasMany(Service::class, 'category_id');
}

  public function news()
{
    return $this->hasMany(News::class, 'category_id');
}


}
