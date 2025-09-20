<?php

// app/Models/ZaloSetting.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZaloSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'zalo_contact',
        'zalo_type',
        'zalo_icon',
        'messenger_contact',
        'messenger_type',
        'messenger_icon',
        'call_contact',
        'call_type',
        'call_icon',
    ];

    protected $casts = [
        'zalo_type' => 'string',
        'messenger_type' => 'string',
        'call_type' => 'string',
    ];

    // Method để lấy setting hiện tại (chỉ có 1 record)
    public static function getCurrent()
    {
        return self::firstOrCreate(
            [], // Không có where condition vì chỉ có 1 record
            [
                'zalo_contact' => '0367881230', // Default
                'zalo_type' => 'phone',
                'zalo_icon' => 'fas fa-comment',
                'messenger_contact' => 'drdatclinic',
                'messenger_type' => 'facebook',
                'messenger_icon' => 'fab fa-facebook-messenger',
                'call_contact' => '0367881230',
                'call_type' => 'phone',
                'call_icon' => 'fas fa-phone',
            ]
        );
    }

    // Accessor để tạo URL cho Zalo
    public function getZaloUrlAttribute()
    {
        return 'https://zalo.me/' . $this->zalo_contact;
    }

    // Accessor để tạo URL cho Messenger
    public function getMessengerUrlAttribute()
    {
        if ($this->messenger_type === 'facebook') {
            return 'https://m.me/' . $this->messenger_contact;
        }
        return $this->messenger_contact;
    }

    // Accessor để tạo URL cho Call
    public function getCallUrlAttribute()
    {
        if ($this->call_type === 'phone') {
            return 'tel:' . $this->call_contact;
        }
        return $this->call_contact;
    }
}
