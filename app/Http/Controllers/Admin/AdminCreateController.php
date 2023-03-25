<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\Admin\SendNewsletter;
use App\Models\Branch;
use App\Models\CarouselBanner;
use App\Models\Coupon;
use App\Models\NewsletterMail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Models\ParentCategory;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductMedia;
use Carbon\Carbon;
use Storage;
use Hash;
use DB;

/*
|--------------------------------------------------------------------------
| Admin Create Controller
|--------------------------------------------------------------------------
|
| Create operations for admin are handled from this controller.
|
*/

interface AdminCreate {

    public function handleAdminCreate(Request $request);
    public function handleBranchCreate(Request $request);

}

class AdminCreateController extends Controller implements AdminCreate
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
    | Handle Admin Create
    |--------------------------------------------------------------------------
    */
    public function handleAdminCreate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => ['required','string','min:1','max:250'],
            'email' => ['required','string','min:1','max:250','unique:admins'],
            'phone' => ['required','numeric','unique:admins'],
            'role' => ['required','string','min:1','max:250'],
            'password' => ['required','string','min:6','max:20','confirmed'],
            'profile' => ['nullable','file','mimes:jpg,jpeg,png,webp'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->phone = $request->input('phone');
            $admin->role = $request->input('role');
            $admin->password = Hash::make($request->input('password'));
            if ($request->hasFile('profile')) {
                $admin->profile = $request->file('profile')->store('admins');
            }
            $result = $admin->save();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Admin Access Created',
                    'description' => 'Admin access is successfully created.'
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
    | Handle Branch Create
    |--------------------------------------------------------------------------
    */
    public function handleBranchCreate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => ['required','string','min:1','max:250'],
            'email' => ['required','string','min:1','max:250','unique:branches'],
            'phone' => ['required','numeric','unique:branches'],
            'password' => ['required','string','min:6','max:20','confirmed'],
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
            
            $branch = new Branch();
            $branch->name = $request->input('name');
            $branch->email = $request->input('email');
            $branch->phone = $request->input('phone');
            $branch->street = $request->input('street');
            $branch->city = $request->input('city');
            $branch->pincode = $request->input('pincode');
            $branch->state = $request->input('state');
            $branch->country = $request->input('country');
            $branch->type = $request->input('type');
            $branch->password = Hash::make($request->input('password'));
            $result = $branch->save();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Branch Created',
                    'description' => 'Branch is successfully created.'
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
