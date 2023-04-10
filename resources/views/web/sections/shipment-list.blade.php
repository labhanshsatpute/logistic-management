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

            <div class="md:col-span-9 md:space-y-10">

                @foreach ($shipments as $shipment)
                <div class="md:border sm:border-b w-full md:p-9 sm:py-5 rounded-md space-y-3">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <h1 class="font-semibold md:text-xl sm:text-lg">Shippment ID - #{{$shipment->id}}</h1>
                            
                                @switch($shipment->status)
                                    @case('Placed')
                                        <p class="alert-warning-sm">Shipment Placed</p>
                                        @break
                                    @case('Confirmed')
                                        <p class="alert-success-sm">Shipment Confirmed</p>
                                        @break
                                    @case('Cancelled')
                                        <p class="alert-danger-sm">Shipment Cancelled</p>
                                        @break
                                @endswitch
                                
                        </div>
                        <div class="space-y-2">
                            <p class="text-sm text-slate-800 flex items-center justify-start mb-1">Deliver to {{$shipment->reciever_name}}</p>
                            <p class="text-sm text-slate-800 flex items-center justify-start mb-1">{{$shipment->reciever_email}}</p>
                            <p class="text-sm text-slate-800 flex items-center justify-start mb-1">{{$shipment->reciever_phone_primary}}</p>
                        
                            <p class="text-base font-medium text-slate-800 flex items-center justify-start mb-1">Total : {{env('APP_CURRENCY')}}{{number_format($shipment->payment_total,2)}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                
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
