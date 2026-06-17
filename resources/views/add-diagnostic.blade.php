@extends('master')

@section('content')
    @include('nav')

    <!-- page section start -->
    <div class="page-body">
        <a class="go_back" href="#">
            <img src="{{ asset('assets/images/arrow-left.png') }}" alt="varasa arrow-left icon">
            <p>Back</p>
        </a>
        <div class="urin_test page-border">
            <h1>{{ $update ? 'Update' : 'Add' }} Diagnostic Sample Collection</h1>
            <form action="{{ $update ? route('update.diagnostic', ['id' => $update->id]) : route('diagnostic.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if ($update)
                    @method('PUT')
                @endif
                <div class="TestName">
                    <label for="TestName">Test Name</label>
                    <input type="text" name="testname" value="{{ $update->test_name ?? null }}" placeholder="Urine Test"
                        required>
                </div>

                <div class="all-diagnostic">
                    <div class="diagnostic">
                        @if ($update)

                            @if ($update->Hospital->isNotEmpty())
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($update->Hospital as $hospital)
                                    <div class="item">
                                        <div class="urin-test-bottom urin-test-one diagnostic-content">
                                            <div class="HospitalName">
                                                <label for="HospitalName">Hospital Name</label>
                                                <input type="text" name="hospitals[{{ $hospital->id }}][name]"
                                                    value="{{ $hospital->hospital_name }}" placeholder="Hospital Name"
                                                    required="">
                                            </div>
                                            <div class="TestPrice">
                                                <label for="TestPrice">Test Price</label>
                                                <input type="text" name="hospitals[{{ $hospital->id }}][price]"
                                                    value="{{ $hospital->test_price }}" placeholder="Test Price"
                                                    required="">
                                            </div>
                                            <input type="hidden" name="hospitals[{{ $hospital->id }}][id]"
                                                value="{{ $hospital->id }}">
                                            <div class="Test-btns Test-btns-top">
                                                <input type="file" name="hospitals[{{ $hospital->id }}][image]"
                                                    class="hospital_image file1" style="display:none" accept="image/*">
                                                <button type="button" onclick="UploadFuncn(this)">
                                                    <img src="{{ url('storage/' . $hospital->hospital_image) }}"
                                                        alt="Upload Image" class="preview-img" width="30" height="30"
                                                        style="object-fit: contain">
                                                </button>
                                                <button type="button" onclick="editDiagnostic(this)"
                                                    class="edit">Edit</button>
                                                <button type="button" onclick="deleteDiagnostic(this)">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            @endif

                        @endif
                    </div>
                    <div class="diagnostic"></div>
                </div>
                <div class="urin-test-bottom">
                    <div class="HospitalName">
                        <input type="text" class="hospital_name" placeholder="Hospital Name">
                    </div>
                    <div class="TestPrice">
                        <input type="text" class="test_price" placeholder="500">
                    </div>
                    <div class="Test-btns">
                        <button type="button" class="upload-btn">
                            <input type="file" class="setIcon file1" name="hospital_image">
                            <img src="{{ asset('assets/images/upload-image.png') }}" alt="img-upload">
                        </button>
                        <button type="button" class="delete-btn diagnostic-btn">Add</button>
                    </div>
                </div>
                <button type="submit" class="diagnostic-add-btn">Save</button>
            </form>
        </div>
    </div>
    <!-- page section end -->
    </div>
    </div>


    <script>
        function UploadFuncn(button) {
            let fileInput = button.previousElementSibling; // Select the file input inside the same parent div
            fileInput.click(); // Trigger file input dialog

            // Listen for file selection and display the selected file preview
            fileInput.addEventListener("change", function() {
                if (fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Create an image element to display the preview
                        let previewImage = button.querySelector('.preview-img');
                        previewImage.src = e.target.result; // Set the image source to the uploaded file
                        previewImage.style.display = 'block'; // Make the preview image visible
                        previewImage.style.width = '50';
                        previewImage.style.height = '50';
                        previewImage.style.objectFit = 'contain'

                        // Change button image after upload
                        // button.innerHTML = `<img src="assets/images/upload-success.png" alt="Uploaded">`;
                    };

                    reader.readAsDataURL(file); // Read the file as a data URL
                }
            });
        }

        function UploadFunc(ElemSelector1, ElemSelector2) {
            const element1 = document.querySelector(ElemSelector1);
            const element2 = document.querySelector(ElemSelector2);

            if (element1 && element2) {
                element1.addEventListener("click", (() => {
                    element2.click();
                }));
            }
        }

        // add diagnostic start
        const diagnostic_btn = document.querySelector('.diagnostic-btn');
        const diagnostic = document.querySelector('.diagnostic');
        let counter = 0; // Counter for dynamically created fields

        function AddDiagnostic() {
            const hospital_name = document.querySelector('.hospital_name').value;
            const test_price = document.querySelector('.test_price').value;

            // Validate the input
            if (hospital_name === '' || test_price === '') {
                alert('Please fill in both fields before adding!');
                return;
            }

            // Increment the counter for unique names
            counter++;

            // Create new item div
            const newItem = document.createElement('div');
            newItem.classList.add('item');
            let upImge = "{{ asset('assets/images/upload-image.png') }}"
            newItem.innerHTML = `
                <div class="urin-test-bottom urin-test-one diagnostic-content">
                    <div class="HospitalName">
                        <label for="HospitalName">Hospital Name</label>
                        <input type="text" name="hospitals[${counter}][name]" value="${hospital_name}" placeholder="Hospital Name" required>
                    </div>
                    <div class="TestPrice">
                        <label for="TestPrice">Test Price</label>
                        <input type="text" name="hospitals[${counter}][price]" value="${test_price}" placeholder="Test Price" required>
                    </div>
                <div class="Test-btns Test-btns-top">
                    <input type="file" name="hospitals[${counter}][image]" class="hospital_image file1" style="display:none" accept="image/*" required>
                    <button type="button" onclick="UploadFuncn(this)">
                        <img src="${upImge}" alt="Upload Image" class="preview-img" >
                        </button>

                        <button type="button" onclick="editDiagnostic(this)" class="edit">Edit</button>
                        <button type="button" onclick="deleteDiagnostic(this)">Delete</button>
                    </div>
                </div>
            `;

            // Append the new item to the list
            document.querySelector('.diagnostic').appendChild(newItem);

            // Reset the input fields
            document.querySelector('.hospital_name').value = '';
            document.querySelector('.test_price').value = '';
        }

        // Handle 'Add More' button click
        document.querySelector('.diagnostic-btn').addEventListener("click", AddDiagnostic);

        // Handle delete functionality
        function deleteDiagnostic(element) {
            element.closest('.item').remove();
        }

        // Handle edit functionality (if needed)
        function editDiagnostic(element) {
            // You can add the logic to edit the fields here
            alert('Edit functionality can be added here!');
        }
    </script>
@endsection
