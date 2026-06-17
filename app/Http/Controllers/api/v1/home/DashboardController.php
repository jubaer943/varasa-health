<?php

namespace App\Http\Controllers\Api\V1\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Service;

class DashboardController extends Controller
{
    //getting dashboard data 
    public function index()
    {
        $banners = Campaign::all();
        $services = Service::all();

        $data = [
            'campaign' => [],
            'services' => []
        ];

        foreach ($banners as $banner) {
            if ($banner->status == 1) {
                $data['campaign'][] = [
                    'id' => $banner->id,
                    'name' => $banner->name,
                    'campaignImage' => url('storage/' . $banner->campaign_banner),
                    'discount' => $banner->discount,
                ];
            }
        }

        foreach ($services as $service) {
            $data['services'][] = [
                'id' => $service->id,
                'name' => $service->name,
                'banner' => url('assets/images/' . $service->banner),
            ];
        }

        return response()->json([
            'status' => true,
            'message' => 'Dashboard Data retrieved successfully!',
            'code' => \Illuminate\Http\Response::HTTP_OK,
            'data' => $data,
            'description' => null,
        ]);
    }
}
