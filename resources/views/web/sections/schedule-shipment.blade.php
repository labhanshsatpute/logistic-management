@extends('web.layouts.app')

@section('web-section')
    {{-- Page Cover & Breadcrumb Section (Start) --}}
    <section class="relative bg-cover bg-center md:block sm:hidden"
        style="background-image: url('{{ asset('web/images/cover-image.jpg') }}')">
        @include('web.common.bottom-header')
        <div class="md:pt-32 md:pb-20 sm:py-20">
            <div class="container">
                <h1 class="font-semibold text-white text-4xl">Schedule a Shipment</h1>
            </div>
        </div>
    </section>
    <section class="py-6 border-b shadow-sm relative md:hidden sm:block">
        <div class="container">
            <ul class="flex items-center justify-start space-x-3">
                <li><a href="{{ route('view.home') }}" class="link">Home</a></li>
                <li><i data-feather="chevron-right" class="h-4 w-4 text-gray-700"></i></li>
                <li><a href="{{ route('view.schedule.shipment') }}" class="link">Schedule a Shipment</a></li>
            </ul>
        </div>
    </section>
    {{-- Page Cover & Breadcrumb Section (End) --}}

    {{-- Page Section (Start) --}}
    <section class="md:py-20 sm:py-0">
        <form class="container" method="POST" action="{{route('handle.shipment.create')}}">

            @csrf
            
            <div class="grid md:grid-cols-12 sm:grid-cols-1 gap-10">

                <div class="md:col-span-3 md:block sm:hidden">
                    @include('web.common.dashboard-sidebar')
                </div>

                <div class="md:col-span-9 md:space-y-10 sm:space-y-5">

                    <figure class="bg-white md:border sm:border-x-0 md:shadow-md">
                        <div class="md:px-5 py-4 border-b">
                            <h1 class="font-semibold text-lg mb-1">Pickup Information</h1>
                            <p class="text-xs text-gray-500">Please fill the required fields</p>
                        </div>
                        <div class="md:px-5 py-5">
                            <div class="grid md:grid-cols-4 sm:grid-cols-1 gap-5">

                                {{-- Sender Name --}}
                                <div class="flex flex-col">
                                    <label for="sender_name" class="input-label">Name <em>*</em></label>
                                    <input type="text" name="sender_name" value="{{ old('sender_name') }}"
                                        class="input-box-md @error('sender_name') input-invalid @enderror"
                                        placeholder="Enter Name" required minlength="1" maxlength="250"
                                        autocomplete="name">
                                    @error('sender_name')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Sender Email --}}
                                <div class="flex flex-col">
                                    <label for="sender_email" class="input-label">Email Address <em>*</em></label>
                                    <input type="email" name="sender_email" value="{{ old('sender_email') }}"
                                        class="input-box-md @error('sender_email') input-invalid @enderror"
                                        placeholder="Enter Email Address" required minlength="1" maxlength="250"
                                        autocomplete="email">
                                    @error('sender_email')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Sender Phone Primary --}}
                                <div class="flex flex-col">
                                    <label for="sender_phone_primary" class="input-label">Phone <em>*</em></label>
                                    <input type="tel" pattern="[0-9]{10}" name="sender_phone_primary"
                                        value="{{ old('sender_phone_primary') }}"
                                        class="input-box-md @error('sender_phone_primary') input-invalid @enderror"
                                        placeholder="Enter Phone (10 Digits)" required minlength="10" maxlength="10"
                                        autocomplete="phone">
                                    @error('sender_phone_primary')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Sender Phone Primary --}}
                                <div class="flex flex-col">
                                    <label for="sender_phone_alternate" class="input-label">Phone (Alternate)</label>
                                    <input type="tel" pattern="[0-9]{10}" name="sender_phone_alternate"
                                        value="{{ old('sender_phone_alternate') }}"
                                        class="input-box-md @error('sender_phone_alternate') input-invalid @enderror"
                                        placeholder="Enter Phone (10 Digits)" minlength="10" maxlength="10"
                                        autocomplete="phone">
                                    @error('sender_phone_alternate')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Sender Address Home --}}
                                <div class="flex flex-col md:col-span-2">
                                    <label for="sender_address_home" class="input-label">Home</label>
                                    <input type="text" name="sender_address_home"
                                        value="{{ old('sender_address_home') }}"
                                        class="input-box-md @error('sender_address_home') input-invalid @enderror"
                                        placeholder="Enter Home / Flat / Building" minlength="1" maxlength="250">
                                    @error('sender_address_home')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Sender Address Street --}}
                                <div class="flex flex-col md:col-span-2">
                                    <label for="sender_address_street" class="input-label">Street <em>*</em></label>
                                    <input id="search_input" type="text" name="sender_address_street"
                                        value="{{ old('sender_address_street') }}"
                                        class="input-box-md @error('sender_address_street') input-invalid @enderror"
                                        placeholder="Enter Street / Area / Locality" required minlength="1"
                                        maxlength="250">
                                    @error('sender_address_street')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Sender Address City --}}
                                <div class="flex flex-col">
                                    <label for="sender_address_city" class="input-label">City <em>*</em></label>
                                    <input type="text" name="sender_address_city"
                                        value="{{ old('sender_address_city') }}"
                                        class="input-box-md @error('sender_address_city') input-invalid @enderror"
                                        placeholder="Enter City" required minlength="1" maxlength="250">
                                    @error('sender_address_city')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Sender Address Pincode --}}
                                <div class="flex flex-col">
                                    <label for="sender_address_pincode" class="input-label">Pincode <em>*</em></label>
                                    <input type="tel" pattern="[0-9]{6}" name="sender_address_pincode"
                                        value="{{ old('sender_address_pincode') }}"
                                        class="input-box-md @error('sender_address_pincode') input-invalid @enderror"
                                        placeholder="Enter Pincode (6 Digits)" required minlength="6" maxlength="6">
                                    @error('sender_address_pincode')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Sender Address State --}}
                                <div class="flex flex-col">
                                    <label for="sender_address_state" class="input-label">State <em>*</em></label>
                                    <input type="text" name="sender_address_state"
                                        value="{{ old('sender_address_state') }}"
                                        class="input-box-md @error('sender_address_state') input-invalid @enderror"
                                        placeholder="Enter State" required minlength="1" maxlength="250">
                                    @error('sender_address_state')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Sender Address Country --}}
                                <div class="flex flex-col">
                                    <label for="sender_address_country" class="input-label">Country <em>*</em></label>
                                    <input type="text" name="sender_address_country"
                                        value="{{ old('sender_address_country') }}"
                                        class="input-box-md @error('sender_address_country') input-invalid @enderror"
                                        placeholder="Enter Country" required minlength="1" maxlength="250">
                                    @error('sender_address_country')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Pickup Date --}}
                                <div class="flex flex-col">
                                    <label for="pickup_date" class="input-label">Pickup Date <em>*</em></label>
                                    <input type="date" name="pickup_date" value="{{ old('pickup_date') }}"
                                        class="input-box-md @error('pickup_date') input-invalid @enderror" required>
                                    @error('pickup_date')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Pickup Slot --}}
                                <div class="flex flex-col">
                                    <label for="pickup_slot" class="input-label">Pickup Timing <em>*</em></label>
                                    <select name="pickup_slot"
                                        class="input-box-md @error('pickup_slot') input-invalid @enderror" required>
                                        <option value="">Select Slot</option>
                                        <option value="Morning">Morning (10:00 AM - 12:00 PM)</option>
                                        <option value="Afternoon">Afternoon (12:00 PM - 4:00 PM)</option>
                                        <option value="Evening">Evening (4:00 PM - 6:00 PM)</option>
                                    </select>
                                    @error('pickup_slot')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </figure>

                    <figure class="bg-white md:border sm:border-x-0 md:shadow-md">
                        <div class="md:px-5 py-4 border-b">
                            <h1 class="font-semibold text-lg mb-1">Delivery Information</h1>
                            <p class="text-xs text-gray-500">Please fill the required fields</p>
                        </div>
                        <div class="md:px-5 py-5">
                            <div class="grid md:grid-cols-4 sm:grid-cols-1 gap-5">

                                {{-- Reciever Name --}}
                                <div class="flex flex-col">
                                    <label for="reciever_name" class="input-label">Name <em>*</em></label>
                                    <input type="text" name="reciever_name" value="{{ old('reciever_name') }}"
                                        class="input-box-md @error('reciever_name') input-invalid @enderror"
                                        placeholder="Enter Name" required minlength="1" maxlength="250"
                                        autocomplete="name">
                                    @error('reciever_name')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Reciever Email --}}
                                <div class="flex flex-col">
                                    <label for="reciever_email" class="input-label">Email Address <em>*</em></label>
                                    <input type="email" name="reciever_email" value="{{ old('reciever_email') }}"
                                        class="input-box-md @error('reciever_email') input-invalid @enderror"
                                        placeholder="Enter Email Address" required minlength="1" maxlength="250"
                                        autocomplete="email">
                                    @error('reciever_email')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Reciever Phone Primary --}}
                                <div class="flex flex-col">
                                    <label for="reciever_phone_primary" class="input-label">Phone <em>*</em></label>
                                    <input type="tel" pattern="[0-9]{10}" name="reciever_phone_primary"
                                        value="{{ old('reciever_phone_primary') }}"
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
                                        value="{{ old('reciever_phone_alternate') }}"
                                        class="input-box-md @error('reciever_phone_alternate') input-invalid @enderror"
                                        placeholder="Enter Phone (10 Digits)" minlength="10" maxlength="10"
                                        autocomplete="phone">
                                    @error('reciever_phone_alternate')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Reciever Address Home --}}
                                <div class="flex flex-col md:col-span-2">
                                    <label for="reciever_address_home" class="input-label">Home</label>
                                    <input type="text" name="reciever_address_home"
                                        value="{{ old('reciever_address_home') }}"
                                        class="input-box-md @error('reciever_address_home') input-invalid @enderror"
                                        placeholder="Enter Home / Flat / Building" minlength="1" maxlength="250">
                                    @error('reciever_address_home')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Reciever Address Street --}}
                                <div class="flex flex-col md:col-span-2">
                                    <label for="reciever_address_street" class="input-label">Street <em>*</em></label>
                                    <input type="text" name="reciever_address_street"
                                        value="{{ old('reciever_address_street') }}"
                                        class="input-box-md @error('reciever_address_street') input-invalid @enderror"
                                        placeholder="Enter Street / Area / Locality" required minlength="1"
                                        maxlength="250">
                                    @error('reciever_address_street')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Reciever Address City --}}
                                <div class="flex flex-col">
                                    <label for="reciever_address_city" class="input-label">City <em>*</em></label>
                                    <input type="text" name="reciever_address_city"
                                        value="{{ old('reciever_address_city') }}"
                                        class="input-box-md @error('reciever_address_city') input-invalid @enderror"
                                        placeholder="Enter City" required minlength="1" maxlength="250">
                                    @error('reciever_address_city')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Reciever Address Pincode --}}
                                <div class="flex flex-col">
                                    <label for="reciever_address_pincode" class="input-label">Pincode <em>*</em></label>
                                    <input type="tel" pattern="[0-9]{6}" name="reciever_address_pincode"
                                        value="{{ old('reciever_address_pincode') }}"
                                        class="input-box-md @error('reciever_address_pincode') input-invalid @enderror"
                                        placeholder="Enter Pincode (6 Digits)" required minlength="6" maxlength="6">
                                    @error('reciever_address_pincode')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Reciever Address State --}}
                                <div class="flex flex-col">
                                    <label for="reciever_address_state" class="input-label">State <em>*</em></label>
                                    <input type="text" name="reciever_address_state"
                                        value="{{ old('reciever_address_state') }}"
                                        class="input-box-md @error('reciever_address_state') input-invalid @enderror"
                                        placeholder="Enter State" required minlength="1" maxlength="250">
                                    @error('reciever_address_state')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Reciever Address Country --}}
                                <div class="flex flex-col">
                                    <label for="reciever_address_country" class="input-label">Country <em>*</em></label>
                                    <input type="text" name="reciever_address_country"
                                        value="{{ old('reciever_address_country') }}"
                                        class="input-box-md @error('reciever_address_country') input-invalid @enderror"
                                        placeholder="Enter Country" required minlength="1" maxlength="250">
                                    @error('reciever_address_country')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </figure>

                    <figure class="bg-white md:border sm:border-x-0 md:shadow-md">
                        <div class="md:px-5 py-4 border-b">
                            <h1 class="font-semibold text-lg mb-1">Package Information</h1>
                            <p class="text-xs text-gray-500">Please fill the required fields</p>
                        </div>
                        <div class="md:px-5 py-5">
                            <div class="grid md:grid-cols-4 sm:grid-cols-1 gap-5">

                                {{-- Package Type --}}
                                <div class="flex flex-col">
                                    <label for="package_type" class="input-label">Package Type <em>*</em></label>
                                    <select onchange="handleCalculateBill()" name="package_type"
                                        class="input-box-md @error('package_type') input-invalid @enderror" required>
                                        <option value="">Select Type</option>
                                        <option value="Grocery">Grocery</option>
                                        <option value="Food & Vegetable">Food & Vegetable</option>
                                        <option value="Electronics">Electronics</option>
                                        <option value="Home Appliances">Home Appliances</option>
                                        <option value="Furniture">Furniture</option>
                                        <option value="Handle With Care">Handle With Care</option>
                                        <option value="Vaccine">Vaccine</option>
                                        <option value="Medicine">Medicine</option>
                                        <option value="Liquor">Liquor</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    @error('package_type')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Package Name --}}
                                <div class="flex flex-col">
                                    <label for="package_name" class="input-label">Package Name <em>*</em></label>
                                    <input type="text" name="package_name" value="{{ old('package_name') }}"
                                        class="input-box-md @error('package_name') input-invalid @enderror"
                                        placeholder="Enter Name" required minlength="1" maxlength="250">
                                    @error('package_name')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Package Summary --}}
                                <div class="flex flex-col md:col-span-2">
                                    <label for="package_summary" class="input-label">Package Summary</label>
                                    <input type="text" name="package_summary" value="{{ old('package_summary') }}"
                                        class="input-box-md @error('package_summary') input-invalid @enderror"
                                        placeholder="Enter Summary" minlength="1" maxlength="250">
                                    @error('package_summary')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Package Length --}}
                                <div class="flex flex-col">
                                    <label for="package_length" class="input-label">Length <em>*</em></label>
                                    <div class="space-y-4">
                                        <div class="flex items-center input-box-md">
                                            <output id="package_length_output">5</output>
                                            <p class="font-medium text-sm ml-1"> Inches</p>
                                        </div>
                                        <input name="package_length" value="{{ old('package_length', 5) }}"
                                            type="range" step="1"
                                            class="px-3 rounded-md"
                                            min="5" max="60" oninput="package_length_output.value=value">
                                    </div>
                                </div>

                                {{-- Package Width --}}
                                <div class="flex flex-col">
                                    <label for="package_width" class="input-label">Width <em>*</em></label>
                                    <div class="space-y-4">
                                        <div class="flex items-center input-box-md">
                                            <output id="package_width_output">5</output>
                                            <p class="font-medium text-sm ml-1"> Inches</p>
                                        </div>
                                        <input name="package_width" value="{{ old('package_width', 5) }}" type="range"
                                            step="1"
                                            class="px-3 rounded-md"
                                            min="5" max="60" oninput="package_width_output.value=value">
                                    </div>
                                </div>

                                {{-- Package Height --}}
                                <div class="flex flex-col">
                                    <label for="package_height" class="input-label">Height <em>*</em></label>
                                    <div class="space-y-4">
                                        <div class="flex items-center input-box-md">
                                            <output id="package_height_output">2</output>
                                            <p class="font-medium text-sm ml-1"> Inches</p>
                                        </div>
                                        <input name="package_height" value="{{ old('package_height', 2) }}"
                                            type="range" step="1"
                                            class="px-3 rounded-md"
                                            min="2" max="60" oninput="package_height_output.value=value">
                                    </div>
                                </div>

                                {{-- Package Weight --}}
                                <div class="flex flex-col">
                                    <label for="package_weight" class="input-label">Weight <em>*</em></label>
                                    <div class="space-y-4">
                                        <div class="flex items-center input-box-md">
                                            <output id="package_weight_output">0.25</output>
                                            <p class="font-medium text-sm ml-1"> Kg</p>
                                        </div>
                                        <input onchange="handleCalculateBill()" name="package_weight" value="{{ old('package_weight', 0.25) }}"
                                            type="range" step="0.25"
                                            class="px-3 rounded-md"
                                            min="0.25" max="30" oninput="package_weight_output.value=value">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </figure>

                    <figure class="bg-white md:border sm:border-x-0 md:shadow-md">
                        <div class="md:px-5 py-4 border-b">
                            <h1 class="font-semibold text-lg mb-1">Billing Summary</h1>
                            <p class="text-xs text-gray-500">check your shipment billing summary and make payment</p>
                        </div>
                        <div class="md:px-5 py-5 border-b">
                            <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-5">
                                <div>

                                    <table class="w-full">
                                        <tbody>
                                            <tr>
                                                <td class="pb-3">
                                                    <div>
                                                        <h1 class="font-semibold text-sm">Delivery Charges</h1>
                                                    </div>
                                                </td>
                                                <td class="align-bottom pb-3 text-right">
                                                    <p class="text-base font-medium" id="delivery-charges"></p>
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
                                                    <p class="text-base font-medium" id="tax-charges"></p>
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
                                                    <p class="text-lg font-semibold" id="total"></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="md:p-5 sm:px-0 sm:py-5">
                            <button type="submit" class="btn-ascent-dark-md md:w-auto sm:w-full">Make a
                                Payment & Continue</button>
                        </div>
                    </figure>

                </div>

            </div>
        </form>
    </section>
    {{-- Page Section (End) --}}
