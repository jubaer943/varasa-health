<?php

use App\Http\Controllers\Api\V1\Home\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppUserController;
use App\Http\Controllers\SubadminController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\Servicecontroller;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubServicesController;
use App\Http\Livewire\OrdersList;
use Illuminate\Support\Facades\Auth;

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('login');
})->name('login');

Route::post('/login', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::prefix('my-profile')->group(function () {
        Route::get('/', function () {
            return view('profile');
        })->name('my-profile');

        Route::put('/', [ProfileController::class, 'update'])->name('my-profile.update');
    });

    Route::prefix('campaign')->group(function () {
        Route::get('/', [CampaignController::class, 'index'])->name('campaign.index');
        Route::get('add', function () {
            return view('campaign-add');
        })->name('campaign.add');

        Route::post('add', [CampaignController::class, 'add'])->name('campaign.store');
        Route::post('action', [CampaignController::class, 'actions'])->name('campaign.action');
        Route::post('delete', [CampaignController::class, 'delete'])->name('campaign.delete');
    });

    Route::prefix('sub-admin')->group(function () {
        Route::get('/', [SubadminController::class, 'index'])->name('sub-admin.index');

        Route::get('add', function () {
            return view('subadminadd');
        })->name('sub-admin.add');

        Route::get('presentation/{admin_id}', [SubadminController::class, 'presentation'])->name('sub-admin.presentation');
        Route::post('add', [SubadminController::class, 'add'])->name('sub-admin.store');
        Route::post('presentation/{admin_id}', [SubadminController::class, 'permission'])->name('sub-admin.permissoin');
        Route::post('action', [SubadminController::class, 'adminActions'])->name('sub-admin.action');
    });

    Route::prefix('our-services')->group(function () {
        Route::get('/', [Servicecontroller::class, 'index'])->name('our-services.index');

        Route::get('edit/{service_id}', [SubServicesController::class, 'serviceData'])->name('our-services.edit');
        Route::post('edit/{service_id}', [SubServicesController::class, 'updateService'])->name('our-service.edited');
        Route::get('sub-services/{service_id}', [SubServicesController::class, 'index'])->name('sub-services.index');

        Route::get('add/{service_id}', [SubServicesController::class, 'addSubService'])->name('add.addSubService');

        Route::post('add/{service_id}', [SubServicesController::class, 'store'])->name('store.subservice');
        Route::get('update/{service_id}', [SubServicesController::class, 'viewUpdate'])->name('our-services.update');
        Route::put('update/{service_id}', [SubServicesController::class, 'update'])->name('update.our-service');
        Route::get('caregiver', [SubServicesController::class, 'caregiverView'])->name('caregiver.view');

        Route::get('add-caregiver', function () {
            return view('add_caregiver', ['updateCaregiver' => null]);
        })->name('caregiver.add');
        Route::get('diagnostic/add', function () {
            return view('add-diagnostic', ['update' => null]);
        })->name('diagnostic.add');

        Route::post('add-caregiver', [SubServicesController::class, 'caregiverAdd'])->name('caregiver.store');
        Route::get('caregiver/update/{service_id}', [SubServicesController::class, 'viewCaregiverUpdate'])->name('caregiver.update');
        Route::put('caregiver/update/{service_id}', [SubServicesController::class, 'caregiverUpdate'])->name('update.caregiver');
        Route::get('diagnostic', [DiagnosticController::class, 'viewDiagnosticTest'])->name('diagnostic.viewtest');
        Route::post('diagnostic/add', [DiagnosticController::class, 'addDiagnosticStore'])->name('diagnostic.store');
        Route::get('diagnostic/details/{id}', [DiagnosticController::class, 'viewDiagnosticDetails'])->name('diagnostic.details');
        Route::get('diagnostic/update/{id}', [DiagnosticController::class, 'viewUpdate'])->name('diagnostic.update');
        Route::put('diagnostic/update/{id}', [DiagnosticController::class, 'update'])->name('update.diagnostic');
        Route::post('action', [DiagnosticController::class, 'actions'])->name('diagnostic.action');
        Route::post('actions', [SubServicesController::class, 'actions'])->name('our-services.action');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [AppUserController::class, 'index'])->name('users.index');
        Route::post('action', [AppUserController::class, 'actionStatus'])->name('users.action');
        Route::get('profile/{user_id}', [AppUserController::class, 'userDetails'])->name('users.profile');
    });

    Route::prefix('professional')->group(function () {
        Route::get('/', [ProfessionalController::class, 'index'])->name('professional.index');
        Route::get('profile/{pro_id}', [ProfessionalController::class, 'profile'])->name('professional.profile');
        Route::get('earning/{pro_id}', [ProfessionalController::class, 'earningDashboard'])->name('professional.earning');
        Route::post('action', [ProfessionalController::class, 'actionStatus'])->name('professional.action');
    });

    Route::prefix('order')->group(function () {
        Route::get('/', [OrderAdminController::class, 'index'])->name('order.index');
        Route::get('details/{order_id}', [OrderAdminController::class, 'orderDetails'])->name('order.details');
    });

    Route::get('settings', function () {
        return view('settings');
    })->name('settings');

    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('/save-privacy-policies', [SettingsController::class, 'savePrivacyPolicies']);
        Route::post('/save-about-us', [SettingsController::class, 'saveAboutUs']);
    });

    Route::view('notification', 'notification')->name('notify');
});
