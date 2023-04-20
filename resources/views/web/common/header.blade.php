<header class="relative z-50 top-0 bg-white border-b md:block sm:hidden shadow-lg" id="desktop-header">
    <nav>
        <div class="container py-4">
            <div class="flex items-center justify-between">
                <a href="{{route('view.home')}}">
                    <img src="{{asset('web/images/logo.png')}}" alt="logo" class="h-[50px] w-auto">
                </a>
                <div class="flex items-center space-x-9">
                    <ul class="flex items-center space-x-7">
                        <li><a href="{{route('view.services')}}" class="text-sm hover:text-web-ascent duration-300 ease-in-out hover:ease-in-out">Services</a></li>
                        <li><a href="#" class="text-sm hover:text-web-ascent duration-300 ease-in-out hover:ease-in-out">News & Media</a></li>
                        <li><a href="{{route('view.career')}}" class="text-sm hover:text-web-ascent duration-300 ease-in-out hover:ease-in-out">Careers</a></li>
                    </ul>
                    <a href="#">
                        <button class="btn-ascent-dark-md flex items-center justify-center">Track My Package <i data-feather="map-pin" class="h-4 w-4 ml-2"></i></button>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<header class="fixed w-full h-auto z-50 top-0 shadow-lg bg-white border-b md:hidden sm:bloxk" id="mobile-header">
    <nav>
        <div class="container py-4">
            <div class="flex items-center justify-between">
                <a href="{{route('view.home')}}">
                    <img src="{{asset('web/images/logo.png')}}" alt="logo" class="h-[50px] w-auto">
                </a>
                <button class="px-1" onclick="handleToggleSidebar()">
                    <i data-feather="x" class="h-8 w-8" id="sidebar-toggler-close" style="display: none;"></i>
                    <i data-feather="menu" class="h-8 w-8" id="sidebar-toggler-menu"></i>
                </button>
            </div>
        </div>
    </nav>
</header>