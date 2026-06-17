@extends('master')

@section('content')
    @include('nav')
    <!-- page section start -->
    <div class="page-body">
        <a class="go_back" href="Professional.html">
            <img src="{{ asset('assets/images/arrow-left.png') }}" alt="varasa arrow-left icon">
            <p>Back</p>
        </a>
        <div class="page-border">
            <!-- user info start -->
            <div class="user-info">
                <div class="user-name">
                    <h2>{{ $professional->full_name }}</h2>
                    <div>
                        <button style="cursor: pointer"
                            onclick="window.location.href='{{ route('professional.earning', ['pro_id' => $professional->id]) }}'">
                            Earnings Dashboard
                        </button>
                        <button>Professional ID: {{ $professional->professional_id }}</button>
                    </div>
                </div>
                <div class="profile-photo">
                    <p>Profile Picture</p>
                    <button class="upload-btn1">
                        <img src="{{ asset('assets/images/upload-image.png') }}" alt="profile Picture">
                    </button>
                    <input type="file" class="setIcon file1">
                </div>
                <div class="user-details">
                    <div>
                        <label for="FName">Full Name</label>
                        <input type="text" name="FName" value="{{ $professional->full_name }}" disabled id="FName"
                            placeholder="Tanvir Hossen">
                        <img src="{{ asset('assets/images/edit-2.png') }}" alt="edit icon varasa">
                    </div>
                    <div>
                        <label for="Email">Email</label>
                        <input type="email" name="Email" value="{{ $professional->email }}" disabled id="Email"
                            placeholder="rahitulislam213@gmail.com">
                        <img src="{{ asset('assets/images/edit-2.png') }}" alt="edit icon varasa">
                    </div>
                    <div>
                        <label for="Number">Phone Number</label>
                        <input type="number" name="Number" value="{{ $professional->phone }}" disabled id="Number"
                            placeholder=" 01402860617">
                        <img src="{{ asset('assets/images/edit-2.png') }}" alt="edit icon varasa">
                    </div>
                    <div>
                        <label for="date">Date of Birth</label>
                        <input type="date" name="date"
                            value="{{ \Carbon\Carbon::parse($professional->dob)->format('Y-m-d') }}" id="date"
                            placeholder="2nd July, 2001">

                        <img src="{{ asset('assets/images/date-2.png') }}" alt="date icon varasa">
                    </div>
                    <div>
                        <label for="Gender">Gender</label>
                        <input type="text" value="{{ $professional->gender == 1 ? 'Male' : 'Female' }}" disabled
                            name="Gender" id="Gender" placeholder="Male">
                        <img src="{{ asset('assets/images/edit-2.png') }}" alt="edit icon varasa">
                    </div>
                    <div>
                        <label for="Location">Location</label>
                        <input type="text" name="Location" value="{{ $professional->primary_location ?? 'Not Found' }}"
                            disabled id="Location" placeholder="Block 2, Road 56, Banani, Dhaka, Bangladesh">
                        <img src="{{ asset('assets/images/edit-2.png') }}" alt="edit icon varasa">
                    </div>
                    <div>
                        <label for="NID_No">NID No</label>
                        <input type="text" name="NID_No" value="{{ $professional->nid_number }}" id="NID_No"
                            placeholder="1020923494">
                        <img src="{{ asset('assets/images/edit-2.png') }}" alt="edit icon varasa">
                    </div>
                </div>

                <div class="NID-License">
                    <div class="NID-Attachment">
                        <h5>NID Attachment</h5>
                        <div>
                            <div>
                                <img src="{{ asset('assets/images/NID-1.png') }}" alt="nid image">
                            </div>
                            <div>
                                <img src="{{ asset('assets/images/NID-2.png') }}" alt="nid image">
                            </div>
                        </div>
                    </div>
                    <div class="License-Attachment">
                        <h5>License Attachment</h5>
                        <div>
                            <div>
                                <img src="{{ asset('assets/images/NID-3.png') }}" alt="nid image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- user info end -->
        </div>
        <div class="Earning-section">
            <h1>Earning</h1>
            <div class="Earning-top">
                <div>
                    <img src="{{ asset('assets/images/search.png') }}" alt="search icon varasa">
                    <input type="text" name="search" id="search">
                </div>

                <a href="{{ route('professional.earning', ['pro_id' => $professional->id]) }}" type="button">See All</a>
            </div>
            <p>Net Earnings: <span> {{ $orders->sum('total_price') }} BDT
                </span></p>
            <div class="Earnings">
                @if ($orders->count() > 0)
                    @foreach ($orders as $order)
                        <div>
                            <ul>
                                <li>
                                    <p>Order ID : </p>
                                    <p> {{ $order->order_number }} </p>
                                </li>
                                <li>
                                    <p>Amount :</p>
                                    <p> {{ $order->price * $order->quantity }} BDT</p>
                                </li>
                                <li>
                                    <p>Date :</p>
                                    <p> {{ $order->orderDate }}</p>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                @else
                    <h4 class="card-title" style="margin-top: 3rem;">No Service Found</h4>
                @endif

            </div>
        </div>

        <div class="Professional-order order">
            <h1>Orders</h1>
            <div class="search_refresh">
                <div>
                    <img src="{{ asset('assets/images/search.png') }}" alt="varasa search icon">
                    <input type="text" name="search" id="search" placeholder="Search">
                </div>
                <button class="Refresh">
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
                            <option value="Payment Type">Payment Type</option>
                            <option value="Payment Type">Payment Type</option>
                            <option value="Payment Type">Payment Type</option>
                            <option value="Payment Type">Payment Type</option>
                        </select>
                    </div>
                    <div>
                        <p>Area Wise</p>
                        <select name="Select-Area" id="Select-Area">
                            <option value="Select Area">Select Area</option>
                            <option value="Payment Type">Payment Type</option>
                            <option value="Payment Type">Payment Type</option>
                            <option value="Payment Type">Payment Type</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- order box start -->
            <div class="Order-box-section">
                @if ($orders->count() > 0)
                    @foreach ($orders as $order)
                        <div class="Order-box">
                            <div class="order-time">
                                <p>Order ID : <b>{{ $order->order_number }}</b></p>
                                <div>
                                    <p>Order Date :
                                        <b>{{ \Carbon\Carbon::parse($order->created_at)->format('F j, Y . h:i A') }}
                                        </b>
                                    </p>
                                    <p>Service Time:
                                        <b>{{ \Carbon\Carbon::parse($order->created_at)->format('F j, Y . h:i A') }}</b>
                                    </p>
                                </div>
                            </div>
                            <div class="order-img">
                                <img src="assets/images/profile icon.png" alt="">
                                <p>{{ $order->service->name }} <br>
                                    @foreach ($order->service->subServices as $subService)
                                        {{ $subService->service_name }}
                                    @endforeach
                                </p>
                            </div>
                            <hr class="order-hr">
                            <div class="order-amount">
                                <div>
                                    <p>Payment: <b>{{ $order->payment_method }}</b></p>
                                    <p>Amount : <b> {{ $order->total_price }} BDT</b></p>
                                </div>
                                <a href="OrderDetails.html">
                                    <p>View Order</p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h4 class="card-title" style="margin-top: 3rem;">No Orders Found</h4>
                @endif
            </div>
            <!-- order box end -->
        </div>
    </div>
    <!-- page section end -->
    </div>
    </div>

    <script>
        var pro_id = @json($pro_id);
        $(document).ready(function() {
            function fetchOrders(pro_id) {
                let status = $(".order-type-btn button.active").attr("data-status") || 0;

                $.ajax({
                    url: "{{ route('professional.profile', ['pro_id' => '__PRO_ID__']) }}".replace(
                        '__PRO_ID__', pro_id),
                    type: "GET",
                    data: {
                        status: status,
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr) {
                        console.error("error:", xhr.responseText);

                    }
                });
            }

            $(".order-type-btn button").first().addClass("active");

            $(".order-type-btn button").on("click", function() {
                $(".order-type-btn button").removeClass("active");
                $(this).addClass("active");

                fetchOrders(pro_id);
            })

            fetchOrders(pro_id);

        });
    </script>
@endsection
