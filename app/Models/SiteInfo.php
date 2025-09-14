<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    use HasFactory;
    protected $table = 'site_info';
    protected $fillable = [
        'id',
        'header_logo',
        'footer_logo',
        'slogan'
    ];
}
