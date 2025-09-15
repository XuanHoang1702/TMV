<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advertisement extends Model
{
    use HashFactory;
    protected $table = ' advertisement';
    protected $fillable = [
        'id',
        'page',
        'main_image',
        'sub_images',
        'titles',
        'contents'
    ];
}
