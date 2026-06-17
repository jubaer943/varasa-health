<?php

namespace App\Http\Controllers\api\v1\home;


use App\Http\Controllers\Controller;
use App\Models\DiagnosticTest;
use Illuminate\Http\Request;
use App\Models\SubService;
use App\Models\TestHospital;

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
                'service_icon' => url('storage/' . $subService->service_icon),
                'name' => $subService->service_name,
                'price' => $subService->service_fee,
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


        $subService = SubService::with(['activities', 'faqs', 'advancePrice'])
            ->find($sub_serviceId);


        if (!$subService) {
            return response()->json([
                'status' => false,
                'message' => 'Service details not found!',
                'code' => \Illuminate\Http\Response::HTTP_NOT_FOUND,
                'data' => $data,
                'description' => null,
            ], 404);
        }


        if ($subService->service_fee_type == 1) {
            $weeklyLowestPrice  = $subService->advancePrice()
                ->where('service', 'LIKE', 'Weekly%')
                ->min('price');

            $monthlyLowestPrice  = $subService->advancePrice()
                ->where('service', 'LIKE', 'Monthly%')
                ->min('price');


            $data['subService'] = [
                [
                    'id' => $subService->id,
                    'name' => $subService->service_name . ' Weekly',
                    'type' => 'Weekly',
                    'service_fee' => $weeklyLowestPrice,
                    'cover_image' => url('storage/' . $subService->cover_image),
                    'total_order' => 0,
                    'rating' => 0.00,
                ],
                [
                    'id' => $subService->id,
                    'name' => $subService->service_name . ' Monthly',
                    'type' => 'Monthly',
                    'service_fee' => $monthlyLowestPrice,
                    'cover_image' => url('storage/' . $subService->cover_image),
                    'total_order' => 0,
                    'rating' => 0.00,
                ]
            ];
        } else {

            $data['subService'] = [
                'id' => $subService->id,
                'name' => $subService->service_name,
                'type' => null,
                'service_fee' => $subService->service_fee,
                'cover_image' => url('storage/' . $subService->cover_image),
                'total_order' => 0,
                'rating' => 0.00,
            ];
        }

        $data['activities'] = $subService->activities->map(fn($activite) => [
            'id' => $activite->id,
            'activity' => $activite->activity,
        ]);

        $data['FAQ'] = $subService->faqs->map(fn($faq) => [
            'id' => $faq->id,
            'question' => $faq->question,
            'answer' => $faq->answer,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Service Data retrieved successfully!',
            'code' => \Illuminate\Http\Response::HTTP_OK,
            'data' => $data,
            'description' => null,
        ]);
    }

    public function addvancedPricing(Request $request)
    {
        $id = $request->query('id');
        $type = $request->query('type');
        $data = [
            'service_name' => null,
            'pricing' => null,
        ];
        $service = SubService::find($id);

        if (!$service) {
            return response()->json(['status' => false, 'code' => 404, 'message' => 'Invalid service Id', 'data' => null], 404);
        }

        $prices = $service->advancePrice()->where('service', 'LIKE', $type . '%')->get();

        if (empty($prices)) {
            return  response()->json(['status' => false, 'code' => 404, 'message' => 'price not found', 'data' => null], 404);
        }
        $data['service_name'] = $service->service_name;
        foreach ($prices as $price) {
            $data['pricing'][] = [

                'id' => $price->id,
                'price_name' => $price->service,
                'price' => $price->price,

            ];
        }
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'price data retrived successfully !',
            'data' => $data,
        ]);
    }

    public function diagnosticTest()
    {
        $dignosticTests = DiagnosticTest::where('status', 1)->get();

        if ($dignosticTests->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'Test not found !', 'data' => null], 404);
        }
        $data = [];
        foreach ($dignosticTests as $dignosticTest) {
            $data[] = [
                'id' => $dignosticTest->id,
                'name' => $dignosticTest->test_name,
            ];
        }
        return response()->json(['status' => true, 'message' => 'Test data retirved successfully !', 'data' => $data]);
    }

    public function testHospitals($test_id)
    {

        $hospitals = TestHospital::where('test_id', $test_id)->get();

        if ($hospitals->isEmpty()) {
            return response()->json(['status' => false, 'code' => 404, 'message' => 'Hospital not found !', 'data' => null], 404);
        }

        $data = [];
        foreach ($hospitals as $hospital) {
            $data[] = [
                'id' => $hospital->id,
                'hospital_name' => $hospital->hospital_name,
                'hospital_image' => $hospital->hospital_image,
                'test_price' => $hospital->test_price,
            ];
        }
        return response()->json(['status' => true, 'code' => 200, 'message' => 'Hospital data retirved successfully !', 'data' => $data]);
    }
}
