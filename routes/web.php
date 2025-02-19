<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppUserController;
use App\Http\Controllers\SubadminController;
use App\Http\Controllers\CampaignController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\Servicecontroller;
use App\Http\Controllers\SubServicesController;
use Illuminate\Support\Facades\Auth;

// Public routes (non-authenticated)
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('login');
})->name('login');

Route::post('/login', [UserController::class, 'login']);

// Logout route
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Authenticated routes (protected by middleware)
Route::middleware(['auth'])->group(function () {

    // Dashboard and Profile
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::prefix('my-profile')->group(function () {
        Route::get('/', function () {
            return view('profile');
        })->name('my-profile');

        Route::put('/', [ProfileController::class, 'update'])->name('my-profile.update');
    });

    // Campaign routes
    Route::prefix('campaign')->group(function () {
        Route::get('/', [CampaignController::class, 'index'])->name('campaign.index');
        Route::get('add', function () {
            return view('campaign-add');
        })->name('campaign.add');

        Route::post('add', [CampaignController::class, 'add'])->name('campaign.store');
    });

    // Sub-admin routes
    Route::prefix('sub-admin')->group(function () {
        Route::get('/', [SubadminController::class, 'index'])->name('sub-admin.index');

        Route::get('add', function () {
            return view('subadminadd');
        })->name('sub-admin.add');

        Route::post('add', [SubadminController::class, 'add'])->name('sub-admin.store');
    });

    // services 
    Route::prefix('our-services')->group(function () {
        //
        Route::get('/', [Servicecontroller::class, 'index'])->name('our-services.index');
        Route::get('sub-services/{service_id}', [SubServicesController::class, 'index'])->name('sub-services.index');
        Route::get('add/{service_id}', [SubServicesController::class, 'addSubService'])->name('add.addSubService');
        Route::post('add/{service_id}', [SubServicesController::class, 'store'])->name('store.subservice');
    });

    // Users routes

    Route::get('users', [AppUserController::class, 'index'])->name('users.index');
    // Professional routes
    Route::get('professional', [ProfessionalController::class, 'index'])->name('professional.index');

    // Route::get('professional', function () {
    //     return view('professional');
    // })->name('professional');

    // Orders routes
    Route::get('orders', function () {
        return view('orders');
    })->name('orders');

    // Settings routes
    Route::get('settings', function () {
        return view('settings');
    })->name('settings');
});
