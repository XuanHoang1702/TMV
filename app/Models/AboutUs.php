<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';

    protected $fillable = [
        'title',
        'description',
        'sub_title',
        'section',
    ];

    

    public function icons()
    {
        return $this->hasMany(AboutUsIcon::class);
    }
}
