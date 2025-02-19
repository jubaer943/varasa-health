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
                <button>Running Campaign</button>
                <button>Campaign History</button>
            </div>
            <a href="campaign/add" class="add-presentation">
                <img src="assets/images/plus white.png" alt="varasa plus icon">
                <p>Add Campaign</p>
            </a>
        </div>
        <div class="user-table">
            <!-- user table -->
            <table class="campaign-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Campaign Picture</th>
                        <th>Campaign Name</th>
                        <th>Start Date</th>
                        <th>end Date</th>
                        <th>Area</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($campaigns->isNotEmpty())
                        {{-- Check if there are campaigns --}}
                        @foreach ($campaigns as $campaign)
                            <tr>
                                <td>{{ $campaign->id }}</td>
                                <td><img class="campaign-bg"
                                        src="{{ asset('storage/app/public/' . $campaign->campaign_banner) }}"
                                        alt="varasa campaign bg image"></td>
                                <td>{{ $campaign->name }}</td>
                                <td>{{ $campaign->start_at }}</td>
                                <td>{{ $campaign->end_at }}</td>
                                <td>{{ $campaign->area }}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" {{ $campaign->status ? 'checked' : '' }}>
                                        <span class="slider slider-green"></span>
                                    </label>
                                </td>
                                <td><img class="campaign-delete" src="assets/images/delete.png" alt="delete icon"></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center">No campaigns found.</td>
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
