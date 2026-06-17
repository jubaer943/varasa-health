@extends('master')

@section('content')
    @include('nav')

    <!-- page section start -->
    <div class="page-body">
        <a class="go_back" href="Order.html">
            <img src="{{ asset('assets/images/arrow-left.png') }}" alt="varasa arrow-left icon">
            <p>Back</p>
        </a>
        <div class="page-border">
            <!-- user info start -->
            <div class="user-info">
                <div class="user-name">
                    <h2> {{ $user->fullname }} </h2>
                    <a href="#">
                        <p>User ID: {{ $user->userId }} </p>
                    </a>
                </div>
                <div class="profile-photo">
                    <p>Profile Picture</p>
                    <img src="{{ $user->profile_picture == null ? asset('assets/images/profile icon.png') : asset('storage/' . $user->profile_picture) }}"
                        alt="profile Picture">
                </div>
                <div class="user-details">
                    <div>
                        <p>Full Name</p>
                        <div>{{ $user->fullname }}</div>
                    </div>
                    <div>
                        <p>Email</p>
                        <div> {{ $user->email }} </div>
                    </div>
                    <div>
                        <p>Phone Number</p>
                        <div>{{ $user->phone }}</div>
                    </div>
                    <div>
                        <p>Date of Birth</p>
                        <div> {{ \Carbon\Carbon::parse($user->dob)->format('jS F, Y') }}
                        </div>
                    </div>
                    <div>
                        <p>Gender</p>
                        <div>Male</div>
                    </div>
                    <div>
                        <p>Primary Location</p>
                        <div>
                            @if ($user->UserLocation->isNotEmpty())
                                @php
                                    $location = $user->UserLocation->first();
                                @endphp
                                {{ $location->flat_no }}, {{ $location->house_no }}, {{ $location->road }},
                                {{ $location->aria }}
                            @else
                                Location not set
                            @endif
                        </div>
                    </div>
                    <div>
                        <p>Joined</p>
                        <div>{{ \Carbon\Carbon::parse($user->created_at)->format('jS F, Y') }}</div>
                    </div>
                </div>
            </div>
            <!-- user info end -->
        </div>

        <!-- order section start -->
        <div class="user-details-order order">
            <h1>Orders</h1>
            <div class="search_refresh">
                <div>
                    <img src="{{ asset('assets/images/search.png') }}" alt="varasa search icon">
                    <input type="text" name="search" id="search" placeholder="Search">
                </div>
                <button>
                    <img src="{{ asset('assets/images/refresh.png') }}" alt="varasa refresh icon">
                    <p>Refresh</p>
                </button>
            </div>

            <!-- active/pending/complete button -->
            <div class="order-type-btn">
                <div class="lefts-btn">
                    <button data-status="1">Active</button>
                    <button data-status="0">Pending</button>
                    <button data-status="2">Complete</button>
                </div>
                <div class="right-btns">
                    <div>
                        <p>Date</p>
                        <input type="date" name="date" id="date">
                    </div>
                    <div>
                        <p>Payment Type</p>
                        <select name="Payment-Type" id="Payment-Type">
                            <option value="Payment Type" selected>All</option>
                            <option value="Cash">Cash</option>
                            <option value="Bkash">Bkash</option>
                            <option value="Nagad">Nagad</option>
                            <option value="Card">Card</option>
                        </select>
                    </div>
                    <div>
                        <p>Area Wise</p>
                        <select name="Select-Area" id="Select-Area">
                            <option value="Select Area">Select Area</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- order box start -->
            <div class="Order-box-section"></div>
            <!-- order box end -->
        </div>
        <!-- order section end -->
    </div>
    <!-- page section end -->
    </div>
    </div>



    <script>
        var user_id = @json($user_id);

        $(document).ready(function() {
            function fetchOrders(user_id) {
                let status = $(".order-type-btn button.active").attr("data-status") || 0;
                let paymentType = $("#Payment-Type").val();
                // let area = $("#Select-Area").val();
                let search = $("#search").val();
                let date = $("#date").val();

                $.ajax({
                    url: "{{ route('users.profile', ['user_id' => '__USER_ID__']) }}".replace(
                        '__USER_ID__', user_id),
                    type: "GET",
                    data: {
                        status: status,
                        date: date,
                        payment_type: paymentType,
                        // area: area,
                        search: search
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        if (response.orders.length === 0) {
                            $(".Order-box-section").html(
                                '<h4 class="card-title " style="margin-top: 2rem;">No order Found</h4>'
                            );
                        } else {
                            console.log(response);

                            $(".Order-box-section").html(response.orders.map(order => `
                            <div class="Order-box">
                                <div class="order-time"> 
                                    <p>Order ID : <b>${order.order_number}</b></p>
                                    <div>
                                        <p>Order Date : <b>${new Date(order.created_at).toLocaleString('en-US', { month: 'short', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', hour12: true }).replace(',', '')}</b></p>
                                        <p>Service Time: <b>${(h => `${h % 12 || 12}:${order.schedule?.start_time.split(":")[1]} ${h >= 12 ? "PM" : "AM"}`)(parseInt(order.schedule?.start_time))} - ${(h => `${h % 12 || 12}:${order.schedule?.end_time.split(":")[1]} ${h >= 12 ? "PM" : "AM"}`)(parseInt(order.schedule?.end_time))}</b></p>
                                    </div>
                                </div>
                                <div class="order-img">
                                    <img src="assets/images/profile icon.png" alt="">
                                    <p>${order.service?.name}  <br>${order.advance_price?.service ?? ''}</p>
                                </div>
                                <hr class="order-hr">
                                <div class="order-amount">
                                    <div>
                                        <p>Payment: <b>${order.payment_method ?? 'cash'}</b></p>
                                        <p>Amount : <b>${order.price} BDT</b></p>
                                    </div>
                                    <a href="/order/details/${order.id}">
                                        <p>View Order</p>
                                    </a>
                                </div>
                            </div>
                    `).join(""));
                        }
                    },
                    error: function(xhr) {
                        console.error("Error:", xhr.responseText);
                    }
                });
            }

            // // Mark first button as active on page load
            $(".order-type-btn button").first().addClass("active");

            // // Handle filter button click
            $(".order-type-btn button").click(function() {
                $(".order-type-btn button").removeClass("active");
                $(this).addClass("active");
                fetchOrders(user_id);
            });

            // // Handle input changes
            $("#date, #Payment-Type, #Select-Area, #search").on("change keyup", function() {
                fetchOrders(user_id);
            });

            // Initial fetch on page load
            fetchOrders(user_id);
        });
    </script>
@endsection
