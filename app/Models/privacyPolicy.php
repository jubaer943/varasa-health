<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class privacyPolicy extends Model
{
    //
    protected $table = 'privacy_policys';
    protected $fillable = [
        'privacy_policy_description',
        'policy_type',
    ];
}
