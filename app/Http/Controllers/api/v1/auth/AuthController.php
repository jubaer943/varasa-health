<?php

namespace App\Http\Controllers\api\v1\auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteAccountRequest;
use App\Models\AppUser;
use App\Models\UserLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;
use Laravel\Ui\Presets\React;
use App\AuthenticatedProfessional;
use App\Traits\SendsSms;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    use SendsSms;
    use AuthenticatedProfessional;

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
            'otp' => null,
            'description' => null,
        ]);
    }


    public function user_login(Request $request)
    {
        $credentials = $request->only('number', 'password');
        $rawNumber = (string) $request->number;
        $cleanNumber = preg_replace('/^\+?88/', '', preg_replace('/\s+|-/', '', $rawNumber));

        $user = AppUser::where('phone', $rawNumber)
            ->orWhere('phone', $cleanNumber)
            ->first();

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

        // Demo credentials for Google Play Console testing
        $isDemoNumber = in_array($cleanNumber, ['01703326358', '1703326358']);
        if ($isDemoNumber) {
            $user->otp = 123456;
            $user->otp_expires_at = Carbon::now()->addYears(2);
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Otp sent successfully !',
                'code' => 200,
                'otp' => null,
                'description' => null,
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
            'otp' => null,
            'description' => null,
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);
        $phone = (string) $request->number;
        $cleanNumber = preg_replace('/^\+?88/', '', preg_replace('/\s+|-/', '', $phone));
        $otp = (string) $request->otp;

        // Check if phone exists
        $user = AppUser::where('phone', $phone)
            ->orWhere('phone', $cleanNumber)
            ->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'Phone number not found.',
                'data' => null
            ]);
        }

        $isDemoNumber = in_array($cleanNumber, ['01703326358', '1703326358']);

        // Google Play Console demo credential: fixed OTP 123456
        if ($isDemoNumber && $otp === '123456') {
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

        // Check if OTP matches
        $userWithOtp = AppUser::where(function ($q) use ($phone, $cleanNumber) {
            $q->where('phone', $phone)->orWhere('phone', $cleanNumber);
        })->where('otp', $otp)->first();

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
                    'id' => $location->id,
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
        $validator = Validator::make($request->all(), [
            'name'            => 'nullable|string|max:255',
            'fullName'        => 'nullable|string|max:255',
            'fullname'        => 'nullable|string|max:255',
            'email'           => 'nullable|email|max:255',
            'gender'          => 'nullable',
            'dob'             => 'nullable|string|max:255',
            'profile_picture' => 'nullable|max:25600',
            'profile_pic'     => 'nullable|max:25600',
            'image'           => 'nullable|max:25600',
            'photo'           => 'nullable|max:25600',
            'avatar'          => 'nullable|max:25600',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = $this->getAuthenticatedUser();

        if (!$user) {
            return response()->json(['errors' => 'User not found'], 404);
        }

        $fullName = $request->fullname ?? $request->fullName ?? $request->name;
        if ($fullName !== null) {
            $user->fullname = $fullName;
        }
        if ($request->email !== null) {
            $user->email = $request->email;
        }
        if ($request->dob !== null) {
            $user->dob = $request->dob;
        }
        if ($request->gender !== null) {
            $user->gender = (int) $request->gender;
        }

        // Check for uploaded file in any common field name
        $file = $request->file('profile_picture') 
             ?? $request->file('profile_pic') 
             ?? $request->file('image') 
             ?? $request->file('photo') 
             ?? $request->file('avatar') 
             ?? $request->file('file');

        if ($file && $file->isValid()) {
            // Delete old file if present
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $path = $file->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        } else {
            // Check for base64 encoded image string
            $base64Image = $request->input('profile_picture') 
                        ?? $request->input('profile_pic') 
                        ?? $request->input('image');

            if ($base64Image && is_string($base64Image) && preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $imageContent = substr($base64Image, strpos($base64Image, ',') + 1);
                $ext = strtolower($type[1]);
                if (in_array($ext, ['jpg', 'jpeg', 'gif', 'png', 'webp'])) {
                    $decoded = base64_decode($imageContent);
                    if ($decoded !== false) {
                        $fileName = 'profile_pictures/' . uniqid() . '.' . $ext;
                        Storage::disk('public')->put($fileName, $decoded);
                        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                            Storage::disk('public')->delete($user->profile_picture);
                        }
                        $user->profile_picture = $fileName;
                    }
                }
            }
        }

        $user->save();

        $default_profilePic = $user->gender == 1 ? url('assets/images/profile_male.png') : url('assets/images/profile_female.jpg');
        $pictureUrl = $user->profile_picture ? url('storage/' . $user->profile_picture) : $default_profilePic;

        return response()->json([
            'status'  => true,
            'code'    => 200,
            'message' => "Profile updated successfully",
            'data'    => [
                'fullName'        => $user->fullname,
                'dob'             => $user->dob,
                'gender'          => (int) $user->gender,
                'phone'           => $user->phone,
                'email'           => $user->email,
                'userId'          => $user->userId,
                'profile_picture' => $pictureUrl,
                'profile_pic'     => $pictureUrl,
            ],
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
            'data' => [
                'id' => $location->id,
                'flat_no' => $location->flat_no,
                'house_no' => $location->house_no,
                'road' => $location->road,
                'area' => $location->area,
                'postcode' => $location->postcode,
                'country' => $location->country,
            ],
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
                    'id' => $location->id,
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

    public function update_location(Request $request, $id = null)
    {
        $user = $this->getAuthenticatedUser();
        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 401,
                'message' => 'Unauthorized or User not found',
            ], 401);
        }

        $locationId = $id ?? $request->id ?? $request->location_id;
        if (!$locationId) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => 'Location ID is required.',
            ], 422);
        }

        $location = UserLocation::where('id', $locationId)
            ->where('user_id', $user->id)
            ->first();

        if (!$location) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'Location not found or does not belong to user.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'flat_no' => 'nullable|string',
            'house_no' => 'nullable|string',
            'road' => 'nullable|string',
            'area' => 'nullable|string',
            'postcode' => 'nullable|string',
            'country' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        if ($request->has('flat_no')) $location->flat_no = $request->flat_no;
        if ($request->has('house_no')) $location->house_no = $request->house_no;
        if ($request->has('road')) $location->road = $request->road;
        if ($request->has('area')) $location->area = $request->area;
        if ($request->has('postcode')) $location->postcode = $request->postcode;
        if ($request->has('country')) $location->country = $request->country;

        $location->save();

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Location updated successfully !',
            'data' => [
                'id' => $location->id,
                'flat_no' => $location->flat_no,
                'house_no' => $location->house_no,
                'road' => $location->road,
                'area' => $location->area,
                'postcode' => $location->postcode,
                'country' => $location->country,
            ],
        ], 200);
    }

    public function delete_location(Request $request, $id = null)
    {
        $user = $this->getAuthenticatedUser();
        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 401,
                'message' => 'Unauthorized or User not found',
            ], 401);
        }

        $locationId = $id ?? $request->id ?? $request->location_id;
        if (!$locationId) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => 'Location ID is required.',
            ], 422);
        }

        $location = UserLocation::where('id', $locationId)
            ->where('user_id', $user->id)
            ->first();

        if (!$location) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'Location not found or does not belong to user.',
            ], 404);
        }

        $location->delete();

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Location deleted successfully !',
        ], 200);
    }


    public function deleteAccount(DeleteAccountRequest $request)
    {
        $accountType = (int) $request->account_type;
        $user = null;


        if ($accountType === 1) {
            $user = $this->getAuthenticatedUser();
        } elseif ($accountType === 2) {
            $user = $this->AuthenticatedProfessional();
        }

        if (!$user) {
            return response()->json([
                'status'  => false,
                'code'    => 401,
                'message' => 'Unauthenticated or user not found.',
                'data'    => [],
            ], 401);
        }

        $user->update([
            'phone' => 'DEL_' . time() . '_' . $user->phone,
        ]);

        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (\Exception $e) {
        }

        return response()->json([
            'status'  => true,
            'code'    => 200,
            'message' => 'Account deleted successfully!',
            'data'    => [],
        ], 200);
    }
}
