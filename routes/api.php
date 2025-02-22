<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\auth\AuthController;
use App\Http\Controllers\api\v1\home\DashboardController;
use App\Http\Controllers\api\v1\home\ServiceController;
use App\Http\Controllers\api\v1\TimeSlotController;
use App\Http\Controllers\Servicecontroller as ControllersServicecontroller;
use PHPUnit\Architecture\Services\ServiceContainer;

Route::prefix('v1')->group(function () {
    // auth route 
    Route::prefix('auth/user')->group(function () {
        Route::post('register', [AuthController::class, 'user_register']);
        // Route::middleware('jwt.auth')->get('user-profile', 'AuthController@userProfile');
        Route::get('profile', [AuthController::class, 'userProfile']);
        Route::post('verify', [AuthController::class, 'verify']);

        Route::post('login', [AuthController::class, 'user_login']);
        Route::post('location', [AuthController::class, 'add_location']);
        // Route::get('test', function () {
        //     return response()->json(['message' => 'API Routes are working!']);
        // });
    });

    Route::prefix('home/user')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index']);

        Route::get('sub-services/{id}', [ServiceController::class, 'index']);

        Route::get('service-details/{sub_serviceId}', [ServiceController::class, 'details']);

        Route::get('apitest', function () {
            return response()->json(['message' => 'Home API Routes are working!']);
        });
    });

    Route::get('user/schedules', [TimeSlotController::class, 'index']);

    // Route::post('user/order',  []);
});
