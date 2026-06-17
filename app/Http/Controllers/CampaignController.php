<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use Carbon\Carbon;

class CampaignController extends Controller
{
    //
    public function index(Request $request)
    {
        $currentTime = Carbon::now();
        $query = Campaign::query();
        $filter = $request->filter ? $request->filter : 1;

        // Apply filter
        if ($filter == 1) {
            $query->whereIn('status', [1, 0]);
        } else {
            $query->where('status', $filter);
        }

        if ($request->has('search') && !empty($request->search)) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', "%{$request->search}%")
                    ->orWhere('Area', 'LIKE', "%{$request->search}%");
            });
        }
        $data = $query->get();
        $campaigns = [];

        if ($data->isNotEmpty()) {
            foreach ($data as $item) {
                // Check if end_at is passed and update status
                if (Carbon::parse($item->end_at)->lte($currentTime)) {
                    $item->status = 2;
                    $item->save();
                }

                $area = $item->status == 0 ? 'Stop' : $item->area;
                $campaigns[] = [
                    'id' => $item->id,
                    'campaign_banner' => $item->campaign_banner,
                    'name' => $item->name,
                    'start_at' => Carbon::parse($item->start_at)->format('l, m/d/y'),
                    'end_at' => Carbon::parse($item->end_at)->format('l, m/d/y'),
                    'area' => $area,
                    'status' => $item->status,
                ];
            }
        }

        if ($request->ajax()) {
            return response()->json(['campaigns' => $campaigns]);
        }
        return view('campaign', compact('campaigns'));
    }

    public function actions(Request $request)
    {
        $campaign = Campaign::findOrFail($request->id);

        $campaign->status = $request->status;
        $campaign->save();

        return response()->json(['message' => 'status updated successully', 'new_status' => $campaign->status]);
    }

    public function delete(Request $request)
    {
        $campaign = Campaign::find($request->id);

        if ($campaign) {
            $campaign->delete();
            return response()->json(['message' => 'Campaign deleted successfully']);
        }
    }
    public function add(Request $request)
    {
        $request->validate([
            'CampaignName' => 'required|string',
            'Area' => 'required|string',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date',
            'Discount' => 'required|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048', // Validate the file
        ]);
        $imagePath = null;
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $imagePath = $image->store('campaigns', 'public');
        }
        $campaign = new Campaign();
        $campaign->name = $request->input('CampaignName');
        $campaign->area = $request->input('Area');
        $campaign->start_at = $request->input('StartDate');
        $campaign->end_at = $request->input('EndDate');
        $campaign->discount = $request->input('Discount');
        $campaign->campaign_banner = $imagePath;
        $campaign->save();

        return redirect()->route('campaign.index')->with('success', 'Campaign added successfully');
    }
}
