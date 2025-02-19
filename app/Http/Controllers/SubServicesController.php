<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubService;
use PhpParser\Node\Expr\FuncCall;

class SubServicesController extends Controller
{
    //
    public function index(Request $request, $service_id)
    {
        $subservices = SubService::where('service_id', $service_id)->get();

        return view('sub-services', compact('subservices', 'service_id'));
    }

    // add sub services 
    public function addSubService($service_id)
    {

        return view('add-subservice', compact('service_id'));
    }

    public function store(Request $request, $service_id)
    {
        // Validate the incoming data
        // $validated = $request->validate([
        //     'Name' => 'required|string|max:255',
        //     'ServiceFees' => 'nullable|numeric',
        //     'Activities' => 'required|array',
        //     'FAQ.question' => 'required|array',
        //     'FAQ.answer' => 'required|array',
        // ]);


        $serviceIconPath = null;
        $coverImagePath = null;
        if ($request->hasFile('service_icon')) {
            $serviceIconPath = $request->file('service_icon')->store('services', 'public');
        }
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('services', 'public');
        }

        $serviceFeeType = (int) $request->input('service_fee_type');
        $serviceFee = $serviceFeeType === 0 ? $request->input('ServiceFees') : 0;

        try {
            $subService = SubService::create([
                'service_name' => $request->input('Name'),
                'service_fee_type' => $serviceFeeType,
                'service_fee' => $serviceFee,
                'service_id' => $service_id,
                'service_icon' => $serviceIconPath,
                'cover_image' => $coverImagePath,
            ]);
        } catch (\Exception $e) {
            dd('Error: ', $e->getMessage());
        }


        foreach ($request['FAQ']['question'] as $key => $question) {
            $subService->faqs()->create([
                'question' => $question,
                'answer' => $request['FAQ']['answer'][$key],
            ]);
        }

        foreach ($request['Activities'] as $key => $Activity) {
            $subService->activities()->create([
                'activity' => $Activity,
            ]);
        }

        return redirect()->route('sub-services.index', ['service_id' => $service_id])
            ->with('success', 'sub service added successfully!');
    }
}
