<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Professional;

class ProfessionalSeeder extends Seeder
{
    public function run()
    {
        Professional::create([
            'professional_type' => 1, 
            'service_area' => 'New York',
            'full_name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password123'), 
            'dob' => '1990-05-15',
            'gender' => 1, 
            'status' => 1, 
        ]);

    }
}
