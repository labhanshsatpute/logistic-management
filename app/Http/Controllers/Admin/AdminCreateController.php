<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\Admin\SendNewsletter;
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

    public function handleParentCategoryCreate(Request $request);
    public function handleChildCategoryCreate(Request $request);
    public function handleProductCreate(Request $request);
    public function handleCouponCreate(Request $request);
    public function handleCarouselBannerCreate(Request $request);
    public function handleAdminCreate(Request $request);

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
    | Handle Parent Category Create
    |--------------------------------------------------------------------------
    */
    public function handleParentCategoryCreate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => ['required','string','min:1','max:250','unique:parent_categories'],
            'slug' => ['required','string','min:1','max:500','unique:parent_categories'],
            'summary' => ['required','string','min:1','max:500'],
            'description' => ['nullable','string','min:1','max:1000'],
            'thumbnail' => ['required','file','mimes:jpg,jpeg,png,webp'],
            'cover_image' => ['required','file','mimes:jpg,jpeg,png,webp'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
            $parent_category = new ParentCategory();
            $parent_category->name = $request->input('name');
            $parent_category->slug = $request->input('slug');
            $parent_category->summary = $request->input('summary');
            $parent_category->description = $request->input('description');
            $parent_category->thumbnail = $request->file('thumbnail')->store('parent-categories');
            $parent_category->cover_image = $request->file('cover_image')->store('parent-categories');
            $result = $parent_category->save();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Parent Category Created',
                    'description' => 'Parent category is successfully created.'
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
    | Handle Child Category Create
    |--------------------------------------------------------------------------
    */
    public function handleChildCategoryCreate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'parent_category_id' => ['required'],
            'name' => ['required','string','min:1','max:250','unique:child_categories'],
            'slug' => ['required','string','min:1','max:500','unique:child_categories'],
            'summary' => ['required','string','min:1','max:500'],
            'description' => ['nullable','string','min:1','max:1000'],
            'thumbnail' => ['required','file','mimes:jpg,jpeg,png,webp'],
            'cover_image' => ['required','file','mimes:jpg,jpeg,png,webp'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
            $child_category = new ChildCategory();
            $child_category->parent_category_id = $request->input('parent_category_id');
            $child_category->name = $request->input('name');
            $child_category->slug = $request->input('slug');
            $child_category->summary = $request->input('summary');
            $child_category->description = $request->input('description');
            $child_category->thumbnail = $request->file('thumbnail')->store('child-categories');
            $child_category->cover_image = $request->file('cover_image')->store('child-categories');
            $result = $child_category->save();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Child Category Created',
                    'description' => 'Child category is successfully created.'
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
    | Handle Product Create
    |--------------------------------------------------------------------------
    */
    public function handleProductCreate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => ['required','string','min:1','max:250'],
            'sku' => ['required','string','min:1','max:250'],
            'slug' => ['required','string','min:1','max:250','unique:products'],
            'summary' => ['nullable','string','min:1','max:500'],
            'description' => ['nullable','string','min:1','max:10000'],
            'parent_category' => ['required','string','min:1','max:250'],
            'child_category' => ['nullable','string','min:1','max:250'],

            'tags' => ['nullable'],
            'highlights.*' => ['nullable'],
            'sizes_value.*' => ['nullable'],
            'sizes_price.*' => ['nullable'],
            'colors_name.*' => ['nullable'],
            'colors_value.*' => ['nullable'],

            'meta_title' => ['nullable','string','min:1','max:250'],
            'meta_keywords' => ['nullable','string','min:1','max:1000'],
            'meta_description' => ['nullable','string','min:1','max:1000'],

            'price_original' => ['required','numeric'],
            'price_discounted' => ['nullable','numeric'],
            'tax_percentage' => ['required','numeric'],

            'availability' => ['required'],

            'thumbnail' => ['required','file','mimes:jpg,jpeg,png,webp'],
            'product_media.*' => ['nullable'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {

            $product = new Product();
            $product->name = $request->input('name');
            $product->sku = $request->input('sku');
            $product->slug = $request->input('slug');
            $product->summary = $request->input('summary');
            $product->description = $request->input('description');
            $product->parent_category = $request->input('parent_category');
            $product->child_category = $request->input('child_category');
            $product->meta_title = $request->input('meta_title');
            $product->meta_description = $request->input('meta_description');
            $product->price_original = $request->input('price_original');
            $product->price_discounted = $request->input('price_discounted');
            $product->tax_percentage = $request->input('tax_percentage');
            $product->availability = $request->input('availability');
            $product->thumbnail = $request->file('thumbnail')->store('products');
            
            if ($request->input('highlights')) {
                $highlights = [];
                foreach ($request->input('highlights') as $highlight) {
                    array_push($highlights, $highlight);
                }
                $product->highlights = json_encode($highlights);
            } else { $product->highlights = null; }

            if ($request->input('tags') != "") {
                $tags = [];
                foreach (json_decode($request->input('tags')) as $tag) {
                    array_push($tags, $tag->value);
                }
                $product->tags = json_encode($tags);
            } else { $product->tags = null; }

            if ($request->input('meta_keywords') != "") {
                $meta_keywords = [];
                foreach (json_decode($request->input('meta_keywords')) as $keyword) {
                    array_push($meta_keywords, $keyword->value);
                }
                $product->meta_keywords = json_encode($meta_keywords);
            } else { $product->meta_keywords = null; }

            if ($request->input('sizes_value')) {
                $sizes = [];
                foreach ($request->input('sizes_value') as $key => $size) {
                    array_push($sizes, [
                        'value' =>  $request->input('sizes_value')[$key],
                        'price' =>  $request->input('sizes_price')[$key]
                    ]);
                }
                $product->sizes = json_encode($sizes);
            } else { $product->sizes = null; }

            if ($request->input('colors_name')) {
                $colors = [];
                foreach ($request->input('colors_name') as $key => $color) {
                    array_push($colors, [
                        'name' =>  $request->input('colors_name')[$key],
                        'value' =>  $request->input('colors_value')[$key]
                    ]);
                }
                $product->colors = json_encode($colors);
            } else { $product->colors = null; }

            $result = $product->save();

            if ($result && $request->product_media) {
                foreach ($request->product_media as $key => $file) {
                    if ($request->hasFile('product_media')) {
                        $product_media = new ProductMedia();
                        $product_media->product_id = $product->id;
                        $product_media->type = $file->getClientMimeType();
                        $product_media->name = $file->getClientOriginalName();
                        $product_media->path = $file->store('products');
                        $product_media->save();
                    }
                }
            }

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Product Created',
                    'description' => 'Product is successfully created.'
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
    | Handle Coupon Create
    |--------------------------------------------------------------------------
    */
    public function handleCouponCreate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => ['required','string','min:1','max:250'],
            'code' => ['required','string','min:1','max:250','unique:coupons'],
            'summary' => ['required','string','min:1','max:500'],
            'start_date' => ['required','string'],
            'expire_date' => ['required','string'],
            'discount_type' => ['required','string','min:1','max:250'],
            'discount_value' => ['required','numeric'],
            'minimum_purchase' => ['required','numeric'],
            'user_type' => ['required','string','min:1','max:250'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
            $coupon = new Coupon();
            $coupon->name = $request->input('name');
            $coupon->code = $request->input('code');
            $coupon->summary = $request->input('summary');
            $coupon->start_date = $request->input('start_date');
            $coupon->expire_date = $request->input('expire_date');
            $coupon->discount_type = $request->input('discount_type');
            $coupon->discount_value = $request->input('discount_value');
            $coupon->minimum_purchase = $request->input('minimum_purchase');
            $coupon->user_type = $request->input('user_type');
            $result = $coupon->save();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Coupon Created',
                    'description' => 'Coupon is successfully created.'
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
    | Handle Newsletter Publish
    |--------------------------------------------------------------------------
    */
    public function handleNewsletterPublish(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'title' => ['required','string','min:1','max:250'],
            'link' => ['required','string','min:1','max:500'],
            'summary' => ['required','string','min:1','max:500'],
            'description' => ['required','string','min:1','max:10000']
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } 
        else {

            $data = [
                'title' => $request->input('title'),
                'link' => $request->input('link'),
                'summary' => $request->input('summary'),
                'description' => $request->input('description'),
            ];

            foreach (NewsletterMail::where('status',true)->get() as $newsletter_mail) {
                dispatch(new SendNewsletter($newsletter_mail->email, $data));
            }

            return redirect()->back()->with('message', [
                'status' => 'success',
                'title' => 'Newsletter Published',
                'description' => 'Newsletter is successfully sent to all emails'
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Carousel Banner Create
    |--------------------------------------------------------------------------
    */
    public function handleCarouselBannerCreate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => ['required','string','min:1','max:250'],
            'link' => ['nullable','string','min:1','max:250'],
            'summary' => ['nullable','string','min:1','max:500'],
            'image' => ['required','file','mimes:jpg,jpeg,png,webp'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
            $carousel_banner = new CarouselBanner();
            $carousel_banner->name = $request->input('name');
            $carousel_banner->link = $request->input('link');
            $carousel_banner->summary = $request->input('summary');
            $carousel_banner->image = $request->file('image')->store('carousel-banners');
            $result = $carousel_banner->save();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Banner Created',
                    'description' => 'Banner is successfully created.'
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
}
