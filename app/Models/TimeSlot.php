<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'shift'
    ];

    // Relationship with Booking model
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'time_slots_id');  // Correct relationship: Booking::class, foreign key is time_slots_id
    }
}
