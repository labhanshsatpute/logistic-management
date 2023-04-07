@extends('web.layouts.app')

@section('web-section')
<section class="md:py-20 sm:py-5">
    <div class="container">
        
        <figure class="md:shadow-lg bg-white md:w-[450px] sm:w-full md:border mx-auto">
            <form action="{{ route('handle.login') }}" method="POST" class="md:px-10 sm:px-5 py-16 text-center space-y-5"
                onsubmit="this.querySelector('button[type=submit]').setAttribute('disabled','disabled')">

                <div>
                    <h1 class="font-semibold text-3xl mb-2 text-web-ascent-dark">Welcome Back!</h1>
                    <p class="text-xs text-slate-600 mb-6">Please fill the credentials to login</p>
                    @csrf
                </div>
                
                <div class="flex flex-col">
                    <label for="email" class="input-label">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" id="email"
                        class="input-box-md @error('email') input-invalid @enderror"
                        placeholder="Enter Email Address" required minlength="7" maxlength="250">
                    @error('email')
                    <span class="input-error" id="email-input-error">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="flex flex-col">
                    <label for="password" class="input-label">Password</label>
                    <input type="password" name="password" id="password"
                        class="input-box-md @error('password') input-invalid @enderror"
                        placeholder="Enter Password" required minlength="6" maxlength="20">
                    @error('password')
                    <span class="input-error" id="password-input-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start space-x-[1px]">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember" class="text-xs font-medium cursor-pointer select-none">Keep me signed in</label>
                    </div>
                    <div>
                        <a href="{{ route('view.forgot.password') }}" class="font-medium text-xs text-web-ascent hover:text-web-ascent-dark">Forgot password?</a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn-ascent-md w-full"><i data-feather="key" class="h-4 w-4 opacity-50 absolute mr-auto"></i>Submit</button>
                </div>

                <div>
                    <p class="text-slate-600 text-xs">Dosen't have an account? <a href="{{ route('view.register') }}" class="font-medium text-xs text-web-ascent hover:text-web-ascent-dark">Register now</a></p>
                </div>


            </form>
        </figure>
        
        
    </div>
</section>
@endsection