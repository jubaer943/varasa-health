@extends('master')

@section('content')
    @include('nav')
    <!-- page section start -->
    <div class="page-body">
        <div class="NurseCaregiver-top">
            <a class="go_back" href="#">
                <img src="{{ asset('assets/images/arrow-left.png') }}" alt="varasa arrow-left icon">
                <p>Back</p>
            </a>
            <a href="{{ route('diagnostic.add') }}" class="button">Add New</a>
        </div>
        <div class="all-service">
            @if ($diagnosticTests->count() > 0)
                @foreach ($diagnosticTests as $diagnosticTest)
                    <div class="service diagnostic-service {{ $diagnosticTest->status == 1 ? '' : 'disabled-service' }}">
                        <div class="service-body">
                            <h4> {{ $diagnosticTest->test_name }} </h4>
                            <p>
                                <img src="{{ asset('assets/images/star.png') }}" alt="varasa start icon">
                                <span>0.0</span>
                            </p>
                        </div>
                        <div class="service-btns">
                            <a href="{{ route('diagnostic.details', ['id' => $diagnosticTest->id]) }}" class="button">See
                                Details</a>
                            <div class="NurseCaregiver-switch">
                                <label class="switch"><input type="checkbox"
                                        {{ $diagnosticTest->status == 1 ? 'checked' : '' }}
                                        data-status="{{ $diagnosticTest->id }}"><span
                                        class="slider slider-green NurseCaregiver-switchs"></span></label>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No test found.</p>
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
                    url: "{{ route('diagnostic.action') }}",
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
