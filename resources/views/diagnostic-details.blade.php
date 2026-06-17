@extends('master')

@section('content')
    @include('nav')

    <!-- page section start -->
    <div class="page-body">
        <div class="NurseCaregiver-top">
            <a class="go_back" href="{{ route('diagnostic.viewtest') }}">
                <img src="{{ asset('assets/images/arrow-left.png') }}" alt="varasa arrow-left icon">
                <p>Back</p>
            </a>
            <a href="{{ route('diagnostic.add') }}" class="button">Add New</a>
        </div>
        <div class="all-service">
            <div class="service diagnostic-service diagnostic-collection">
                <div class="service-body">
                    <h4>{{ $diagnosticTest->test_name }}</h4>
                    <div>
                        <p>
                            <img src="{{ asset('assets/images/star.png') }}" alt="varasa start icon">
                        <p>0.0</p>
                        </p>
                        <a href="{{ route('diagnostic.update', ['id' => $diagnosticTest->id]) }}">
                            <img src="{{ asset('assets/images/edit.png') }}" alt="varasa edit icon">
                        </a>
                    </div>
                </div>
                <div class="service-btns">
                    @if ($diagnosticTest->Hospital->isNotEmpty())
                        @foreach ($diagnosticTest->Hospital as $hospital)
                            <div>
                                <div><img src="{{ url('storage/' . $hospital->hospital_image) }}" alt="img"
                                        width="30" height="30"></div>
                                <div class="details">{{ $hospital->hospital_name }}</div>
                                <div>{{ $hospital->test_price }} BDT</div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- page section end -->
    </div>
    </div>
@endsection
