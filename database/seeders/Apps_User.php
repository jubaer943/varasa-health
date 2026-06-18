<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Apps_User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('apps_users')->insert([
            'fullname' => 'Hridoy Khan',
            'email' => 'admin@gmail.com',
            'phone' => '01703326358',
            'dob' => '16-07-2003',
            'gender' => 1,
        ]);
    }
}
