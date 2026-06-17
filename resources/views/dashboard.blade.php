@extends('master')

@section('content')
    @include('nav')
    <!-- page section start -->
    <div class="page-body order">
        <div class="dashboard-top">
            <div>
                <p>Active Orders</p>
                <p> {{ $activeOrders }} </p>
            </div>
            <div class="pending-order">
                <p>Pending Orders</p>
                <p> {{ $pendingOrders }} </p>
            </div>
            <div>
                <p>Complete Orders</p>
                <p> {{ $completedOrders }} </p>
            </div>
            <div>
                <p>Our Services</p>
                <p> {{ $services }} </p>
            </div>
            <div>
                <p>Users</p>
                <p> {{ $users }} </p>
            </div>
            <div>
                <p>Professionals</p>
                <p>{{ $professionals }}</p>
            </div>
        </div>
        <div class="dashboard">
            <div class="card">
                <div class="title">
                    <p>Revenue</p>
                    <div>
                        <div>
                            <img class="year_left" src="assets/images/arrow-left.png" alt="varasa arrow icon">
                            <p class="dashboard_year">2024</p>
                            <img class="year_right" src="assets/images/arrow-right.png" alt="varasa arrow icon">
                        </div>
                        <select name="time" id="time">
                            <option value="monthly">Monthly</option>
                            <option value="Yearly">Yearly</option>
                        </select>
                    </div>
                </div>
                <div class="chart">
                    <div>
                        <div class="bar bar6"></div>
                        <div class="label">Jan</div>
                    </div>
                    <div>
                        <div class="bar bar4"></div>
                        <div class="label">Feb</div>
                    </div>
                    <div>
                        <div class="bar bar8"></div>
                        <div class="label">Mar</div>
                    </div>
                    <div>
                        <div class="bar bar6"></div>
                        <div class="label">Apr</div>
                    </div>
                    <div>
                        <div class="bar bar3"></div>
                        <div class="label">May</div>
                    </div>
                    <div>
                        <div class="bar bar4"></div>
                        <div class="label">Jun</div>
                    </div>
                    <div>
                        <div class="bar bar3"></div>
                        <div class="label">Jul</div>
                    </div>
                    <div>
                        <div class="bar bar7"></div>
                        <div class="label">Aug</div>
                    </div>
                    <div>
                        <div class="bar bar5"></div>
                        <div class="label">Sep</div>
                    </div>
                    <div>
                        <div class="bar bar3"></div>
                        <div class="label">Oct</div>
                    </div>
                    <div>
                        <div class="bar bar5"></div>
                        <div class="label">Nov</div>
                    </div>
                    <div>
                        <div class="bar bar6"></div>
                        <div class="label">Dec</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="title">
                    <p>Orders <span>(order Placed Quantity)</span></p>
                    <div>
                        <div>
                            <p>May, 2024</p>
                        </div>
                        <select name="time" id="time">
                            <option value="monthly">Monthly</option>
                            <option value="Yearly">Yearly</option>
                        </select>
                    </div>
                </div>
                <div class="chart chart-two">
                    <div>
                        <div class="bar bar4"></div>
                        <div class="label">set, 21</div>
                    </div>
                    <div>
                        <div class="bar bar7"></div>
                        <div class="label">set, 21</div>
                    </div>
                    <div>
                        <div class="bar bar2"></div>
                        <div class="label">set, 21</div>
                    </div>
                    <div>
                        <div class="bar bar8"></div>
                        <div class="label">set, 21</div>
                    </div>
                    <div>
                        <div class="bar bar6"></div>
                        <div class="label">set, 21</div>
                    </div>
                    <div>
                        <div class="bar bar4"></div>
                        <div class="label">set, 21</div>
                    </div>
                    <div>
                        <div class="bar bar7"></div>
                        <div class="label">set, 21</div>
                    </div>
                </div>
            </div>
        </div>

        @if (Auth::user()->permissions->isEmpty())
            <h1 class="dashboard-order">Orders</h1>
            <div class="search_refresh">
                <div>
                    <img src="assets/images/search.png" alt="varasa search icon">
                    <input type="text" name="search" id="search" placeholder="Search" autofocus>
                </div>
                <button class="Refresh">
                    <img src="assets/images/refresh.png" alt="varasa refresh icon">
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
                            <!-- Add actual payment types here -->
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
            <div class="Order-box-section">
            </div>
        @else
            @php
                $has_permission = Auth::user()->permissions->first();
            @endphp
            @if ($has_permission->orders == 1)
                <h1 class="dashboard-order">Orders</h1>
                <div class="search_refresh">
                    <div>
                        <img src="assets/images/search.png" alt="varasa search icon">
                        <input type="text" name="search" id="search" placeholder="Search" autofocus>
                    </div>
                    <button class="Refresh">
                        <img src="assets/images/refresh.png" alt="varasa refresh icon">
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
                                <!-- Add actual payment types here -->
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
                <div class="Order-box-section">
                </div>
            @endif
        @endif
        <!-- order box end -->
    </div>
    <!-- page section end -->
    </div>
    </div>
    <script>
        $(document).ready(function() {
            function fetchOrders() {
                let status = $(".order-type-btn button.active").attr("data-status") || 0;
                let paymentType = $("#Payment-Type").val();
                let area = $("#Select-Area").val();
                let search = $("#search").val();
                let date = $("#date").val();

                $.ajax({
                    url: "{{ route('order.index') }}",
                    type: "GET",
                    data: {
                        status: status,
                        date: date,
                        payment_type: paymentType,
                        area: area,
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
                                <a href="OrderDetails.html">
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

            // Mark first button as active on page load
            $(".order-type-btn button").first().addClass("active");

            // Handle filter button click
            $(".order-type-btn button").click(function() {
                $(".order-type-btn button").removeClass("active");
                $(this).addClass("active");
                fetchOrders();
            });

            // Handle input changes
            $("#date, #Payment-Type, #Select-Area, #search").on("change keyup", function() {
                fetchOrders();
            });

            // Initial fetch on page load
            fetchOrders();
        });
    </script>
@endsection
