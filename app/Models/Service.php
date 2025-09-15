<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $fillable = [
        'name', 'slug', 'description', 'content', 'image',
        'icon_page_home',
        'icon_page_service',
        'price_range', 'duration', 'category_id', 'parent_id',
        'is_active', 'allow_line_breaks', 'sort_order', 'meta_title', 'meta_description',
    ];

    public function details()
    {
        return $this->hasMany(ServiceDetail::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function parent()
    {
        return $this->belongsTo(Service::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Service::class, 'parent_id');
    }



}
