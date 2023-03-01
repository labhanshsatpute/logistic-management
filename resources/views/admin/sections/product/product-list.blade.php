@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Products</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.product.list') }}">Products</a></li>
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
                <a href="{{ route('admin.view.product.create') }}" class="btn-primary-md">Add Product</a>
            </div>
        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Availability</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->parent_category }} {{ $product->child_category }}</td>
                                <td>{{env('APP_CURRENCY')}}{{ $product->price_discounted }} <span
                                        class="line-through text-slate-600 ml-2">{{env('APP_CURRENCY')}}{{ $product->price_original }}</span></td>
                                
                                <td>
                                    <label class="relative cursor-pointer">
                                        <input onchange="handleUpdateStatus({{$product->id}})" @checked($product->status) type="checkbox" class="sr-only peer">
                                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2.5px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-admin-ascent"></div>
                                    </label>
                                </td>
                                <td>
                                    @switch($product->availability)
                                        @case('In Stock')
                                            <div class="table-status-success">{{ $product->availability }}</div>
                                            @break
                                        @case('Out of Stock')
                                            <div class="table-status-warning">{{ $product->availability }}</div>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <div class="table-dropdown">
                                        <button>Options<i data-feather="chevron-down" class="ml-1 toggler-icon"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a href="{{route('admin.view.product.update',['id' => $product->id])}}" class="dropdown-link-primary"><i data-feather="edit" class="mr-1"></i> Edit Product</a></li>
                                                <li><a href="#" class="dropdown-link-primary"><i data-feather="copy" class="mr-1"></i> Duplicate Product</a></li>
                                                <li><a href="javascript:handleProductDelete({{$product->id}});" class="dropdown-link-danger"><i data-feather="trash-2" class="mr-1"></i> Delete Product</a></li>
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
        document.getElementById('product-tab').classList.add('active');

        const handleUpdateStatus = (id) => {
            fetch("{{ route('admin.handle.product.status') }}", {
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

        const handleProductDelete = (id) => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this product!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            `{{ url('admin/product/delete')}}/${id}`;
                    }
                });
        }
    </script>
@endsection
