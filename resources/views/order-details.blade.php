@extends('master')

@section('content')
    @include('nav')

    <!-- page section start -->
    <div class="page-body">
        <a class="go_back" href="{{ route('order.index') }}">
            <img src="{{ asset('assets/images/arrow-left.png') }}" alt="varasa arrow-left icon">
            <p>Back</p>
        </a>
        <div class="order-details page-border">
            <div class="order-details-title">
                <h1>Order Details</h1 <p>(
                @if ($order->status == 0)
                    Pending
                @endif
                @if ($order->status == 1)
                    Active
                @endif
                @if ($order->status == 2)
                    Complited
                @endif

                Order)</p>
            </div>
            <div class="order-summary">
                <table>
                    <tr>
                        <td>Order ID: <strong>{{ $order->order_number ?? null }}</strong></td>
                    </tr>
                    <tr>
                        <td>Service: <strong>{{ $order->products->service_name ?? null }}
                                {{ $order->advance_price_id !== null ? $order->advancePrice->service : null }}</strong></td>
                        <td>Person: <strong> {{ $order->quantity }} </strong></td>
                    </tr>
                    <tr>
                        <td>Price: <strong> {{ $order->price }} BDT</strong></td>
                        <td>Payment: <strong> {{ $order->payment_method == null ? 'Cash' : $order->payment_method }}
                            </strong></td>
                    </tr>
                    <tr>
                        <td>Location: <strong> {{ $order->address ?? null }} </strong></td>
                        <td>Total Amount: <strong> {{ $order->total_price ?? null }} BDT</strong></td>
                    </tr>
                    <tr>
                        <td>Order Date: <strong>{{ \Carbon\Carbon::parse($order->created_at)->format('d F, Y') }}
                            </strong></td>
                        <td>Order Time: <strong>{{ \Carbon\Carbon::parse($order->created_at)->format('h.i a') }}
                            </strong></td>
                    </tr>
                    <tr>
                        {{-- <td>Service Date: <strong>15 October, 2024 - 22 October, 2024</strong></td> --}}
                        <td colspan="2">Service Time: <strong>
                                {{ \Carbon\Carbon::parse($order->schedule->start_time)->format('h.i a') }} -
                                {{ \Carbon\Carbon::parse($order->schedule->end_time)->format('h.i a') }}</strong></td>
                    </tr>
                </table>
            </div>
            <div class="user_Professional_info">
                <button class="user_info_btn active-user-btn">User Info</button>
                <button class="Prof_info_btn">Professional Info</button>
            </div>
            <!-- user info start -->
            <div class="user-info">
                <div class="user-name">
                    <h2> {{ $order->appsUsers->fullname ?? null }} </h2>
                    <a href="{{ route('users.profile', ['user_id' => $order->user_id]) }}">
                        <p>View Profile</p>
                    </a>
                </div>
                <div class="profile-photo">
                    <p>Profile Picture</p>
                    <img src="{{ $order->appsUsers->profile_picture !== null ?: asset('assets/images/profile icon.png') }}"
                        alt="profile Picture">
                </div>
                <div class="user-details">
                    <div>
                        <p>Full Name</p>
                        <div>{{ $order->appsUsers->fullname ?? null }}</div>
                    </div>
                    <div>
                        <p>Email</p>
                        <div>{{ $order->appsUsers->email ?? null }}</div>
                    </div>
                    <div>
                        <p>Phone Number</p>
                        <div>{{ $order->appsUsers->phone ?? null }}</div>
                    </div>

                </div>
            </div>
            <!-- user info end -->
            @if ($order->service_provider !== null)
                <!-- Professional info start -->
                <div class="Professional-info user-hide">
                    <div class="user-name">
                        <h2> {{ $order->professional->full_name ?? null }} </h2>
                        <a href="{{ route('professional.profile', ['pro_id' => $order->professional->id ?? null]) }}">
                            <p>View Profile</p>
                        </a>
                    </div>
                    <div class="profile-photo">
                        <p>Profile Picture</p>
                        <img src="{{ $order->professional->profile_picture !== null ?: asset('assets/images/profile icon.png') }}"
                            alt="profile Picture">
                    </div>
                    <div class="user-details">
                        <div>
                            <p>Full Name</p>
                            <div> {{ $order->professional->full_name ?? null }}</div>
                        </div>
                        <div>
                            <p>Email</p>
                            <div> {{ $order->professional->email ?? null }}</div>
                        </div>
                        <div>
                            <p>Phone Number</p>
                            <div> {{ $order->professional->phone ?? null }}</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- page section end -->
    </div>
    </div>
@endsection
