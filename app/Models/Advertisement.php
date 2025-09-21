<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    protected $table = 'advertisement';

    protected $fillable = [
        'service_id',
        'page',
        'main_image',
        'sub_images',
        'titles',
        'contents',
        'order',
        'is_active'
    ];

    protected $casts = [
        'sub_images' => 'array',
        'titles' => 'array',
        'contents' => 'array',
        'is_active' => 'boolean',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
