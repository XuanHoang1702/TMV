<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $fillable = [
        'name', 'slug', 'description', 'content', 'image',
        'icon', 'price_range', 'duration', 'category_id',
        'is_active', 'sort_order', 'meta_title', 'meta_description'
    ];

    public function details()
    {
        return $this->hasMany(ServiceDetail::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
