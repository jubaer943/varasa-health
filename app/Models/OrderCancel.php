<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderCancel extends Model
{
    protected $table = 'ordercancels';
    // Define the fillable fields for mass assignment
    protected $fillable = [
        'order_id',
        'professional_id',
    ];

    public function professional()
    {
        return $this->belongsTo(Professional::class, 'professional_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
