<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\CmsContent;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $validated = $request->validate([
            'user_privacy_policy' => ['nullable', 'string'],
            'professional_privacy_policy' => ['nullable', 'string'],
        ]);

        try {
            DB::transaction(function () use ($validated) {

                // User Privacy Policy
                CmsContent::updateOrCreate(
                    [
                        'type' => 'privacy-policy',
                        'user_type' => 'user',
                    ],
                    [
                        'title' => 'Privacy Policy',
                        'description' => $validated['user_privacy_policy'] ?? '',
                    ]
                );

                // Professional Privacy Policy
                CmsContent::updateOrCreate(
                    [
                        'type' => 'privacy-policy',
                        'user_type' => 'professional',
                    ],
                    [
                        'title' => 'Privacy Policy',
                        'description' => $validated['professional_privacy_policy'] ?? '',
                    ]
                );
            });

            return response()->json([
                'success' => true,
                'message' => 'Privacy Policies saved successfully!',
            ]);
        } catch (\Throwable $e) {

            Log::error('Privacy policy update failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to save Privacy Policies.',
            ], 500);
        }
    }

    public function saveTermsCondition(Request $request)
    {
        $validated = $request->validate([
            'user_terms_condition' => ['nullable', 'string'],
            'professional_terms_condition' => ['nullable', 'string'],
        ]);

        try {
            DB::transaction(function () use ($validated) {

                // User terms condition
                CmsContent::updateOrCreate(
                    [
                        'type' => 'terms-condition',
                        'user_type' => 'user',
                    ],
                    [
                        'title' => 'Terms & Condition',
                        'description' => $validated['user_terms_condition'] ?? '',
                    ]
                );

                // Professional terms & condition
                CmsContent::updateOrCreate(
                    [
                        'type' => 'terms-condition',
                        'user_type' => 'professional',
                    ],
                    [
                        'title' => 'Terms & Condition',
                        'description' => $validated['professional_terms_condition'] ?? '',
                    ]
                );
            });

            return response()->json([
                'success' => true,
                'message' => 'Terms & condition saved successfully!',
            ]);
        } catch (\Throwable $e) {

            Log::error('Privacy policy update failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to save Privacy Policies.',
            ], 500);
        }
    }



    public function saveAboutUs(Request $request)
    {
        $validated = $request->validate([
            'user_about' => ['nullable', 'string'],
            'professional_about' => ['nullable', 'string'],
        ]);

        try {

            DB::transaction(function () use ($validated) {

                About::updateOrCreate(
                    [
                        'about_type' => 1,
                    ],
                    [
                        'about_description' =>
                        $validated['user_about'] ?? '',
                    ]
                );



                About::updateOrCreate(
                    [
                        'about_type' => 2,
                    ],
                    [
                        'about_description' =>
                        $validated['professional_about'] ?? '',
                    ]
                );
            });


            return response()->json([
                'success' => true,
                'message' => 'About Us saved successfully!',
            ]);
        } catch (\Throwable $e) {

            Log::error(
                'About Us update failed',
                [
                    'message' => $e->getMessage(),
                ]
            );


            return response()->json([
                'success' => false,
                'message' => 'Failed to save About Us.',
            ], 500);
        }
    }
}
