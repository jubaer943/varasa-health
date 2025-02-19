<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    protected $table = 'activities';
    // Define the fillable fields for mass assignment
    protected $fillable = [
        'activity',
        'sub_service_id',  // Foreign key field
    ];

    // Define the relationship with the SubService model
    public function subService()
    {
        return $this->belongsTo(SubService::class, 'sub_service_id');
    }
}
