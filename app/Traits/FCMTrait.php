<?php

namespace App\Traits;

use App\Models\DeviceToken;
use App\Models\Notification as ModelsNotification;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Exception\Messaging\NotFound;


trait FCMTrait
{
    protected function sendFCM($deviceToken, $title, $body)
    {
        $factory = (new Factory)->withServiceAccount(storage_path('app/firebase/firebase-credentials.json'));
        $messaging = $factory->createMessaging();

        $message = CloudMessage::new()
            ->withTarget('token', $deviceToken)
            ->withNotification(Notification::create($title, $body));

        return $messaging->send($message);
    }

    protected function sendPushNotification($userId, $userType, $title, $body)
    {
        $tokens = DeviceToken::where('tokenable_id', $userId)
            ->where('tokenable_type', $userType)
            ->get();

        foreach ($tokens as $token) {

            try {

                $this->sendFCM($token->device_token, $title, $body);

                $user_id = null;
                $professional_id = null;
                if ($token->tokenType == 1) {
                    $user_id = $userId;
                } else {
                    $professional_id = $userId;
                }

                ModelsNotification::create([
                    'professional_id' => $professional_id,
                    'user_id' => $user_id,
                    'title' => $title,
                    'body' => $body
                ]);
            } catch (NotFound $e) {

                $token->delete();
            }
        }
    }
}
