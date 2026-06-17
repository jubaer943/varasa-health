<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestHospital extends Model
{
    //
    protected $fillable = [
        'hospital_name',
        'test_price',
        'hospital_image',
        'test_id',
    ];


    public function diagnosticTest()
    {
        return $this->belongsTo(DiagnosticTest::class, 'id');
    }
}
