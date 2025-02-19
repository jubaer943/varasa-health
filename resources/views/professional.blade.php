@extends('master')

@section('content')
@include('nav')
<!-- page section start -->
<!-- page section start -->
<div class="page-body">
    <div class="search-user">
        <img src="assets/images/search.png" alt="varasa search icon">
        <input type="text" name="search" id="search" placeholder="Search" autofocus>
    </div>
    <div class="user-filter-btn">
        <div class="user-left-btn">
            <button>All Professional</button>
            <button>Nurse</button>
            <button>Physiotherpist</button>
            <button>Caregiver</button>
            <button>Active Professionals</button>
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
                @if ($professionals->count() > 0)
                @foreach ($professionals as $professional)
                <tr>
                    <td>D0001</td>
                    <td><img src="assets/images/profile icon.png" alt="Profile Picture"></td>
                    <td>{{ $professional->full_name }}</td>
                    <td>{{ $professional->email }}</td>
                    <td>01565248762</td>
                    <td><label class="switch"><input type="checkbox" {{ $professional->status == 1 ? 'checked': ''  }} ><span class="slider slider-green"></span></label></td>
                    <td><a href="ProfesionalProfile.html" class="see-more">
                            <p>See More</p>
                        </a></td>
                </tr>
                @endforeach
                @else 
                <tr>
                    <td colspan="8" class="text-center">No Profesional found.</td>
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