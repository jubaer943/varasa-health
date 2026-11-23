<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\Professional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class MapboxTokenController extends Controller
{
    public function store(Request $request)
    {
        $actor = $this->resolveAuthenticatedActor();
        if (!$actor) {
            return response()->json([
                'status'  => false,
                'message' => 'Unauthenticated.',
            ], 401);
        }

        $request->validate([
            'token' => ['required', 'string', 'max:2000'],
        ]);

        DB::table('app_settings')->updateOrInsert(
            ['key' => 'mapbox_public_token'],
            [
                'value'      => $request->token,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        return response()->json([
            'status'  => true,
            'message' => 'Mapbox token saved successfully.',
            'data'    => [
                'token' => $request->token,
            ],
        ]);
    }

    public function show()
    {
        $actor = $this->resolveAuthenticatedActor();
        if (!$actor) {
            return response()->json([
                'status'  => false,
                'message' => 'Unauthenticated.',
            ], 401);
        }

        $token = DB::table('app_settings')
            ->where('key', 'mapbox_public_token')
            ->value('value');

        return response()->json([
            'status' => true,
            'data'   => [
                'token' => $token,
            ],
        ]);
    }

    private function resolveAuthenticatedActor(): AppUser|Professional|null
    {
        try {
            $token = JWTAuth::parseToken();
            $payload = $token->getPayload();
            $sub = $payload->get('sub');

            if (!$sub) {
                return null;
            }

            if ($user = AppUser::find($sub)) {
                return $user;
            }

            return Professional::find($sub);
        } catch (\Throwable $e) {
            return null;
        }
    }
}
