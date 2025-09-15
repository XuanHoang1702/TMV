<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = 'informations';
    protected $fillable = [
        'id',
        'name',
        'address',
        'working_time',
        'email',
        'images_address',
        'hotline',
        'website'
    ];
}
