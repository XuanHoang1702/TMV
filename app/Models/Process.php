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
        'title',
       
        'page',
        'section',
        'service_id'
    ];

    public function processImages()
    {
        return $this->hasMany(ProcessImage::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
