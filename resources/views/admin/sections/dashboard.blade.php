@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Dashboard</h1>
        <ul class="breadcrumb">
            <li><a href="#">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="#">Dashboard</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <div class="grid md:grid-cols-3 md:gap-10 sm:gap-5">

        <figure class="panel-card">
            <div class="panel-card-body">
                <div class="flex items-center justify-between mb-2">
                    <div class="space-y-2">
                        <p class="text-sm text-slate-500 font-medium tracking-wider uppercase">Products</p>
                        <h1 class="font-bold text-3xl">{{env('APP_CURRENCY')}}23,000</h1>
                    </div>
                    <div>
                        <div class="h-12 w-12 flex items-center justify-center bg-indigo-600 rounded-full text-white">
                            <i data-feather="box"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="flex items-center justify-start font-medium text-slate-500 text-sm whitespace-nowrap">
                       Listed on website
                    </p>
                </div>
            </div>
        </figure>

        <figure class="panel-card">
            <div class="panel-card-body">
                <div class="flex items-center justify-between mb-2">
                    <div class="space-y-2">
                        <p class="text-sm text-slate-500 font-medium tracking-wider uppercase">Users</p>
                        <h1 class="font-bold text-3xl">345</h1>
                    </div>
                    <div>
                        <div class="h-12 w-12 flex items-center justify-center bg-purple-600 rounded-full text-white">
                            <i data-feather="user"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="flex items-center justify-start font-medium text-slate-500 text-sm whitespace-nowrap">
                        Registred on website
                    </p>
                </div>
            </div>
        </figure>

        <figure class="panel-card">
            <div class="panel-card-body">
                <div class="flex items-center justify-between mb-2">
                    <div class="space-y-2">
                        <p class="text-sm text-slate-500 font-medium tracking-wider uppercase">Orders</p>
                        <h1 class="font-bold text-3xl">234</h1>
                    </div>
                    <div>
                        <div class="h-12 w-12 flex items-center justify-center bg-orange-600 rounded-full text-white">
                            <i data-feather="shopping-bag"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="flex items-center justify-start font-medium text-slate-500 text-sm whitespace-nowrap">
                        Todays orders
                    </p>
                </div>
            </div>
        </figure>


    </div>
@endsection

@section('panel-script')
    <script>
        document.getElementById('dashboard-tab').classList.add('active');
    </script>
@endsection