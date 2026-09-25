<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'rate',
        'name',
        'banner',
        'has_subservice',
    ];


    public function subServices()
    {
        return $this->hasMany(SubService::class, 'service_id');
    }


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return round($this->reviews()->where('is_approved', true)->avg('rating'), 1) ?? 0.0;
    }
}
