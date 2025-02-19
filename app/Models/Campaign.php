<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'campaigns'; // Ensure it matches your database table name

    protected $fillable = [
        'name',
        'start_at',
        'end_at',
        'area',
        'campaign_banner',
        'status'
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'campaign_banner' => 'string',
        'status' => 'integer' // Ensure status is stored as 1 (active) or 0 (inactive)
    ];
}
