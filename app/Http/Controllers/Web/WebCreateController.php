<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentPaymentTransaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Str;

/*
|--------------------------------------------------------------------------
| Web Create Controller
|--------------------------------------------------------------------------
|
| Create operations for web are handled from this controller.
|
*/

interface WebCreate 
{
    public function handleShipmentCreate(Request $request);
    public static function handleShipmentPaymentTransactionCreate($shipment_id);
}

class WebCreateController extends Controller implements WebCreate
{
    /*
    |--------------------------------------------------------------------------
    | Handle Shipment Create
    |--------------------------------------------------------------------------
    */
    public function handleShipmentCreate(Request $request)
    {
        $validation = Validator::make($request->all(),[

            'sender_name' => ['required','string','min:1','max:250'],
            'sender_email' => ['required','string','min:1','max:250'],
            'sender_phone_primary' => ['required','numeric','digits:10'],
            'sender_phone_alternate' => ['nullable','numeric','digits:10'],

            'sender_address_home' => ['nullable','string','min:1','max:250'],
            'sender_address_street' => ['required','string','min:1','max:250'],
            'sender_address_city' => ['required','string','min:1','max:250'],
            'sender_address_pincode' => ['required','string','min:1','max:250'],
            'sender_address_state' => ['required','string','min:1','max:250'],
            'sender_address_country' => ['required','string','min:1','max:250'],

            'reciever_name' => ['required','string','min:1','max:250'],
            'reciever_email' => ['required','string','min:1','max:250'],
            'reciever_phone_primary' => ['required','numeric','digits:10'],
            'reciever_phone_alternate' => ['nullable','numeric','digits:10'],

            'reciever_address_home' => ['nullable','string','min:1','max:250'],
            'reciever_address_street' => ['required','string','min:1','max:250'],
            'reciever_address_city' => ['required','string','min:1','max:250'],
            'reciever_address_pincode' => ['required','string','min:1','max:250'],
            'reciever_address_state' => ['required','string','min:1','max:250'],
            'reciever_address_country' => ['required','string','min:1','max:250'],

            'package_type' => ['required','string','min:1','max:250'],
            'package_name' => ['required','string','min:1','max:250'],
            'package_summary' => ['nullable','string','min:1','max:250'],

            'package_length' => ['required','numeric'],
            'package_width' => ['required','numeric'],
            'package_height' => ['required','numeric'],
            'package_weight' => ['required','numeric'],

            'pickup_date' => ['required'],
            'pickup_slot' => ['required']
            
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {

            $bill_summary = WebUtilityController::handleCalculateShipmentBill($request);
            
            $shipment = new Shipment();
            $shipment->user_id = auth()->user()->id;

            $shipment->sender_name = $request->input('sender_name');
            $shipment->sender_email = $request->input('sender_email');
            $shipment->sender_phone_primary = $request->input('sender_phone_primary');
            $shipment->sender_phone_alternate = $request->input('sender_phone_alternate');
            $shipment->sender_address_home = $request->input('sender_address_home');
            $shipment->sender_address_street = $request->input('sender_address_street');
            $shipment->sender_address_city = $request->input('sender_address_city');
            $shipment->sender_address_pincode = $request->input('sender_address_pincode');
            $shipment->sender_address_state = $request->input('sender_address_state');
            $shipment->sender_address_country = $request->input('sender_address_country');

            $shipment->reciever_name = $request->input('reciever_name');
            $shipment->reciever_email = $request->input('reciever_email');
            $shipment->reciever_phone_primary = $request->input('reciever_phone_primary');
            $shipment->reciever_phone_alternate = $request->input('reciever_phone_alternate');
            $shipment->reciever_address_home = $request->input('reciever_address_home');
            $shipment->reciever_address_street = $request->input('reciever_address_street');
            $shipment->reciever_address_city = $request->input('reciever_address_city');
            $shipment->reciever_address_pincode = $request->input('reciever_address_pincode');
            $shipment->reciever_address_state = $request->input('reciever_address_state');
            $shipment->reciever_address_country = $request->input('reciever_address_country');

            $shipment->package_name = $request->input('package_name');
            $shipment->package_summary = $request->input('package_summary');
            $shipment->package_type = $request->input('package_type');
            $shipment->package_length = $request->input('package_length');
            $shipment->package_width = $request->input('package_width');
            $shipment->package_height = $request->input('package_height');
            $shipment->package_weight = $request->input('package_weight');

            $shipment->pickup_date = $request->input('pickup_date');
            $shipment->pickup_slot = $request->input('pickup_slot');

            $shipment->payment_delivery_charges = $bill_summary['delivery_charges'];
            $shipment->payment_tax_charges = $bill_summary['tax'];
            $shipment->payment_total = $bill_summary['total'];

            $result = $shipment->save();

            if ($result) {
                $shipment_payment = $this->handleShipmentPaymentTransactionCreate($shipment->id);

                return redirect()->route('view.shipment.payment.razorpay',['token' => $shipment_payment->token]);
            }
            else {
                abort(500);
            }

        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Shipment Payment Transaction Create
    |--------------------------------------------------------------------------
    */
    public static function handleShipmentPaymentTransactionCreate($shipment_id)
    {
        $shipment = Shipment::find($shipment_id);

        $shipment_payment = new ShipmentPaymentTransaction();
        $shipment_payment->user_id = auth()->user()->id;
        $shipment_payment->shipment_id = $shipment->id;
        $shipment_payment->token = Str::random(30);
        $shipment_payment->gateway = "Razorpay";
        $shipment_payment->amount = $shipment->payment_total;
        $shipment_payment->save();

        return $shipment_payment;
    }
}
