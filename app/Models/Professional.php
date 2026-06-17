<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Booking;


class Professional extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'professionals';

    protected $fillable = [
        'professional_id',
        'professional_type',
        'service_area',
        'full_name',
        'email',
        'profile_picture',
        'password',
        'phone',
        'ref_phone',
        'service_city',
        'dob',
        'gender',
        'primary_location',
        'ref_nid',
        'nid_front_photo',
        'nid_back_photo',
        'license_photo',
        'status',
        'otp',
        'otp_expires_at',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'dob' => 'date',
        'status' => 'integer',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $lastUser = self::where('professional_id', 'like', 'P%')
                ->orderBy('professional_id', 'desc')
                ->first();

            $nextNumber = $lastUser ? (intval(substr($lastUser->professional_id, 1)) + 1) : 1;

            $formattedNumber = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

            $user->professional_id = "P{$formattedNumber}";
        });
    }


    public function bookings()
    {
        return $this->hasMany(Booking::class, 'professional_id');
    }

    public function orderCancels()
    {
        return $this->hasMany(orderCancel::class, 'professional_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'service_provider');
    }

    public function deviceTokens()
    {
        return $this->morphMany(DeviceToken::class, 'tokenable');
    }

    // JWT Authentication Methods
    public function getJWTIdentifier()
    {
        return $this->getKey();  // Return primary key (id)
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
