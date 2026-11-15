<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\CmsContent;
use App\Models\HelpFaq;
use App\Models\PrivacyPolicy;
use App\Models\privacyPolicy as ModelsPrivacyPolicy;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function support($user_type = null)
    {
        $typeInt = 2; // Default to professional
        if ($user_type !== null) {
            if (is_numeric($user_type)) {
                $typeInt = (int) $user_type;
            } elseif (in_array(strtolower($user_type), ['user', 'patient', 'customer', '1'])) {
                $typeInt = 1;
            } elseif (in_array(strtolower($user_type), ['professional', 'pro', 'doctor', 'nurse', '2'])) {
                $typeInt = 2;
            }
        }

        $faqs = HelpFaq::where('user_type', $typeInt)->select('id', 'question', 'answer')->get();
        if ($faqs->isEmpty()) {
            $faqs = HelpFaq::select('id', 'question', 'answer')->get();
        }
        if ($faqs->isEmpty()) {
            $faqs = \App\Models\Faq::select('id', 'question', 'answer')->take(10)->get();
        }

        $data = [
            'faqs' => $faqs,
            'phone' => '01703326358',
            'number' => '01703326358',
            'email' => 'support@varasahealth.com',
            'support_email' => 'support@varasahealth.com',
        ];

        return response()->json(
            [
                'status' => true,
                'code' => 200,
                'message' => 'Data retrieved successfully !',
                'data' => $data,
                'description' => null,
            ],
            200
        );
    }

    public function policy(string $user_type)
    {
        $policy = CmsContent::where('type', 'privacy-policy')
            ->where('user_type', $user_type)
            ->latest()
            ->first();

        if (!$policy) {
            return response()->json([
                'status'  => false,
                'code' => 404,
                'message' => 'Privacy Policy not found',
                'data'    => null,
                'decscription' => null,
            ]);
        }

        return response()->json([
            'status'  => true,
            'code' => 200,
            'message' => 'Privacy Policy fetched successfully',
            'data'    => [
                'id'          => $policy->id,
                'title'       => 'Privacy Policy',
                'description' => $policy?->description,
                'updated_at'  => $policy->updated_at?->format('Y-m-d H:i:s'),
            ],
            'decscription' => null,
        ]);
    }

    public function terms(string $user_type)
    {
        $policy = CmsContent::where('type', 'terms-condition')
            ->where('user_type', $user_type)
            ->latest()
            ->first();

        if (!$policy) {
            return response()->json([
                'status'  => false,
                'code' => 404,
                'message' => 'Terms and Conditions not found',
                'data'    => null,
                'decscription' => null,
            ]);
        }

        return response()->json([
            'status'  => true,
            'code' => 200,
            'message' => 'Terms and Conditions fetched successfully',
            'data'    => [
                'id'          => $policy->id,
                'title'       => $policy->title,
                'description' => $policy?->description,
                'updated_at'  => $policy->updated_at?->format('Y-m-d H:i:s'),
            ],
            'decscription' => null,
        ]);
    }

    public function socialLinks()
    {
        $settings = CmsContent::whereIn('type', [
            'facebook_url',
            'instagram_url',
            'youtube_url',
            'twitter_url',
            'x_url',
            'linkedin_url',
            'whatsapp_number',
        ])->pluck('description', 'type')->toArray();

        $facebook = $settings['facebook_url'] ?? 'https://facebook.com/varasahealth';
        $instagram = $settings['instagram_url'] ?? 'https://instagram.com/varasahealth';
        $youtube = $settings['youtube_url'] ?? 'https://youtube.com/@varasahealth';
        $twitter = $settings['x_url'] ?? $settings['twitter_url'] ?? 'https://x.com/varasahealth';
        $linkedin = $settings['linkedin_url'] ?? 'https://linkedin.com/company/varasahealth';

        $socialLinks = [
            [
                'id' => 1,
                'platform' => 'Facebook',
                'url' => $facebook,
                'icon' => url('assets/images/facebook.png'),
            ],
            [
                'id' => 2,
                'platform' => 'YouTube',
                'url' => $youtube,
                'icon' => url('assets/images/youtube.png'),
            ],
            [
                'id' => 3,
                'platform' => 'Instagram',
                'url' => $instagram,
                'icon' => url('assets/images/instagram.png'),
            ],
            [
                'id' => 4,
                'platform' => 'X',
                'url' => $twitter,
                'icon' => url('assets/images/x.png'),
            ],
            [
                'id' => 5,
                'platform' => 'LinkedIn',
                'url' => $linkedin,
                'icon' => url('assets/images/linkedin.png'),
            ],
        ];

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Social links fetched successfully',
            'data' => $socialLinks,
            'links' => [
                'facebook' => $facebook,
                'youtube' => $youtube,
                'instagram' => $instagram,
                'x' => $twitter,
                'twitter' => $twitter,
                'linkedin' => $linkedin,
            ],
            'description' => null,
        ], 200);
    }

    public function aboutUs(Request $request, $user_type = null)
    {
        $requestedType = $user_type ?? $request->query('user_type');
        $type = 1;
        $typeStr = 'user';

        if ($requestedType !== null && $requestedType !== '') {
            $normalized = strtolower(trim((string)$requestedType));
            if (in_array($normalized, ['2', 'professional', 'pro'])) {
                $type = 2;
                $typeStr = 'professional';
            } elseif (in_array($normalized, ['1', 'user'])) {
                $type = 1;
                $typeStr = 'user';
            } else {
                return response()->json([
                    'status'       => false,
                    'code'         => 400,
                    'message'      => 'Invalid user type. Valid options are user (1) or professional (2)',
                    'data'         => null,
                    'decscription' => null,
                ]);
            }
        }

        $about = About::where('about_type', $type)
            ->latest()
            ->first();

        // Fallback to any about record if specific type doesn't exist
        if (!$about) {
            $about = About::first();
        }

        if (!$about) {
            return response()->json([
                'status'       => false,
                'code'         => 404,
                'message'      => 'About Us not found',
                'data'         => null,
                'decscription' => null,
            ]);
        }

        return response()->json([
            'status'  => true,
            'code'    => 200,
            'message' => 'About Us fetched successfully',
            'data'    => [
                'id'                => $about->id,
                'title'             => 'About Us',
                'description'       => $about->about_description,
                'about_description' => $about->about_description,
                'about_type'        => (int) $about->about_type,
                'user_type'         => $typeStr,
                'updated_at'        => $about->updated_at?->format('Y-m-d H:i:s'),
            ],
            'decscription' => null,
        ]);
    }
}

