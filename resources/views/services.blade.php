@extends('master')

@section('content')
    @include('nav')

    <!-- page section start -->
    <div class="page-body">
        <div class="all-service">
            @if ($services->count() > 0)
                @foreach ($services as $service)
                    <div class="service">
                        <div class="service-img">
                            <img src="{{ asset('storage/' . $service->banner) }}" alt="varasa service image">
                            <a href="{{ route('our-services.edit', ['service_id' => $service->id]) }}">
                                <img src="{{ asset('assets/images/edit.png') }}" alt="varasa edit icon">
                            </a>
                        </div>
                        <div class="service-body">
                            <h4>{{ $service->name }}</h4>
                            <p>
                                <img src="assets/images/star.png" alt="varasa start icon">
                                <span>{{ $service->rate }}</span>
                            </p>
                        </div>
                        <a class="button"
                            href="{{ $service->id == 3 ? 'our-services/caregiver' : ($service->id == 4 ? 'our-services/diagnostic' : 'our-services/sub-services/' . $service->id) }}
">
                            <p>See All Sub Services</p>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- page section end -->
    </div>
    </div>

@endsection