@endsection

@section('web-script')
    <script>
        document.getElementById('schedule-shipment-tab').classList.add('active');

        const handleCalculateBill = () => {
            $.ajax({
                type: "POST",
                url: "{{ route('handle.calculate.shipment.bill') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    package_weight: document.querySelector('input[name=package_weight]').value,
                    package_type: document.querySelector('select[name=package_type]').value,
                },
                success: function(data) {
                    document.querySelector('#delivery-charges').innerHTML = "{{env('APP_CURRENCY')}}" + data.data.delivery_charges;
                    document.querySelector('#tax-charges').innerHTML = "{{env('APP_CURRENCY')}}" + data.data.tax;
                    document.querySelector('#total').innerHTML = "{{env('APP_CURRENCY')}}" + data.data.total;
                }
            });
        }

        setTimeout(() => {
            handleCalculateBill();
        }, 100);

        $(document).ready(function() {

            var pickup_autocomplete = new google.maps.places.Autocomplete((document.querySelector(
                'input[name=sender_address_street]')), {
                types: ['geocode'],
                componentRestrictions: {
                    country: "IN"

                }
            });

            google.maps.event.addListener(pickup_autocomplete, 'place_changed', function() {
                let near_place = pickup_autocomplete.getPlace();

                let city = near_place.address_components.filter((item) => {
                    return item.types[0] == "locality";
                });

                if (city.length != 0) {
                    document.querySelector('input[name=sender_address_city]').value = city[0].long_name;
                }

                let pincode = near_place.address_components.filter((item) => {
                    return item.types[0] == "postal_code";
                });

                if (pincode.length != 0) {
                    document.querySelector('input[name=sender_address_pincode]').value = pincode[0]
                        .long_name;
                }

                let state = near_place.address_components.filter((item) => {
                    return item.types[0] == "administrative_area_level_1";
                });

                document.querySelector('input[name=sender_address_state]').value = state[0].long_name;

                let country = near_place.address_components.filter((item) => {
                    return item.types[0] == "country";
                });

                document.querySelector('input[name=sender_address_country]').value = country[0].long_name;

                let remove_string = `, ${city[0].long_name}, ${state[0].long_name}`;

                if (pincode.length != 0) {
                    if (near_place.formatted_address.includes(pincode[0].long_name)) {
                        remove_string =
                            `, ${city[0].long_name}, ${state[0].long_name} ${pincode[0].long_name}`;
                    }
                }

                document.querySelector('input[name=sender_address_street]').value = near_place
                    .formatted_address.replace(remove_string, '');

            });

            var delivery_autocomplete = new google.maps.places.Autocomplete((document.querySelector(
                'input[name=reciever_address_street]')), {
                types: ['geocode'],
                componentRestrictions: {
                    country: "IN"
                }
            });

            google.maps.event.addListener(delivery_autocomplete, 'place_changed', function() {
                let near_place = delivery_autocomplete.getPlace();

                let city = near_place.address_components.filter((item) => {
                    return item.types[0] == "locality";
                });

                if (city.length != 0) {
                    document.querySelector('input[name=reciever_address_city]').value = city[0].long_name;
                }

                let pincode = near_place.address_components.filter((item) => {
                    return item.types[0] == "postal_code";
                });

                if (pincode.length != 0) {
                    document.querySelector('input[name=reciever_address_pincode]').value = pincode[0]
                        .long_name;
                }

                let state = near_place.address_components.filter((item) => {
                    return item.types[0] == "administrative_area_level_1";
                });

                document.querySelector('input[name=reciever_address_state]').value = state[0].long_name;

                let country = near_place.address_components.filter((item) => {
                    return item.types[0] == "country";
                });

                document.querySelector('input[name=reciever_address_country]').value = country[0].long_name;

                let remove_string = `, ${city[0].long_name}, ${state[0].long_name}`;

                if (pincode.length != 0) {
                    if (near_place.formatted_address.includes(pincode[0].long_name)) {
                        remove_string =
                            `, ${city[0].long_name}, ${state[0].long_name} ${pincode[0].long_name}`;
                    }
                }

                document.querySelector('input[name=reciever_address_street]').value = near_place
                    .formatted_address.replace(remove_string, '');

            });

        });
    </script>
@endsection
