<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'professional_id',
        'time_slots_id',
        'status'
    ];

    // Relationship with TimeSlot model
    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class, 'time_slots_id');
    }

    public function professional()
    {
        return $this->belongsTo(Professional::class, 'professional_id');
    }
}
