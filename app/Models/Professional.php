<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    use HasFactory;

    protected $table = 'professionals'; 

    protected $fillable = [
        'professional_type',
        'service_area',
        'full_name',
        'email',
        'profile_picture',
        'password',
        'dob',
        'gender',
        'primary_location',
        'ref_nid',
        'nid_front_photo',
        'nid_back_photo',
        'license_photo',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'dob' => 'date',
        'status' => 'boolean',
    ];
}
