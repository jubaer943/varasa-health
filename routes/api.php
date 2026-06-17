<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\auth\AuthController;
use App\Http\Controllers\api\v1\auth\ProfessionalController;
use App\Http\Controllers\api\v1\home\DashboardController;
use App\Http\Controllers\Api\V1\Home\EarningController;
use App\Http\Controllers\api\v1\home\ServiceController;
use App\Http\Controllers\api\v1\home\OrderController;
use App\Http\Controllers\api\v1\NotificationController;
use App\Http\Controllers\api\v1\TimeSlotController;
use App\Http\Controllers\Servicecontroller as ControllersServicecontroller;
use App\Models\Notification;
use PHPUnit\Architecture\Services\ServiceContainer;


Route::prefix('v1')->group(function () {
    // auth route 
    Route::prefix('auth/user')->group(function () {
        Route::post('register', [AuthController::class, 'user_register']);
        Route::get('profile', [AuthController::class, 'userProfile']);
        Route::post('profile/update', [AuthController::class, 'profileUpdate']);
        Route::post('verify', [AuthController::class, 'verify']);

        Route::post('login', [AuthController::class, 'user_login']);
        Route::post('location', [AuthController::class, 'add_location']);
        Route::get('saved/address', [AuthController::class, 'savedLocation']);
        Route::get('check', [AuthController::class, 'checkToken']);
    });

    Route::prefix('home/user')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index']);

        Route::get('sub-services/{id}', [ServiceController::class, 'index']);

        Route::get('service-details/{sub_serviceId}', [ServiceController::class, 'details']);

        Route::get('service/price', [ServiceController::class, 'addvancedPricing']);
        Route::get('service/diagnostictest', [ServiceController::class, 'diagnosticTest']);
        Route::get('service/hospitals/{test_id}', [ServiceController::class, 'testHospitals']);
    });

    Route::get('user/schedules', [TimeSlotController::class, 'index']);

    Route::prefix('auth/professional')->group(function () {
        Route::post('sentotp', [ProfessionalController::class, 'sentOtp']);
        Route::post('verify', [ProfessionalController::class, 'otpVerify']);
        Route::post('information', [ProfessionalController::class, 'othersInfo']);
        Route::post('document', [ProfessionalController::class, 'document']);
        Route::post('login', [ProfessionalController::class, 'login']);
        Route::get('profile', [ProfessionalController::class, 'profile']);
        Route::post('profile/update', [ProfessionalController::class, 'profileUpdate']);
        Route::post('change/password', [ProfessionalController::class, 'changePassword']);
    });

    // order routes 
    Route::prefix('user')->group(function () {
        Route::post('order',  [OrderController::class, 'placeOrder']);
        Route::get('myorders', [OrderController::class, 'myOrders']);
        Route::get('order/details/{order_id}', [OrderController::class, 'userOrderDetails']);
    });
    Route::prefix('professional')->group(function () {
        Route::get('orders', [OrderController::class, 'getOrder']);
        Route::get('order/details/{order_id}', [OrderController::class, 'orderDetails']);
        Route::post('order/action', [OrderController::class, 'updateOrderStatus']);
        Route::post('order/sendotp', [OrderController::class, 'sendOrderOtp']);
        Route::post('order/verifyotp', [OrderController::class, 'verifyOrderOtp']);
        Route::get('myservices', [OrderController::class, 'professionalServices']);
        Route::get('earning', [EarningController::class, 'dashboard']);
        Route::post('pay', [EarningController::class, 'payment']);
        Route::post('location', [ProfessionalController::class, 'updateLocation']);
        Route::get('transaction/history', [EarningController::class, 'transactionHistory']);
    });
    Route::prefix('notification')->group(function () {
        Route::get('/{user_type}', [NotificationController::class, 'allNotifications']);
        Route::post('save/token', [NotificationController::class, 'saveFCMToken']);
        Route::get('notify', [NotificationController::class, 'sendNotification']);
    });
    Route::post('sms', [NotificationController::class, 'testSms']);
    Route::get('check-fcm-token', [NotificationController::class, 'checkFCMToken']);
});
