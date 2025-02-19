<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Services extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('Services')->insert([
            [
                'rate' => 0,
                'name' => 'Nurse Home Service',
                'banner' => 'service-1.png',
            ],
            [
                'rate' => 0,
                'name' => 'Physiotherapy Home Service',
                'banner' => 'service-2.png',
            ],
            [
                'rate' => 0,
                'name' => 'Nurse Caregiver & Others',
                'banner' => 'service-3.png',
            ],
            [
                'rate' => 0,
                'name' => 'Home Diagnostic Test',
                'banner' => 'service-4.png',
            ],
        ]);
        
    }
}
