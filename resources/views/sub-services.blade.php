@extends('master')

@section('content')
    @include('nav')
    <!-- page section start -->
    <div class="page-body">
        <div class="NurseCaregiver-top">
            <a class="go_back" href="OurService.html">
                <img src="{{ asset('assets/images/arrow-left.png') }}" alt="varasa arrow-left icon">
                <p>Back</p>
            </a>
            @php
                $url = '';
                if ($service_id == 1) {
                    $url = url('our-services/add/nurse/' . $service_id);
                } elseif ($service_id == 2) {
                    $url = url('our-services/add/' . $service_id);
                }
            @endphp
            <a href="{{ url('our-services/add/' . $service_id) }}" class="button">Add New</a>
        </div>
        <div class="all-service">
            @if ($subservices->count() > 0)
                @foreach ($subservices as $subservice)
                    <div class="service NurseCaregiver-service  {{ $subservice->status == 1 ? '' : 'disabled-service' }}">
                        <div class="service-img">
                            <img src="{{ asset('storage/' . $subservice->service_icon) }}" alt="varasa service image">
                            <a href="{{ route('our-services.update', ['service_id' => $service_id]) }}">
                                <img src="{{ asset('assets/images/edit.png') }}" alt="varasa edit icon">
                            </a>
                        </div>
                        <div class="service-body">
                            <h4>{{ $subservice->service_name }}</h4>
                            <p>
                                <img src="{{ asset('assets/images/star.png') }}" alt="varasa start icon">
                                <span>0.0</span>
                            </p>
                        </div>
                        <div class="service-btns">
                            <button
                                class="button">{{ $subservice->service_fee == null ? '0.00' : $subservice->service_fee }}
                                BDT</button>
                            <div class="NurseCaregiver-switch">
                                <label class="switch"><input type="checkbox" {{ $subservice->status == 1 ? 'checked' : '' }}
                                        data-status="{{ $subservice->id }}"><span
                                        class="slider slider-green NurseCaregiver-switchs"></span></label>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h4 class="card-title" style="margin-top: 3rem;">No Data Found</h4>
            @endif

        </div>
    </div>
    <!-- page section end -->
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".NurseCaregiver-switchs").on("click", function() {
                let checkbox = $(this).prev("input[type='checkbox']"); // Get the checkbox
                let serviceId = checkbox.data("status"); // Get service ID from data attribute
                let status = checkbox.prop("checked") ? 0 : 1; // Check if checked
                console.log(serviceId);
                console.log(status);

                // Perform AJAX request to update status
                $.ajax({
                    url: "{{ route('our-services.action') }}",
                    type: "POST",
                    data: {
                        id: serviceId,
                        status: status
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {

                        alert(
                            `Service ${response.new_status == 1 ? 'activated' : 'deactivated'} successfully!`
                        );
                    },
                    error: function(xhr) {
                        console.error("Error:", xhr.responseText);
                    }
                });
            });
        });
    </script>


@endsection
