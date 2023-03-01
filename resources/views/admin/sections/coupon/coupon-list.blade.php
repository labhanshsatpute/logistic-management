@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Coupons</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.coupon.list') }}">Coupons</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">All Records</h1>
                <p class="panel-card-description">All available records </p>
            </div>
            <div>
                <a href="{{ route('admin.view.coupon.create') }}" class="btn-primary-md">Create Coupon</a>
            </div>
        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->id }}</td>
                                <td>{{ $coupon->name }}</td>
                                <td>{{ $coupon->code }}</td>
                                <td>
                                    @switch($coupon->discount_type)
                                        @case('Fixed')
                                            {{env('APP_CURRENCY')}}{{ $coupon->discount_value }}
                                            @break
                                        @case('Percentage')
                                            {{ $coupon->discount_value }}% 
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <label class="relative cursor-pointer">
                                        <input onchange="handleUpdateStatus({{$coupon->id}})" @checked($coupon->status) type="checkbox" class="sr-only peer">
                                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2.5px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-admin-ascent"></div>
                                    </label>
                                </td>
                                <td>
                                    <div class="table-dropdown">
                                        <button>Options<i data-feather="chevron-down" class="ml-1 toggler-icon"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a href="{{route('admin.view.coupon.update',['id' => $coupon->id])}}" class="dropdown-link-primary"><i data-feather="edit" class="mr-1"></i> Edit Coupon</a></li>
                                                <li><a href="javascript:handleDelete({{$coupon->id}});" class="dropdown-link-danger"><i data-feather="trash-2" class="mr-1"></i> Delete Coupon</a></li>
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
        
        <div class="panel-card-footer">

        </div>
    </figure>
@endsection

@section('panel-script')
    <script>
        document.getElementById('coupon-tab').classList.add('active');

        const handleUpdateStatus = (id) => {
            fetch("{{ route('admin.handle.coupon.status') }}", {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    _token: "{{ csrf_token() }}"
                })
            }).then((response) => {
                return response.json();
            }).then((result) => {
                console.log(result);
            }).catch((error) => {
                console.error(error);
            });
        }

        const handleDelete = (id) => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this coupon!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            `{{ url('admin/coupon/delete')}}/${id}`;
                    }
                });
        }
    </script>
@endsection
