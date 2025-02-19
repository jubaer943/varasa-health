<div class="varasa-pages">
    <!-- ******** side-navbar start ******** -->
    <nav class="side-navbar">
        <div>
            <img src="{{ asset('assets/images/varasa logo.png') }}" alt="varasa logo">
        </div>

        <ul class="navbar-ul">
            <li>
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <img class="nav-img" src="{{ asset('assets/images/Dashboard.png') }}" data-image-url="{{ asset('assets/images/') }}" alt="Dashboard">
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('our-services.index') }}">
                    <img class="nav-img" src="{{ asset('assets/images/Our Service.png') }}" data-image-url="{{ asset('assets/images/') }}" alt="Our Service">
                    <p>Our Service</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('orders') }}">
                    <img class="nav-img" src="{{ asset('assets/images/Orders.png') }}" data-image-url="{{ asset('assets/images/') }}" alt="Orders">
                    <p>Orders</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('my-profile') }}">
                    <img class="nav-img" src="{{ asset('assets/images/My Profile.png') }}" data-image-url="{{ asset('assets/images/') }}" alt="My Profile">
                    <p>My Profile</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('users.index') }}">
                    <img class="nav-img" src="{{ asset('assets/images/Users.png') }}" data-image-url="{{ asset('assets/images/') }}" alt="Users">
                    <p>Users</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('professional.index') }}">
                    <img class="nav-img" src="{{ asset('assets/images/Professionals.png') }}" data-image-url="{{ asset('assets/images/') }}" alt="Professionals">
                    <p>Professionals</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('sub-admin.index') }}">
                    <img class="nav-img" src="{{ asset('assets/images/Sub Admins.png') }}" data-image-url="{{ asset('assets/images/') }}" alt="Sub Admins">
                    <p>Sub Admins</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="Notification.html">
                    <img class="nav-img" src="{{ asset('assets/images/Notifications.png') }}" data-image-url="{{ asset('assets/images/') }}" alt="Notifications">
                    <p>Notifications</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('campaign.index') }}">
                    <img class="nav-img" src="{{ asset('assets/images/Campaign.png') }}" data-image-url="{{ asset('assets/images/') }}" alt="Campaign">
                    <p>Campaign</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('settings') }}">
                    <img class="nav-img" src="{{ asset('assets/images/Setting.png') }}" data-image-url="{{ asset('assets/images/') }}" alt="Setting">
                    <p>Setting</p>
                </a>
            </li>
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img class="nav-img" src="{{ asset('assets/images/Log Out.png') }}" alt="Log Out">
                    <p>Log Out</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
        
    </nav>
    <!-- ******** side-navbar end ******** -->

    <div class="pages-top">
        <!-- ********* top-navbar start********* -->
        <header class="top-navbar">
            <div>
                <a href="#" class="app-link">
                    <img src="{{ asset('assets/images/android logo.png') }} " alt="varasa android app logo">
                    <p>Android App <span>Link</span></p>
                </a>
                <a href="#" class="app-link">
                    <img src="{{ asset('assets/images/ios logo.png') }}" alt="varasa ios app logo">
                    <p>IOS App <span>Link</span></p>
                </a>
            </div>
            <div class="top-navbar-end">
                <button class="notification">
                    <img src="{{ asset('assets/images/bell.png') }}" alt="varasa bell logo">
                    <span class="badge">9+</span>
                </button>
                <div class="notification-box">
                    <p>You Have <span>9+</span> New Notification</p>
                    <hr>
                    <div class="notification-details">
                        <img src="{{ asset('assets/images/profile icon.png') }}" alt="profile icon">
                        <div>
                            <h4>MD. Rahitul Islam</h4>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                    <div class="notification-details">
                        <img src="{{ asset('assets/images/profile icon.png') }}" alt="profile icon">
                        <div>
                            <h4>MD. Rahitul Islam</h4>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                    <div class="see-all-notification">
                        <a href="Notification.html">See All Notification</a>
                    </div>
                </div>
                <div class="email">
                    <h6>{{ Auth::user()->name }}</h6>
                    <p>{{ Auth::user()->email }}</p>
                </div>
                <a href="#">
                    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/images/profile icon.png') }}" width="50" height="50" style="border-radius: 50%; object-fit:contain" alt="varasa profile icon">
                </a>
                <div class="bar-icon">
                    <img class="bar_btn" src="{{ asset('assets/images/bar.png') }}" alt="varasa bar icon">
                </div>
            </div>
        </header>

        <!-- side responsive-navbar start(initially -> display:none;) -->
        <nav class="responsive-navbar">
            <div class="responsive-navbar-logo">
                <img src="assets/images/varasa logo.png" alt="varasa logo">
                <img src="assets/images/cross.png" alt="varasa Cross Mark logo" class="Cross-Mark">
            </div>
            <div class="navbar-ul-section">
                <ul class="navbar-ul">
                    <li>
                        <a class="nav-link" href="Dashboard.html">
                            <img class="nav-img" src="assets/images/Dashboard.png" alt="Dashboard">
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="OurService.html">
                            <img class="nav-img" src="assets/images/Our Service.png" alt="Our Service">
                            <p>Our Service</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="Order.html">
                            <img class="nav-img" src="assets/images/Orders.png" alt="Orders">
                            <p>Orders</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="MyProfile.html">
                            <img class="nav-img" src="assets/images/My Profile.png" alt="My Profile">
                            <p>My Profile</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="users">
                            <img class="nav-img" src="assets/images/Users.png" alt="Users">
                            <p>Users</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="Professional.html">
                            <img class="nav-img" src="assets/images/Professionals.png" alt="Professionals">
                            <p>Professionals</p>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-ul">
                    <li>
                        <a class="nav-link" href="SubAdmin.html">
                            <img class="nav-img" src="assets/images/Sub Admins.png" alt="Sub Admins">
                            <p>Sub Admins</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="Notification.html">
                            <img class="nav-img" src="assets/images/Notifications.png" alt="Notifications">
                            <p>Notifications</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="Campaign.html">
                            <img class="nav-img" src="assets/images/Campaign.png" alt="Campaign">
                            <p>Campaign</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="Setting.html">
                            <img class="nav-img" src="assets/images/Setting.png" alt="Setting">
                            <p>Setting</p>
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf <!-- CSRF token for security -->
                            <button class="nav-link" href="LogOut.html">
                                <img class="nav-img" src="assets/images/Log Out.png" alt="Log Out">
                                <p>Log Out</p>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>