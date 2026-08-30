<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpFaq extends Model
{
    protected $fillable = ['question', 'answer', 'type'];
}
