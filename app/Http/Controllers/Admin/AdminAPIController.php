<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarouselBanner;
use App\Models\Coupon;
use App\Models\NewsletterMail;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\ParentCategory;
use App\Models\ChildCategory;
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

    public function handleParentCategoryStatus(Request $request);
    public function handleChildCategoryStatus(Request $request);
    public function handleProductStatus(Request $request);
    public function handleCouponStatus(Request $request);
    public function handleNewsletterMailStatus(Request $request);
    public function handleCarouselBannerStatus(Request $request);
    public function handleAdminStatus(Request $request);

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
    | Handle Parent Category Status
    |--------------------------------------------------------------------------
    */
    public function handleParentCategoryStatus(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:parent_categories'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $parent_category = ParentCategory::find($request->id);
            $parent_category->status = ! (boolean)$parent_category->status;
            $parent_category->update();
            return response(['message' => 'Status updated','data' => $parent_category],200);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Child Category Status
    |--------------------------------------------------------------------------
    */
    public function handleChildCategoryStatus(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:child_categories'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $child_category = ChildCategory::find($request->id);
            $child_category->status = ! (boolean)$child_category->status;
            $child_category->update();
            return response(['message' => 'Status updated','data' => $child_category],200);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Product Status
    |--------------------------------------------------------------------------
    */
    public function handleProductStatus(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:products'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $product = Product::find($request->id);
            $product->status = ! (boolean)$product->status;
            $product->update();
            return response(['message' => 'Status updated','data' => $product],200);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Coupon Status
    |--------------------------------------------------------------------------
    */
    public function handleCouponStatus(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:coupons'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $coupon = Coupon::find($request->id);
            $coupon->status = ! (boolean)$coupon->status;
            $coupon->update();
            return response(['message' => 'Status updated','data' => $coupon],200);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Newsletter Mail Status
    |--------------------------------------------------------------------------
    */
    public function handleNewsletterMailStatus(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:newsletter_mails'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $newsletter_mail = NewsletterMail::find($request->id);
            $newsletter_mail->status = ! (boolean)$newsletter_mail->status;
            $newsletter_mail->update();
            return response(['message' => 'Status updated','data' => $newsletter_mail],200);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Carousel Banner Status
    |--------------------------------------------------------------------------
    */
    public function handleCarouselBannerStatus(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:carousel_banners'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $carousel_banner = CarouselBanner::find($request->id);
            $carousel_banner->status = ! (boolean)$carousel_banner->status;
            $carousel_banner->update();
            return response(['message' => 'Status updated','data' => $carousel_banner],200);
        }
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
    

    public function handleBranchStatus(Request $request)
    {
        # code...
    }
}
