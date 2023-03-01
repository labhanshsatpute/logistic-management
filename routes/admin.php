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

    Route::get('dashboard', [AdminViewController::class, 'viewDashboard'])->name('admin.view.dashboard');

    Route::prefix('setting')->group(function () {
        Route::get('/', [AdminViewController::class, 'viewSetting'])->name('admin.view.setting');
        Route::get('/account-information', [AdminViewController::class, 'viewAccountSetting'])->name('admin.view.account.setting');
        Route::post('/account-information', [AdminUpdateController::class, 'handleAccountInformationUpdate'])->name('admin.handle.account.information.update');
        Route::post('/account-password', [AdminUpdateController::class, 'handleAccountPasswordUpdate'])->name('admin.handle.account.password.update');
    });

    Route::prefix('product')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewProductList'])->name('admin.view.product.list');
        Route::get('/create', [AdminViewController::class, 'viewProductCreate'])->name('admin.view.product.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewProductUpdate'])->name('admin.view.product.update');
        Route::post('/create', [AdminCreateController::class, 'handleProductCreate'])->name('admin.handle.product.create');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleProductUpdate'])->name('admin.handle.product.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleProductDelete'])->name('admin.handle.product.delete');
        Route::put('/status', [AdminAPIController::class, 'handleProductStatus'])->name('admin.handle.product.status');
        Route::get('/media/delete/{id}', [AdminDeleteController::class, 'handleProductMediaDelete'])->name('admin.handle.product.media.delete');
    });

    Route::prefix('coupon')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewCouponList'])->name('admin.view.coupon.list');
        Route::get('/create', [AdminViewController::class, 'viewCouponCreate'])->name('admin.view.coupon.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewCouponUpdate'])->name('admin.view.coupon.update');
        Route::post('/create', [AdminCreateController::class, 'handleCouponCreate'])->name('admin.handle.coupon.create');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleCouponUpdate'])->name('admin.handle.coupon.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleCouponDelete'])->name('admin.handle.coupon.delete');
        Route::put('/status', [AdminAPIController::class, 'handleCouponStatus'])->name('admin.handle.coupon.status');
    });

    Route::prefix('newsletter')->group(function () {
        Route::get('/publish', [AdminViewController::class, 'viewNewsletterPublish'])->name('admin.view.newsletter.publish');
        Route::post('/publish', [AdminCreateController::class, 'handleNewsletterPublish'])->name('admin.handle.newsletter.publish');
        Route::get('/mail/list', [AdminViewController::class, 'viewNewsletterMailList'])->name('admin.view.newsletter.mail.list');
        Route::get('/mail/delete/{id}', [AdminDeleteController::class, 'handleNewsletterMailDelete'])->name('admin.handle.newsletter.mail.delete');
        Route::put('/mail/status', [AdminAPIController::class, 'handleNewsletterMailStatus'])->name('admin.handle.newsletter.mail.status');
    });

    Route::prefix('category')->group(function () {

        Route::get('/parent/list', [AdminViewController::class, 'viewParentCategoryList'])->name('admin.view.parent.category.list');
        Route::get('/parent/create', [AdminViewController::class, 'viewParentCategoryCreate'])->name('admin.view.parent.category.create');
        Route::get('/parent/update/{id}', [AdminViewController::class, 'viewParentCategoryUpdate'])->name('admin.view.parent.category.update');
        Route::post('/parent/create', [AdminCreateController::class, 'handleParentCategoryCreate'])->name('admin.handle.parent.category.create');
        Route::post('/parent/update/{id}', [AdminUpdateController::class, 'handleParentCategoryUpdate'])->name('admin.handle.parent.category.update');
        Route::get('/parent/delete/{id}', [AdminDeleteController::class, 'handleParentCategoryDelete'])->name('admin.handle.parent.category.delete');
        Route::put('/parent/status', [AdminAPIController::class, 'handleParentCategoryStatus'])->name('admin.handle.parent.category.status');

        Route::get('/child/list', [AdminViewController::class, 'viewChildCategoryList'])->name('admin.view.child.category.list');
        Route::get('/child/create', [AdminViewController::class, 'viewChildCategoryCreate'])->name('admin.view.child.category.create');
        Route::get('/child/update/{id}', [AdminViewController::class, 'viewChildCategoryUpdate'])->name('admin.view.child.category.update');
        Route::post('/child/create', [AdminCreateController::class, 'handleChildCategoryCreate'])->name('admin.handle.child.category.create');
        Route::post('/child/update/{id}', [AdminUpdateController::class, 'handleChildCategoryUpdate'])->name('admin.handle.child.category.update');
        Route::get('/child/delete/{id}', [AdminDeleteController::class, 'handleChildCategoryDelete'])->name('admin.handle.child.category.delete');
        Route::put('/child/status', [AdminAPIController::class, 'handleChildCategoryStatus'])->name('admin.handle.child.category.status');
    });

    Route::prefix('carousel-banner')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewCarouselBannerList'])->name('admin.view.carousel.banner.list');
        Route::get('/create', [AdminViewController::class, 'viewCarouselBannerCreate'])->name('admin.view.carousel.banner.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewCarouselBannerUpdate'])->name('admin.view.carousel.banner.update');
        Route::post('/create', [AdminCreateController::class, 'handleCarouselBannerCreate'])->name('admin.handle.carousel.banner.create');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleCarouselBannerUpdate'])->name('admin.handle.carousel.banner.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleCarouselBannerDelete'])->name('admin.handle.carousel.banner.delete');
        Route::put('/status', [AdminAPIController::class, 'handleCarouselBannerStatus'])->name('admin.handle.carousel.banner.status');
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

});