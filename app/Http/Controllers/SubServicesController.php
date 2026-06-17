<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\SubService;
use PhpParser\Node\Expr\FuncCall;
use Psy\Sudo;

class SubServicesController extends Controller
{
    //
    public function index(Request $request, $service_id)
    {
        $subservices = SubService::where('service_id', $service_id)->get();

        return view('sub-services', compact('subservices', 'service_id'));
    }

    public function serviceData($service_id)
    {
        $service = Service::find($service_id);
        return view('edit-service', compact('service', 'service_id'));
    }

    public function updateService(Request $request, $service_id)
    {

        $request->validate(
            [
                'name' => 'nullable',
                'banner' => 'nullable',
            ]
        );
        $service = Service::find($service_id);

        if (!$service) {
            return response()->json(['error' => 'Invalid service Id']);
        }

        $service->update(array_filter([
            'name' => $request->name ?? $service->name,
        ], fn($value) => $value !== null));

        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('services', 'public');
            $service->banner = $path;
            $service->save();
        }

        return redirect()->route('our-services.index')->with('success', 'Updated successfully !');
    }
    // add sub services 
    public function addSubService($service_id)
    {
        $service = Service::find($service_id);
        $updateService = null;
        return view('add-subservice', compact('service_id', 'service', 'updateService'));
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

    public function viewUpdate($service_id)
    {
        // $updateService = Service::find($service_id);
        $updateService = SubService::with(
            'service',
            'faqs',
            'activities',
        )->where('service_id', $service_id)->first();
        // return response()->json($updateService);
        return view('add-subservice', compact('updateService', 'service_id'));
    }

    public function update(Request $request, $service_id)
    {
        $subService = SubService::findOrFail($service_id);

        $serviceIconPath = $subService->service_icon;
        $coverImagePath = $subService->cover_image;

        if ($request->hasFile('service_icon')) {
            $serviceIconPath = $request->file('service_icon')->store('services', 'public');
        }
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('services', 'public');
        }

        $serviceFeeType = (int) $request->input('service_fee_type');
        $serviceFee = $serviceFeeType === 0 ? $request->input('ServiceFees') : 0;

        $subService->update([
            'service_name' => $request->input('Name'),
            'service_fee_type' => $serviceFeeType,
            'service_fee' => $serviceFee,
            'service_id' => $service_id,
            'service_icon' => $serviceIconPath,
            'cover_image' => $coverImagePath,
        ]);

        $existingFaqIds = $request->has('FAQ.id') ? array_filter($request->input('FAQ.id')) : [];

        $subService->faqs()->whereNotIn('id', $existingFaqIds)->delete();

        if ($request->has('FAQ.question')) {
            foreach ($request->input('FAQ.question') as $key => $question) {
                if (!empty($request->input('FAQ.id')[$key])) {
                    $faq = $subService->faqs()->find($request->input('FAQ.id')[$key]);
                    if ($faq) {
                        $faq->update([
                            'question' => $question,
                            'answer' => $request->input('FAQ.answer')[$key],
                        ]);
                    }
                } else {
                    $subService->faqs()->create([
                        'question' => $question,
                        'answer' => $request->input('FAQ.answer')[$key],
                    ]);
                }
            }
        }

        $existingActivityIds = $request->has('Activities_id') ? array_filter($request->input('Activities_id')) : [];

        $subService->activities()->whereNotIn('id', $existingActivityIds)->delete();

        if ($request->has('Activities')) {
            foreach ($request->input('Activities') as $key => $Activity) {
                if (!empty($request->input('Activities_id')[$key])) {
                    $activity = $subService->activities()->find($request->input('Activities_id')[$key]);
                    if ($activity) {
                        $activity->update(['activity' => $Activity]);
                    }
                } else {
                    $subService->activities()->create(['activity' => $Activity]);
                }
            }
        }

        return redirect()->route('sub-services.index', ['service_id' => $service_id])
            ->with('success', 'Sub service updated successfully!');
    }


    public function caregiverView()
    {
        $subservices = SubService::where('service_id', 3)->get();
        $data = [
            'service' => $subservices,
        ];
        return view('caregiverView', compact('data'));
    }

    public function caregiverAdd(Request $request)
    {

        // $request->validate([
        //     'service_icon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        //     'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        //     'Name' => 'required|string|max:255',
        //     'service' => 'required|array',
        //     'service.*' => 'string',
        //     'price' => 'required|array',
        //     'price.*' => 'nullable|numeric',
        //     'FAQ.question' => 'array',
        //     'FAQ.answer' => 'array',
        //     'Activities' => 'array',
        // ]);

        $services = $request->input('service');
        $prices = $request->input('price');

        $serviceIconPath = null;
        $coverImagePath = null;

        if ($request->hasFile('service_icon')) {
            $serviceIconPath = $request->file('service_icon')->store('services', 'public');
        }
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('services', 'public');
        }
        try {
            $subService = SubService::create([
                'service_name' => $request->input('Name'),
                'service_fee_type' => 1,
                'service_id' => 3,
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

        foreach ($services as $key => $serviceName) {
            // Only insert if there is a price
            if (isset($prices[$key])) {
                $subService->advancePrice()->create([
                    'service' => $serviceName,
                    'price' => $prices[$key] ?? 0,
                ]);
            }
        }

        return redirect()->route('caregiver.view')
            ->with('success', 'sub service added successfully!');
    }

    public function viewCaregiverUpdate($service_id)
    {
        $updateCaregiver = SubService::with(
            'advancePrice',
            'activities',
            'faqs',
            'service'
        )->find($service_id);
        return view('add_caregiver', compact('updateCaregiver', 'service_id'));
    }

    public function caregiverUpdate(Request $request, $service_id)
    {
        $caregiver = SubService::findOrFail($service_id);

        $caregiverIconPath = $caregiver->service_icon;
        $coverImagePath = $caregiver->cover_image;

        // If new files are uploaded, update the file paths
        if ($request->hasFile('service_icon')) {
            $caregiverIconPath = $request->file('service_icon')->store('services', 'public');
        }
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('services', 'public');
        }

        $caregiver->update([
            'service_name' => $request->input('Name'),
            'service_fee_type' => 1,
            'service_id' => 3,
            'service_icon' => $caregiverIconPath,
            'cover_image' => $coverImagePath,
        ]);

        // 🔥 Remove unchecked services
        $existingServices = $caregiver->advancePrice()->pluck('service')->toArray();
        $selectedServices = !empty($request->service) ? array_values($request->service) : [];

        $servicesToDelete = array_diff($existingServices, $selectedServices);
        if (!empty($servicesToDelete)) {
            $caregiver->advancePrice()->whereIn('service', $servicesToDelete)->delete();
        }

        // Update or create Advance Pricing
        if (!empty($request->service)) {
            foreach ($request->service as $key => $serviceName) {
                $caregiver->advancePrice()->updateOrCreate(
                    ['sub_service_id' => $caregiver->id, 'service' => $serviceName],
                    ['price' => $request->price[$key] ?? 0]
                );
            }
        }

        // 🔥 Remove deleted FAQs
        $existingFaqIds = $caregiver->faqs()->pluck('id')->toArray();
        $submittedFaqIds = $request->FAQ['id'] ?? [];

        $faqsToDelete = array_diff($existingFaqIds, $submittedFaqIds);
        if (!empty($faqsToDelete)) {
            $caregiver->faqs()->whereIn('id', $faqsToDelete)->delete();
        }

        // Update or create FAQ entries
        if (!empty($request->FAQ['question'])) {
            foreach ($request['FAQ']['question'] as $key => $question) {
                if (!empty($question)) {
                    if (isset($request['FAQ']['id'][$key])) {
                        $faq = $caregiver->faqs()->find($request['FAQ']['id'][$key]);
                        if ($faq) {
                            $faq->update([
                                'question' => $question,
                                'answer' => $request['FAQ']['answer'][$key] ?? '',
                            ]);
                        }
                    } else {
                        $caregiver->faqs()->create([
                            'question' => $question,
                            'answer' => $request['FAQ']['answer'][$key] ?? '',
                        ]);
                    }
                }
            }
        }

        // 🔥 Remove deleted Activities
        $existingActivityIds = $caregiver->activities()->pluck('id')->toArray();
        $submittedActivityIds = $request->Activities_id ?? [];

        $activitiesToDelete = array_diff($existingActivityIds, $submittedActivityIds);
        if (!empty($activitiesToDelete)) {
            $caregiver->activities()->whereIn('id', $activitiesToDelete)->delete();
        }

        // Update or create activity entries
        if (!empty($request->Activities)) {
            foreach ($request['Activities'] as $key => $Activity) {
                if (!empty($Activity)) {
                    if (isset($request['Activities_id'][$key])) {
                        $activity = $caregiver->activities()->find($request['Activities_id'][$key]);
                        if ($activity) {
                            $activity->update(['activity' => $Activity]);
                        }
                    } else {
                        $caregiver->activities()->create(['activity' => $Activity]);
                    }
                }
            }
        }

        return redirect()->route('caregiver.view')
            ->with('success', 'Caregiver Updated successfully!');
    }


    public function actions(Request $request)
    {
        $subService = SubService::find($request->id);

        $subService->status = $request->status;
        $subService->save();
        return response()->json(['message' => 'Status updated successfully', 'new_status' => $subService->status]);
    }
}
