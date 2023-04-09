<aside class="dashboard-sidebar">
    <ul>
        <li>
            <a href="{{route('view.dashboard')}}">
                <button type="button" id="dashboard-tab"><i data-feather="user"></i>My Dashboard</button>
            </a>
        </li>
        <li>
            <a href="{{route('view.schedule.shipment')}}">
                <button type="button" id="schedule-shipment-tab"><i data-feather="calendar"></i>Schedule a Shipment</button>
            </a>
        </li>
        <li>
            <a href="{{route('view.shipments')}}">
                <button type="button" id="shipments-tab"><i data-feather="clipboard"></i>My Shipments</button>
            </a>
        </li>
        <li>
            <a href="{{route('view.setting')}}">
                <button type="button" id="setting-tab"><i data-feather="settings"></i>Account Setting</button>
            </a>
        </li>
        <li>
            <button type="button" onclick="handleLogout()"><i data-feather="log-out"></i>Logout</button>
        </li>
    </ul>        
</aside>