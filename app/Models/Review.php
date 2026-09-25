<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'provider_id',
        'rating',
        'comment',
        'is_approved',
    ];

    public function user()
    {
        return $this->belongsTo(AppUser::class, 'user_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function provider()
    {
        return $this->belongsTo(Professional::class, 'provider_id');
    }
}
