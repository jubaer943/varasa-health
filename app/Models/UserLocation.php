<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    //
    use HasFactory;
    protected $table = 'user_locations';

    protected $fillable = [
        'flat_no',
        'house_no',
        'road',
        'aria',
        'postcode',
        'country',
        'user_id',
    ];

    public function AppUser()
    {
        return $this->belongsTo(AppUser::class, 'user_id');
    }
}
