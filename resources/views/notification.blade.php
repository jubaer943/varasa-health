@extends('master')

@section('content')
    @include('nav')
    <!-- page section start -->
    <div class="page-body">
        <p>Today</p>
        <div class="all-notification">
            <h4 class="card-title " style="margin-top:2rem">No notification found !</h4>
            {{-- <div>
                <div>
                    <img src="assets/images/notification.png" alt="notification profile image">
                    <div>
                        <h4>New Order Placed</h4>
                        <p>Professional ID: P-0004 accepted the order (Order ID: <span>A240125-0009</span>)</p>
                    </div>
                </div>
                <div class="notification-time">
                    <p>06: 19 pm</p>
                    <a href="OrderDetails.html">View Order</a>
                </div>
            </div>
            <div>
                <div>
                    <img src="assets/images/notification.png" alt="notification profile image">
                    <div>
                        <h4>New Order Placed</h4>
                        <p>User ID: P-0004 has been paid 1200 BDT and Transaction ID is <span>1DKJWHY</span></p>
                    </div>
                </div>
                <div class="notification-time">
                    <p>06: 19 pm</p>
                    <a href="OrderDetails.html">View Order</a>
                </div>
            </div>
            <div>
                <div>
                    <img src="assets/images/notification.png" alt="notification profile image">
                    <div>
                        <h4>New Order Placed</h4>
                        <p>User ID: D0004 has been placed an order </p>
                    </div>
                </div>
                <div class="notification-time">
                    <p>06: 19 pm</p>
                    <a href="OrderDetails.html">View Order</a>
                </div>
            </div> --}}
        </div>
        {{-- 
        <p class="notification-date">Yesterday</p>
        <div class="all-notification">
            <div>
                <div>
                    <img src="assets/images/notification.png" alt="notification profile image">
                    <div>
                        <h4>New Order Placed</h4>
                        <p>User ID: D0004 has been placed an order </p>
                    </div>
                </div>
                <div class="notification-time">
                    <p>06: 19 pm</p>
                    <a href="OrderDetails.html">View Order</a>
                </div>
            </div>
            <div>
                <div>
                    <img src="assets/images/notification.png" alt="notification profile image">
                    <div>
                        <h4>New Order Placed</h4>
                        <p>User ID: D0004 has been placed an order </p>
                    </div>
                </div>
                <div class="notification-time">
                    <p>06: 19 pm</p>
                    <a href="OrderDetails.html">View Order</a>
                </div>
            </div>
            <div>
                <div>
                    <img src="assets/images/notification.png" alt="notification profile image">
                    <div>
                        <h4>New Order Placed</h4>
                        <p>User ID: D0004 has been placed an order </p>
                    </div>
                </div>
                <div class="notification-time">
                    <p>06: 19 pm</p>
                    <a href="OrderDetails.html">View Order</a>
                </div>
            </div>
            <div>
                <div>
                    <img src="assets/images/notification.png" alt="notification profile image">
                    <div>
                        <h4>New Order Placed</h4>
                        <p>User ID: D0004 has been placed an order </p>
                    </div>
                </div>
                <div class="notification-time">
                    <p>06: 19 pm</p>
                    <a href="OrderDetails.html">View Order</a>
                </div>
            </div>
            <div>
                <div>
                    <img src="assets/images/notification.png" alt="notification profile image">
                    <div>
                        <h4>New Order Placed</h4>
                        <p>User ID: D0004 has been placed an order </p>
                    </div>
                </div>
                <div class="notification-time">
                    <p>06: 19 pm</p>
                    <a href="OrderDetails.html">View Order</a>
                </div>
            </div>
            <div>
                <div>
                    <img src="assets/images/notification.png" alt="notification profile image">
                    <div>
                        <h4>New Order Placed</h4>
                        <p>User ID: D0004 has been placed an order </p>
                    </div>
                </div>
                <div class="notification-time">
                    <p>06: 19 pm</p>
                    <a href="OrderDetails.html">View Order</a>
                </div>
            </div>
        </div>

        <p class="notification-date">08/10/2024</p>
        <div class="all-notification">
            <div>
                <div>
                    <img src="assets/images/notification.png" alt="notification profile image">
                    <div>
                        <h4>New Order Placed</h4>
                        <p>User ID: D0004 has been placed an order </p>
                    </div>
                </div>
                <div class="notification-time">
                    <p>06: 19 pm</p>
                    <a href="OrderDetails.html">View Order</a>
                </div>
            </div>
            <div>
                <div>
                    <img src="assets/images/notification.png" alt="notification profile image">
                    <div>
                        <h4>New Order Placed</h4>
                        <p>User ID: D0004 has been placed an order </p>
                    </div>
                </div>
                <div class="notification-time">
                    <p>06: 19 pm</p>
                    <a href="OrderDetails.html">View Order</a>
                </div>
            </div>
            <div>
                <div>
                    <img src="assets/images/notification.png" alt="notification profile image">
                    <div>
                        <h4>New Order Placed</h4>
                        <p>User ID: D0004 has been placed an order </p>
                    </div>
                </div>
                <div class="notification-time">
                    <p>06: 19 pm</p>
                    <a href="OrderDetails.html">View Order</a>
                </div>
            </div>
            <div>
                <div>
                    <img src="assets/images/notification.png" alt="notification profile image">
                    <div>
                        <h4>New Order Placed</h4>
                        <p>User ID: D0004 has been placed an order </p>
                    </div>
                </div>
                <div class="notification-time">
                    <p>06: 19 pm</p>
                    <a href="OrderDetails.html">View Order</a>
                </div>
            </div>
            <div>
                <div>
                    <img src="assets/images/notification.png" alt="notification profile image">
                    <div>
                        <h4>New Order Placed</h4>
                        <p>User ID: D0004 has been placed an order </p>
                    </div>
                </div>
                <div class="notification-time">
                    <p>06: 19 pm</p>
                    <a href="OrderDetails.html">View Order</a>
                </div>
            </div>
            <div>
                <div>
                    <img src="assets/images/notification.png" alt="notification profile image">
                    <div>
                        <h4>New Order Placed</h4>
                        <p>User ID: D0004 has been placed an order </p>
                    </div>
                </div>
                <div class="notification-time">
                    <p>06: 19 pm</p>
                    <a href="OrderDetails.html">View Order</a>
                </div>
            </div>
        </div> --}}
    </div>
    <!-- page section end -->
    </div>
    </div>
@endsection
