@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Add Branch</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.branch.list') }}">Branches</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.branch.create') }}">Add Branch</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.branch.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Add Information</h1>
                    <p class="panel-card-description">Please fill the required fields</p>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    {{-- Divider --}}
                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold">General Information</h1>
                    </div>

                    {{-- Name --}}
                    <div class="flex flex-col">
                        <label for="name" class="input-label">Name <em>*</em></label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="input-box-md @error('name') input-invalid @enderror" placeholder="Enter name" required minlength="1" maxlength="250">
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email  --}}
                    <div class="flex flex-col">
                        <label for="email" class="input-label">Email address <em>*</em></label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="input-box-md @error('email') input-invalid @enderror" placeholder="Enter email" required
                            minlength="1" maxlength="250">
                        @error('email')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Phone  --}}
                    <div class="flex flex-col">
                        <label for="phone" class="input-label">Phone <em>*</em></label>
                        <input type="tel" name="phone" value="{{ old('phone') }}"
                            class="input-box-md @error('phone') input-invalid @enderror" pattern="[0-9]{10}" placeholder="Enter phone" required
                            minlength="10" maxlength="10">
                        @error('phone')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Type  --}}
                    <div class="flex flex-col">
                        <label for="type" class="input-label">Type <em>*</em></label>
                        <select name="type" class="input-box-md @error('type') input-invalid @enderror" required>
                            <option value="">Select Type</option>
                            <option value="Head Office">Head Office</option>
                            <option value="City Office">City Office</option>
                            <option value="Regional Warehouse">Regional Warehouse</option>
                        </select>
                        @error('type')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold">Address Information</h1>
                    </div>

                    {{-- Street --}}
                    <div class="flex flex-col">
                        <label for="street" class="input-label">Street <em>*</em></label>
                        <input type="text" name="street" value="{{ old('street') }}"
                            class="input-box-md @error('street') input-invalid @enderror" placeholder="Enter street"
                            required minlength="1" maxlength="250">
                        @error('street')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- City --}}
                    <div class="flex flex-col">
                        <label for="city" class="input-label">City <em>*</em></label>
                        <input type="text" name="city" value="{{ old('city') }}"
                            class="input-box-md @error('city') input-invalid @enderror" placeholder="Enter city" required
                            minlength="1" maxlength="250">
                        @error('city')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Pincode --}}
                    <div class="flex flex-col">
                        <label for="pincode" class="input-label">Pincode <em>*</em></label>
                        <input type="text" name="pincode" value="{{ old('pincode') }}"
                            class="input-box-md @error('pincode') input-invalid @enderror" placeholder="Enter pincode"
                            required minlength="1" maxlength="250">
                        @error('pincode')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- State --}}
                    <div class="flex flex-col">
                        <label for="state" class="input-label">State <em>*</em></label>
                        <input type="text" name="state" value="{{ old('state') }}"
                            class="input-box-md @error('state') input-invalid @enderror" placeholder="Enter state"
                            required minlength="1" maxlength="250">
                        @error('state')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Country --}}
                    <div class="flex flex-col">
                        <label for="country" class="input-label">Country <em>*</em></label>
                        <input type="text" name="country" value="{{ old('country') }}"
                            class="input-box-md @error('country') input-invalid @enderror" placeholder="Enter country"
                            required minlength="1" maxlength="250">
                        @error('country')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Divider --}}
                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold">Create Password</h1>
                    </div>

                    {{-- Password --}}
                    <div class="input-group">
                        <label for="password" class="input-label">Password <em>*</em></label>
                        <input type="password" name="password"
                            class="input-box-md @error('password') input-invalid @enderror" placeholder="Enter password"
                            required minlength="6" maxlength="20">
                        @error('password')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Confirm password --}}
                    <div class="input-group">
                        <label for="password_confirmation" class="input-label">Confirm password <em>*</em></label>
                        <input type="password" name="password_confirmation"
                            class="input-box-md @error('password_confirmation') input-invalid @enderror"
                            placeholder="Repeat password" required minlength="6" maxlength="20">
                        @error('password_confirmation')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>
                    

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Add Branch</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('branch-tab').classList.add('active');
    </script>
@endsection
