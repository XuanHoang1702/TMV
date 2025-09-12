<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = 'informations';
    protected $fillable = [
        'id',
        'name',
        'address',
        'working_time',
        'email'
    ];
}
