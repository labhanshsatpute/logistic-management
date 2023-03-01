@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Edit Coupon</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.coupon.list') }}">Coupons</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.coupon.update', ['id' => $coupon->id]) }}">Edit Coupon</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{route('admin.handle.coupon.update',['id' => $coupon->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Update Information</h1>
                    <p class="panel-card-description">Please fill the required fields</p>
                </div>
                <div>
                    <button type="button" class="btn-danger-md" onclick="handleDelete()">Delete</button>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    {{-- Name --}}
                    <div class="flex flex-col">
                        <label for="name" class="input-label">Name</label>
                        <input type="text" name="name" value="{{ old('name', $coupon->name) }}"
                            class="input-box-md @error('name') input-invalid @enderror" placeholder="Enter name" required>
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Code --}}
                    <div class="flex flex-col">
                        <label for="code" class="input-label">Code</label>
                        <input type="text" name="code" value="{{ old('code', $coupon->code) }}"
                            class="input-box-md @error('code') input-invalid @enderror" placeholder="Enter code" required>
                        @error('code')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Start Date --}}
                    <div class="flex flex-col">
                        <label for="start_date" class="input-label">Start Date</label>
                        <input type="date" name="start_date" value="{{ old('start_date',$coupon->start_date) }}"
                            class="input-box-md @error('start_date') input-invalid @enderror" required>
                        @error('start_date')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Expire Date --}}
                    <div class="flex flex-col">
                        <label for="expire_date" class="input-label">Expire Date</label>
                        <input type="date" name="expire_date" value="{{ old('expire_date', $coupon->expire_date) }}"
                            class="input-box-md @error('expire_date') input-invalid @enderror" required>
                        @error('expire_date')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Summary --}}
                    <div class="flex flex-col md:col-span-4 sm:col-span-1">
                        <label for="summary" class="input-label">Summary</label>
                        <input type="text" name="summary" value="{{ old('summary', $coupon->summary) }}"
                            class="input-box-md @error('summary') input-invalid @enderror" placeholder="Enter summary"
                            minlength="1" maxlength="500">
                        @error('summary')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Discount Type --}}
                    <div class="flex flex-col">
                        <label for="discount_type" class="input-label">Discount Type</label>
                        <div class="space-x-3 flex">
                            <div class="input-radio">
                                <input type="radio" value="Fixed" @checked(old('discount_type', $coupon->discount_type) == 'Fixed') name="discount_type"
                                    id="discount_type_fixed" required>
                                <label for="discount_type_fixed">Fixed</label>
                            </div>
                            <div class="input-radio">
                                <input type="radio" value="Percentage" @checked(old('discount_type', $coupon->discount_type) == 'Percentage') name="discount_type"
                                    id="discount_type_percentage" required>
                                <label for="discount_type_percentage">Percentage</label>
                            </div>
                        </div>
                        @error('discount_type')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- User Type --}}
                    <div class="flex flex-col">
                        <label for="user_type" class="input-label">User Type</label>
                        <div class="space-x-3 flex">
                            <div class="input-radio">
                                <input type="radio" value="New User" @checked(old('user_type',$coupon->user_type) == 'New User') name="user_type"
                                    id="user_type_new" required>
                                <label for="user_type_new">New User</label>
                            </div>
                            <div class="input-radio">
                                <input type="radio" value="All User" @checked(old('user_type',$coupon->user_type) == 'All User') name="user_type"
                                    id="user_type_all" required>
                                <label for="user_type_all">All User</label>
                            </div>
                        </div>
                        @error('user_type')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <hr>
                    </div>

                    {{-- Discount Value --}}
                    <div class="flex flex-col">
                        <label for="discount_value" class="input-label">Discount Value</label>
                        <input type="number" step="any" name="discount_value" value="{{ old('discount_value', $coupon->discount_value) }}"
                            class="input-box-md @error('discount_value') input-invalid @enderror"
                            placeholder="Enter value" required min="0" max="1000000">
                        @error('discount_value')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Minimum Purchase --}}
                    <div class="flex flex-col">
                        <label for="minimum_purchase" class="input-label">Minimum Purchase</label>
                        <input type="number" step="any" name="minimum_purchase" value="{{ old('minimum_purchase', $coupon->minimum_purchase) }}"
                            class="input-box-md @error('minimum_purchase') input-invalid @enderror"
                            placeholder="Enter price" required min="0" max="1000000">
                        @error('minimum_purchase')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Save Changes</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('coupon-tab').classList.add('active');

        const handleDelete = () => {
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
                            "{{ route('admin.handle.coupon.delete', ['id' => $coupon->id]) }}";
                    }
                });
        }
    </script>
@endsection
