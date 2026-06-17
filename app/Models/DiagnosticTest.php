<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosticTest extends Model
{
    //
    protected $fillable = [
        'test_name',
        'status',
    ];


    public function Hospital()
    {
        return $this->hasMany(TestHospital::class, 'test_id');
    }
}
