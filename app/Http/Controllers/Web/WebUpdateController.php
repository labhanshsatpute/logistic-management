<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentPaymentTransaction;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Razorpay\Api\Api;
use Str;
use Storage;
use Hash;
use DB;

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

    /*
    |--------------------------------------------------------------------------
    | Handle Account Information Update
    |--------------------------------------------------------------------------
    */
    public function handleAccountInformationUpdate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => ['required','string','min:1','max:250'],
            'email' => ['required','string','min:1','max:250',Rule::unique('users')->ignore(auth()->user()->id,'id')],
            'phone' => ['required','numeric','digits_between:10,20',Rule::unique('users')->ignore(auth()->user()->id,'id')],
            'profile' => ['nullable','file','mimes:jpg,jpeg,png,webp'],
            'account_password' => ['required','string','min:1','max:250'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
            if (Hash::check($request->input('account_password'), auth()->user()->password)) {

                $admin = User::find(auth()->user()->id);
                $admin->name = $request->input('name');
                $admin->email = $request->input('email');
                $admin->phone = $request->input('phone');
                if ($request->hasFile('profile')) {
                    if (!is_null(auth()->user()->profile)) Storage::delete(auth()->user()->profile);
                    $admin->profile = $request->file('profile')->store('users');
                }
                $result = $admin->update();

                if ($result) {
                    return redirect()->back()->with('message', [
                        'status' => 'success',
                        'title' => 'Changes Saved',
                        'description' => 'The changes are successfully saved'
                    ]);
                } else {
                    return redirect()->back()->with('message', [
                        'status' => 'error',
                        'title' => 'An error occcured',
                        'description' => 'There is an internal server issue please try again.'
                    ]);
                }
            }
            else {
                return redirect()->back()->withErrors(['account_password' => 'Incorrect password']);
            }
            
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Account Password Update
    |--------------------------------------------------------------------------
    */
    public function handleAccountPasswordUpdate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'current_password' => ['required','string','min:1','max:250'],
            'password' => ['required','string','min:6','max:20','confirmed'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
            if (Hash::check($request->input('current_password'),auth()->user()->password)) {

                $admin = User::find(auth()->user()->id);
                $admin->password = Hash::make($request->input('password'));
                $result = $admin->update();

                if ($result) {
                    return redirect()->back()->with('message', [
                        'status' => 'success',
                        'title' => 'Password Updated',
                        'description' => 'The password is successfully updated'
                    ]);
                } else {
                    return redirect()->back()->with('message', [
                        'status' => 'error',
                        'title' => 'An error occcured',
                        'description' => 'There is an internal server issue please try again.'
                    ]);
                }
            }
            else {
                return redirect()->back()->withErrors(['current_password' => 'Incorrect password']);
            }
        }
    }
}
