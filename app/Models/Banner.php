<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
     protected $table = 'banners';
   protected $fillable = [
    'title',
    'image_path',
    'link',
    'page',
    'order',
    'is_active',
    'section',
];

}
