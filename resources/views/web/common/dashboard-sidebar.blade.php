<aside class="dashboard-sidebar">
    <ul>
        <li>
            <a href="{{route('view.dashboard')}}">
                <button id="dashboard-tab"><i data-feather="user"></i>My Dashboard</button>
            </a>
        </li>
        <li>
            <a href="{{route('view.schedule.shippment')}}">
                <button id="schedule-shippment-tab"><i data-feather="calendar"></i>Schedule a Shippment</button>
            </a>
        </li>
        <li>
            <a href="{{route('view.dashboard')}}">
                <button id="shippment-tab"><i data-feather="clipboard"></i>My Shippments</button>
            </a>
        </li>
        <li>
            <a href="{{route('view.dashboard')}}">
                <button id="setting-tab"><i data-feather="settings"></i>Account Setting</button>
            </a>
        </li>
        <li>
            <a href="{{route('view.dashboard')}}">
                <button><i data-feather="log-out"></i>Logout</button>
            </a>
        </li>
    </ul>        
</aside>