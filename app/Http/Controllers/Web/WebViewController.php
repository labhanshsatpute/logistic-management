<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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
    public function viewScheduleShippment();

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
        return view('web.sections.dashboard');
    }

    // View Schedule Shippment
    public function viewScheduleShippment()
    {
        return view('web.sections.schedule-shippment');
    }
}
