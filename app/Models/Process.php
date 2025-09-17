<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Process extends Model
{
    use HasFactory;
    protected $table = 'process';

    protected $fillable = [
        'id',
        'order',
        'image',
        'title',
        'content',
        'page',
        'section'
    ];
}
