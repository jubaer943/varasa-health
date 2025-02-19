<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use PhpParser\Node\Expr\FuncCall;

class CampaignController extends Controller
{
    //
    public function index()
    {
        $campaigns = Campaign::all();
        return view('campaign', compact('campaigns'));
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
            $imagePath = $image->store('campaigns', 'public'); // Store in 'storage/app/public/campaigns'
        }
        $campaign = new Campaign();
        $campaign->name = $request->input('CampaignName');
        $campaign->area = $request->input('Area');
        $campaign->start_at = $request->input('StartDate');
        $campaign->end_at = $request->input('EndDate');
        $campaign->discount = $request->input('Discount');
        $campaign->campaign_banner = $imagePath; // Store the image path in the database
        $campaign->save();
        return redirect()->route('campaign')->with('success', 'Campaign added successfully');
    }
}
