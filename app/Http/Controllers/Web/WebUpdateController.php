<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentPaymentTransaction;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Str;

/*
|--------------------------------------------------------------------------
| Web Update Controller
|--------------------------------------------------------------------------
|
| Update operations for web are handled from this controller.
|
*/

interface WebUpdate
{
    public function handleShipmentPaymentRazorpay(Request $request, $token);
}
class WebUpdateController extends Controller implements WebUpdate
{
    /*
    |--------------------------------------------------------------------------
    | Handle Shipment Payment Razorpay
    |--------------------------------------------------------------------------
    */
    public function handleShipmentPaymentRazorpay(Request $request, $token)
    {
        $input = $request->all();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));

                $shipment_payment = ShipmentPaymentTransaction::where('token',$token)->first();
                $shipment_payment->method = $response->method;
                $shipment_payment->status = "Completed";
                $shipment_payment->transaction_id = $response->id;
                $shipment_payment->update();

                $shipment = Shipment::find($shipment_payment->shipment_id);
                $shipment->payment_status = "Paid";
                $shipment->update();
                
                return redirect()->route('view.dashboard');

            } catch (Exception $e) {
                dd($e->getMessage());
            }
        }        
    }
}
