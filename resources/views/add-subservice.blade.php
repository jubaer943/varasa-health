@extends('master')

@section('content')
    @include('nav')

    <!-- page section start -->
    <div class="page-body">
        <a class="go_back" href="OurSubService.html">
            <img src="{{ asset('assets/images/arrow-left.png') }}" alt="varasa arrow-left icon">
            <p>Back</p>
        </a>
        <div class="page-border Video-Consultation">
            <h1>Nurse Home Service</h1>
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="img-upload-section">
                    <label for="SetIcon"><b>Set Icon</b> (65*65 px jpeg, png, svg)</label>
                    <div>
                        <div>
                            <img src="{{ asset('assets/images/upload-image.png') }}" class="setIcon-btn upload-btn1"
                                alt="image upload icon">
                            <input type="file" class="setIcon file1" name="service_icon">
                        </div>
                    </div>
                </div>

                <div class="input-section">
                    <label for="Name"><b>Name</b></label>
                    <input type="text" name="Name" id="Name" placeholder="Cannula">
                </div>

                <div class="img-upload-section">
                    <label for="SetIcon"><b>Upload Cover Image</b> (65*65 px jpeg, png, svg)</label>
                    <div>
                        <div>
                            <img src="{{ asset('assets/images/upload-image.png') }}" class="setIcon-btn upload-btn2"
                                alt="image upload icon">
                            <input type="file" class="setIcon file2" name="cover_image">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="switch">
                        <input type="checkbox" name="service_fee_type" value="1" id="advanced-service" checked><span
                            class="slider slider-black"></span>
                        <input type="hidden" name="service_fee_type" value="0">
                    </label>
                    <label for="advanced-service">Advanced service fee</label>
                </div>

                <div class="input-section">
                    <label for="ServiceFees"><b>Service Fees</b></label>
                    <input type="text" name="ServiceFees" id="ServiceFees" placeholder="500BDT">
                </div>

                <div class="input-section Activities-section">
                    <label for="Activities"><b>Activities</b></label>
                    <div class="all-activities">
                        <div class="activities"></div>
                    </div>
                    <div class="input-area">
                        <div>
                            <input type="text" name="Activities[]" class="activities-input" placeholder="Write Here">
                        </div>
                        <button type="button" class="activities_btn">Add</button>
                    </div>
                </div>

                <div class="input-section FAQ-section">
                    <label for="FAQ"><b>FAQ</b></label>
                    <div class="all-faq">
                        <div class="faq"></div>
                    </div>
                    <div class="input-area">
                        <div>
                            <input type="text" name="FAQ[question][]" class="FAQ_input" placeholder="Question Here">
                            <input type="text" name="FAQ[answer][]" class="Answer_input" placeholder="Answer Here">
                        </div>
                        <button type="button" class="FAQ_btn">Add</button>
                    </div>
                </div>

                <button class="sub_nurse_submit" type="submit">Save</button>
            </form>
        </div>
    </div>
    <!-- page section end -->
    </div>
    </div>
@endsection
