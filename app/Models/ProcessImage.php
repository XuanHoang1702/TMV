<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProcessImage extends Model
{
    use HasFactory;

    protected $table = 'process_images';

    protected $fillable = [
        'process_id',
        'image',
        'title',
        'description',
    ];

    public function process()
    {
        return $this->belongsTo(Process::class);
    }
}
