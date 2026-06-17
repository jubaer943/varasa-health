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

        $otp = random_int(100000, 999999);

        $this->sendOtp($request->phone, $otp);

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

                $otp = rand(100000, 999999);
                $existingUser->otp = $otp;
                $existingUser->otp_expires_at = Carbon::now()->addMinutes(2);
                $existingUser->save();

                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => 'OTP sent successfully!',
                    'otp' => $otp,
                ], 200);
            }

            $otp = rand(100000, 999999);
            Professional::create([
                'phone' => $request->phone,
                'otp' => $otp,
                'otp_expires_at' => Carbon::now()->addMinutes(2),
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


        $user = Professional::where('phone', $request->phone)->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Phone number not found.',
                'data' => null
            ], 400);
        }

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
            $nid_back_path = $request->file('nid_front')->store('professional', 'public');
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

        $user = Professional::where('phone', $request->phone)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'This Mobile number is not registered yet.',
                'data' => null,
            ], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
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
                'profile_picture' => $user->profile_picture,
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
                'profile_picture' => url('storage/' . $professional->profile_picture),
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
            'name'    => 'required|string|max:255',
            'dob'          => 'required|date',
            'gender'       => 'required|in:1,2',
            'email'        => 'required|email|max:255',
            'profile_pic'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
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
        $professional->full_name = $request->name;
        $professional->dob       = $request->dob;
        $professional->gender    = $request->gender;
        $professional->email     = $request->email;

        // Handle image upload if exists
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/professionals/profile_pics', $filename); // Save to storage/app/public/...

            // Optional: delete old file if you store previous path in DB
            // Storage::delete($professional->profile_pic);

            $professional->profile_picture = 'professionals/profile_pics/' . $filename;
        }

        $professional->save();

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Profile updated successfully',
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
}
