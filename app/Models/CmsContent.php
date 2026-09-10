<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsContent extends Model
{
    protected $fillable = [
        'type',
        'user_type',
        'title',
        'description',
    ];
}
