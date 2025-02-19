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
            <button>All Sub Admin</button>
        </div>
        <a href="{{ route('sub-admin.add') }}" class="add-presentation">
            <img src="assets/images/plus white.png" alt="varasa plus icon">
            <p>Add Sub Admin</p>
        </a>
    </div>
    <div class="user-table">
        <!-- user table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Reg. Date</th>
                    <th>Approval</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($admins->isNotEmpty()) <!-- Check if admins are available -->
                @foreach($admins as $admin)
                <tr>
                    <td>{{ 'D' . str_pad($admin->id, 4, '0', STR_PAD_LEFT) }}</td> <!-- Assuming 'D' prefix and zero-padding the ID -->
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($admin->created_at)->format('M d, Y') }}</td> <!-- Format created_at -->
                    <td>
                        <label class="switch">
                            <input type="checkbox" {{ $admin->is_active ? 'checked' : '' }}> <!-- Assuming you have a column is_active -->
                            <span class="slider slider-green"></span>
                        </label>
                    </td>
                    <td>
                        <a href="" class="see-more">
                            <p>Permission</p>
                        </a>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="7">No sub-admins found.</td> <!-- Display a message if no admins are available -->
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