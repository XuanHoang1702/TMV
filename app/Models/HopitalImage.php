<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class HopitalImage extends Model
{
    use HasFactory;
    protected $table = 'hopital_image';
    protected $fillable = [
        'image',
        'title'
    ];
}
