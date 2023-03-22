<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
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
            'email' => ['required','string','min:1','max:250',Rule::unique('braches')->ignore($id,'id')],
            'phone' => ['required','numeric',Rule::unique('braches')->ignore($id,'id')],
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
}
