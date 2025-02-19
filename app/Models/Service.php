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
}
