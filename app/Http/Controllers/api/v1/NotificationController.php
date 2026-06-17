<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FCMTrait;
use App\Traits\SendsSms;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\AuthenticatedProfessional;
use App\Models\AppUser;
use App\Models\DeviceToken;
use App\Models\Notification;

class NotificationController extends Controller
{
    use SendsSms;
    use FCMTrait;
    use AuthenticatedProfessional;


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

    public function saveFCMToken(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'tokenType' => 'required|integer',
                'fcm_token' => 'required|string',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => $validator->errors(),
                'otp' => null,
            ], 200);
        }

        // Get user based on tokenType
        if ((int)$request->tokenType === 1) {
            $user = $this->getAuthenticatedUser();
        } elseif ((int)$request->tokenType === 0) {
            $user = $this->getAuthenticatedProfessional();
        } else {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid tokenType provided.',
            ], 400);
        }

        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 401,
                'message' => 'Unauthorized or token invalid.',
            ], 401);
        }
        // return response()->json($user);
        $tokenType = (int)$request->tokenType === 1 ? $user->userId : $user->professional_id;
        // Save or update the FCM token
        DeviceToken::updateOrInsert(
            ['device_token' => $request->fcm_token],
            [
                'tokenable_id' => $user->id,
                'tokenable_type' => $tokenType,
                'tokenType' => $request->tokenType,
                'device_token' => $request->fcm_token,
            ]
        );

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'FCM token saved successfully.',

        ]);
    }


    public function sendNotification()
    {
        $this->sendPushNotification(2, 'P0002', 'Order', 'Order placed successfully !');


        return response()->json(['message' => 'Notification sent successfully']);
    }

    public function allNotifications($user_type)
    {

        if ((int) $user_type === 1) {
            $user = $this->getAuthenticatedUser();
        } elseif ((int) $user_type === 0) {
            $user = $this->getAuthenticatedProfessional();
        } else {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid tokenType provided.',
                'data' => null,
            ], 400);
        }
        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 401,
                'message' => 'Unauthorized or token invalid.',
                'data' => null,
            ], 401);
        }
        $notifications = (int) $user_type === 1 ? Notification::where('user_id', $user->id)->get() : Notification::where('professional_id', $user->id)->get();


        if (!$notifications) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'Notification not found.',
                'data' => null,
            ], 404);
        }

        $data = [];

        foreach ($notifications as $notification) {
            $data[] = [
                'sender_picture' => null,
                'title' => $notification->title,
                'notification' => $notification->body,
                'date_time' => $notification->created_at,
            ];
        }

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Notifications retrieved successfully.',
            'data' => $data,
        ], 200);
    }

    public function testSms()
    {
        $result = $this->sendOtp('01313229493', '123456');

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'SMS sent successfully.',
            'data' => $result,
        ]);
    }
    /**
     * Check FCM token validity by sending a test message.
     */
    public function checkFCMToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string',
        ]);

        $token = $request->fcm_token;

        // Call the checker function
        $result = $this->sendFCMMessageAndCheckToken($token, "Token validation test");

        // Return as JSON
        return response()->json($result);
    }

    private function sendFCMMessageAndCheckToken($token, $message)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = config('services.fcm.server_key'); // Store in config/services.php

        $fields = [
            'to' => $token,
            'notification' => [
                'title' => 'Token Check',
                'body' => $message,
            ],
        ];

        $headers = [
            'Authorization: key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);

        if ($result === false) {
            $error = curl_error($ch);
            curl_close($ch);
            return [
                'success' => false,
                'type' => 'curl_error',
                'message' => $error,
            ];
        }

        curl_close($ch);

        $response = json_decode($result, true);

        if (isset($response['results'][0]['error'])) {
            $error = $response['results'][0]['error'];
            $unregisteredErrors = ['NotRegistered', 'InvalidRegistration', 'MismatchSenderId'];

            if (in_array($error, $unregisteredErrors)) {
                return [
                    'success' => false,
                    'type' => 'unregistered_token',
                    'message' => $error,
                ];
            } else {
                return [
                    'success' => false,
                    'type' => 'other_fcm_error',
                    'message' => $error,
                ];
            }
        }

        return [
            'success' => true,
            'type' => 'sent',
            'response' => $response,
        ];
    }
}
