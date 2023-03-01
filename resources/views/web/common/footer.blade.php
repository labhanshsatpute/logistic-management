<footer class="space-y-6 border-y pb-6 pt-8">
    <div>
        <div class="container">
            <div class="grid md:grid-cols-3 sm:grid-cols-1 md:gap-10 sm:gap-6">

                <div class="space-y-4">
                    <a href="{{ route('main') }}" class="text-2xl">
                        <span class="text-black font-bold">Laravel </span>
                        <span class="text-web-ascent font-bold"> Ecommerce</span>
                    </a>
                    <div>
                        <p class="text-sm text-gray-600 leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div>
                        <ul class="flex space-x-3">
                            <li><a href="#" class="footer-social-media"><i data-feather="facebook"></i></a></li>
                            <li><a href="#" class="footer-social-media"><i data-feather="twitter"></i></a></li>
                            <li><a href="#" class="footer-social-media"><i data-feather="instagram"></i></a></li>
                            <li><a href="#" class="footer-social-media"><i data-feather="linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-10 sm:gap-6">

                        <div class="space-y-4">
                            <h1 class="text-lg font-semibold">About</h1>
                            <ul class="space-y-2">
                                <li><a href="#" class="footer-link">About us</a></li>
                                <li><a href="#" class="footer-link">Services</a></li>
                                <li><a href="#" class="footer-link">Rules & Terms</a></li>
                                <li><a href="#" class="footer-link">Blogs</a></li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <h1 class="text-lg font-semibold">Services</h1>
                            <ul class="space-y-2">
                                <li><a href="#" class="footer-link">Help center</a></li>
                                <li><a href="#" class="footer-link">Money refund</a></li>
                                <li><a href="#" class="footer-link">Terms and Policy</a></li>
                                <li><a href="#" class="footer-link">Open dispute</a></li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <h1 class="text-lg font-semibold">For Users</h1>
                            <ul class="space-y-2">
                                <li><a href="#" class="footer-link">User Login </a></li>
                                <li><a href="#" class="footer-link">User register </a></li>
                                <li><a href="#" class="footer-link">Account Setting </a></li>
                                <li><a href="#" class="footer-link">My Orders</a></li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <h1 class="text-lg font-semibold">Get the app</h1>
                            <ul class="space-y-2">
                                <div>
                                    <a href="#"><img src="{{asset('web/images/footer/appstore.webp')}}" alt="appstore" class="h-10 w-auto"></a>
                                </div>
                                <div>
                                    <a href="#"><img src="{{asset('web/images/footer/playstore.webp')}}" alt="playstore" class="h-10 w-auto"></a>
                                </div>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <hr>
    </div>
    <div>
        <div class="container">
            <div class="grid md:grid-cols-2 gap-5 justify-between">

                <div class="md:order-1 sm:order-2">
                    <p class="text-gray-600 text-sm">© {{date('Y')}} {{env('APP_NAME')}}. All rights reserved.</p>
                </div>

                <div class="md:order-2 sm:order-1">
                    <ul class="flex md:flex-row sm:flex-col md:items-center md:space-x-5 sm:space-x-0 md:space-y-0 sm:space-y-2 justify-end">
                        <li><a href="#" class="footer-link">Support</a></li>
                        <li><a href="#" class="footer-link">Privacy Policy</a></li>
                        <li><a href="#" class="footer-link">Terms & Conditions</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</footer>