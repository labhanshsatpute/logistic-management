<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ShipmentPaymentTransaction;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web View Controller
|--------------------------------------------------------------------------
|
| View operations for web are handled from this controller.
|
*/

interface WebView {

    public function viewHome();
    public function viewDashboard();
    public function viewScheduleShipment();
    public function viewShipmentPaymentRazorpay($token);

}

class WebViewController extends Controller implements WebView
{   
    // View Home
    public function viewHome()
    {
        return view('web.sections.home');
    }

    // View Dashboard
    public function viewDashboard()
    {
        return view('web.sections.dashboard');
    }

    // View Schedule Shipment
    public function viewScheduleShipment()
    {
        return view('web.sections.schedule-shipment');
    }

    // View Shipment Payment Razorpay
    public function viewShipmentPaymentRazorpay($token)
    {
        $payment = ShipmentPaymentTransaction::where('token',$token)->first();
        
        if ($payment->status != "Completed") {
            return view('web.sections.shipment-payment-razorpay',['payment' => $payment]);
        }
        else {
            abort(419);
        }
    }


}
