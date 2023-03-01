<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\CarouselBanner;
use App\Models\Coupon;
use App\Models\ParentCategory;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductMedia;
use App\Models\NewsletterMail;

interface AdminView {

    public function viewDashboard();
    public function viewSetting();
    public function viewAccountSetting();

    public function viewParentCategoryList();
    public function viewParentCategoryCreate();
    public function viewParentCategoryUpdate($id);

    public function viewChildCategoryList();
    public function viewChildCategoryCreate();
    public function viewChildCategoryUpdate($id);

    public function viewCouponList();
    public function viewCouponCreate();
    public function viewCouponUpdate($id);

    public function viewNewsletterPublish();
    public function viewNewsletterMailList();

    public function viewCarouselBannerList();
    public function viewCarouselBannerCreate();
    public function viewCarouselBannerUpdate($id);

    public function viewAdminList();
    public function viewAdminCreate();
    public function viewAdminUpdate($id);

}

class AdminViewController extends Controller
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

    /** View Parent Category List **/
    public function viewParentCategoryList()
    {
        $parent_categories = ParentCategory::all();
        return view('admin.sections.category.parent-category-list',[
            'parent_categories' => $parent_categories
        ]);
    }

    /** View Parent Category Create **/
    public function viewParentCategoryCreate()
    {
        return view('admin.sections.category.parent-category-create');
    }

    /** View Parent Category Update **/
    public function viewParentCategoryUpdate($id)
    {
        $parent_category = ParentCategory::find($id);
        return view('admin.sections.category.parent-category-update',[
            'parent_category' => $parent_category
        ]);
    }

    /** View Child Category List **/
    public function viewChildCategoryList()
    {
        $child_categories = ChildCategory::all();
        return view('admin.sections.category.child-category-list',[
            'child_categories' => $child_categories
        ]);
    }

    /** View Child Category Create **/
    public function viewChildCategoryCreate()
    {
        $parent_categories = ParentCategory::where('status',true)->orderBy('name')->get();
        return view('admin.sections.category.child-category-create',[
            'parent_categories' => $parent_categories
        ]);
    }

    /** View Child Category Update **/
    public function viewChildCategoryUpdate($id)
    {
        $child_category = ChildCategory::find($id);
        $parent_categories = ParentCategory::where('status',true)->orderBy('name')->get();
        return view('admin.sections.category.child-category-update',[
            'child_category' => $child_category,
            'parent_categories' => $parent_categories
        ]);
    }

    /** View Product List **/
    public function viewProductList()
    {
        $products = Product::orderBy('created_at','DESC')->get();
        return view('admin.sections.product.product-list',[
            'products' => $products
        ]);
    }

    /** View Product Create **/
    public function viewProductCreate()
    {
        $parent_categories = ParentCategory::where('status',true)->orderBy('name')->get();
        $child_categories = ChildCategory::where('status',true)->orderBy('name')->get();
        return view('admin.sections.product.product-create',[
            'parent_categories' => $parent_categories,
            'child_categories' => $child_categories
        ]);
    }

    /** View Product Update **/
    public function viewProductUpdate($id)
    {
        $product = Product::find($id);
        $product_media = ProductMedia::where('product_id',$id)->orderBy('created_at','DESC')->get();
        $parent_categories = ParentCategory::where('status',true)->orderBy('name')->get();
        $child_categories = ChildCategory::where('status',true)->orderBy('name')->get();
        return view('admin.sections.product.product-update',[
            'product' => $product,
            'product_media' => $product_media,
            'parent_categories' => $parent_categories,
            'child_categories' => $child_categories
        ]);
    }
    
    /** View Coupon List **/
    public function viewCouponList()
    {
        $coupons = Coupon::orderBy('created_at','DESC')->get();
        return view('admin.sections.coupon.coupon-list',[
            'coupons' => $coupons
        ]);
    }

    /** View Coupon Create **/
    public function viewCouponCreate()
    {
        return view('admin.sections.coupon.coupon-create');
    }

    /** View Coupon Update **/
    public function viewCouponUpdate($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.sections.coupon.coupon-update',[
            'coupon' => $coupon,
        ]);
    }

    /** View Newsletter Publish **/
    public function viewNewsletterPublish()
    {
        return view('admin.sections.newsletter.newsletter-publish');
    }
    
    /** View Newsletter Mail List **/
    public function viewNewsletterMailList()
    {
        $newsletter_mails = NewsletterMail::orderBy('created_at','DESC')->get();
        return view('admin.sections.newsletter.newsletter-mail-list',[
            'newsletter_mails' => $newsletter_mails
        ]);
    }

    /** View Carousel Banner List **/
    public function viewCarouselBannerList()
    {
        $carousel_banners = CarouselBanner::all();
        return view('admin.sections.carousel-banner.carousel-banner-list',[
            'carousel_banners' => $carousel_banners
        ]);
    }

    /** View Carousel Banner Create **/
    public function viewCarouselBannerCreate()
    {
        return view('admin.sections.carousel-banner.carousel-banner-create');
    }

    /** View Carousel Banner Update **/
    public function viewCarouselBannerUpdate($id)
    {
        $carousel_banner = CarouselBanner::find($id);
        return view('admin.sections.carousel-banner.carousel-banner-update',[
            'carousel_banner' => $carousel_banner
        ]);
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

}
