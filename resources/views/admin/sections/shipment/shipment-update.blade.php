@extends('admin.layouts.app')

@php
    $package_type = ['Grocery', 'Food & Vegetable', 'Electronics', 'Home Appliances', 'Furniture', 'Handle With Care', 'Vaccine', 'Medicine', 'Liquor', 'Other'];
@endphp

@section('panel-header')
    <div>
        <h1 class="panel-title">Edit Shipment</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.shipment.list') }}">Shipments</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.shipment.update', ['id' => $shipment->id]) }}">Edit Shipments</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.shipment.update', ['id' => $shipment->id]) }}" method="POST"
        enctype="multipart/form-data" class="md:space-y-10 sm:space-y-5">

        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Pickup Information</h1>
                    <p class="panel-card-description">Please check the information of sender</p>
                    @csrf
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    {{-- Sender Name --}}
                    <div class="input-group">
                        <label for="sender_name" class="input-label">Name</label>
                        <input type="text" name="sender_name" value="{{ old('sender_name', $shipment->sender_name) }}"
                            class="input-box-md @error('sender_name') input-invalid @enderror" placeholder="Enter name"
                            required>
                        @error('sender_name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Sender Name --}}
                    <div class="input-group">
                        <label for="sender_email" class="input-label">Email address</label>
                        <input type="text" name="sender_email" value="{{ old('sender_email', $shipment->sender_email) }}"
                            class="input-box-md @error('sender_email') input-invalid @enderror"
                            placeholder="Enter email address" required>
                        @error('sender_email')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Sender Phone Primary --}}
                    <div class="input-group">
                        <label for="sender_phone_primary" class="input-label">Phone (Primary)</label>
                        <input type="text" name="sender_phone_primary"
                            value="{{ old('sender_phone_primary', $shipment->sender_phone_primary) }}"
                            class="input-box-md @error('sender_phone_primary') input-invalid @enderror"
                            placeholder="Enter phone (primary)" required>
                        @error('sender_phone_primary')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Sender Phone Alternate --}}
                    <div class="input-group">
                        <label for="sender_phone_alternate" class="input-label">Phone (Alternate)</label>
                        <input type="text" name="sender_phone_alternate"
                            value="{{ old('sender_phone_primary', $shipment->sender_phone_alternate) }}"
                            class="input-box-md @error('sender_phone_alternate') input-invalid @enderror"
                            placeholder="Enter phone (alternate)">
                        @error('sender_phone_alternate')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Sender Address Home --}}
                    <div class="flex flex-col md:col-span-2">
                        <label for="sender_address_home" class="input-label">Home</label>
                        <input type="text" name="sender_address_home"
                            value="{{ old('sender_address_home', $shipment->sender_address_home) }}"
                            class="input-box-md @error('sender_address_home') input-invalid @enderror"
                            placeholder="Enter Home / Flat / Building" minlength="1" maxlength="250">
                        @error('sender_address_home')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Sender Address Street --}}
                    <div class="flex flex-col md:col-span-2">
                        <label for="sender_address_street" class="input-label">Street </label>
                        <input id="search_input" type="text" name="sender_address_street"
                            value="{{ old('sender_address_street', $shipment->sender_address_street) }}"
                            class="input-box-md @error('sender_address_street') input-invalid @enderror"
                            placeholder="Enter Street / Area / Locality" required minlength="1" maxlength="250">
                        @error('sender_address_street')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Sender Address City --}}
                    <div class="flex flex-col">
                        <label for="sender_address_city" class="input-label">City </label>
                        <input type="text" name="sender_address_city"
                            value="{{ old('sender_address_city', $shipment->sender_address_city) }}"
                            class="input-box-md @error('sender_address_city') input-invalid @enderror"
                            placeholder="Enter City" required minlength="1" maxlength="250">
                        @error('sender_address_city')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Sender Address Pincode --}}
                    <div class="flex flex-col">
                        <label for="sender_address_pincode" class="input-label">Pincode </label>
                        <input type="tel" pattern="[0-9]{6}" name="sender_address_pincode"
                            value="{{ old('sender_address_pincode', $shipment->sender_address_pincode) }}"
                            class="input-box-md @error('sender_address_pincode') input-invalid @enderror"
                            placeholder="Enter Pincode (6 Digits)" required minlength="6" maxlength="6">
                        @error('sender_address_pincode')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Sender Address State --}}
                    <div class="flex flex-col">
                        <label for="sender_address_state" class="input-label">State </label>
                        <input type="text" name="sender_address_state"
                            value="{{ old('sender_address_state', $shipment->sender_address_state) }}"
                            class="input-box-md @error('sender_address_state') input-invalid @enderror"
                            placeholder="Enter State" required minlength="1" maxlength="250">
                        @error('sender_address_state')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Sender Address Country --}}
                    <div class="flex flex-col">
                        <label for="sender_address_country" class="input-label">Country </label>
                        <input type="text" name="sender_address_country"
                            value="{{ old('sender_address_country', $shipment->sender_address_country) }}"
                            class="input-box-md @error('sender_address_country') input-invalid @enderror"
                            placeholder="Enter Country" required minlength="1" maxlength="250">
                        @error('sender_address_country')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Pickup Date --}}
                    <div class="flex flex-col">
                        <label for="pickup_date" class="input-label">Pickup Date </label>
                        <input type="date" name="pickup_date"
                            value="{{ old('pickup_date', $shipment->pickup_date) }}"
                            class="input-box-md @error('pickup_date') input-invalid @enderror" required>
                        @error('pickup_date')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Pickup Slot --}}
                    <div class="flex flex-col">
                        <label for="pickup_slot" class="input-label">Pickup Timing </label>
                        <select name="pickup_slot" class="input-box-md @error('pickup_slot') input-invalid @enderror"
                            required>
                            <option @selected($shipment->pickup_slot == 'Morning') value="Morning">Morning (10:00 AM - 12:00 PM)</option>
                            <option @selected($shipment->pickup_slot == 'Afternoon') value="Afternoon">Afternoon (12:00 PM - 4:00 PM)</option>
                            <option @selected($shipment->pickup_slot == 'Evening') value="Evening">Evening (4:00 PM - 6:00 PM)</option>
                        </select>
                        @error('pickup_slot')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                </div>
            </div>
        </figure>

        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Delivery Information</h1>
                    <p class="panel-card-description">Please check the information of reciever</p>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">


                    {{-- Reciever Name --}}
                    <div class="flex flex-col">
                        <label for="reciever_name" class="input-label">Name</label>
                        <input type="text" name="reciever_name"
                            value="{{ old('reciever_name', $shipment->reciever_name) }}"
                            class="input-box-md @error('reciever_name') input-invalid @enderror" placeholder="Enter Name"
                            required minlength="1" maxlength="250" autocomplete="name">
                        @error('reciever_name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Reciever Email --}}
                    <div class="flex flex-col">
                        <label for="reciever_email" class="input-label">Email Address</label>
                        <input type="email" name="reciever_email"
                            value="{{ old('reciever_email', $shipment->reciever_email) }}"
                            class="input-box-md @error('reciever_email') input-invalid @enderror"
                            placeholder="Enter Email Address" required minlength="1" maxlength="250"
                            autocomplete="email">
                        @error('reciever_email')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Reciever Phone Primary --}}
                    <div class="flex flex-col">
                        <label for="reciever_phone_primary" class="input-label">Phone</label>
                        <input type="tel" pattern="[0-9]{10}" name="reciever_phone_primary"
                            value="{{ old('reciever_phone_primary', $shipment->reciever_phone_primary) }}"
                            class="input-box-md @error('reciever_phone_primary') input-invalid @enderror"
                            placeholder="Enter Phone (10 Digits)" required minlength="10" maxlength="10"
                            autocomplete="phone">
                        @error('reciever_phone_primary')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Reciever Phone Primary --}}
                    <div class="flex flex-col">
                        <label for="reciever_phone_alternate" class="input-label">Phone (Alternate)</label>
                        <input type="tel" pattern="[0-9]{10}" name="reciever_phone_alternate"
                            value="{{ old('reciever_phone_alternate', $shipment->reciever_phone_alternate) }}"
                            class="input-box-md @error('reciever_phone_alternate') input-invalid @enderror"
                            placeholder="Enter Phone (10 Digits)" minlength="10" maxlength="10" autocomplete="phone">
                        @error('reciever_phone_alternate')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Reciever Address Home --}}
                    <div class="flex flex-col md:col-span-2">
                        <label for="reciever_address_home" class="input-label">Home</label>
                        <input type="text" name="reciever_address_home"
                            value="{{ old('reciever_address_home', $shipment->reciever_address_home) }}"
                            class="input-box-md @error('reciever_address_home') input-invalid @enderror"
                            placeholder="Enter Home / Flat / Building" minlength="1" maxlength="250">
                        @error('reciever_address_home')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Reciever Address Street --}}
                    <div class="flex flex-col md:col-span-2">
                        <label for="reciever_address_street" class="input-label">Street</label>
                        <input type="text" name="reciever_address_street"
                            value="{{ old('reciever_address_street', $shipment->reciever_address_street) }}"
                            class="input-box-md @error('reciever_address_street') input-invalid @enderror"
                            placeholder="Enter Street / Area / Locality" required minlength="1" maxlength="250">
                        @error('reciever_address_street')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Reciever Address City --}}
                    <div class="flex flex-col">
                        <label for="reciever_address_city" class="input-label">City</label>
                        <input type="text" name="reciever_address_city"
                            value="{{ old('reciever_address_city', $shipment->reciever_address_city) }}"
                            class="input-box-md @error('reciever_address_city') input-invalid @enderror"
                            placeholder="Enter City" required minlength="1" maxlength="250">
                        @error('reciever_address_city')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Reciever Address Pincode --}}
                    <div class="flex flex-col">
                        <label for="reciever_address_pincode" class="input-label">Pincode</label>
                        <input type="tel" pattern="[0-9]{6}" name="reciever_address_pincode"
                            value="{{ old('reciever_address_pincode', $shipment->reciever_address_pincode) }}"
                            class="input-box-md @error('reciever_address_pincode') input-invalid @enderror"
                            placeholder="Enter Pincode (6 Digits)" required minlength="6" maxlength="6">
                        @error('reciever_address_pincode')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Reciever Address State --}}
                    <div class="flex flex-col">
                        <label for="reciever_address_state" class="input-label">State</label>
                        <input type="text" name="reciever_address_state"
                            value="{{ old('reciever_address_state', $shipment->reciever_address_state) }}"
                            class="input-box-md @error('reciever_address_state') input-invalid @enderror"
                            placeholder="Enter State" required minlength="1" maxlength="250">
                        @error('reciever_address_state')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Reciever Address Country --}}
                    <div class="flex flex-col">
                        <label for="reciever_address_country" class="input-label">Country</label>
                        <input type="text" name="reciever_address_country"
                            value="{{ old('reciever_address_country', $shipment->reciever_address_country) }}"
                            class="input-box-md @error('reciever_address_country') input-invalid @enderror"
                            placeholder="Enter Country" required minlength="1" maxlength="250">
                        @error('reciever_address_country')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                </div>
            </div>
        </figure>

        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Package Information</h1>
                    <p class="panel-card-description">Please check the information of package</p>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    {{-- Package Type --}}
                    <div class="flex flex-col">
                        <label for="package_type" class="input-label">Package Type</label>
                        <select onchange="handleCalculateBill()" name="package_type"
                            class="input-box-md @error('package_type') input-invalid @enderror" required>
                            @foreach ($package_type as $item)
                                <option @selected($shipment->package_type == $item) value="{{ $item }}">{{ $item }}
                                </option>
                            @endforeach
                        </select>
                        @error('package_type')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Package Name --}}
                    <div class="flex flex-col">
                        <label for="package_name" class="input-label">Package Name</label>
                        <input type="text" name="package_name"
                            value="{{ old('package_name', $shipment->package_name) }}"
                            class="input-box-md @error('package_name') input-invalid @enderror" placeholder="Enter Name"
                            required minlength="1" maxlength="250">
                        @error('package_name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Package Summary --}}
                    <div class="flex flex-col md:col-span-2">
                        <label for="package_summary" class="input-label">Package Summary</label>
                        <input type="text" name="package_summary"
                            value="{{ old('package_summary', $shipment->package_summary) }}"
                            class="input-box-md @error('package_summary') input-invalid @enderror"
                            placeholder="Enter Summary" minlength="1" maxlength="250">
                        @error('package_summary')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Package Length --}}
                    <div class="flex flex-col">
                        <label for="package_length" class="input-label">Length</label>
                        <div class="space-y-4">
                            <div class="flex items-center input-box-md">
                                <output id="package_length_output">{{ $shipment->package_length }}</output>
                                <p class="font-medium text-sm ml-1"> Inches</p>
                            </div>
                            <input name="package_length" value="{{ old('package_length', $shipment->package_length) }}"
                                type="range" step="1" class="px-3 rounded-md" min="5" max="60"
                                oninput="package_length_output.value=value">
                        </div>
                    </div>

                    {{-- Package Width --}}
                    <div class="flex flex-col">
                        <label for="package_width" class="input-label">Width</label>
                        <div class="space-y-4">
                            <div class="flex items-center input-box-md">
                                <output id="package_width_output">{{ $shipment->package_width }}</output>
                                <p class="font-medium text-sm ml-1"> Inches</p>
                            </div>
                            <input name="package_width" value="{{ old('package_width', $shipment->package_width) }}"
                                type="range" step="1" class="px-3 rounded-md" min="5" max="60"
                                oninput="package_width_output.value=value">
                        </div>
                    </div>

                    {{-- Package Height --}}
                    <div class="flex flex-col">
                        <label for="package_height" class="input-label">Height</label>
                        <div class="space-y-4">
                            <div class="flex items-center input-box-md">
                                <output id="package_height_output">{{ $shipment->package_height }}</output>
                                <p class="font-medium text-sm ml-1"> Inches</p>
                            </div>
                            <input name="package_height" value="{{ old('package_height', $shipment->package_height) }}"
                                type="range" step="1" class="px-3 rounded-md" min="2" max="60"
                                oninput="package_height_output.value=value">
                        </div>
                    </div>

                    {{-- Package Weight --}}
                    <div class="flex flex-col">
                        <label for="package_weight" class="input-label">Weight</label>
                        <div class="space-y-4">
                            <div class="flex items-center input-box-md">
                                <output id="package_weight_output">{{ $shipment->package_weight }}</output>
                                <p class="font-medium text-sm ml-1"> Kg</p>
                            </div>
                            <input onchange="handleCalculateBill()" name="package_weight"
                                value="{{ old('package_weight', $shipment->package_weight) }}" type="range"
                                step="0.25" class="px-3 rounded-md" min="0.25" max="30"
                                oninput="package_weight_output.value=value">
                        </div>
                    </div>

                </div>
            </div>
        </figure>

        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Delivery Route</h1>
                    <p class="panel-card-description">Manage delivery route for this shipment</p>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    {{-- Branches --}}
                    <div class="flex flex-col md:col-span-2 sm:col-span-1">
                        <div class="space-y-2">
                            <div class="space-y-2" id="route-branch-id-inputs">

                            </div>
                            <button type="button" onclick="handleCreateBranchSelect()" class="btn-secondary-md">Add
                                Route Branch</button>
                        </div>
                        @error('route_branch_id')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
        </figure>

        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Billing Summary</h1>
                    <p class="panel-card-description">Please check billing summary for this shipment</p>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-5">
                    <div>

                        <table class="w-full ignore">
                            <tbody>
                                <tr>
                                    <td class="pb-3">
                                        <div>
                                            <h1 class="font-semibold text-sm">Delivery Charges</h1>
                                        </div>
                                    </td>
                                    <td class="align-bottom pb-3 text-right">
                                        <p class="text-base font-medium" id="delivery-charges">{{env('APP_CURRENCY') . number_format($shipment->payment_delivery_charges,2)}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pb-3">
                                        <div class="space-y-2">
                                            <h1 class="font-semibold text-sm">Tax (GST)</h1>
                                            <p class="text-xs font-medium text-gray-500">18% GST charges will
                                                applicable</p>
                                        </div>
                                    </td>
                                    <td class="align-bottom pb-3 text-right">
                                        <p class="text-base font-medium" id="tax-charges">{{env('APP_CURRENCY') . number_format($shipment->payment_tax_charges,2)}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-3">
                                        <h1 class="font-semibold text-lg">Grand Total : </h1>
                                    </td>
                                    <td class="align-bottom pt-3 text-right">
                                        <p class="text-lg font-semibold" id="total">{{env('APP_CURRENCY') . number_format($shipment->payment_total,2)}}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </figure>

        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Shipment Information</h1>
                    <p class="panel-card-description">Othe information about this shipment</p>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                     {{-- Status --}}
                     <div class="flex flex-col">
                        <label for="status" class="input-label">Shipment Status</label>
                        <select name="status" class="input-box-md @error('status') input-invalid @enderror" required>
                            <option @selected($shipment->status == "Placed") value="Placed">Placed</option>
                            <option @selected($shipment->status == "Confirmed") value="Confirmed">Confirmed</option>
                            <option @selected($shipment->status == "Picked") value="Picked">Picked</option>
                            <option @selected($shipment->status == "Delivered") value="Delivered">Delivered</option>
                            <option @selected($shipment->status == "Cancelled") value="Cancelled">Cancelled</option>
                        </select>
                        @error('status')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Payment Status --}}
                    <div class="flex flex-col">
                        <label for="payment_status" class="input-label">Payment Status</label>
                        <input type="text" name="payment_status"
                            value="{{ old('payment_status', $shipment->payment_status) }}"
                            class="input-box-md @error('payment_status') input-invalid @enderror" readonly>
                        @error('payment_status')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Created at --}}
                    <div class="flex flex-col">
                        <label for="created_at" class="input-label">Booked on</label>
                        <input type="text" name="created_at"
                            value="{{ old('created_at', date('D d M Y h:i A',strtotime($shipment->created_at)) ) }}"
                            class="input-box-md @error('created_at') input-invalid @enderror" readonly>
                        @error('created_at')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Created at --}}
                    <div class="flex flex-col">
                        <label for="shipment_ref_id" class="input-label">Shipment Ref. ID</label>
                        <input type="text" name="shipment_ref_id"
                            value="{{ old('shipment_ref_id', $shipment->shipment_ref_id ) }}"
                            class="input-box-md @error('shipment_ref_id') input-invalid @enderror" readonly>
                        @error('shipment_ref_id')
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
        document.getElementById('shipment-tab').classList.add('active');

        const handleCreateBranchSelect = () => {

            let parentDiv = document.createElement('div');
            parentDiv.className = "flex space-x-2";

            let branchSelect = document.createElement('select');
            branchSelect.name = "route_branch_id[]";
            branchSelect.className = "input-box-md w-full";
            branchSelect.required = true;
            fetch("{{ route('admin.handle.get.branch') }}").then((res) => {
                return res.json();
            }).then((data) => {

                let option_default = document.createElement('option');
                option_default.value = "";
                option_default.innerHTML = "Select Route Branch";
                branchSelect.append(option_default);

                data.data.forEach((branch) => {
                    let option_data = document.createElement('option');
                    option_data.value = branch.id;
                    option_data.innerHTML = branch.city;
                    branchSelect.append(option_data);
                });

            }).catch((error) => {
                console.error(error);
            })

            let remove = document.createElement('button');
            remove.className = "btn-danger-md";
            remove.innerHTML = ' &times ';
            remove.type = "button";
            remove.onclick = (event) => {
                event.target.parentNode.remove();
            }
            parentDiv.append(branchSelect, remove);
            document.getElementById('route-branch-id-inputs').appendChild(parentDiv);
        }
    </script>
@endsection
