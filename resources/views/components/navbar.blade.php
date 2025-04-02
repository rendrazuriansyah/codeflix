<nav class="navbar fixed-top navbar-expand-lg bg-body-nav">
    <div class="container-fluid">
        <!-- Navbar toggler button for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <!-- Hamburger icon -->
            <i class="text-white fa-solid fa-bars"></i>
        </button>

        <!-- Navbar brand/logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img class="navbar-icon" src="{{ asset('assets/img/codeflix_logo.png') }}" alt="Codeflix Logo">
        </a>

        <!-- Collapsible navbar content -->
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <!-- Category navigation component -->
            <x-category-nav />

            <!-- Search form -->
            <form class="d-flex me-md-5" role="search" method="GET" action="{{ route('movies.search') }}">
                <input 
                    class="form-control search-box text-white" 
                    type="search" 
                    name="q" 
                    value="{{ request('q') }}"
                    placeholder="Search here" 
                    aria-label="Search" 
                >
                <i class="fa-solid fa-magnifying-glass search-icon" onclick="this.closest('form').submit();" style="cursor: pointer;"></i>
            </form>

            <!-- Navbar icons (notifications and user profile) -->
            <ul class="pt-3 nav-icon d-flex">
                <!-- Notification dropdown -->
                <li class="dropdown me-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-bell bell-icon"></i>
                    </a>
                    <ul class="dropdown-menu notification">
                        <!-- Notification item -->
                        <li>
                            <a class="dropdown-item notification-item" href="#">
                                <img class="time-subscribe" src="assets/img/Clock.png" alt="Clock Icon">
                                <div class="notification-content">
                                    <p class="multi-line-text-subscribe">Premium subscription has expired!</p>
                                    <span class="notification-date">Today</span>
                                </div>
                            </a>
                        </li>
                        <!-- Additional notification items -->
                        <li>
                            <a class="dropdown-item notification-item" href="#">
                                <img class="time-subscribe" src="assets/img/Kingkong.png" alt="Kingkong Icon">
                                <div class="notification-content">
                                    <p class="multi-line-text-subscribe">New movie released</p>
                                    <p class="multi-line-text-new-movie">Khong Guan Super</p>
                                    <span class="notification-date">1 day ago</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item notification-item" href="#">
                                <img class="time-subscribe" src="assets/img/Blackhat.png" alt="Blackhat Icon">
                                <div class="notification-content">
                                    <p class="multi-line-text-subscribe">New movie released</p>
                                    <p class="multi-line-text-new-movie">Black Hat</p>
                                    <span class="notification-date">2 days ago</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item notification-item" href="#">
                                <img class="time-subscribe" src="assets/img/Kingkong.png" alt="Kingkong Icon">
                                <div class="notification-content">
                                    <p class="multi-line-text-subscribe">New movie released</p>
                                    <p class="multi-line-text-new-movie">Laugh Tate</p>
                                    <span class="notification-date">2 days ago</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- User profile dropdown -->
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-user user-icon"></i>
                    </a>
                    <ul class="dropdown-menu user-info">
                        <!-- User profile settings link -->
                        <li><a class="dropdown-item user-info-item" href="#"><i
                                    class="fa-solid fa-circle-user"></i> Profile Setting</a></li>
                        <!-- Logout link with form submission -->
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            <a class="dropdown-item user-info-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                    class="fa-solid fa-right-from-bracket"></i>
                                Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

