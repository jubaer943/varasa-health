@extends('master')

@section('content')
@include('nav')
<!-- page section start -->
<!-- page section start -->
<!-- page section start -->
<div class="page-body order">
    <h1>Orders</h1>
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
            <button>Active</button>
            <button>Pending</button>
            <button>Complete</button>
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
        <h4 class="card-title" style="margin-top: 3rem;">No Orders Found</h4>
    </div>
    <!-- order box end -->
</div>
<!-- page section end -->
</div>
</div>

@endsection