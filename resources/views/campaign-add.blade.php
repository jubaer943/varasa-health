@extends('master')

@section('content')
@include('nav')
<!-- page section start -->
<div class="page-body">
    <a class="go_back" href="Campaign.html">
        <img src="assets/images/arrow-left.png" alt="varasa arrow-left icon">
        <p>Back</p>
    </a>
    <form action="{{ url('/campaign/add') }}" method="POST" class="page-border" enctype="multipart/form-data">
        @csrf
        <!-- user info start -->
        <div class="user-info">
            <div class="user-name">
                <h2>Add New Campaign</h2>
            </div>
            <div class="Campaign-Banner">
                <p><span>Set Campaign Banner</span> (16:9 jpeg, png, svg)</p>
                <button class="upload-btn1" type="button">
                    <img src="assets/images/upload-image.png" alt="profile Picture">
                </button>
                <input type="file" name="banner" class="setIcon file1">
            </div>
            <div class="user-details">
                <div>
                    <label for="CampaignName">Campaign Name</label>
                    <input type="text" name="CampaignName" id="CampaignName" placeholder="Physiotherapist">
                </div>
                <div>
                    <label for="Area">Select Campaign Area</label>
                    <input type="text" name="Area" id="Area" placeholder="Dhaka">
                </div>
                <div>
                    <label for="StartDate">Campaign Start Date</label>
                    <input type="date" name="StartDate" id="StartDate" placeholder="2nd July, 2024">
                </div>
                <div>
                    <label for="EndDate">Campaign End Date</label>
                    <input type="date" name="EndDate" id="EndDate" placeholder="10th July, 2024">
                </div>
                <div>
                    <label for="Discount">Discount Percentage</label>
                    <input type="text" name="Discount" id="Discount" placeholder="35%">
                </div>
            </div>
            <button type="submit" class="sub_nurse_submit button">Run Campaign</button>
        </div>
        <!-- user info end -->
    </form>
</div>
<!-- page section end -->
</div>
</div>
@endsection