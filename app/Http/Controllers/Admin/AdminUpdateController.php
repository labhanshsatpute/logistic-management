<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarouselBanner;
use App\Models\Coupon;
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
| Admin Update Controller
|--------------------------------------------------------------------------
|
| Update operations for admin are handled from this controller.
|
*/

interface AdminUpdate {

    public function handleAccountInformationUpdate(Request $request);
    public function handleAccountPasswordUpdate(Request $request);
    public function handleParentCategoryUpdate(Request $request, $id);
    public function handleChildCategoryUpdate(Request $request, $id);
    public function handleProductUpdate(Request $request, $id);
    public function handleCouponUpdate(Request $request, $id);
    public function handleCarouselBannerUpdate(Request $request, $id);
    public function handleAdminUpdate(Request $request, $id);

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
    | Handle Parent Category Update
    |--------------------------------------------------------------------------
    */
    public function handleParentCategoryUpdate(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'name' => ['required','string','min:1','max:250',Rule::unique('parent_categories')->ignore($id,'id')],
            'slug' => ['required','string','min:1','max:500',Rule::unique('parent_categories')->ignore($id,'id')],
            'summary' => ['required','string','min:1','max:500'],
            'description' => ['nullable','string','min:1','max:1000'],
            'thumbnail' => ['nullable','file','mimes:jpg,jpeg,png,webp'],
            'cover_image' => ['nullable','file','mimes:jpg,jpeg,png,webp'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
            $parent_category = ParentCategory::find($id);
            $parent_category->name = $request->input('name');
            $parent_category->slug = $request->input('slug');
            $parent_category->summary = $request->input('summary');
            $parent_category->description = $request->input('description');
            if ($request->hasFile('thumbnail')) {
                if (!is_null($parent_category->thumbnail)) Storage::delete($parent_category->thumbnail);
                $parent_category->thumbnail = $request->file('thumbnail')->store('parent-categories');
            }
            if ($request->hasFile('cover_image')) {
                if (!is_null($parent_category->cover_image)) Storage::delete($parent_category->cover_image);
                $parent_category->cover_image = $request->file('cover_image')->store('parent-categories');
            }
            $result = $parent_category->update();

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
    | Handle Child Category Update
    |--------------------------------------------------------------------------
    */
    public function handleChildCategoryUpdate(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'parent_category_id' => ['required'],
            'name' => ['required','string','min:1','max:250',Rule::unique('parent_categories')->ignore($id,'id')],
            'slug' => ['required','string','min:1','max:500',Rule::unique('parent_categories')->ignore($id,'id')],
            'summary' => ['required','string','min:1','max:500'],
            'description' => ['nullable','string','min:1','max:1000'],
            'thumbnail' => ['nullable','file','mimes:jpg,jpeg,png,webp'],
            'cover_image' => ['nullable','file','mimes:jpg,jpeg,png,webp'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
            $child_category = ChildCategory::find($id);
            $child_category->parent_category_id = $request->input('parent_category_id');
            $child_category->name = $request->input('name');
            $child_category->slug = $request->input('slug');
            $child_category->summary = $request->input('summary');
            $child_category->description = $request->input('description');
            if ($request->hasFile('thumbnail')) {
                if (!is_null($child_category->thumbnail)) Storage::delete($child_category->thumbnail);
                $child_category->thumbnail = $request->file('thumbnail')->store('child-categories');
            }
            if ($request->hasFile('cover_image')) {
                if (!is_null($child_category->cover_image)) Storage::delete($child_category->cover_image);
                $child_category->cover_image = $request->file('cover_image')->store('child-categories');
            }
            $result = $child_category->update();

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
    | Handle Product Update
    |--------------------------------------------------------------------------
    */
    public function handleProductUpdate(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'name' => ['required','string','min:1','max:250'],
            'sku' => ['required','string','min:1','max:250'],
            'slug' => ['required','string','min:1','max:250',Rule::unique('products')->ignore($id,'id')],
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

            'thumbnail' => ['nullable','file','mimes:jpg,jpeg,png,webp'],
            'product_media.*' => ['nullable'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {

            $product = Product::find($id);
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

            if ($request->hasFile('thumbnail')) {
                if (!is_null($product->thumbnail)) Storage::delete($product->thumbnail);
                $product->thumbnail = $request->file('thumbnail')->store('products');
            }
            
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

            $result = $product->update();

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
    | Handle Coupon Update
    |--------------------------------------------------------------------------
    */
    public function handleCouponUpdate(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'name' => ['required','string','min:1','max:250'],
            'code' => ['required','string','min:1','max:250',Rule::unique('coupons')->ignore($id,'id')],
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
            $coupon = Coupon::find($id);
            $coupon->name = $request->input('name');
            $coupon->code = $request->input('code');
            $coupon->summary = $request->input('summary');
            $coupon->start_date = $request->input('start_date');
            $coupon->expire_date = $request->input('expire_date');
            $coupon->discount_type = $request->input('discount_type');
            $coupon->discount_value = $request->input('discount_value');
            $coupon->minimum_purchase = $request->input('minimum_purchase');
            $coupon->user_type = $request->input('user_type');
            $result = $coupon->update();

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
    | Handle Carousel Banner Update
    |--------------------------------------------------------------------------
    */
    public function handleCarouselBannerUpdate(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'name' => ['required','string','min:1','max:250'],
            'link' => ['nullable','string','min:1','max:250'],
            'summary' => ['nullable','string','min:1','max:500'],
            'image' => ['nullable','file','mimes:jpg,jpeg,png,webp'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
            $carousel_banner = CarouselBanner::find($id);
            $carousel_banner->name = $request->input('name');
            $carousel_banner->link = $request->input('link');
            $carousel_banner->summary = $request->input('summary');
            if ($request->hasFile('image')) {
                if (!is_null($carousel_banner->image)) Storage::delete($carousel_banner->image);
                $carousel_banner->image = $request->file('image')->store('carousel-banners');
            }
            $result = $carousel_banner->update();

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
}
