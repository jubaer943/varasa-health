<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    protected $fillable = [
        'tokenable_id',
        'tokenable_type',
        'tokenType',
        'device_token'
    ];

    public function tokenable()
    {
        return $this->morphTo();
    }
}
