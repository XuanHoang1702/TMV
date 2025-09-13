<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    use HasFactory;
    protected $table = 'site_info';
    protected $fillable = [
        'id',
        'logo',
        'slogan'
    ];
}
