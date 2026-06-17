<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class advancePrice extends Model
{
    //
    protected $table = 'advance_price';
    protected $fillable = [
        'id',
        'service',
        'price',
        'sub_service_id',  // Foreign key field
    ];

    public function subService()
    {
        return $this->belongsTo(SubService::class, 'sub_service_id');
    }
    public function Orders()
    {
        return $this->hasMany(Order::class, 'id');
    }
}
