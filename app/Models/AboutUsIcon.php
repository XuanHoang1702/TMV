<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class AboutUsIcon extends Model
{
    protected $table = 'about_us_icons';

    protected $fillable = [
        'about_us_id',
        'icon',
        'icon_title',
        'icon_content',
    ];

    public function aboutUs()
    {
        return $this->belongsTo(AboutUs::class);
    }
}
