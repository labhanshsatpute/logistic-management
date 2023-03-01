<aside id="sidebar">
    <div
        class="sticky top-0 left-0 h-screen flex flex-col justify-start shadow-xl bg-white border-r py-8 px-8 space-y-7">
        <div class="text-center">
            <span>
                <svg class="h-8 w-8 mx-auto mb-3 fill-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M504.4,115.83a5.72,5.72,0,0,0-.28-.68,8.52,8.52,0,0,0-.53-1.25,6,6,0,0,0-.54-.71,9.36,9.36,0,0,0-.72-.94c-.23-.22-.52-.4-.77-.6a8.84,8.84,0,0,0-.9-.68L404.4,55.55a8,8,0,0,0-8,0L300.12,111h0a8.07,8.07,0,0,0-.88.69,7.68,7.68,0,0,0-.78.6,8.23,8.23,0,0,0-.72.93c-.17.24-.39.45-.54.71a9.7,9.7,0,0,0-.52,1.25c-.08.23-.21.44-.28.68a8.08,8.08,0,0,0-.28,2.08V223.18l-80.22,46.19V63.44a7.8,7.8,0,0,0-.28-2.09c-.06-.24-.2-.45-.28-.68a8.35,8.35,0,0,0-.52-1.24c-.14-.26-.37-.47-.54-.72a9.36,9.36,0,0,0-.72-.94,9.46,9.46,0,0,0-.78-.6,9.8,9.8,0,0,0-.88-.68h0L115.61,1.07a8,8,0,0,0-8,0L11.34,56.49h0a6.52,6.52,0,0,0-.88.69,7.81,7.81,0,0,0-.79.6,8.15,8.15,0,0,0-.71.93c-.18.25-.4.46-.55.72a7.88,7.88,0,0,0-.51,1.24,6.46,6.46,0,0,0-.29.67,8.18,8.18,0,0,0-.28,2.1v329.7a8,8,0,0,0,4,6.95l192.5,110.84a8.83,8.83,0,0,0,1.33.54c.21.08.41.2.63.26a7.92,7.92,0,0,0,4.1,0c.2-.05.37-.16.55-.22a8.6,8.6,0,0,0,1.4-.58L404.4,400.09a8,8,0,0,0,4-6.95V287.88l92.24-53.11a8,8,0,0,0,4-7V117.92A8.63,8.63,0,0,0,504.4,115.83ZM111.6,17.28h0l80.19,46.15-80.2,46.18L31.41,63.44Zm88.25,60V278.6l-46.53,26.79-33.69,19.4V123.5l46.53-26.79Zm0,412.78L23.37,388.5V77.32L57.06,96.7l46.52,26.8V338.68a6.94,6.94,0,0,0,.12.9,8,8,0,0,0,.16,1.18h0a5.92,5.92,0,0,0,.38.9,6.38,6.38,0,0,0,.42,1v0a8.54,8.54,0,0,0,.6.78,7.62,7.62,0,0,0,.66.84l0,0c.23.22.52.38.77.58a8.93,8.93,0,0,0,.86.66l0,0,0,0,92.19,52.18Zm8-106.17-80.06-45.32,84.09-48.41,92.26-53.11,80.13,46.13-58.8,33.56Zm184.52,4.57L215.88,490.11V397.8L346.6,323.2l45.77-26.15Zm0-119.13L358.68,250l-46.53-26.79V131.79l33.69,19.4L392.37,178Zm8-105.28-80.2-46.17,80.2-46.16,80.18,46.15Zm8,105.28V178L455,151.19l33.68-19.4v91.39h0Z"/></svg>
            </span>
            <h1 class="text-xl font-bold mb-1">Admin Panel</h1>
            <p class="text-xs text-slate-600">Laravel Ecommerce</p>
        </div>
        <hr>
        <ul class="flex flex-col space-y-6">


            <li>
                <a href="{{route('admin.view.dashboard')}}" class="sidebar-tab" id="dashboard-tab"> <i data-feather="activity"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="#" class="sidebar-tab"> <i data-feather="bell"></i> <span>Notifications</span></a>
            </li>

            
            <li>
                <a href="#" class="sidebar-tab"> <i data-feather="shopping-cart"></i> <span>Orders</span></a>
            </li>
            <hr>
            <li>
                <a href="{{route('admin.view.parent.category.list')}}" class="sidebar-tab" id="category-tab"> <i data-feather="layers"></i> <span>Categories</span></a>
            </li>

            <li>
                <a href="{{route('admin.view.product.list')}}" class="sidebar-tab" id="product-tab"> <i data-feather="box"></i> <span>Products</span></a>
            </li>
            <li>
                <a href="{{route('admin.view.coupon.list')}}" class="sidebar-tab" id="coupon-tab"> <i data-feather="tag"></i> <span>Coupons</span></a>
            </li>
            <li>
                <a href="{{route('admin.view.admin.list')}}" class="sidebar-tab" id="admin-tab"> <i data-feather="key"></i> <span>Admin Access</span></a>
            </li>

            <li>
                <a href="{{route('admin.view.carousel.banner.list')}}" class="sidebar-tab" id="carousel-banner-tab"> <i data-feather="layout"></i> <span>Carousel Banners</span></a>
            </li>

            <li>
                <a href="{{route('admin.view.newsletter.publish')}}" class="sidebar-tab" id="newsletter-tab"> <i data-feather="send"></i> <span>Newsletter</span></a>
            </li>

            <li>
                <a href="{{route('admin.view.setting')}}" class="sidebar-tab" id="setting-tab"> <i data-feather="settings"></i> <span>Setting</span></a>
            </li>


        </ul>
    </div>
</aside>
