@extends('web.layouts.app')

@section('web-section')

{{-- Page Cover & Breadcrumb Section (Start) --}}
<section class="relative bg-cover bg-center md:block sm:hidden" style="background-image: url('{{asset('web/images/cover-image.jpg')}}')">
    @include('web.common.bottom-header')
    <div class="md:pt-32 md:pb-20 sm:py-20">
        <div class="container">
            <h1 class="font-semibold text-white text-4xl">My Shipments</h1>
        </div>
    </div>
</section>
<section class="py-6 border-b shadow-sm relative md:hidden sm:block">
    <div class="container">
        <ul class="flex items-center justify-start space-x-3">
            <li><a href="{{ route('view.home') }}" class="link">Home</a></li>
            <li><i data-feather="chevron-right" class="h-4 w-4 text-gray-700"></i></li>
            <li><a href="{{ route('view.shipments') }}" class="link">My Shipments</a></li>
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

            <div class="md:col-span-9">

                
            </div>

        </div>
        

    </div>
</section>
{{-- Page Section (End) --}}

@endsection


@section('web-script')
    <script>
        document.getElementById('shipments-tab').classList.add('active');
    </script>
@endsection
