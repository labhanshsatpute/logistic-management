<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarouselBanner;
use App\Models\Coupon;
use App\Models\NewsletterMail;
use App\Models\Admin;
use App\Models\ChildCategory;
use App\Models\ParentCategory;
use App\Models\ProductMedia;
use App\Models\Product;
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

    public function handleParentCategoryDelete($id);
    public function handleChildCategoryDelete($id);
    public function handleCouponDelete($id);
    public function handleProductDelete($id);
    public function handleProductMediaDelete($id);
    public function handleNewsletterMailDelete($id);
    public function handleCarouselBannerDelete($id);
    public function handleAdminDelete($id);

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
    | Handle Parent Category Delete
    |--------------------------------------------------------------------------
    */
    public function handleParentCategoryDelete($id)
    {
        foreach (ChildCategory::where('parent_category_id',$id)->get() as $key => $value) {
            $this->handleChildCategoryDelete($value->id);
        }
        $parent_category = ParentCategory::find($id);
        Storage::delete($parent_category->thumbnail);
        Storage::delete($parent_category->cover_image);
        $parent_category->delete();
        return redirect()->route('admin.view.parent.category.list')->with('message',[
            'status' => 'success',
            'title' => 'Parent Category Deleted',
            'description' => 'The parent category is successfully deleted'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Child Category Delete
    |--------------------------------------------------------------------------
    */
    public function handleChildCategoryDelete($id)
    {
        $child_category = ChildCategory::find($id);
        Storage::delete($child_category->thumbnail);
        Storage::delete($child_category->cover_image);
        $child_category->delete();
        return redirect()->route('admin.view.child.category.list')->with('message',[
            'status' => 'success',
            'title' => 'Child Category Deleted',
            'description' => 'The child category is successfully deleted'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Product Delete
    |--------------------------------------------------------------------------
    */
    public function handleProductDelete($id)
    {
        foreach (ProductMedia::where('product_id',$id)->get() as $key => $value) {
            $this->handleProductMediaDelete($value->id);
        }
        $product = Product::find($id);
        Storage::delete($product->thumbnail);
        $product->delete();
        return redirect()->route('admin.view.product.list')->with('message',[
            'status' => 'success',
            'title' => 'Product Deleted',
            'description' => 'The product is successfully deleted'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Product Media Delete
    |--------------------------------------------------------------------------
    */
    public function handleProductMediaDelete($id)
    {
        $product_media = ProductMedia::find($id);
        Storage::delete($product_media->path);
        $product_media->delete();
        return redirect()->back()->with('message',[
            'status' => 'success',
            'title' => 'Media Deleted',
            'description' => 'The product media is successfully deleted'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Coupon Delete
    |--------------------------------------------------------------------------
    */
    public function handleCouponDelete($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect()->route('admin.view.coupon.list')->with('message',[
            'status' => 'success',
            'title' => 'Coupon Deleted',
            'description' => 'The coupon is successfully deleted'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Newsletter Mail Delete
    |--------------------------------------------------------------------------
    */
    public function handleNewsletterMailDelete($id)
    {
        $newsletter_mail = NewsletterMail::find($id);
        $newsletter_mail->delete();
        return redirect()->back()->with('message',[
            'status' => 'success',
            'title' => 'Newsletter Mail Deleted',
            'description' => 'The newsletter mail is successfully deleted'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Carousel Banner Delete
    |--------------------------------------------------------------------------
    */
    public function handleCarouselBannerDelete($id)
    {
        $carousel_banner = CarouselBanner::find($id);
        Storage::delete($carousel_banner->image);
        $carousel_banner->delete();
        return redirect()->route('admin.view.carousel.banner.list')->with('message',[
            'status' => 'success',
            'title' => 'Banner Deleted',
            'description' => 'The carousel banner is successfully deleted'
        ]);
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
    
}
