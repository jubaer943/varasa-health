<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';
    // Define the fillable fields for mass assignment
    protected $fillable = [
        'question',
        'answer',
        'sub_service_id',  // Foreign key field
    ];

    // Define the relationship with the SubService model
    public function subService()
    {
        return $this->belongsTo(SubService::class, 'sub_service_id');
    }
}
