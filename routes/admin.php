<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminViewController;
use App\Http\Controllers\Admin\AdminUpdateController;
use App\Http\Controllers\Admin\AdminCreateController;
use App\Http\Controllers\Admin\AdminDeleteController;
use App\Http\Controllers\Admin\AdminAPIController;

Route::middleware(['guest:admin'])->group(function () {
    Route::get('login', [AdminAuthController::class, 'viewLogin'])->name('admin.view.login');
    Route::post('login', [AdminAuthController::class, 'handleLogin'])->name('admin.handle.login');
});

Route::middleware(['auth:admin'])->group(function () {

    Route::post('logout', function() {
        Auth::logout();
        return redirect()->route('admin.view.login');
    })->name('admin.handle.logout');

    Route::get('dashboard', [AdminViewController::class, 'viewDashboard'])->name('admin.view.dashboard');

    Route::prefix('setting')->group(function () {
        Route::get('/', [AdminViewController::class, 'viewSetting'])->name('admin.view.setting');
        Route::get('/account-information', [AdminViewController::class, 'viewAccountSetting'])->name('admin.view.account.setting');
        Route::post('/account-information', [AdminUpdateController::class, 'handleAccountInformationUpdate'])->name('admin.handle.account.information.update');
        Route::post('/account-password', [AdminUpdateController::class, 'handleAccountPasswordUpdate'])->name('admin.handle.account.password.update');
    });

    Route::prefix('branch')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewBranchList'])->name('admin.view.branch.list');
        Route::get('/create', [AdminViewController::class, 'viewBranchCreate'])->name('admin.view.branch.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewBranchUpdate'])->name('admin.view.branch.update');
        Route::post('/create', [AdminCreateController::class, 'handleBranchCreate'])->name('admin.handle.branch.create');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleBranchUpdate'])->name('admin.handle.branch.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleBranchDelete'])->name('admin.handle.branch.delete');
        Route::put('/status', [AdminAPIController::class, 'handleBranchStatus'])->name('admin.handle.branch.status');
    });

    Route::prefix('shipment')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewShipmentList'])->name('admin.view.shipment.list');
        Route::get('/update/{id}', [AdminViewController::class, 'viewShipmentUpdate'])->name('admin.view.shipment.update');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleShipmentUpdate'])->name('admin.handle.shipment.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleShipmentDelete'])->name('admin.handle.shipment.delete');
        Route::get('/get/branch', [AdminAPIController::class, 'handleGetBranch'])->name('admin.handle.get.branch');
    });


    Route::prefix('admin-access')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewAdminList'])->name('admin.view.admin.list');
        Route::get('/create', [AdminViewController::class, 'viewAdminCreate'])->name('admin.view.admin.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewAdminUpdate'])->name('admin.view.admin.update');
        Route::post('/create', [AdminCreateController::class, 'handleAdminCreate'])->name('admin.handle.admin.create');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleAdminUpdate'])->name('admin.handle.admin.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleAdminDelete'])->name('admin.handle.admin.delete');
        Route::put('/status', [AdminAPIController::class, 'handleAdminStatus'])->name('admin.handle.admin.status');
    });


    Route::get('/test', [AdminAPIController::class, 'handleTestRoute'])->name('admin.handle.test');

});