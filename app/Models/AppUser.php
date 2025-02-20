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


    public function UserLocation()
    {
        return $this->hasMany(UserLocation::class, 'user_id');
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
