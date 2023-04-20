<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Storage;
use Hash;
use DB;

/*
|--------------------------------------------------------------------------
| Admin Update Controller
|--------------------------------------------------------------------------
|
| Update operations for admin are handled from this controller.
|
*/

interface AdminUpdate {

    public function handleAccountInformationUpdate(Request $request);
    public function handleAccountPasswordUpdate(Request $request);
    public function handleAdminUpdate(Request $request, $id);
    public function handleBranchUpdate(Request $request, $id);

}

class AdminUpdateController extends Controller implements AdminUpdate
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
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
            'email' => ['required','string','min:1','max:250',Rule::unique('admins')->ignore(auth()->user()->id,'id')],
            'phone' => ['required','numeric','digits_between:10,20',Rule::unique('admins')->ignore(auth()->user()->id,'id')],
            'profile' => ['nullable','file','mimes:jpg,jpeg,png,webp'],
            'account_password' => ['required','string','min:1','max:250'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
            if (Hash::check($request->input('account_password'), auth()->user()->password)) {

                $admin = Admin::find(auth()->user()->id);
                $admin->name = $request->input('name');
                $admin->email = $request->input('email');
                $admin->phone = $request->input('phone');
                if ($request->hasFile('profile')) {
                    if (!is_null(auth()->user()->profile)) Storage::delete(auth()->user()->profile);
                    $admin->profile = $request->file('profile')->store('admins');
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

                $admin = Admin::find(auth()->user()->id);
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

    /*
    |--------------------------------------------------------------------------
    | Handle Admin Update
    |--------------------------------------------------------------------------
    */
    public function handleAdminUpdate(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'name' => ['required','string','min:1','max:250'],
            'email' => ['required','string','min:1','max:250',Rule::unique('admins')->ignore($id,'id')],
            'phone' => ['required','numeric',Rule::unique('admins')->ignore($id,'id')],
            'role' => ['required','string','min:1','max:250'],
            'profile' => ['nullable','file','mimes:jpg,jpeg,png,webp'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {

            if ($request->input('password_change')) {
                if ($request->input('password') != $request->input('password_confirmation')) {
                    return redirect()->back()->withErrors(['password' => 'The password confirmation does not match.'])->withInput();
                }
            }

            $admin = Admin::find($id);
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->phone = $request->input('phone');
            $admin->role = $request->input('role');
            if ($request->input('password')) {
                $admin->password = Hash::make($request->input('password'));
            }
            if ($request->hasFile('profile')) {
                if (!is_null($admin->profile)) Storage::delete($admin->profile);
                $admin->profile = $request->file('profile')->store('admins');
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
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Branch Update
    |--------------------------------------------------------------------------
    */
    public function handleBranchUpdate(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'name' => ['required','string','min:1','max:250'],
            'email' => ['required','string','min:1','max:250',Rule::unique('branches')->ignore($id,'id')],
            'phone' => ['required','numeric',Rule::unique('branches')->ignore($id,'id')],
            'street' => ['required','string','min:1','max:250'],
            'city' => ['required','string','min:1','max:250'],
            'pincode' => ['required','string','min:1','max:250'],
            'state' => ['required','string','min:1','max:250'],
            'country' => ['required','string','min:1','max:250'],
            'type' => ['required','string','min:1','max:250'],            
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {

            $branch = Branch::find($id);
            $branch->name = $request->input('name');
            $branch->email = $request->input('email');
            $branch->phone = $request->input('phone');
            $branch->street = $request->input('street');
            $branch->city = $request->input('city');
            $branch->pincode = $request->input('pincode');
            $branch->state = $request->input('state');
            $branch->country = $request->input('country');
            $branch->type = $request->input('type');
            if ($request->input('password')) {
                $branch->password = Hash::make($request->input('password'));
            }
            $result = $branch->update();

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
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Shipment Update
    |--------------------------------------------------------------------------
    */
    public function handleShipmentUpdate(Request $request, $id)
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
            'pickup_slot' => ['required'],

            'status' => ['required','string','min:1','max:250'],
            
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {

            $shipment = Shipment::find($id);

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

            $shipment->status = $request->input('status');

            $result = $shipment->update();

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
    }
}
