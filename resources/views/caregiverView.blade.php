@extends('master')

@section('content')
    @include('nav')

    <!-- page section start -->
    <div class="page-body">
        <div class="NurseCaregiver-top">
            <a class="go_back" href="{{ route('our-services.index') }}">
                <img src="{{ asset('assets/images/arrow-left.png') }}" alt="varasa arrow-left icon">
                <p>Back</p>
            </a>
            <a href="{{ url('our-services/add-caregiver') }}" style="text-decoration:none">
                <button class="button">Add New</button>
            </a>
        </div>

        @if ($data['service']->count() > 0)
            <div class="all-service NurseCaregiver">
                @foreach ($data['service'] as $subservice)
                    <div class="service NurseCaregiver-service {{ $subservice->status == 1 ? '' : 'disabled-service' }}">
                        <div class="service-img">
                            <img src="{{ asset('storage/' . $subservice->service_icon) }}" alt="varasa service image">
                            <a href="{{ route('caregiver.update', ['service_id' => $subservice->id]) }}">
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
                        <div class="NurseCaregiver-switch">
                            <label class="switch"><input type="checkbox" {{ $subservice->status == 1 ? 'checked' : '' }}
                                    data-status="{{ $subservice->id }}"><span
                                    class="slider slider-green NurseCaregiver-switchs"></span></label>
                        </div>
                        @foreach ($subservice->advancePrice as $price)
                            <button class="button">{{ $price->service }} - {{ $price->price }} BDT</button>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @else
            <p>No services found.</p>
        @endif

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
