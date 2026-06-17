@extends('master')

@section('content')
    @include('nav')
    <!-- page section start -->
    <div class="page-body">
        <a class="go_back" href="{{ route('our-services.index') }}">
            <img src="{{ asset('assets/images/arrow-left.png') }}" alt="varasa arrow-left icon">
            <p>Back</p>
        </a>
        <div class="page-border Video-Consultation">
            <h1>{{ $service->name }}</h1>
            <form action="{{ route('our-service.edited', ['service_id' => $service_id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="img-upload-section">
                    <label for="SetIcon"><b>Set Icon</b> (65*65 px jpeg, png, svg)</label>
                    <div>
                        <div class="upload-btn1">
                            <img src="{{ $service->banner == null ? asset('assets/images/upload-image.png') : asset('storage/' . $service->banner) }}"
                                {{ $service->banner == null ? 'width="100" height="100"' : '' }} class="preview1"
                                alt="image upload icon">

                            <input type="file" name="banner" class="setIcon file1">
                        </div>
                    </div>
                </div>

                <div class="input-section">
                    <label for="Name"><b>Name</b></label>
                    <input type="text" value="{{ $service->name }}" name="name" id="Name"
                        placeholder="Nurse Home Service">
                </div>

                <div class="Add-New">
                    <button class="saveBtn" type="submit">save</button>
                    {{-- <a href="OurServiceSubNurse.html">Save</a> --}}
                </div>
            </form>
        </div>
    </div>
    <!-- page section end -->
    </div>
    </div>
@endsection
