<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'content', 'image',
        'icon', 'price_range', 'duration', 'category',
        'is_active', 'sort_order', 'meta_title', 'meta_description'
    ];

    public function details()
    {
        return $this->hasMany(ServiceDetail::class);
    }
}
