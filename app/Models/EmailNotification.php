<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class EmailNotification extends Model
{
    use HasFactory;
    protected $table = 'email_notification';

    protected $fillable = [
        'id',
        'email'
    ];
}
