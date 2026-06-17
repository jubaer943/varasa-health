@extends('master')

@section('content')
    @include('nav')
    <!-- page section start -->
    <!-- page section start -->


    <div class="page-body">
        <a class="go_back" href="SubAdmin.html">
            <img src="assets/images/arrow-left.png" alt="varasa arrow-left icon">
            <p>Back</p>
        </a>
        <form action="{{ route('sub-admin.add') }}" method="POST" class="page-border">
            <!-- user info start -->
            @csrf
            <div class="user-info">
                <div class="user-name">
                    <h2>Add Sub Admin </h2>
                </div>

                <div class="user-details sub-admin-user">
                    <div>

                        <label for="FName">Full Name</label>
                        <input type="text" name="FName" id="FName" placeholder="Tanvir Hossen">
                    </div>
                    <div>
                        <label for="Email">Email</label>
                        <input type="email" name="Email" value="{{ old('Email') }}" id="Email"
                            placeholder="rahitulislam213@gmail.com">
                    </div>
                    <div>
                        <label for="Password">Password</label>
                        <input type="password" name="Password" id="Password" placeholder="73D28Ab">
                    </div>
                </div>
                <button type="submit" class="button">Save</button>
            </div>
            <!-- user info end -->
        </form>
    </div>
    <!-- page section end -->
    </div>
    </div>
@endsection
