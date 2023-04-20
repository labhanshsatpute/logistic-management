<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Admin;
use Carbon\Carbon;
use Hash;
use DB;

/*
|--------------------------------------------------------------------------
| Admin API Controller
|--------------------------------------------------------------------------
|
| API operations for admin are handled from this controller.
|
*/
interface AdminAPI {

    public function handleAdminStatus(Request $request);
    public function handleBranchStatus(Request $request);
    public function handleGetBranch();

}

class AdminAPIController extends Controller implements AdminAPI
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
    | Handle Admin Status
    |--------------------------------------------------------------------------
    */
    public function handleAdminStatus(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:admins'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $admin = Admin::find($request->id);
            $admin->status = ! (boolean)$admin->status;
            $admin->update();
            return response(['message' => 'Status updated','data' => $admin],200);
        }
    }
    
    /*
    |--------------------------------------------------------------------------
    | Handle Branch Status
    |--------------------------------------------------------------------------
    */
    public function handleBranchStatus(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:branches'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $branch = Branch::find($request->id);
            $branch->status = ! (boolean)$branch->status;
            $branch->update();
            return response(['message' => 'Status updated','data' => $branch],200);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Get Bracnh
    |--------------------------------------------------------------------------
    */
    public function handleGetBranch()
    {
        $branches = Branch::where('status',true)->orderBy('name')->get();
        return response(['status' => true, 'data' => $branches],200);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Test Route
    |--------------------------------------------------------------------------
    */
    public function handleTestRoute(Request $request)
    {
        foreach (Branch::all() as $value) {
            $branch = Branch::find($value->id);
            if (strpos($branch->name,'Logisti')) {
                $branch->name = str_replace('Logisticscs', 'Logistics',$branch->name);
            }
            $branch->update();
        }
        dd('Done');
    }
}
