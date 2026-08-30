<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\HelpFaq;
use App\Models\PrivacyPolicy;
use App\Models\privacyPolicy as ModelsPrivacyPolicy;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function support($user_type)
    {
        if (!is_numeric($user_type)) {
            return response()->json(
                [
                    'status' => false,
                    'code' => 400,
                    'message' => 'Invalid user type',
                    'data' => null,
                    'decscription' => null,
                ]
            );
        }

        $faqs = HelpFaq::where('user_type', (int)$user_type)->select('id', 'question', 'answer')->get();
        $data = [
            'faqs' => $faqs,
            'number' => null,
            'email' => null,
        ];
        return response()->json(
            [
                'status' => false,
                'code' => 400,
                'message' => 'Invalid user type',
                'data' => $data,
                'decscription' => null,
            ]
        );
    }

    public function policy(int $user_type)
    {
        $policy = PrivacyPolicy::where('policy_type', $user_type)
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
                'description' => $policy?->privacy_policy_description,
                'updated_at'  => $policy->updated_at?->format('Y-m-d H:i:s'),
            ],
            'decscription' => null,
        ]);
    }

    public function trams(int $user_type)
    {
        $policy = PrivacyPolicy::where('policy_type', $user_type)
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
                'title'       => 'Terms and Conditions',
                'description' => $policy?->privacy_policy_description,
                'updated_at'  => $policy->updated_at?->format('Y-m-d H:i:s'),
            ],
            'decscription' => null,
        ]);
    }
}
