<div class="sidebar show shadow-sm" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="#" class="nav_logo">
                <img class="kdis-logo" src="{{asset('images/kdis-logo.png')}}" alt="">
            </a>
            <div class="nav_list">
                <a href="#" class="nav_link active">
                    <i class='bx bx-grid-alt nav_icon'></i>
                    <span class="nav_name">Dashboard</span>
                </a>
                <a href="#" class="nav_link">
                    <i class='bx bx-user nav_icon'></i>
                    <span class="nav_name">Users</span>
                </a>
                <a href="#" class="nav_link">
                    <i class='bx bx-credit-card-alt nav_icon'></i>
                    <span class="nav_name">Billing</span>
                </a>
                <a href="#" class="nav_link">
                    <i class='bx bx-wifi nav_icon' ></i>
                    <span class="nav_name">Hotspot</span>
                </a>
                <a href="#" class="nav_link">
                    <i class='bx bx-support nav_icon' ></i>
                    <span class="nav_name">Support</span>
                </a>
                <a href="#" class="nav_link">
                    </i><i class='bx bx-cog nav_icon' ></i>
                    <span class="nav_name">Settings</span>
                </a>
            </div>
        </div>
        <a href="#" class="nav_link"
            onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
            <i class='bx bx-log-out nav_icon'></i>
            <span class="nav_name">SignOut</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </nav>
</div>
