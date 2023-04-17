<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
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
    public function viewSetting();

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
        $upcoming_shipment = Shipment::where('user_id',auth()->user()->id)->orderBy('created_at','DESC')->first();
        return view('web.sections.dashboard',['upcoming_shipment' => $upcoming_shipment]);
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

    // View Schedule Shipment
    public function viewShipmentList()
    {
        $shipments = Shipment::where('user_id',auth()->user()->id)->orderBy('created_at','DESC')->get();
        return view('web.sections.shipment-list',['shipments' => $shipments]);
    }

    // View Setting
    public function viewSetting()
    {
        return view('web.sections.setting');
    }

    // View About
    public function viewAbout()
    {
        return view('web.sections.about');
    }

    // View Career
    public function viewCareer()
    {
        return view('web.sections.careers');
    }

    // View Customer Support
    public function viewCustomerSupport()
    {
        return view('web.sections.customer-support');
    }

    // View Locate Office
    public function viewLocateOffice()
    {
        return view('web.sections.locate-office');
    }

    // View Privacy Policy
    public function viewPrivacyPolicy()
    {
        return view('web.sections.privacy-policy');
    }

}
