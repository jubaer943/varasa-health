<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed for 7 AM to 12 PM (Morning)
        $startTime = strtotime('07:00 AM'); // starting time (7 AM)
        $endTime = strtotime('12:00 PM');   // ending time (12 PM)

        while ($startTime < $endTime) {
            DB::table('time_slots')->insert(
                [
                    'start_time' => date('H:i:s', $startTime), // 24-hour format for start time
                    'end_time' => date('H:i:s', strtotime('+1 hour', $startTime)), // 1 hour difference
                    'shift' => 1, // Morning shift
                ]
            );
            $startTime = strtotime('+1 hour', $startTime); // Move to the next hour
        }

        // Seed for 2 PM to 7 PM (Evening)
        $startTime = strtotime('02:00 PM'); // starting time (2 PM)
        $endTime = strtotime('07:00 PM');   // ending time (7 PM)

        while ($startTime < $endTime) {
            DB::table('time_slots')->insert(
                [
                    'start_time' => date('H:i:s', $startTime), // 24-hour format for start time
                    'end_time' => date('H:i:s', strtotime('+1 hour', $startTime)), // 1 hour difference
                    'shift' => 2, // Evening shift
                ]
            );
            $startTime = strtotime('+1 hour', $startTime); // Move to the next hour
        }

        // Seed for 7 PM to 12 AM (Night)
        $startTime = strtotime('07:00 PM'); // starting time (7 PM)
        $endTime = strtotime('12:00 AM') + 86400;   // ending time (12 AM next day)

        while ($startTime < $endTime) {
            DB::table('time_slots')->insert(
                [
                    'start_time' => date('H:i:s', $startTime), // 24-hour format for start time
                    'end_time' => date('H:i:s', strtotime('+1 hour', $startTime)), // 1 hour difference
                    'shift' => 3, // Night shift
                ]
            );
            $startTime = strtotime('+1 hour', $startTime); // Move to the next hour
        }
    }
}
