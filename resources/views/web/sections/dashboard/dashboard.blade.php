@extends('web.layouts.app')

@section('web-section')

{{-- Page Cover & Breadcrumb Section (Start) --}}
<section class="relative bg-cover bg-center md:block sm:hidden" style="background-image: url('{{asset('web/images/cover-image.jpg')}}')">
    @include('web.common.bottom-header')
    <div class="md:pt-32 md:pb-20 sm:py-20">
        <div class="container">
            <h1 class="font-semibold text-white text-4xl">My Dashboard</h1>
        </div>
    </div>
</section>
{{-- Page Cover & Breadcrumb Section (End) --}}

{{-- Page Section (Start) --}}
<section class="md:py-20 sm:py-0">
    <div class="md:container">
        <div class="grid md:grid-cols-12 sm:grid-cols-1 gap-10">

            <div class="md:col-span-3 md:block sm:hidden">
                @include('web.common.dashboard-sidebar')
            </div>

            <div class="md:col-span-9">
                <figure class="bg-white border md:shadow-md">
                    <div class="bg-web-ascent-dark md:px-20 sm:px-10 relative py-20 overflow-visible" style="background-image: url('/web/images/account-bg.svg')">
                        <img src="{{ is_null(auth()->user()->profile) ? asset('web/images/default-profile.png') : asset('storage/'. auth()->user()->profile)}}" alt="profile-img" class="h-[130px] w-[130px] rounded-full absolute z-20 -bottom-1/3 bg-white ring-8 ring-gray-600" />
                    </div>
                    <div class="md:px-20 sm:px-9 pt-20 md:pb-16 sm:pb-9 space-y-7">
                        <div class="space-y-2">
                          <p class="text-2xl font-semibold">{{Auth::user()->name}}</p>
                          <p class="text-gray-500 text-sm flex items-center"><i data-feather="mail" class="h-4 w-4 mr-1 mb-[1px]"></i> {{Auth::user()->email}}</p>
                          <p class="text-gray-500 text-sm flex items-center"><i data-feather="phone" class="h-4 w-4 mr-1 mb-[1px]"></i> {{Auth::user()->phone}}</p>
                        </div>
                        <div>
                          <a href="#" class="btn-light-md flex items-center justify-center w-fit"><i data-feather="edit" class="h-4 w-4 mb-[1px] mr-2"></i> Edit Information</a>
                        </div>
                      </div>
                </figure>
            </div>

        </div>
    </div>
</section>
{{-- Page Section (End) --}}

@endsection

@section('web-script')
    <script>
        document.getElementById('dashboard-tab').classList.add('active');
    </script>
@endsection
