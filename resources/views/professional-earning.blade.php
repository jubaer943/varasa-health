@extends('master')

@section('content')
    @include('nav')
    <!-- page section start -->
    <div class="page-body">
        <a class="go_back" href="ProfesionalProfile.html">
            <img src="{{ asset('assets/images/arrow-left.png') }}" alt="varasa arrow-left icon">
            <p>Back</p>
        </a>

        <div class="Commission">
            <h5>Earnings & Commission</h5>
            <div class="Commission-date">
                <select name="days">
                    <option value="weekly" selected>Weekly</option>
                    <option value="Monthly">Monthly</option>
                    <option value="Yearly">Yearly</option>
                </select>
                <select name="date">
                    <option value="weekly" selected>Oct 20- - Oct 26, 2024</option>
                    <option value="weekly">Jan 23- - Jan 29, 2024</option>
                    <option value="weekly">Jun 14- - Jun 18, 2024</option>
                    <option value="weekly">July 03- - July 23, 2024</option>
                </select>
            </div>
            <div class="sub-commission">
                <div>
                    <p>Net Earnings</p>
                    <p> {{ $netEanring }} BDT</p>
                </div>
                <div>
                    <p>Net Commission</p>
                    <p>{{ $netCommistion }} BDT</p>
                </div>
                <div class="edit-due">
                    <div>
                        <p>Due Commission</p>
                        <p>0 BDT</p>
                    </div>
                    <img src="{{ asset('assets/images/edit-2.png') }}" alt="">
                </div>
                <div>
                    <p>-</p>
                    <p>-</p>
                </div>
                <div>
                    <p>Total Services</p>
                    <p> {{ $totalService }} </p>
                </div>
                <div>
                    <p>Total Completed</p>
                    <p> {{ $complitedService }} </p>
                </div>
                <div>
                    <p>Online Payment</p>
                    <p> {{ $OnlinePayment }} BDT</p>
                </div>
                <div>
                    <p>Cash Payment</p>
                    <p> {{ $cashPayment }} BDT</p>
                </div>
            </div>
        </div>
        <div class="Earning-section">
            <h1>Earnings by Services</h1>
            <div class="Earning-top">
                <div>
                    <img src="{{ asset('assets/images/search.png') }}" alt="search icon varasa">
                    <input type="text" name="search" id="search">
                </div>
            </div>
            <div class="Earnings">
                @if ($orders->count() > 0)
                    @foreach ($orders as $order)
                        <div>
                            <ul>
                                <li>
                                    <p>Order ID : </p>
                                    <p>{{ $order->order_number }}</p>
                                </li>
                                <li>
                                    <p>Amount :</p>
                                    <p> {{ $order->price * $order->quantity }} BDT</p>
                                </li>
                                <li>
                                    <p>Date :</p>
                                    <p> {{ $order->orderDate }} </p>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                @else
                    <h4 class="card-title" style="margin-top: 3rem;">No Service Found</h4>
                @endif

            </div>
        </div>
    </div>
    <!-- page section end -->
    </div>
    </div>
@endsection
