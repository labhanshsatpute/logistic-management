@extends('web.layouts.app')

@section('web-section')

{{-- Page Cover & Breadcrumb Section (Start) --}}
<section class="relative bg-cover bg-center md:block sm:hidden" style="background-image: url('{{asset('web/images/cover-image.jpg')}}')">
    @include('web.common.bottom-header')
    <div class="md:pt-32 md:pb-20 sm:py-20">
        <div class="container">
            <h1 class="font-semibold text-white text-4xl">Payment</h1>
        </div>
    </div>
</section>
<section class="py-6 border-b shadow-sm relative md:hidden sm:block">
    <div class="container">
        <ul class="flex items-center justify-start space-x-3">
            <li><a href="{{ route('view.home') }}" class="link">Home</a></li>
            <li><i data-feather="chevron-right" class="h-4 w-4 text-gray-700"></i></li>
            <li><a href="javascript:void();" class="link">Shipment</a></li>
            <li><i data-feather="chevron-right" class="h-4 w-4 text-gray-700"></i></li>
            <li><a href="{{ route('view.shipment.payment.razorpay',['token' => $payment->token]) }}" class="link">Payment</a></li>
        </ul>
    </div>
</section>
{{-- Page Cover & Breadcrumb Section (End) --}}

{{-- Page Section (Start) --}}
<section class="md:py-20 sm:py-10">
    <div class="container">

        <div class="flex justify-center items-center text-center flex-col space-y-10">
            <div>
                <h1 class="font-semibold md:text-3xl sm:text-2xl">You have to pay  {{env('APP_CURRENCY')}}{{number_format($payment->amount,2)}}</h1>
            </div>
            <div>
                <form action="{{route('handle.shipment.payment.razorpay',['token' => $payment->token ])}}" method="POST">
                    @csrf
                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                            data-key="{{env('RAZORPAY_KEY')}}"
                            data-amount="{{$payment->amount * 100}}"
                            data-buttontext="Make Payment"
                            data-name="Shipment Payment"
                            data-theme.color="#fb8500">
                    </script>
                </form>
            </div>
            <div>
                <h1>Note : Do not close or reload browser after payment completion.</h1>
            </div>
        </div>

    </div>
</section>
{{-- Page Section (End) --}}

@endsection

@section('web-script')
<script>
    document.querySelectorAll('.razorpay-payment-button')[0].classList.add('btn-light-lg');
    document.querySelectorAll('.razorpay-payment-button')[0].classList.add('cursor-pointer');
</script>    
@endsection