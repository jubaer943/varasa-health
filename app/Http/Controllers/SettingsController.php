<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;

class SettingsController extends Controller
{
    public function index()
    {
        $userPrivacyPolicy = PrivacyPolicy::where('policy_type', 1)->first();
        $professionalPrivacyPolicy = PrivacyPolicy::where('policy_type', 2)->first();
        $userAbout = About::where('about_type', 1)->first();
        $professionalAbout = About::where('about_type', 2)->first();
        return view('settings', compact('userPrivacyPolicy', 'professionalPrivacyPolicy', 'userAbout', 'professionalAbout'));
    }

    public function savePrivacyPolicies(Request $request)
    {
        // Example logic
        // You should update the records accordingly
        $userContent = $request->user_privacy_policy;
        $professionalContent = $request->professional_privacy_policy;

        // Save to database
        PrivacyPolicy::where('privacy_type', 'user')->update(['privacy_policy_description' => $userContent]);
        PrivacyPolicy::where('privacy_type', 'professional')->update(['privacy_policy_description' => $professionalContent]);

        return response()->json(['message' => 'Privacy Policies saved successfully']);
    }

    public function saveAboutUs(Request $request)
    {
        $userAbout = $request->user_about;
        $professionalAbout = $request->professional_about;

        // Save to database
        About::where('about_type', 'user')->update(['about_description' => $userAbout]);
        About::where('about_type', 'professional')->update(['about_description' => $professionalAbout]);

        return response()->json(['message' => 'About Us saved successfully']);
    }
}
