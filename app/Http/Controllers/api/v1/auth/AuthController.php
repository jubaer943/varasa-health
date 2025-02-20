<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;
use Laravel\Ui\Presets\React;

class AuthController extends Controller
{
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

        // Generate a random 5-digit OTP
        $otp = random_int(10000, 99999);
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
        $otp = random_int(10000, 99999);

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
                'message' => 'Phone number not found.',
                'data' => null
            ], 400);
        }

        // Check if OTP matches
        $userWithOtp = AppUser::where('phone', $phone)->where('otp', $otp)->first();
        if (!$userWithOtp) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP.',
                'data' => null,
            ], 400);
        }

        // Check OTP expiry
        if (Carbon::now()->greaterThan($userWithOtp->otp_expires_at)) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP expired.'
            ], 400);
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

    public function userProfile()
    {
        try {
            $token = JWTAuth::getToken();
            if (!$token) {

                return response()->json(['error' => 'Token not provided'], 400);
            }
            $payload = JWTAuth::parseToken()->getPayload();

            $user = AppUser::where('id', $payload->get('sub'))->first();

            if ($user) {
                return response()->json([
                    'status' => true,
                    'message' => 'Profile data retrive successfully.',
                    'code' => 200,
                    'data' => [
                        'fullName' => $user->fullname,
                        'dob' => $user->dob,
                        'gender' => $user->gender,
                        'phone' => $user->phone,
                        'email' => $user->email,
                        'primary_location' => $user->primary_location,
                        'profile_picture' => $user->profile_picture,
                    ],
                    'description' => null,
                ]);
                // return response()->json(['user' => $user]);
            } else {

                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['error' => 'Token is expired'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['error' => 'Token is invalid'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['error' => 'Token is absent'], 401);
        } catch (\Exception $e) {

            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function add_location(Request $request)
    {
        return $request->input();
        // $token = JWTAuth::getToken();
        // if (!$token) {
        //     return response()->json(['satus' => false, 'code' => 400, 'message' => 'Token not provided']);
        // }
        // $payload = JWTAuth::parseToken()->getPayload();

        // $location = AppUser::where('id', $payload->get('sub'))->first()->UserLocation;

        // return response()->json($location);
    }
}
