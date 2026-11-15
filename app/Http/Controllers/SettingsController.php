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
        $userPrivacyPolicy = CmsContent::where('user_type', 'user')
            ->where('type', 'privacy-policy')->first();
        $professionalPrivacyPolicy = CmsContent::where('user_type', 'professional')
            ->where('type', 'privacy-policy')->first();
        $userTermsCondition = CmsContent::where('user_type', 'user')
            ->where('type', 'terms-condition')->first();
        $professionalTermsCondition = CmsContent::where('user_type', 'professional')
            ->where('type', 'terms-condition')->first();
        $refundPolicy = CmsContent::where('user_type', 'user')
            ->where('type', 'refund-policy')->first();
        $userAbout = About::where('about_type', 1)->first();
        $professionalAbout = About::where('about_type', 2)->first();
        $siteSettings = CmsContent::whereIn('type', [
            'contact_us',
            'helpline_number',
            'helpline_alt',
            'whatsapp_number',
            'whatsapp_message',
            'support_email',
            'office_address',
            'service_area',
            'facebook_url',
            'linkedin_url',
            'hero_title',
            'hero_subtitle',
            'android_url',
            'ios_url',
        ])->pluck('description', 'type')->toArray();

        $contactUs = CmsContent::where('type', 'contact_us')->first();
        $androidUrl = $siteSettings['android_url'] ?? '';
        $iosUrl = $siteSettings['ios_url'] ?? '';

        return view('settings', compact(
            'userPrivacyPolicy',
            'professionalPrivacyPolicy',
            'userTermsCondition',
            'professionalTermsCondition',
            'refundPolicy',
            'userAbout',
            'professionalAbout',
            'contactUs',
            'androidUrl',
            'iosUrl',
            'siteSettings'
        ));
    }

    public function saveRefundPolicy(Request $request)
    {
        $validated = $request->validate([
            'refund_policy' => ['nullable', 'string'],
        ]);

        try {
            CmsContent::updateOrCreate(
                [
                    'type' => 'refund-policy',
                    'user_type' => 'user',
                ],
                [
                    'title' => 'Cancellation & Refund Policy',
                    'description' => $validated['refund_policy'] ?? '',
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Cancellation & Refund Policy saved successfully!',
            ]);
        } catch (\Throwable $e) {
            Log::error('Refund policy update failed', ['message' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to save Refund Policy.',
            ], 500);
        }
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

    public function contactUs(Request $request)
    {
        $validated = $request->validate([
            'contact_us' => ['nullable', 'string'],
            'helpline_number' => ['nullable', 'string'],
            'helpline_alt' => ['nullable', 'string'],
            'whatsapp_number' => ['nullable', 'string'],
            'whatsapp_message' => ['nullable', 'string'],
            'support_email' => ['nullable', 'string'],
            'office_address' => ['nullable', 'string'],
            'service_area' => ['nullable', 'string'],
            'facebook_url' => ['nullable', 'string'],
            'linkedin_url' => ['nullable', 'string'],
            'hero_title' => ['nullable', 'string'],
            'hero_subtitle' => ['nullable', 'string'],
        ]);

        try {
            $primaryPhone = $validated['helpline_number'] ?? $validated['contact_us'] ?? '';

            $fields = [
                'contact_us' => ['title' => 'Contact Us', 'val' => $primaryPhone],
                'helpline_number' => ['title' => 'Primary Helpline Number', 'val' => $primaryPhone],
                'helpline_alt' => ['title' => 'Alternate Helpline Number', 'val' => $validated['helpline_alt'] ?? ''],
                'whatsapp_number' => ['title' => 'WhatsApp Number', 'val' => $validated['whatsapp_number'] ?? ''],
                'whatsapp_message' => ['title' => 'Default WhatsApp Message Template', 'val' => $validated['whatsapp_message'] ?? ''],
                'support_email' => ['title' => 'Support Email', 'val' => $validated['support_email'] ?? ''],
                'office_address' => ['title' => 'Office Address', 'val' => $validated['office_address'] ?? ''],
                'service_area' => ['title' => 'Service Area', 'val' => $validated['service_area'] ?? ''],
                'facebook_url' => ['title' => 'Facebook Page URL', 'val' => $validated['facebook_url'] ?? ''],
                'linkedin_url' => ['title' => 'LinkedIn Page URL', 'val' => $validated['linkedin_url'] ?? ''],
                'hero_title' => ['title' => 'Hero Title', 'val' => $validated['hero_title'] ?? ''],
                'hero_subtitle' => ['title' => 'Hero Subtitle', 'val' => $validated['hero_subtitle'] ?? ''],
            ];

            foreach ($fields as $type => $info) {
                if (isset($info['val'])) {
                    CmsContent::updateOrCreate(
                        [
                            'type' => $type,
                            'user_type' => 'user',
                        ],
                        [
                            'title' => $info['title'],
                            'description' => trim($info['val']),
                        ]
                    );
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Website & Contact information saved successfully!',
            ]);
        } catch (\Throwable $e) {
            Log::error('Contact us update failed', ['message' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to save Contact information: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function saveAppLinks(Request $request)
    {
        $validated = $request->validate([
            'android_url' => ['nullable', 'string'],
            'ios_url' => ['nullable', 'string'],
        ]);

        try {
            CmsContent::updateOrCreate(
                [
                    'type' => 'android_url',
                    'user_type' => 'user',
                ],
                [
                    'title' => 'Android App URL',
                    'description' => trim($validated['android_url'] ?? ''),
                ]
            );

            CmsContent::updateOrCreate(
                [
                    'type' => 'ios_url',
                    'user_type' => 'user',
                ],
                [
                    'title' => 'iOS App URL',
                    'description' => trim($validated['ios_url'] ?? ''),
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'App download links saved successfully!',
            ]);
        } catch (\Throwable $e) {
            Log::error('App links update failed', ['message' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to save App download links.',
            ], 500);
        }
    }
}
