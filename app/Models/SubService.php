<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubService extends Model
{
    use HasFactory;

    // Optional: Specify the table name if it's different from the plural form of the model name
    // protected $table = 'sub_services';

    // Optional: Define the fields that are mass assignable (for create and update operations)
    protected $fillable = [
        'service_icon',
        'service_name',
        'service_fee_type',
        'service_fee',
        'cover_image',
        'service_id',
    ];

    // Define the relationship with the Service model (inverse of hasMany)
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');  // 'service_id' is the foreign key
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class, 'sub_service_id'); // 'sub_service_id' is the foreign key
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'sub_service_id');
    }
}
