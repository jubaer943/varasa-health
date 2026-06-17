<?php

namespace App;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Professional;

trait AuthenticatedProfessional
{
    protected function getAuthenticatedProfessional()
    {
        try {
            $token = JWTAuth::parseToken();
            $payload = $token->getPayload();
            return Professional::find($payload->get('sub'));
        } catch (\Exception $e) {
            return null;
        }
    }
}
