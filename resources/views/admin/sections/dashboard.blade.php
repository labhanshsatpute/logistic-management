@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Dashboard</h1>
        <ul class="breadcrumb">
            <li><a href="{{route('admin.view.dashboard')}}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{route('admin.view.dashboard')}}">Dashboard</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <div class="grid md:grid-cols-3 md:gap-10 sm:gap-5">

        <figure class="panel-card">
            <div class="panel-card-body">
                <div class="flex items-center justify-between mb-2">
                    <div class="space-y-2">
                        <p class="text-sm text-slate-500 font-medium tracking-wider uppercase">Earning</p>
                        <h1 class="font-bold text-3xl">{{env('APP_CURRENCY')}} {{number_format(DB::table('shipments')->where('payment_status','Paid')->sum('payment_total'),2)}}</h1>
                    </div>
                    <div>
                        <div class="h-12 w-12 flex items-center justify-center bg-indigo-600 rounded-full text-white">
                            <i data-feather="dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="flex items-center justify-start font-medium text-slate-500 text-sm whitespace-nowrap">
                       Todays Total Payment
                    </p>
                </div>
            </div>
        </figure>

        <figure class="panel-card">
            <div class="panel-card-body">
                <div class="flex items-center justify-between mb-2">
                    <div class="space-y-2">
                        <p class="text-sm text-slate-500 font-medium tracking-wider uppercase">Users</p>
                        <h1 class="font-bold text-3xl">{{DB::table('users')->where('status',true)->count()}}</h1>
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
                        <p class="text-sm text-slate-500 font-medium tracking-wider uppercase">Shipment</p>
                        <h1 class="font-bold text-3xl">{{DB::table('shipments')->whereRaw('date(created_at) = curdate()')->count()}}</h1>
                    </div>
                    <div>
                        <div class="h-12 w-12 flex items-center justify-center bg-orange-600 rounded-full text-white">
                            <i data-feather="truck"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="flex items-center justify-start font-medium text-slate-500 text-sm whitespace-nowrap">
                        Todays Shipment Booked
                    </p>
                </div>
            </div>
        </figure>

        <figure class="panel-card md:col-span-3 sm:col-span-1">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Pending Shipments</h1>
                    <p class="panel-card-description">Pending shipments listed in website </p>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="panel-card-table">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Sender</th>
                            <th>Pickup From</th>
                            <th>Delivery to</th>
                            <th>Type</th>
                            <th>Bill Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($pending_shipments as $shipment)
                                <tr>
                                    <td>{{ $shipment->id }}</td>
                                    <td>{{ $shipment->sender_name }}</td>
                                    <td>{{ $shipment->sender_address_city }} - {{ $shipment->sender_address_state }} </td>
                                    <td>{{ $shipment->reciever_address_city }} - {{ $shipment->reciever_address_state }} </td>
                                    <td>{{ $shipment->package_type }}</td>
                                    <td>{{env('APP_CURRENCY')}}{{number_format( $shipment->payment_total , 2)}}</td>
                                    <td>
                                        @switch($shipment->status)
                                            @case('Placed')
                                                <div class="table-status-warning">{{ $shipment->status }}</div>
                                                @break
                                            @case('Confirmed' || 'Shipping' || 'Delivered')
                                                <div class="table-status-success">{{ $shipment->status }}</div>
                                                @break
                                            @case('Cancelled')
                                                <div class="table-status-warning">{{ $shipment->status }}</div>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="table-dropdown">
                                            <button>Options<i data-feather="chevron-down" class="ml-1 toggler-icon"></i></button>
                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li><a href="{{route('admin.view.shipment.update',['id' => $shipment->id])}}" class="dropdown-link-primary"><i data-feather="edit" class="mr-1"></i> Edit Shipment</a></li>
                                                    <li><a href="javascript:handleDelete({{$shipment->id}});" class="dropdown-link-danger"><i data-feather="trash-2" class="mr-1"></i> Delete Shipment</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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