<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $table = 'informations';
    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'email',
        'hotline',
        'website',
        'working_time',
        'images_address',
    ];

    protected $casts = [
        'working_time' => 'array',
        'images_address' => 'array',
        'latitude' => 'decimal:6',
        'longitude' => 'decimal:6',
    ];
}
