<aside class="sidebar" id="sidebar">
    <div class="p-7 pt-[95px]">
        <ul class="flex flex-col justify-center">

            <li class="border-b">
                <a href="{{route('view.dashboard')}}">
                    <button class="w-full py-5 text-left">
                        <div class="flex items-center justify-between font-medium text-base">
                            My Acoount
                        </div>
                    </button>
                </a>
            </li>

            <li class="border-b">
                <a href="{{route('view.schedule.shipment')}}">
                    <button class="w-full py-5 text-left">
                        <div class="flex items-center justify-between font-medium text-base">
                            Schedule a Shipment
                        </div>
                    </button>
                </a>
            </li>

            @auth
            <li class="border-b">
                <a href="{{route('view.shipments')}}">
                    <button class="w-full py-5 text-left">
                        <div class="flex items-center justify-between font-medium text-base">
                            My Shipments
                        </div>
                    </button>
                </a>
            </li>

            <li class="border-b">
                <a href="{{route('view.setting')}}">
                    <button class="w-full py-5 text-left">
                        <div class="flex items-center justify-between font-medium text-base">
                            Account Setting
                        </div>
                    </button>
                </a>
            </li>
            @endauth

            
            
            <li class="border-b">
                <a href="{{--route('view.dashboard')--}}">
                    <button class="w-full py-5 text-left">
                        <div class="flex items-center justify-between font-medium text-base">
                            About us
                        </div>
                    </button>
                </a>
            </li>

            <li class="border-b">
                <a href="{{--route('view.dashboard')--}}">
                    <button class="w-full py-5 text-left">
                        <div class="flex items-center justify-between font-medium text-base">
                            Our Services
                        </div>
                    </button>
                </a>
            </li>

            <li class="border-b">
                <a href="{{--route('view.dashboard')--}}">
                    <button class="w-full py-5 text-left">
                        <div class="flex items-center justify-between font-medium text-base">
                            Careers
                        </div>
                    </button>
                </a>
            </li>

            <li class="border-b">
                <a href="{{--route('view.dashboard')--}}">
                    <button class="w-full py-5 text-left">
                        <div class="flex items-center justify-between font-medium text-base">
                            Locate Nearby Office    
                        </div>
                    </button>
                </a>
            </li>

            <li class="border-b">
                <a href="{{--route('view.dashboard')--}}">
                    <button class="w-full py-5 text-left">
                        <div class="flex items-center justify-between font-medium text-base">
                            Customer Support
                        </div>
                    </button>
                </a>
            </li>

            @auth
            <li class="border-b">
                <a href="javascript:handleLogout();">
                    <button class="w-full py-5 text-left">
                        <div class="flex items-center justify-between font-medium text-base">
                            Logout
                        </div>
                    </button>
                </a>
            </li>
            @endauth

            <li class="border-b py-5">
                <a href="{{--route('view.dashboard')--}}">
                    <button class="btn-ascent-dark-lg w-full flex items-center justify-center">Track My Package <i data-feather="map-pin" class="h-4 w-4 ml-2"></i></button>
                </a>
            </li>

            
        </ul>
    </div>
</aside>