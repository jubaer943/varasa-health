<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'our_service',
        'orders',
        'my_profile',
        'users',
        'professionals',
        'settings',
        'notifications',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
