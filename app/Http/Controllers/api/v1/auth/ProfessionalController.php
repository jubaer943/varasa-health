<?php

namespace App\Http\Controllers\api\v1\auth;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Models\Professional;
use App\AuthenticatedProfessional;
use App\Models\ProfessioanalLocation;
use App\Traits\SendsSms;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

use function PHPUnit\Framework\returnSelf;

class ProfessionalController extends Controller
{
    use SendsSms;
    use AuthenticatedProfessional;
    //sent otp for registration 
    public function sentOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits:11',
        ], [
            'phone.required' => 'Phone number is required.',
            'phone.digits' => 'Phone number must be exactly 11 digits.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => $validator->errors()->first('phone'),
                'otp' => null,
            ], 422);
        }

        $rawPhone = (string) $request->phone;
        $cleanPhone = preg_replace('/^\+?88/', '', preg_replace('/\s+|-/', '', $rawPhone));
        $isDemoNumber = in_array($cleanPhone, ['01313229492', '1313229492', '01703326358', '1703326358']);

        $otp = $isDemoNumber ? 123456 : random_int(100000, 999999);

        if (!$isDemoNumber) {
            $this->sendOtp($request->phone, $otp);
        }

        try {
            // Fetch the user
            $existingUser = Professional::where('phone', $request->phone)->first();

            if ($existingUser) {
                // if status is 2 user register not complite yet 
                if ($existingUser->status !== 2) {
                    return response()->json([
                        'status' => false,
                        'code' => 409,
                        'message' => 'Phone number already exists.',
                        'otp' => null,
                    ], 409);
                }

                $existingUser->otp = $otp;
                $existingUser->otp_expires_at = $isDemoNumber ? Carbon::now()->addYears(2) : Carbon::now()->addMinutes(2);
                $existingUser->save();

                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => 'OTP sent successfully!',
                    'otp' => $otp,
                ], 200);
            }

            Professional::create([
                'phone' => $request->phone,
                'otp' => $otp,
                'otp_expires_at' => $isDemoNumber ? Carbon::now()->addYears(2) : Carbon::now()->addMinutes(2),
                'status' => 2
            ]);

            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'OTP sent successfully!',
                'otp' => $otp,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function otpVerify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits:11',
            'otp' => 'required',
        ], [
            'phone.required' => 'Phone number is required.',
            'phone.digits' => 'Phone number must be exactly 11 digits.',
            'otp.required' => 'Otp is required.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => $validator->errors(),
                'data' => null,
            ], 422);
        }


        $rawPhone = (string) $request->phone;
        $cleanPhone = preg_replace('/^\+?88/', '', preg_replace('/\s+|-/', '', $rawPhone));
        $isDemoNumber = in_array($cleanPhone, ['01313229492', '1313229492', '01703326358', '1703326358']);

        $user = Professional::where('phone', $request->phone)
            ->orWhere('phone', $cleanPhone)
            ->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Phone number not found.',
                'data' => null
            ], 400);
        }

        // Google Play Console demo credential: fixed OTP 123456
        if (!($isDemoNumber && (string)$request->otp === '123456')) {
            // Check if OTP matches
            $userWithOtp = Professional::where('phone', $request->phone)->where('otp', $request->otp)->first();
            if (!$userWithOtp) {
                return response()->json([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Invalid OTP.',
                    'data' => null,
                ], 400);
            }

            if (Carbon::now()->greaterThan($userWithOtp->otp_expires_at)) {
                return response()->json([
                    'status' => false,
                    'code' => 400,
                    'message' => 'OTP expired.',
                    'data' => null,
                ], 400);
            }

            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();
        }

        $formData = [
            'professional_type' => $user->professional_type,
            'service_city' => $user->service_city,
            'service_area' => $user->service_area,
            'full_name' => $user->full_name,
            'ref_phone' => $user->ref_phone,
            'email' => $user->email,
            'dob' => $user->dob,
            'nid_number' => $user->nid_number,
            'ref_nid' => $user->ref_nid,
            'nid_front_photo' => $user->nid_front_photo !== null ? url('storage/' . $user->nid_front_photo) : null,
            'nid_back_photo' => $user->nid_back_photo !== null ?  url('storage/' . $user->nid_back_photo) : null,
            'license_photo' => $user->license_photo !== null ? url('storage/' . $user->license_photo) : null,
        ];
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Verified successfully !',
            'data' => $formData,
        ], 200);
    }

    public function othersInfo(Request $request)
    {
        $user = Professional::where('phone', $request->verified_number)->where('status', 2)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'verified number not found ',
            ], 404);
        }


        $user->professional_type = $request->profession;
        $user->service_city = $request->service_city;
        $user->service_area = $request->service_aria;
        $user->full_name = $request->full_name;
        $user->ref_phone = $request->ref_phone;
        $user->email  = $request->email;
        $user->gender = $request->gender;
        $user->password = Hash::make($request->password);
        $user->dob = $request->dob;
        $user->nid_number = $request->nid_no;
        $user->ref_nid = $request->ref_nid_no;
        $user->save();

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Information added successfully !',
        ], 200);
    }

    public function document(Request $request)
    {
        $validatior = Validator::make(
            $request->all(),
            [
                'verified_number' => 'required|digits:11',
                'nid_front' => 'required',
                'nid_back' => 'required',
                'license' => 'nullable',
            ]
        );

        if ($validatior->fails()) {
            return response()->json(['status' => false, 'code' => 422, 'message' => $validatior->errors()], 422);
        }

        $user = Professional::where('phone', $request->verified_number)->where('status', 2)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'verified number not found ',
            ], 404);
        }
        $nid_front_path = null;
        $nid_back_path = null;
        $license_path = null;
        if ($request->hasFile('nid_front')) {
            $nid_front_path = $request->file('nid_front')->store('professional', 'public');
        }
        if ($request->hasFile('nid_back')) {
            $nid_back_path = $request->file('nid_back')->store('professional', 'public');
        }
        if ($request->hasFile('license')) {
            $license_path = $request->file('license')->store('professional', 'public');
        }

        $user->nid_front_photo = $nid_front_path;
        $user->nid_back_photo = $nid_back_path;
        $user->license_photo = $license_path;
        $user->status = 0;
        $user->save();

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Documents uploaded successfully !'
        ], 200);
    }


    public function login(Request $request)
    {
        $rawPhone = (string) $request->phone;
        $cleanPhone = preg_replace('/^\+?88/', '', preg_replace('/\s+|-/', '', $rawPhone));
        $request->merge(['phone' => $cleanPhone]);

        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits:11',
            'password' => 'required',
        ], [
            'phone.required' => 'Phone number is required.',
            'phone.digits' => 'Phone number must be exactly 11 digits.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => $validator->errors(),
                'data' => null,
            ], 422);
        }

        $user = Professional::where('phone', $cleanPhone)
            ->orWhere('phone', $rawPhone)
            ->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'This Mobile number is not registered yet.',
                'data' => null,
            ], 404);
        }

        $isDemoNumber = in_array($cleanPhone, ['01313229492', '1313229492']);
        $passwordMatches = ($isDemoNumber && (string)$request->password === '123456') || Hash::check($request->password, $user->password);

        if (!$passwordMatches) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Incorrect password.',
                'data' => null,
            ], 400);
        }
        $token = JWTAuth::fromUser($user);
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Login successful!',
            'data' => [
                'id' => $user->id,
                'phone' => $user->phone,
                'name' => $user->full_name,
                'status' => (int) $user->status,
                'profile_picture' => $user->profile_picture ? url('storage/' . $user->profile_picture) : null,
                'ratting' => $user->providerAverageRating,
                'token' => $token,  // Only if using token authentication
            ],
        ], 200);
    }


    public function updateLocation(Request $request)
    {

        $professional = $this->getAuthenticatedProfessional();

        if (!$professional) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid or missing token or professional not found',
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'lang' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => $validator->errors(),
                'data' => null,
            ], 422);
        }

        ProfessioanalLocation::updateOrCreate(
            ['professional_id' => $professional->id],
            [
                'latitude' => $request->lat,
                'longitiude' => $request->lang,
            ]
        );


        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Location updated successfully'
        ]);
    }

    public function profile()
    {
        $professional = $this->getAuthenticatedProfessional();

        if (!$professional) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid or missing token or professional not found',
            ], 400);
        }

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Profile retrieved successfully',
            'data' => [
                'fullName' => $professional->full_name,
                'dob' => date('d-m-Y', strtotime($professional->dob)),
                'gender' => (int) $professional->gender,
                'phone' => $professional->phone,
                'email' => $professional->email,
                'userId' => $professional->professional_id,
                'status' => (int) $professional->status,
                'nid_number' => $professional->nid_number,
                'nid_front_photo' => $professional->nid_front_photo ? url('storage/' . $professional->nid_front_photo) : null,
                'nid_back_photo' => $professional->nid_back_photo ? url('storage/' . $professional->nid_back_photo) : null,
                'license_photo' => $professional->license_photo ? url('storage/' . $professional->license_photo) : null,
                'profile_picture' => $professional->profile_picture ? url('storage/' . $professional->profile_picture) : null,
            ]
        ]);
    }

    public function profileUpdate(Request $request)
    {
        $professional = $this->getAuthenticatedProfessional();

        if (!$professional) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid or missing token or professional not found',
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'name'            => 'nullable|string|max:255',
            'fullName'        => 'nullable|string|max:255',
            'full_name'       => 'nullable|string|max:255',
            'dob'             => 'nullable|string|max:255',
            'gender'          => 'nullable',
            'email'           => 'nullable|email|max:255',
            'profile_picture' => 'nullable|max:25600',
            'profile_pic'     => 'nullable|max:25600',
            'image'           => 'nullable|max:25600',
            'photo'           => 'nullable|max:25600',
            'avatar'          => 'nullable|max:25600',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => $validator->errors(),
                'data' => null,
            ], 422);
        }

        // Update basic fields
        $fullName = $request->full_name ?? $request->fullName ?? $request->name;
        if ($fullName !== null) {
            $professional->full_name = $fullName;
        }
        if ($request->dob !== null) {
            $professional->dob = $request->dob;
        }
        if ($request->gender !== null) {
            $professional->gender = (int) $request->gender;
        }
        if ($request->email !== null) {
            $professional->email = $request->email;
        }

        // Handle image upload if exists
        $file = $request->file('profile_picture') 
             ?? $request->file('profile_pic') 
             ?? $request->file('image') 
             ?? $request->file('photo') 
             ?? $request->file('avatar') 
             ?? $request->file('file');

        if ($file && $file->isValid()) {
            if ($professional->profile_picture && Storage::disk('public')->exists($professional->profile_picture)) {
                Storage::disk('public')->delete($professional->profile_picture);
            }
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('professionals/profile_pics', $filename, 'public');
            $professional->profile_picture = 'professionals/profile_pics/' . $filename;
        }

        $professional->save();

        $pictureUrl = $professional->profile_picture ? url('storage/' . $professional->profile_picture) : null;

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Profile updated successfully',
            'data' => [
                'fullName'        => $professional->full_name,
                'dob'             => $professional->dob ? date('d-m-Y', strtotime($professional->dob)) : null,
                'gender'          => (int) $professional->gender,
                'phone'           => $professional->phone,
                'email'           => $professional->email,
                'userId'          => $professional->professional_id,
                'profile_picture' => $pictureUrl,
                'profile_pic'     => $pictureUrl,
            ],
        ]);
    }


    public function changePassword(Request $request)
    {
        $professional = $this->getAuthenticatedProfessional();

        if (!$professional) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid or missing token or professional not found',
            ], 400);
        }

        // Validate request
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ], [
            'old_password.required' => 'Old password is required.',
            'new_password.required' => 'New password is required.',
            'new_password.confirmed' => 'New password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Check old password
        if (!Hash::check($request->old_password, $professional->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Old password is incorrect.',
            ], 401);
        }

        // Update password
        $professional->password = Hash::make($request->new_password);
        $professional->save();

        return response()->json([
            'status' => true,
            'message' => 'Password changed successfully.',
        ]);
    }

    /**
     * Send OTP for Forgot Password
     */
    public function forgotPasswordSentOtp(Request $request)
    {
        $rawPhone = (string) $request->phone;
        $cleanPhone = preg_replace('/^\+?88/', '', preg_replace('/\s+|-/', '', $rawPhone));
        $request->merge(['phone' => $cleanPhone]);

        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits:11',
        ], [
            'phone.required' => 'Phone number is required.',
            'phone.digits' => 'Phone number must be exactly 11 digits.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => $validator->errors()->first('phone'),
                'otp' => null,
            ], 422);
        }

        $user = Professional::where('phone', $cleanPhone)
            ->orWhere('phone', $rawPhone)
            ->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'This mobile number is not registered.',
                'otp' => null,
            ], 404);
        }

        $isDemoNumber = in_array($cleanPhone, ['01313229492', '1313229492', '01703326358', '1703326358']);
        $otp = $isDemoNumber ? 123456 : random_int(100000, 999999);

        if (!$isDemoNumber) {
            $this->sendOtp($user->phone, (string)$otp);
        }

        $user->otp = $otp;
        $user->otp_expires_at = $isDemoNumber ? Carbon::now()->addYears(2) : Carbon::now()->addMinutes(5);
        $user->save();

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'OTP sent successfully for password reset.',
            'otp' => $otp,
        ], 200);
    }

    /**
     * Verify OTP for Forgot Password
     */
    public function forgotPasswordVerify(Request $request)
    {
        $rawPhone = (string) $request->phone;
        $cleanPhone = preg_replace('/^\+?88/', '', preg_replace('/\s+|-/', '', $rawPhone));

        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'otp' => 'required',
        ], [
            'phone.required' => 'Phone number is required.',
            'otp.required' => 'OTP is required.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 422);
        }

        $user = Professional::where('phone', $cleanPhone)
            ->orWhere('phone', $rawPhone)
            ->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'Professional not found.',
                'data' => null,
            ], 404);
        }

        $isDemoNumber = in_array($cleanPhone, ['01313229492', '1313229492', '01703326358', '1703326358']);

        if (!($isDemoNumber && (string)$request->otp === '123456')) {
            if ((string)$user->otp !== (string)$request->otp) {
                return response()->json([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Invalid OTP.',
                    'data' => null,
                ], 400);
            }

            if ($user->otp_expires_at && Carbon::now()->greaterThan($user->otp_expires_at)) {
                return response()->json([
                    'status' => false,
                    'code' => 400,
                    'message' => 'OTP has expired.',
                    'data' => null,
                ], 400);
            }
        }

        // Generate temporary password reset token valid for 15 minutes
        $resetToken = Str::random(60);
        Cache::put('prof_reset_' . $user->id, $resetToken, now()->addMinutes(15));
        Cache::put('prof_reset_phone_' . $cleanPhone, $resetToken, now()->addMinutes(15));

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'OTP verified successfully.',
            'data' => [
                'phone' => $user->phone,
                'reset_token' => $resetToken,
            ],
        ], 200);
    }

    /**
     * Reset Password (Accepts reset_token OR otp)
     */
    public function forgotPasswordReset(Request $request)
    {
        $rawPhone = (string) $request->phone;
        $cleanPhone = preg_replace('/^\+?88/', '', preg_replace('/\s+|-/', '', $rawPhone));

        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required|string|min:6',
        ], [
            'phone.required' => 'Phone number is required.',
            'password.required' => 'New password is required.',
            'password.min' => 'Password must be at least 6 characters.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        // Check password confirmation if provided under any standard key
        $confirmation = $request->password_confirmation ?? $request->confirm_password;
        if ($confirmation !== null && $request->password !== $confirmation) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => 'Password confirmation does not match.',
            ], 422);
        }

        $user = Professional::where('phone', $cleanPhone)
            ->orWhere('phone', $rawPhone)
            ->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'Professional not found.',
            ], 404);
        }

        $isDemoNumber = in_array($cleanPhone, ['01313229492', '1313229492', '01703326358', '1703326358']);
        $isAuthorized = false;

        // Check reset_token if provided
        if ($request->has('reset_token')) {
            $cachedToken = Cache::get('prof_reset_' . $user->id) ?? Cache::get('prof_reset_phone_' . $cleanPhone);
            if ($cachedToken && hash_equals($cachedToken, (string)$request->reset_token)) {
                $isAuthorized = true;
            }
        }

        // Alternatively check OTP if reset_token was not provided or didn't match
        if (!$isAuthorized && $request->has('otp')) {
            if ($isDemoNumber && (string)$request->otp === '123456') {
                $isAuthorized = true;
            } elseif ((string)$user->otp === (string)$request->otp && (!$user->otp_expires_at || Carbon::now()->lessThanOrEqualTo($user->otp_expires_at))) {
                $isAuthorized = true;
            }
        }

        if (!$isAuthorized) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid or expired reset token or OTP. Please request a new OTP.',
            ], 400);
        }

        // Reset password
        $user->password = Hash::make($request->password);
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        // Clear reset token cache
        Cache::forget('prof_reset_' . $user->id);
        Cache::forget('prof_reset_phone_' . $cleanPhone);

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Password has been reset successfully. You can now login with your new password.',
        ], 200);
    }

    public function verificationStatus(Request $request)
    {
        $user = null;

        if ($request->filled('phone')) {
            $rawPhone = (string) $request->phone;
            $cleanPhone = preg_replace('/^\+?88/', '', preg_replace('/\s+|-/', '', $rawPhone));
            $user = Professional::where('phone', $cleanPhone)->orWhere('phone', $rawPhone)->first();
        } else {
            $user = $this->getAuthenticatedProfessional();
        }

        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'Professional not found.',
                'data' => null,
            ], 404);
        }

        $statusCode = (int) $user->status;
        $statusText = match ($statusCode) {
            1 => 'approved',
            0 => 'pending',
            2 => 'documents_required',
            default => 'inactive',
        };

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Verification status retrieved successfully.',
            'data' => [
                'status' => $statusCode,
                'status_text' => $statusText,
                'is_approved' => $statusCode === 1,
                'has_nid_front' => !empty($user->nid_front_photo),
                'has_nid_back' => !empty($user->nid_back_photo),
                'has_license' => !empty($user->license_photo),
                'nid_number' => $user->nid_number,
                'nid_front_photo' => $user->nid_front_photo ? url('storage/' . $user->nid_front_photo) : null,
                'nid_back_photo' => $user->nid_back_photo ? url('storage/' . $user->nid_back_photo) : null,
                'license_photo' => $user->license_photo ? url('storage/' . $user->license_photo) : null,
            ],
        ], 200);
    }
}

