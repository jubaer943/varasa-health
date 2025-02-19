@extends('master')

@section('content')
@include('nav')
<!-- page section start -->
<div class="page-body">
    <a class="go_back" href="Order.html">
        <img src="assets/images/arrow-left.png" alt="varasa arrow-left icon">
        <p>Back</p>
    </a>
    <form action="{{ route('my-profile.update') }}" method="POST" enctype="multipart/form-data" class="page-border">
        @csrf
        @method('PUT') <!-- Add this to specify the method if you're updating data -->
        <!-- user info start -->
        <div class="user-info">
            <div class="user-name">
                <h2>My Profile</h2>
                <div>
                    <button>Admin ID: A-003</button>
                </div>
            </div>

            <div class="profile-photo">
                <p>Profile Picture</p>
                <button class="upload-btn1" type="button">
                    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/images/upload-image.png') }}" width="100" height="100" style="border-radius: 50%; object-fit:contain" alt="profile Picture">
                </button>
                <input type="file" class="setIcon file1" name="profile_picture">
            </div>

            <div class="user-details">
                <div>
                    <label for="FName">Full Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" id="FName" placeholder="Tanvir Hossen">
                    <img src="assets/images/edit-2.png" alt="edit icon varasa">
                </div>
                <div>
                    <label for="Email">Email</label>
                    <input type="email" readonly name="email" value="{{ Auth::user()->email }}" id="Email" placeholder="rahitulislam213@gmail.com">
                    <img src="assets/images/edit-2.png" alt="edit icon varasa">
                </div>
            </div>

            <button type="submit" class="sub_nurse_submit button">Save</button>
        </div>
        <!-- user info end -->
    </form>

</div>
<!-- page section end -->
</div>
</div>
@endsection