@extends('master')

@section('content')
@include('nav')

            <!-- page section start -->
            <div class="page-body">
                <div class="all-service">
                    @if($services->count() > 0)
                    @foreach ($services as $service)
                    <div class="service">
                        <div class="service-img">
                            <img src="assets/images/{{ $service->banner }}" alt="varasa service image">
                            <a href="OurServiceNurse.html">
                                <img src="assets/images/edit.png" alt="varasa edit icon">
                            </a>
                        </div>
                        <div class="service-body">
                            <h4>{{ $service->name }}</h4>
                            <p>
                                <img src="assets/images/star.png" alt="varasa start icon">
                                <span>{{ $service->rate }}</span>
                            </p>
                        </div>
                        <a class="button" href="our-services/sub-services/{{ $service->id }}">
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