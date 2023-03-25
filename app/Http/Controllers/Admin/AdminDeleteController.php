<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Admin;
use Storage;

/*
|--------------------------------------------------------------------------
| Admin Delete Controller
|--------------------------------------------------------------------------
|
| Delete operations for admin are handled from this controller.
|
*/

interface AdminDelete {

    public function handleAdminDelete($id);
    public function handleBranchDelete($id);

}

class AdminDeleteController extends Controller
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
    | Handle Admin Delete
    |--------------------------------------------------------------------------
    */
    public function handleAdminDelete($id)
    {
        $admin = Admin::find($id);
        if (!is_null($admin->profile)) {
            Storage::delete($admin->profile);
        }
        $admin->delete();
        return redirect()->route('admin.view.admin.list')->with('message',[
            'status' => 'success',
            'title' => 'Admin Access Deleted',
            'description' => 'The admin access is successfully deleted'
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Handle Branch Delete
    |--------------------------------------------------------------------------
    */
    public function handleBranchDelete($id)
    {
        $branch = Branch::find($id);
        if (!is_null($branch->profile)) {
            Storage::delete($branch->profile);
        }
        $branch->delete();
        return redirect()->route('admin.view.branch.list')->with('message',[
            'status' => 'success',
            'title' => 'Branch Deleted',
            'description' => 'The branch is successfully deleted'
        ]);
    }
    
}
