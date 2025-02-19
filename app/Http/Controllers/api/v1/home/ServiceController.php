<?php

namespace App\Http\Controllers\api\v1\home;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubService;

class ServiceController extends Controller
{
    //
    public function index(Request $request, $id)
    {

        $subServices = SubService::where('service_id', $id)->where('status', 1)->with('service')->get();

        // return $subServices;
        $data = [
            'serviceName' => null,
            'subServices' => null,
        ];
        foreach ($subServices as $subService) {
            $data['serviceName'] = $subService->service->name;
            $data['subServices'][] = [
                'id' => $subService->id,
                'name' => $subService->service_name,
                'price' => $subService->service_fee . '/Person',
            ];
        }
        return response()->json([
            'status' => true,
            'message' => 'Service Data retrieved successfully!',
            'code' => \Illuminate\Http\Response::HTTP_OK,
            'data' => $data,
            'description' => null,
        ]);
    }

    // sub service details 
    public function details($sub_serviceId)
    {
        $data = [
            'subService' => null,
            'activities' => [],
            'FAQ' => [],
        ];

        $subService = SubService::with(['activities', 'faqs'])->where('id', $sub_serviceId)->first();

        if (!$subService) {
            return response()->json([
                'status' => false,
                'message' => 'Service details not found !',
                'code' => \Illuminate\Http\Response::HTTP_OK,
                'data' => $data,
                'description' => null,
            ], 404);
        }

        $data['subService'] = [
            'id' => $subService->id,
            'name' => $subService->service_name,
            'service_fee' => $subService->service_fee,
            'cover_image' => url('storage/' . $subService->cover_image),
            'total_order' => 0,
            'rating' =>  0.00,
        ];

        // Fetch activities
        $data['activities'] = $subService->activities->map(function ($activity) {
            return [
                'id' => $activity->id,
                'activity' => $activity->activity,
            ];
        });

        // Fetch FAQs
        $data['FAQ'] = $subService->faqs->map(function ($faq) {
            return [
                'id' => $faq->id,
                'question' => $faq->question,
                'answer' => $faq->answer,
            ];
        });

        return response()->json([
            'status' => true,
            'message' => 'Service Data retrieved successfully!',
            'code' => \Illuminate\Http\Response::HTTP_OK,
            'data' => $data,
            'description' => null,
        ]);
    }
}
