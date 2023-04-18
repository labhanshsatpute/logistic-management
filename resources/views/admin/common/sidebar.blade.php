<aside id="sidebar">
    <div
        class="sticky top-0 left-0 h-[111vh] flex flex-col justify-start shadow-xl bg-white border-r py-8 px-8 space-y-7">
        <div class="text-center">
            <div class="mb-3">
                <img src="{{asset('web/images/logo.png')}}" alt="logo" class="h-[50px] w-auto mx-auto">
            </div>
            <p class="text-xs text-slate-600">Administrator Panel</p>
        </div>
        <hr>
        <ul class="flex flex-col space-y-6">


            <li>
                <a href="{{route('admin.view.dashboard')}}" class="sidebar-tab" id="dashboard-tab"> <i data-feather="activity"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="{{route('admin.view.shipment.list')}}" class="sidebar-tab" id="shipment-tab"> <i data-feather="truck"></i> <span>Shipments</span></a>
            </li>
            <hr>
            <li>
                <a href="{{route('admin.view.admin.list')}}" class="sidebar-tab" id="admin-tab"> <i data-feather="key"></i> <span>Admin Access</span></a>
            </li>
            <li>
                <a href="{{route('admin.view.branch.list')}}" class="sidebar-tab" id="branch-tab"> 
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"><path d="M128 148v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12zm140 12h40c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12zm-128 96h40c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12zm128 0h40c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12zm-76 84v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm76 12h40c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12zm180 124v36H0v-36c0-6.6 5.4-12 12-12h19.5V24c0-13.3 10.7-24 24-24h337c13.3 0 24 10.7 24 24v440H436c6.6 0 12 5.4 12 12zM79.5 463H192v-67c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v67h112.5V49L80 48l-.5 415z"/></svg>
                    <span>Branches</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.view.setting')}}" class="sidebar-tab" id="setting-tab"> <i data-feather="settings"></i> <span>Setting</span></a>
            </li>


        </ul>
    </div>
</aside>
