<?php

use App\Http\Controllers\Web\WebCreateController;
use App\Http\Controllers\Web\WebUpdateController;
use App\Http\Controllers\Web\WebUtilityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\WebAuthController;
use App\Http\Controllers\Web\WebViewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[WebViewController::class , 'viewHome'])->name('view.home');

Route::get('/random',function() {
    return rand(1111111111,9999999999);
});


/*
|--------------------------------------------------------------------------
| Guest User Routes
|--------------------------------------------------------------------------
*/

Route::get('/register', [WebAuthController::class, 'viewRegister'])->name('view.register');
Route::post('/register', [WebAuthController::class, 'handleRegister'])->name('handle.register');

Route::get('/login', [WebAuthController::class, 'viewLogin'])->name('view.login');
Route::post('/login', [WebAuthController::class, 'handleLogin'])->name('handle.login');

Route::get('/forgot-password', [WebAuthController::class, 'viewForgotPassword'])->name('view.forgot.password');
Route::post('/forgot-password', [WebAuthController::class, 'handleForgotPassword'])->name('handle.forgot.password');

Route::get('/reset-password/{token}', [WebAuthController::class, 'viewResetPassword'])->name('view.reset.password');
Route::post('/reset-password/{token}', [WebAuthController::class, 'handleResetPassword'])->name('handle.reset.password');


/*
|--------------------------------------------------------------------------
| Authorized Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::post('logout', function() {
        Auth::logout();
        return redirect()->route('view.main');
    })->name('logout');

    Route::get('/dashboard',[WebViewController::class , 'viewDashboard'])->name('view.dashboard');

    Route::get('/schedule-shipment',[WebViewController::class , 'viewScheduleShipment'])->name('view.schedule.shipment');

    Route::post('/shipment/create',[WebCreateController::class , 'handleShipmentCreate'])->name('handle.shipment.create');
    Route::get('/shipments',[WebViewController::class , 'viewShipmentList'])->name('view.shipments');

    Route::get('/shipment/payment/{token}',[WebViewController::class , 'viewShipmentPaymentRazorpay'])->name('view.shipment.payment.razorpay');
    Route::post('/shipment/payment/{token}',[WebUpdateController::class , 'handleShipmentPaymentRazorpay'])->name('handle.shipment.payment.razorpay');

});

Route::post('/calculate-shipment-bill',[WebUtilityController::class , 'handleCalculateShipmentBill'])->name('handle.calculate.shipment.bill');