@extends('master')

@section('content')
@include('nav')
<!-- page section start -->
<div class="page-body">
    <div class="search-user">
        <img src="assets/images/search.png" alt="varasa search icon">
        <input type="text" name="search" id="search" placeholder="Search" autofocus>
    </div>
    <div class="user-filter-btn">
        <div class="user-left-btn">
            <button>All User</button>
            <button>Active User</button>
        </div>
        <div class="user-right-btn">
            <button class="download-type">
                <img src="assets/images/download icon.png" alt="varasa download icon">
            </button>
            <div class="user-download-type hide-download-type">
                <button>
                    <div>
                        <img src="assets/images/excel icon.png" alt="excel icon">
                        <p>Excel Download</p>
                    </div>
                    <img src="assets/images/download icon.png" alt="varasa download icon">
                </button>
                <button>
                    <div>
                        <img src="assets/images/pdf icon.png" alt="pdf icon">
                        <p>PDF Download</p>
                    </div>
                    <img src="assets/images/download icon.png" alt="varasa download icon">
                </button>
                <button>
                    <div>
                        <img src="assets/images/csv icon.png" alt="csv icon">
                        <p>CSV Download</p>
                    </div>
                    <img src="assets/images/download icon.png" alt="varasa download icon">
                </button>
            </div>
        </div>
    </div>
    <div class="user-table">
        <!-- user table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Profile Picture</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($users->count() > 0)  <!-- Correctly checks if users exist -->
                    @foreach($users as $user)
                    <tr>
                        <td>D0001</td>
                        <td><img src="assets/images/profile icon.png" alt="Profile Picture"></td>
                        <td>{{ $user->fullname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider slider-green"></span>
                            </label>
                        </td>
                        <td>
                            <a href="UserDetails.html" class="see-more">
                                <p>See More</p>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">No Users found.</td>
                    </tr>
                @endif
            </tbody>
            
        </table>
        <!-- user table -->
    </div>
</div>
<!-- page section end -->
</div>
</div>
@endsection