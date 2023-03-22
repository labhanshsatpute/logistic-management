<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Branch;

interface AdminView {

    public function viewDashboard();
    public function viewSetting();
    public function viewAccountSetting();

    public function viewAdminList();
    public function viewAdminCreate();
    public function viewAdminUpdate($id);

    public function viewBranchList();
    public function viewBranchCreate();
    public function viewBranchUpdate($id);
}

class AdminViewController extends Controller implements AdminView
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

    /** View Dashboard **/
    public function viewDashboard()
    {
        return view('admin.sections.dashboard');
    }

    /** View Setting **/
    public function viewSetting()
    {
        return view('admin.sections.setting.setting');
    }

    /** View Account Setting **/
    public function viewAccountSetting()
    {
        return view('admin.sections.setting.account');
    }

    /** View Admin List **/
    public function viewAdminList()
    {
        $admins = Admin::where('id','!=',auth()->user()->id)->get();
        return view('admin.sections.admin.admin-list',[
            'admins' => $admins
        ]);
    }

    /** View Admin Create **/
    public function viewAdminCreate()
    {
        return view('admin.sections.admin.admin-create');
    }

    /** View Admin Update **/
    public function viewAdminUpdate($id)
    {
        $admin = Admin::find($id);
        return view('admin.sections.admin.admin-update',[
            'admin' => $admin
        ]);
    }

    /** View Branch List **/
    public function viewBranchList()
    {
        $branches = Branch::all();
        return view('admin.sections.branch.branch-list',[
            'branches' => $branches
        ]);
    }

    /** View Branch Create **/
    public function viewBranchCreate()
    {
        return view('admin.sections.branch.branch-create');
    }

    /** View Branch Update **/
    public function viewBranchUpdate($id)
    {
        $branch = Branch::find($id);
        return view('admin.sections.branch.branch-update',[
            'branch' => $branch
        ]);
    }

}
