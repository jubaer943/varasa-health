@extends('master')

@section('content')
    @include('nav')
    <!-- page section start -->
    <div class="page-body">
        <a class="go_back" href="OurService.html">
            <img src="{{ asset('assets/images/arrow-left.png') }}" alt="varasa arrow-left icon">
            <p>Back</p>
        </a>
        <div class="page-border Video-Consultation">
            <h1>{{ $updateCaregiver ? 'Edit ' . $updateCaregiver->service_name : 'Add New Nurse Caregiver & Others' }}
            </h1>
            <form
                action="{{ $updateCaregiver ? route('update.caregiver', ['service_id' => $service_id]) : route('caregiver.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if ($updateCaregiver)
                    @method('PUT')
                @endif
                <div class="img-upload-section">
                    <label for="SetIcon"><b>Set Icon</b> (65*65 px jpeg, png, svg)</label>
                    <div>
                        <div>
                            <img src="{{ $updateCaregiver && $updateCaregiver->service_icon ? url('storage/' . $updateCaregiver->service_icon) : asset('assets/images/upload-image.png') }}"
                                class="setIcon-btn upload-btn1 preview1" alt="image upload icon"
                                {{ $updateCaregiver && $updateCaregiver->service_icon ? 'width=100 height=100 style=object-fit:contain' : '' }}>
                            <input type="file" name="service_icon" class="setIcon file1">
                        </div>
                    </div>
                </div>

                <div class="input-section">
                    <label for="Name"><b>Name</b></label>
                    <input type="text" name="Name" id="Name" value="{{ $updateCaregiver->service_name ?? null }}"
                        placeholder="Nurse Medical Assistant">
                </div>

                <div class="img-upload-section">
                    <label for="SetIcon"><b>Upload Cover Image</b> (65*65 px jpeg, png, svg)</label>
                    <div>
                        <div>
                            <img src="{{ $updateCaregiver && $updateCaregiver->cover_image ? url('storage/' . $updateCaregiver->cover_image) : asset('assets/images/upload-image.png') }}"
                                class="setIcon-btn upload-btn2 preview2" alt="image upload icon"
                                {{ $updateCaregiver && $updateCaregiver->cover_image ? 'width=100 height=100 style=object-fit:contain' : '' }}>
                            <input type="file" name="cover_image" class="setIcon file2 ">
                        </div>
                    </div>
                </div>



                @php
                    // Convert advance_price to a collection for easy lookup
                    $advancePrices = collect($updateCaregiver->advancePrice ?? []);

                    // Define available services
                    $services = [
                        'weekly_8' => 'Weekly - 8 Hours',
                        'weekly_12' => 'Weekly - 12 Hours',
                        'weekly_16' => 'Weekly - 16 Hours',
                        'weekly_24' => 'Weekly - 24 Hours',
                        'monthly_8' => 'Monthly - 8 Hours',
                        'monthly_12' => 'Monthly - 12 Hours',
                        'monthly_16' => 'Monthly - 16 Hours',
                        'monthly_24' => 'Monthly - 24 Hours',
                    ];
                @endphp

                <div class="service-fee-details active_NurseCaregiver">
                    <div>
                        @foreach (['weekly_8', 'weekly_12', 'weekly_16', 'weekly_24'] as $key)
                            @php
                                $priceData = $advancePrices->firstWhere('service', $services[$key]);

                                $priceValue = $priceData ? $priceData['price'] : '';
                                $checked = $priceData ? 'checked' : ''; // Checkbox should be checked if updating
                            @endphp

                            <div>
                                <input type="checkbox" name="service[{{ $key }}]" value="{{ $services[$key] }}"
                                    class="service-check" {{ $checked }}>
                                <div class="service-info">{{ $services[$key] }}</div>
                                <input type="text" name="price[{{ $key }}]" class="service-info"
                                    placeholder="Price" value="{{ $priceValue }}">
                            </div>
                        @endforeach
                    </div>
                    <div>
                        @foreach (['monthly_8', 'monthly_12', 'monthly_16', 'monthly_24'] as $key)
                            @php
                                $priceData = $advancePrices->firstWhere('service', $services[$key]);
                                $priceValue = $priceData ? $priceData['price'] : '';
                                $checked = $priceData ? 'checked' : ''; // Checkbox should be checked if updating
                            @endphp
                            <div>
                                <input type="checkbox" name="service[{{ $key }}]" value="{{ $services[$key] }}"
                                    class="service-check" {{ $checked }}>
                                <div class="service-info">{{ $services[$key] }}</div>
                                <input type="number" name="price[{{ $key }}]" class="service-info"
                                    placeholder="Price" value="{{ $priceValue }}">
                            </div>
                        @endforeach
                    </div>
                </div>



                <div class="input-section Activities-section">
                    <label for="Activities"><b>Activities</b></label>
                    <div class="all-activities">
                        @if ($updateCaregiver !== null)
                            @if ($updateCaregiver->activities->isNotEmpty())
                                @foreach ($updateCaregiver->activities as $activitie)
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
                        @if ($updateCaregiver !== null)
                            @if ($updateCaregiver->faqs->isNotEmpty())
                                @foreach ($updateCaregiver->faqs as $faq)
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

                <button class="" type="submit">
                    Save
                </button>
            </form>
        </div>
    </div>
    <!-- page section end -->
    </div>
    </div>
@endsection
