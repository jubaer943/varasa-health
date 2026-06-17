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
            <h1>{{ $updateService->service->name ?? null }}</h1>
            <form method="POST"
                action="{{ $updateService ? route('update.our-service', ['service_id' => $service_id]) : route('store.subservice', ['service_id' => $service_id]) }}"
                enctype="multipart/form-data">
                @csrf

                @if ($updateService)
                    @method('PUT')
                @endif
                <div class="img-upload-section">
                    <label for="SetIcon"><b>Set Icon</b> (65*65 px jpeg, png, svg)</label>
                    <div>
                        <div>
                            <img src="{{ $updateService && $updateService->service_icon ? url('storage/' . $updateService->service_icon) : asset('assets/images/upload-image.png') }} "
                                {{ $updateService && $updateService->service_icon ? 'width=100 height=100 style=object-fit: contain;' : '' }}
                                class="setIcon-btn upload-btn1 preview1" alt="image upload icon">
                            <input type="file" class="setIcon file1" name="service_icon">
                        </div>
                    </div>
                </div>

                <div class="input-section">
                    <label for="Name"><b>Name</b></label>
                    <input type="text" value="{{ $updateService->service->name ?? null }}" name="Name" id="Name"
                        placeholder="Cannula">
                </div>

                <div class="img-upload-section">
                    <label for="SetIcon"><b>Upload Cover Image</b> (65*65 px jpeg, png, svg)</label>
                    <div>
                        <div>
                            <img src="{{ $updateService && $updateService->cover_image ? url('storage/' . $updateService->cover_image) : asset('assets/images/upload-image.png') }}"
                                {{ $updateService && $updateService->cover_image ? 'width=100 height=100 style=object-fit:contain' : '' }}
                                class="setIcon-btn upload-btn2 preview2" alt="image upload icon">
                            <input type="file" class="setIcon file2" name="cover_image">
                        </div>
                    </div>
                </div>

                {{-- <div>
                    <label class="switch">
                        <input type="checkbox" name="service_fee_type" value="1" id="advanced-service" checked><span
                            class="slider slider-black"></span>
                        <input type="hidden" name="service_fee_type" value="0">
                    </label>
                    <label for="advanced-service">Advanced service fee</label>
                </div> --}}

                <div class="input-section">
                    <label for="ServiceFees"><b>Service Fees</b></label>
                    <input type="text" name="ServiceFees" id="ServiceFees"
                        value="{{ $updateService->service_fee ?? null }}" placeholder="500BDT">
                </div>

                <div class="input-section Activities-section">
                    <label for="Activities"><b>Activities</b></label>
                    <div class="all-activities">
                        @if ($updateService !== null)
                            @if ($updateService->activities->isNotEmpty())
                                @foreach ($updateService->activities as $activitie)
                                    <div class="activities">
                                        <div class="item">
                                            <input type="text" name="Activities[]" class="activities-write"
                                                value="{{ $activitie->activity }}" readonly>
                                            <input type="hidden" name="Activities_id[]" value="{{ $activitie->id }}">
                                            <div class="activities-btns">
                                                <button type="button" class="edit-btn"
                                                    onclick="editItem(this)">Edit</button>
                                                <button type="button" class="delete-btn"
                                                    onclick="deleteItem(this)">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                        <div class="activities"></div>
                    </div>
                    <div class="input-area">
                        <div>
                            <input type="text" name="" class="activities-input" placeholder="Write Here">
                        </div>
                        <button type="button" class="activities_btn">Add</button>
                    </div>
                </div>
                <div class="input-section FAQ-section">
                    <label for="FAQ"><b>FAQ</b></label>
                    <div class="all-faq">
                        @if ($updateService !== null)
                            @if ($updateService->faqs->isNotEmpty())
                                @foreach ($updateService->faqs as $faq)
                                    <div class="faq">
                                        <div class="item">
                                            <input type="text" name="FAQ[question][]" class="faq-question"
                                                value="{{ $faq->question }}" readonly>
                                            <input type="text" name="FAQ[answer][]" class="faq-answer"
                                                value="{{ $faq->answer }}" readonly>
                                            <input type="hidden" name="FAQ[id][]" value="{{ $faq->id }}">
                                            <div class="faq-btns">
                                                <button type="button" class="edit-btn"
                                                    onclick="editFAQ(this)">Edit</button>
                                                <button type="button" class="delete-btn"
                                                    onclick="deleteFAQ(this)">Delete</button>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            @endif
                        @endif
                        <div class="faq"></div>
                    </div>
                    <div class="input-area">
                        <div>
                            <input type="text" name="" class="FAQ_input" placeholder="Question Here">
                            <input type="text" name="" class="Answer_input" placeholder="Answer Here">
                        </div>
                        <button type="button" class="FAQ_btn">Add</button>
                    </div>
                </div>

                <button class="" type="submit">Save</button>
            </form>
        </div>
    </div>
    <!-- page section end -->
    </div>
    </div>
@endsection
