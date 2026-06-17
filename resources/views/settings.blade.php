@extends('master')

@section('content')
    @include('nav')

    <!-- page section start -->
    <div class="page-body">
        <div class="page-border">
            <div class="search">
                <img src="assets/images/search.png" alt="varasa search icon">
                <input type="text" name="search" id="search" placeholder="Search" autofocus>
            </div>

            <div class="setting">
                <div class="setting-left">
                    <div class="setting-btns">
                        <button class="active-btn buttons" type="button">
                            <p>Privacy Policy</p>
                            <img src="assets/images/arrow-right-white.png" alt="">
                        </button>
                        <button class="buttons" type="button">
                            <p>About Us</p>
                            <img src="assets/images/arrow-right-green.png" alt="">
                        </button>
                        <button class="buttons" type="button">
                            <p>Contact Us</p>
                            <img src="assets/images/arrow-right-green.png" alt="">
                        </button>
                    </div>
                </div>

                <div class="setting-right">

                    <!-- Privacy Policies -->
                    <div class="contents Privacy-policy active_section">
                        <div class="user-professional">
                            <button class="user-pro-btn1 active-user-pro-btn" type="button">User</button>
                            <button class="user-pro-btn1" type="button">Professional</button>
                        </div>

                        <form id="privacyFormUser" class="privacy-form user-pro-contents1 active-user-pro-contents">
                            <h3>User Privacy Policy</h3>
                            <div class="Published">
                                <button type="button">v1.1.0</button>
                                <p>Published on <span>February, 2023</span></p>
                            </div>
                            <div class="policy_text_area">
                                <div class="quill-editor" style="height: 300px;"></div>
                                <textarea class="quill-editor-area d-none" style="display: none"
                                    data-content="{{ $userPrivacyPolicy->privacy_policy_description }}"></textarea>
                            </div>
                        </form>

                        <form id="privacyFormProfessional" class="privacy-form user-pro-contents1">
                            <h3>Professional Privacy Policy</h3>
                            <div class="Published">
                                <button type="button">v1.1.0</button>
                                <p>Published on <span>February, 2023</span></p>
                            </div>
                            <div class="policy_text_area">
                                <div class="quill-editor" style="height: 300px;"></div>
                                <textarea class="quill-editor-area d-none" style="display: none"
                                    data-content="{{ $professionalPrivacyPolicy->privacy_policy_description }}"></textarea>
                            </div>
                        </form>

                        <button id="savePrivacyPolicy" class="save" type="button">Save Privacy Policies</button>
                    </div>

                    <!-- About Us -->
                    <div class="contents About-us">
                        <div class="user-professional">
                            <button class="user-pro-btn2 active-user-pro-btn" type="button">User</button>
                            <button class="user-pro-btn2" type="button">Professional</button>
                        </div>

                        <form id="aboutFormUser" class="privacy-form user-pro-contents2 active-user-pro-contents">
                            <h3>User About Us</h3>
                            <div class="policy_text_area">
                                <div class="quill-editor" style="height: 300px;"></div>
                                <textarea class="quill-editor-area d-none" style="display:none" data-content="{{ $userAbout->about_description }}"></textarea>
                            </div>
                        </form>

                        <form id="aboutFormProfessional" class="privacy-form user-pro-contents2">
                            <h3>Professional About Us</h3>
                            <div class="policy_text_area">
                                <div class="quill-editor" style="height: 300px;"></div>
                                <textarea class="quill-editor-area d-none" style="display:none"
                                    data-content="{{ $professionalAbout->about_description }}"></textarea>
                            </div>
                        </form>

                        <button id="saveAboutUs" class="save" type="button">Save About Us</button>
                    </div>

                    <!-- Contact Us (you can keep as it is) -->
                    <div class="contents Contact-us">
                        <form action="#">
                            <h3>Contact Us</h3>
                            <div class="contact-us-input">
                                <img src="assets/images/call.png" alt="varasa call icon">
                                <input class="contact-input" type="text" name="contactUs" id="contactUs"
                                    placeholder="665656">
                                <img class="contact-edit" src="assets/images/edit-2.png" alt="varasa edit icon">
                            </div>
                            <button class="save" type="submit">Save</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- page section end -->

    <!-- Optional: Loading Spinner -->
    <div id="loadingSpinner" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%);">
        <img src="/assets/images/spinner.gif" alt="Loading...">
    </div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editorDivs = document.querySelectorAll('.quill-editor');
            var textareaFields = document.querySelectorAll('.quill-editor-area');

            editorDivs.forEach(function(editorDiv, index) {
                var quill = new Quill(editorDiv, {
                    theme: 'snow'
                });

                var initialContent = textareaFields[index].dataset.content;
                if (initialContent) {
                    quill.root.innerHTML = initialContent;
                }

                quill.on('text-change', function() {
                    textareaFields[index].value = quill.root.innerHTML;
                });
            });

            function showSpinner() {
                document.getElementById('loadingSpinner').style.display = 'block';
            }

            function hideSpinner() {
                document.getElementById('loadingSpinner').style.display = 'none';
            }

            document.getElementById('savePrivacyPolicy').addEventListener('click', function() {
                var userPrivacyContent = document.querySelector('#privacyFormUser .quill-editor-area')
                    .value;
                var professionalPrivacyContent = document.querySelector(
                    '#privacyFormProfessional .quill-editor-area').value;

                var data = {
                    user_privacy_policy: userPrivacyContent,
                    professional_privacy_policy: professionalPrivacyContent,
                };

                showSpinner();

                fetch('{{ url('/save-privacy-policies') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        hideSpinner();
                        alert('Privacy Policies saved successfully!');
                        console.log(data);
                    })
                    .catch(error => {
                        hideSpinner();
                        console.error('Error:', error);
                    });
            });

            document.getElementById('saveAboutUs').addEventListener('click', function() {
                var userAboutContent = document.querySelector('#aboutFormUser .quill-editor-area').value;
                var professionalAboutContent = document.querySelector(
                    '#aboutFormProfessional .quill-editor-area').value;

                var data = {
                    user_about: userAboutContent,
                    professional_about: professionalAboutContent,
                };

                showSpinner();

                fetch('{{ url('/save-about-us') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        hideSpinner();
                        alert('About Us saved successfully!');
                        console.log(data);
                    })
                    .catch(error => {
                        hideSpinner();
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection
