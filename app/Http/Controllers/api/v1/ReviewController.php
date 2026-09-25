<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\Review;
use App\Models\Service;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function getServiceReviews(Service $service)
    {
        $reviews = $service->reviews()
            ->with('user:id,fullname', 'provider:id,full_name')
            ->where('is_approved', true)
            ->latest()
            ->paginate(10)
            ->through(function ($review) {
                return $review->makeHidden(['provider_id', 'user_id', 'service_id', 'updated_at']);
            });


        return response()->json([
            'status' => true,
            'message' => 'Review retrive successfully!',
            'code' => 200,
            'data' => $reviews,
            'description' => null,
        ]);
    }

    public function store(Request $request)
    {
        $user = $this->getAuthenticatedUser();

        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid or missing token or user not found'
            ], 200);
        }

        Review::create([
            'user_id'     => $user->id,
            'service_id'  => $request->service_id,
            'provider_id' => $request->provider_id,
            'rating'      => $request->rating,
            'comment'     => $request->comment,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Review create successfully!',
            'code' => 200,
            'data' => [],
            'description' => null,
        ]);
    }



    private function getAuthenticatedUser()
    {
        try {
            $token = JWTAuth::parseToken();
            $payload = $token->getPayload();
            return AppUser::find($payload->get('sub'));
        } catch (\Exception $e) {
            return null;
        }
    }
}
