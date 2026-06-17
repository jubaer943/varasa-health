<?php

namespace App\Http\Controllers\api\v1\auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\UserLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;
use Laravel\Ui\Presets\React;
use App\Traits\SendsSms;

class AuthController extends Controller
{
    use SendsSms;
    public function user_register(Request $request)
    {
        // $request->validate([
        //     'fullname' => 'required|string|max:255',
        //     'dob' => 'required|string',
        //     'gender' => 'required|integer',
        //     'phone' => 'required|string|max:15',
        //     'email' => 'required|string|email|max:255|unique:apps_users',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        $hasPhone = AppUser::where('phone', $request->phone)->exists();

        if ($hasPhone) {
            return response()->json([
                'status' => false,
                'code' => 409,
                'message' => "The phone Number is already exits",
                'otp' => null,
                'description' => null,
            ], 200);
        }

        // Generate a random 5-digit OTP
        $otp = random_int(100000, 999999);

        $this->sendOtp($request->phone, $otp);

        $user = AppUser::create([
            'fullname' => $request->fullname,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(2),
        ]);


        return response()->json([
            'status' => true,
            'message' => 'User registered successfully! Please verify your Number.',
            'code' => 200,
            'otp' => $otp,
            'description' => null,
        ]);
    }


    public function user_login(Request $request)
    {
        $credentials = $request->only('number', 'password');

        $user = AppUser::where('phone', $request->number)->first();

        // Check for user 
        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 401,
                'message' => 'This Mobile number is not registered yet.',
                'data' => null,
                'description' => null
            ]);
        }

        // If OTP is not provided, generate and send OTP
        $otp = random_int(100000, 999999);
        $this->sendOtp($request->number, $otp);
        // Store OTP in the database (consider hashing for security)
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(2);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Otp sent successfully !',
            'code' => 200,
            'otp' => $otp,
            'description' => null,
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|integer',
        ]);
        $phone = $request->number;
        $otp = $request->otp;
        // Check if phone exists
        $user = AppUser::where('phone', $phone)->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'Phone number not found.',
                'data' => null
            ]);
        }

        // Check if OTP matches
        $userWithOtp = AppUser::where('phone', $phone)->where('otp', $otp)->first();
        if (!$userWithOtp) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid OTP.',
                'data' => null,
            ]);
        }

        if (Carbon::now()->greaterThan($userWithOtp->otp_expires_at)) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'OTP expired.'
            ]);
        }
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        $token = JWTAuth::fromUser($user);
        return response()->json([
            'status' => true,
            'message' => 'OTP verified successfully.',
            'data' => [
                'fullName' => $user->fullname,
                'dob' => $user->dob,
                'gender' => $user->gender,
                'phone' => $user->phone,
                'email' => $user->email,
                'token' => $token,
            ],
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

    public function checkToken()
    {
        try {
            $token = JWTAuth::parseToken();

            if (JWTAuth::getPayload($token)->get('exp') < time()) {
                return response()->json([
                    'status' => false,
                    'code' => 401,
                    'message' => 'Token has expired.',
                ], 200);
            }

            return response()->json([
                'status' => true,
                'message' => 'Token is valid.',
            ], 200);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token has expired.',
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Token is invalid or not provided.',
            ]);
        }
    }


    public function userProfile()
    {

        $user = $this->getAuthenticatedUser();
        if (!$user) {
            return response()->json(['errors' => 'User not found'], 404);
        }
        $locations = $user->UserLocation()->get();
        $primary_location = [];
        foreach ($locations as $location) {
            $primary_location[] =
                [
                    'flat_no' => $location->flat_no ?? null,
                    'house_no' => $location->house_no ?? null,
                    'road' => $location->road ?? null,
                    'area' => $location->area ?? null,
                    'postcode' => $location->postcode ?? null,
                    'country' => $location->country ?? null,
                ];
        }

        $default_profilePic = $user->gender == 1 ? url('assets/images/profile_male.png') : url('assets/images/profile_female.jpg');
        return response()->json([
            'status' => true,
            'message' => 'Profile data retrive successfully.',
            'code' => 200,
            'data' => [
                'fullName' => $user->fullname,
                'dob' => $user->dob,
                'gender' => (int) $user->gender,
                'phone' => $user->phone,
                'email' => $user->email,
                'userId' => $user->userId,
                'primary_location' => $primary_location,
                'profile_picture' => $user->profile_picture ? url('storage/' . $user->profile_picture) : $default_profilePic,
            ],
            'description' => null,
        ]);
    }

    public function profileUpdate(Request $request)
    {
        $validator = validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'gender' => 'nullable|integer|in:1,2',
            'dob' => 'nullable|date',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = $this->getAuthenticatedUser();

        if (!$user) {
            return response()->json(['errors' => 'User not found'], 404);
        }
        $user->update(array_filter([
            'fullname' => $request->name ?? $user->fullname,
            'email' => $request->email ?? $user->email,
            'dob' => $request->dob ?? $user->dob,
            'gender' => $request->gender ?? $user->gender,
        ], fn($value) => $value !== null));

        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
            $user->save();
        }

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => "profile updated successfully",
        ]);
    }

    public function add_location(Request $request)
    {
        // return $request->input();
        $validator = Validator::make(
            $request->all(),
            [
                'flat_no' => 'nullable|string',
                'house_no' => 'nullable|string',
                'road' => 'nullable|string',
                'area' => 'nullable|string',
                'postcode' => 'nullable|string',
                'country' => 'nullable|string',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ]);
        }
        $token = JWTAuth::getToken();

        if (!$token) {
            return response()->json(['status' => false, 'code' => 400, 'message' => 'Token not provided']);
        }

        $payload = JWTAuth::parseToken()->getPayload();

        $location = UserLocation::create([
            'flat_no' => $request->flat_no,
            'house_no' => $request->house_no,
            'road' => $request->road,
            'area' => $request->area,
            'postcode' => $request->postcode,
            'country' => $request->country,
            'user_id' => $payload->get('sub'),
        ]);

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Location added successfully !',
            'data' => null,
            'description' => null,
        ]);
    }

    public function savedLocation()
    {
        $user = $this->getAuthenticatedUser();

        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'User not found'
            ]);
        }

        $locations = $user->UserLocation()->get();
        $savedLocations = [];
        if (empty($locations)) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'No saved location found'
            ]);
        }
        foreach ($locations as $location) {
            $savedLocations[] =
                [
                    'flat_no' => $location->flat_no ?? null,
                    'house_no' => $location->house_no ?? null,
                    'road' => $location->road ?? null,
                    'area' => $location->area ?? null,
                    'postcode' => $location->postcode ?? null,
                    'country' => $location->country ?? null,
                ];
        }
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Address data retrived successfully !',
            'data' => $savedLocations,
        ]);
    }
}
