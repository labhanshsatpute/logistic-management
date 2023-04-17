@extends('web.layouts.app')

@section('web-section')

{{-- Page Cover & Breadcrumb Section (Start) --}}
<section class="relative bg-cover bg-center md:block sm:hidden" style="background-image: url('{{asset('web/images/cover-image.jpg')}}')">
    @include('web.common.bottom-header')
    <div class="md:pt-32 md:pb-20 sm:py-20">
        <div class="container">
            <h1 class="font-semibold text-white text-4xl">Account Setting</h1>
        </div>
    </div>
</section>
<section class="py-6 border-b shadow-sm relative md:hidden sm:block">
    <div class="container">
        <ul class="flex items-center justify-start space-x-3">
            <li><a href="{{ route('view.home') }}" class="link">Home</a></li>
            <li><i data-feather="chevron-right" class="h-4 w-4 text-gray-700"></i></li>
            <li><a href="{{ route('view.shipments') }}" class="link">Account Setting</a></li>
        </ul>
    </div>
</section>
{{-- Page Cover & Breadcrumb Section (End) --}}

{{-- Page Section (Start) --}}
<section class="md:py-20 sm:py-0">
    <div class="container">
        
        <div class="grid md:grid-cols-12 sm:grid-cols-1 gap-10">

            <div class="md:col-span-3 md:block sm:hidden">
                @include('web.common.dashboard-sidebar')
            </div>

            <div class="md:col-span-9 md:space-y-10 sm:space-y-5">

                <form class="bg-white md:border sm:border-x-0 md:shadow-md" method="POST" action="{{route('handle.account.information.update')}}" enctype="multipart/form-data">
                    <div class="md:px-5 py-4 border-b">
                        <h1 class="font-semibold text-lg mb-1">Account Information</h1>
                        <p class="text-xs text-gray-500">Update your account information</p>
                        @csrf
                    </div>
                    <div class="md:px-5 py-5 border-b">
                        <div class="grid md:grid-cols-4 sm:grid-cols-1 gap-5">

                            {{-- Profile --}}
                            <div class="md:col-span-4 sm:col-span-1">
                                <div class="flex items-center space-x-5">
                                    <img src="{{ is_null(auth()->user()->profile) ? asset('web/images/default-profile.png') : asset('storage/'.auth()->user()->profile) }}" id="profile" alt="profile" class="h-24 w-24 rounded-full border bg-white" />
                                    <div class="input-group">
                                        <label for="profile" class="input-label">Profile</label>
                                        <button type="button" onclick="$('input[name=profile]').click()" class="btn-light-sm">Select Image</button>
                                        <input hidden type="file" accept="image/jpeg, image/jpg, image/png" class="input-box-sm" name="profile" onchange="handleProfilePreview(event)" >
                                        @error('profile')<span class="input-error">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Name --}}
                            <div class="flex flex-col">
                                <label for="name" class="input-label">Your Name <em>*</em></label>
                                <input type="text" name="name" value="{{ old('name',auth()->user()->name) }}"
                                    class="input-box-md @error('name') input-invalid @enderror"
                                    placeholder="Enter Name" required minlength="1" maxlength="250"
                                    autocomplete="off">
                                @error('name')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="flex flex-col">
                                <label for="email" class="input-label">Email Address <em>*</em></label>
                                <input type="email" name="email" value="{{ old('email',auth()->user()->email) }}"
                                    class="input-box-md @error('email') input-invalid @enderror"
                                    placeholder="Enter Email Address" required minlength="1" maxlength="250"
                                    autocomplete="off">
                                @error('email')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Phone Primary --}}
                            <div class="flex flex-col">
                                <label for="phone" class="input-label">Phone <em>*</em></label>
                                <input type="tel" pattern="[0-9]{10}" name="phone"
                                    value="{{ old('phone', auth()->user()->phone) }}"
                                    class="input-box-md @error('phone') input-invalid @enderror"
                                    placeholder="Enter Phone (10 Digits)" required minlength="10" maxlength="10"
                                    autocomplete="off">
                                @error('phone')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Account Password --}}
                            <div class="flex flex-col">
                                <label for="account_password" class="input-label">Account Password <em>*</em></label>
                                <input type="password" name="account_password" class="input-box-md @error('account_password') input-invalid @enderror" placeholder="Enter password" required autocomplete="off">
                                @error('account_password')<span class="input-error">{{ $message }}</span>@enderror
                            </div>

                        </div>
                    </div>
                    <div class="md:p-5 sm:px-0 sm:py-5">
                        <button type="submit" class="btn-ascent-dark-md md:w-auto sm:w-full">Save Changes</button>
                    </div>
                </form>

                <form class="bg-white md:border sm:border-x-0 md:shadow-md" method="POST" action="{{route('handle.account.password.update')}}">
                    <div class="md:px-5 py-4 border-b">
                        <h1 class="font-semibold text-lg mb-1">Update Password</h1>
                        <p class="text-xs text-gray-500">Update your account password</p>
                        @csrf
                    </div>
                    <div class="md:px-5 py-5 border-b">
                        <div class="grid md:grid-cols-4 sm:grid-cols-1 gap-5">

                             {{-- Current password --}}
                            <div class="input-group">   
                                <label for="current_password" class="input-label">Current password</label>
                                <input type="password" name="current_password" class="input-box-md @error('current_password') input-invalid @enderror" placeholder="Enter password" required>
                                @error('current_password')<span class="input-error">{{ $message }}</span>@enderror
                            </div>

                            {{-- New password --}}
                            <div class="input-group">   
                                <label for="password" class="input-label">New password</label>
                                <input type="password" name="password" class="input-box-md @error('password') input-invalid @enderror" minlength="6" maxlength="20" placeholder="Enter password" required>
                                @error('password')<span class="input-error">{{ $message }}</span>@enderror
                            </div>

                            {{-- Confirm password --}}
                            <div class="input-group">   
                                <label for="password_confirmation" class="input-label">Confirm password</label>
                                <input type="password" name="password_confirmation" class="input-box-md @error('password_confirmation') input-invalid @enderror" minlength="6" maxlength="20" placeholder="Repeat password" required>
                                @error('password_confirmation')<span class="input-error">{{ $message }}</span>@enderror
                            </div>
                            
                        </div>
                    </div>
                    <div class="md:p-5 sm:px-0 sm:py-5">
                        <button type="submit" class="btn-ascent-dark-md md:w-auto sm:w-full">Update Password</button>
                    </div>
                </form>

            </div>

        </div>

    </div>
</section>


{{-- Page Section (End) --}}

@endsection


@section('web-script')
    <script>
        document.getElementById('setting-tab').classList.add('active');

        const handleProfilePreview = (event) => {
            if (event.target.files.length == 0) {
                document.getElementById('profile').src = "{{ is_null(auth()->user()->profile) ? asset('web/images/default-profile.png') : asset('storage/'.auth()->user()->profile) }}";
            }
            else {
                document.getElementById('profile').src = URL.createObjectURL(event.target.files[0])
            }
        }
    </script>
@endsection
