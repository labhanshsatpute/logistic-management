@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Shipments</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.shipment.list') }}">Shipments</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">All Shipments</h1>
                <p class="panel-card-description">All shipments listed in website </p>
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
                        @foreach ($shipments as $shipment)
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
@endsection

@section('panel-script')
    <script>
        document.getElementById('shipment-tab').classList.add('active');

        const handleDelete = (id) => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this shipment!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            `{{ url('admin/shipment/delete')}}/${id}`;
                    }
                });
        }
    </script>
@endsection
