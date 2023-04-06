<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Jobs\Web\SendResetPassword;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use DB;

/*
|--------------------------------------------------------------------------
| Web Auth Controller
|--------------------------------------------------------------------------
|
| Authentication operations for web are handled from this controller.
|
*/

interface WebAuth {
    
    public function viewLogin();
    public function handleLogin(Request $request);

    public function viewRegister();
    public function handleRegister(Request $request);

    public function viewForgotPassword();
    public function handleForgotPassword(Request $request);

    public function viewResetPassword($token);
    public function handleResetPassword(Request $request, $token);

}

class WebAuthController extends Controller implements WebAuth
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*
    |--------------------------------------------------------------------------
    | View Login
    |--------------------------------------------------------------------------
    */
    public function viewLogin()
    {
        return view('web.auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Login
    |--------------------------------------------------------------------------
    */
    public function handleLogin(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => ['required', 'string', 'email', 'exists:users', 'min:7', 'max:100'],
            'password' => ['required', 'string', 'min:6', 'max:20'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)) {

                if (session('redirect_url')) return redirect()->to(session('redirect_url'));
                else return redirect(RouteServiceProvider::USER);
            }
            else {
                return redirect()->back()->withErrors(['password' => ['Wrong password']])->withInput($request->only('email', 'remember'));
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | View Register
    |--------------------------------------------------------------------------
    */
    public function viewRegister()
    {
        return view('web.auth.register');
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Register
    |--------------------------------------------------------------------------
    */
    public function handleRegister(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => ['required', 'string','min:1', 'max:250'],
            'email' => ['required', 'string', 'email', 'unique:users', 'min:1', 'max:250'],
            'phone' => ['required', 'numeric', 'unique:users','digits:10'],
            'password' => ['required', 'string', 'min:6', 'max:20','confirmed'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {

            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->password = Hash::make($request->input('password'));
            $result = $user->save();

            if ($result) {

                $user = User::where('phone',$request->input('phone'))->first();
                Auth::login($user,true);

                if (session('redirect_url')) return redirect()->to(session('redirect_url'));
                else return redirect(RouteServiceProvider::USER);
            }
            else {
                return redirect()->back()->with('message',[
                    'status' => 'error',
                    'title' => 'An error occcured',
                    'description' => 'There is an internal server issue please try again.'
                ]);
            }

        }
    }

    /*
    |--------------------------------------------------------------------------
    | View Forgot Password
    |--------------------------------------------------------------------------
    */
    public function viewForgotPassword()
    {
        return view('web.auth.forgot-password');
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Forgot Password
    |--------------------------------------------------------------------------
    */
    public function handleForgotPassword(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => ['required', 'string', 'email', 'exists:users', 'min:6', 'max:100'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
            $token = Str::random(64);

            DB::table('password_resets')->insert(['email' => $request->input('email'),'token' => $token,'created_at' => Carbon::now()]);

            $url = url('/reset-password/'. $token );

            dispatch(new SendResetPassword($request->input('email'),$url));

            return redirect()->back()->with('message',[
                'status' => 'success',
                'title' => 'Link Sent',
                'description' => 'The password reset link sent to your email'
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | View Reset Password
    |--------------------------------------------------------------------------
    */
    public function viewResetPassword($token)
    {
        if (DB::table('password_resets')->where('token',$token)->exists()) {
            $email = DB::table('password_resets')->where('token',$token)->first()->email;
            return view('web.auth.reset-password',['token' => $token, 'email' => $email]);
        }
        else { abort(404); }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Reset Password
    |--------------------------------------------------------------------------
    */
    public function handleResetPassword(Request $request, $token)
    {
        $validation = Validator::make($request->all(),[
            'email' => ['required', 'string', 'email', 'exists:users','exists:password_resets' , 'min:6', 'max:100'],
            'password' => ['required', 'string','confirmed','min:6','max:20']
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
        
            if(DB::table('password_resets')->where(['email' => $request->email, 'token' => $token])->exists()) {
                
                $user = User::where('email', $request->input('email'))->first();
                $user->password = Hash::make($request->input('password'));
                $user->update();
                
                DB::table('password_resets')->where(['email'=> $request->email])->delete();

                return redirect()->route('view.login.email')->with('message',[
                    'status' => 'success',
                    'title' => 'Password Set',
                    'description' => 'Your account password is successfully set.'
                ]);
            }
            else { abort(404); }
        }
    }
    
}