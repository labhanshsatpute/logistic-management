@extends('admin.layouts.app')

@section('panel-header')
<div>
    <h1 class="panel-title">Setting</h1>
    <ul class="breadcrumb">
        <li><a href="{{route('admin.view.dashboard')}}">Admin</a></li>
        <li><i data-feather="chevron-right"></i></li>
        <li><a href="{{route('admin.view.setting')}}">Setting</a></li>
    </ul>
</div>
@endsection

@section('panel-body')

    <div class="grid md:grid-cols-3 sm:grid-cols-1 md:gap-10 sm:gap-5">

        {{-- Account Information Card (Start) --}}
        <figure class="panel-card">
            <div class="h-[220px] w-full bg-admin-ascent border-admin-ascent bg-opacity-50 flex items-center justify-center">
                <img src="{{ is_null(auth()->user('admin')->profile) ? asset('admin/images/default-profile.png') : asset('storage/'.auth()->user('admin')->profile) }}" alt="profile" class="h-[100px] w-[100px] rounded-full border bg-white">
            </div>
            <div class="space-y-5 p-7">
                <div class="space-y-2">
                    <h1 class="font-semibold text-2xl">{{auth()->user()->name}}</h1>
                    <h1 class="text-slate-700 text-sm font-medium flex items-center">
                        <i data-feather="mail" class="h-4 w-4 mr-2"></i> {{auth()->user()->email}}
                    </h1>
                    <h1 class="text-slate-700 text-sm font-medium flex items-center">
                        <i data-feather="phone" class="h-4 w-4 mr-2"></i> {{auth()->user()->phone}}
                    </h1>
                </div>
                <div>
                    <a href="{{route('admin.view.account.setting')}}">
                    <button type="button" class="btn-primary-md w-full"><i data-feather="edit" class="h-4 w-4 opacity-50 absolute mr-auto"></i>Edit Information</button></a>
                </div>
            </div>
        </figure>
        {{-- Account Information Card (End) --}}

        {{-- Payment Gateway Card (Start) --}}
        <figure class="panel-card">
            <div class="h-[220px] w-full flex items-center justify-center bg-white border-b">
                <img src="{{asset('admin/images/setting/payment-gateway.png')}}" alt="payment -gateway" class="h-full w-fit mx-auto">
            </div>
            <div class="space-y-5 p-7">
                <div class="space-y-2">
                    <h1 class="font-semibold text-2xl">Payment Gateways</h1>
                    <p class="text-slate-700 text-sm">Manage multiple payment gateways in your website.</p>
                    <div>
                        <span class="text-xs px-2 py-1 border border-slate-400 rounded inline-block mr-1 mb-1">Razorpay</span>
                        <span class="text-xs px-2 py-1 border border-slate-400 rounded inline-block mr-1 mb-1">PayTM</span>
                        <span class="text-xs px-2 py-1 border border-slate-400 rounded inline-block mr-1 mb-1">Stripe</span>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn-primary-md w-full"><i data-feather="edit" class="h-4 w-4 opacity-50 absolute mr-auto"></i>Edit Information</button>
                </div>
            </div>
        </figure>
        {{-- Payment Gateway Card (End) --}}

        {{-- Notification Email Card (Start) --}}
        <figure class="panel-card">
            <div class="h-[220px] w-full flex items-center justify-center bg-white border-b">
                <img src="{{asset('admin/images/setting/notification-email.png')}}" alt="payment -gateway" class="h-full w-fit mx-auto">
            </div>
            <div class="space-y-5 p-7">
                <div class="space-y-2">
                    <h1 class="font-semibold text-2xl">Notification Emails</h1>
                    <p class="text-slate-700 text-sm">Manage notification email in the website</p>
                    <div>
                        <span class="text-xs px-2 py-1 border border-slate-400 rounded inline-block mr-1 mb-1">labhansh25@gmail.com</span>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn-primary-md w-full"><i data-feather="edit" class="h-4 w-4 opacity-50 absolute mr-auto"></i>Edit Information</button>
                </div>
            </div>
        </figure>
        {{-- Notification Email Card (End) --}}

    </div>
@endsection

@section('panel-script')
<script>
    document.getElementById('setting-tab').classList.add('active');
</script>
@endsection