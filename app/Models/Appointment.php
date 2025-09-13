<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'appointment_date',
        'appointment_time',
        'service_id',
        'status',
        'notes',
        'estimated_price',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime',
        'estimated_price' => 'string',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
