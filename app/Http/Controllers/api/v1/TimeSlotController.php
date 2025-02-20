<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TimeSlot;
use Carbon\Carbon;

class TimeSlotController extends Controller
{
    //
    public function index()
    {
        $timeSolts = TimeSlot::all();
        $times = [
            'Morning' => null,
            'Afternoon' => null,
            'Night' => null,
        ];
        if (!$timeSolts) {
            return response()->json(['status' => false, 'code' => 404, 'message' => 'Time slot is empty !', 'data' => null]);
        }
        foreach ($timeSolts as $timeSolt) {
            // Convert to AM/PM format
            $startTime = Carbon::parse($timeSolt->start_time)->format('h:i A');
            $endTime = Carbon::parse($timeSolt->end_time)->format('h:i A');

            $timeRange = $startTime . ' - ' . $endTime;

            if ($timeSolt['shift'] == 1) {
                $times['Morning'][] = [
                    'id' => $timeSolt->id,
                    'time' => $timeRange,
                    'status' => 'Available',
                ];
            } else if ($timeSolt['shift'] == 2) {
                $times['Afternoon'][] = [
                    'id' => $timeSolt->id,
                    'time' => $timeRange,
                    'status' => 'Available',
                ];
            } else if ($timeSolt['shift'] == 3) {
                $times['Night'][] = [
                    'id' => $timeSolt->id,
                    'time' => $timeRange,
                    'status' => 'Available',
                ];
            }
        }

        return response()->json(
            [
                'status' => true,
                'code' => 200,
                'message' => 'Data retrived successfully !',
                'data' => $times,
                'decscription' => null,
            ]
        );
    }
}
