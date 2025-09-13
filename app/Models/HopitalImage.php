<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HopitalImage extends Model
{
    use HasFactory;
    protected $table = 'hopital_image';
    protected $fillable = [
        'id',
        'image'
    ];
}
