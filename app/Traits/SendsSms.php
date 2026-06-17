<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait SendsSms
{
    /**
     * Send an SMS to the provided phone number with the specified message.
     *
     * @param string $phoneNumber
     * @param string $message
     * @return array
     */
    public function sendSms(string $phoneNumber, string $message): array
    {
        $url = config('sms.url');
        $apiKey = config('sms.key');

        // Construct the request URL
        $requestUrl = $this->buildRequestUrl($url, $apiKey, $message, $phoneNumber);

        try {
            // Send the GET request
            $response = Http::get($requestUrl);

            // Check for a successful response
            if ($response->successful()) {
                return $this->handleSuccessResponse($response);
            }

            // Log and return failure if the response was not successful
            return $this->handleFailureResponse($response);
        } catch (\Exception $e) {
            Log::error('SMS sending failed', ['error' => $e->getMessage()]);
            return $this->handleException($e);
        }
    }

    /**
     * Construct the request URL with parameters.
     *
     * @param string $url
     * @param string $apiKey
     * @param string $message
     * @param string $phoneNumber
     * @return string
     */
    private function buildRequestUrl(string $url, string $apiKey, string $message, string $phoneNumber): string
    {
        return $url . '?api_key=' . $apiKey . '&msg=' . urlencode($message) . '&to=' . $phoneNumber;
    }

    /**
     * Handle the success response.
     *
     * @param \Illuminate\Http\Client\Response $response
     * @return array
     */
    private function handleSuccessResponse($response): array
    {
        return [
            'success' => true,
            'status' => $response->status(),
            'message' => $response->body(),
        ];
    }

    /**
     * Handle the failure response.
     *
     * @param \Illuminate\Http\Client\Response $response
     * @return array
     */
    private function handleFailureResponse($response): array
    {
        Log::warning('SMS sending failed', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return [
            'success' => false,
            'status' => $response->status(),
            'message' => $response->body(),
        ];
    }

    /**
     * Handle exception errors.
     *
     * @param \Exception $exception
     * @return array
     */
    private function handleException(\Exception $exception): array
    {
        return [
            'success' => false,
            'error' => $exception->getMessage(),
        ];
    }

    /**
     * Send an OTP SMS.
     *
     * @param string $phoneNumber
     * @param string $otp
     * @return array
     */
    public function sendOtp(string $phoneNumber, string $otp): array
    {
        $message = "Your OTP is: " . $otp;
        return $this->sendSms($phoneNumber, $message);
    }
}
