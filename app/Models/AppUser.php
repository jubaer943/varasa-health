<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AppUser extends Model implements JWTSubject
{
    use HasFactory;

    protected $table = 'apps_users';

    protected $fillable = [
        'userId',
        'fullname',
        'email',
        'password',
        'phone',
        'dob',
        'gender',
        'primary_location',
        'profile_picture',
        'otp',
        'otp_expires_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $lastUser = self::where('userId', 'like', 'D%')
                ->orderBy('userId', 'desc')
                ->first();

            $nextNumber = $lastUser ? (intval(substr($lastUser->userId, 1)) + 1) : 1;

            $formattedNumber = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

            $user->userId = "D{$formattedNumber}";
        });
    }





    public function UserLocation()
    {
        return $this->hasMany(UserLocation::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function deviceTokens()
    {
        return $this->morphMany(DeviceToken::class, 'tokenable');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
