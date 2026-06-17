<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessioanalLocation extends Model
{
    protected $table = 'professionals_location';
    protected $fillable = [
        'professional_id',
        'latitude',
        'longitiude',
    ];
}
