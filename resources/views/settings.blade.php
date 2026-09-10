@extends('master')

@section('content')

@include('nav')

<!-- =========================================================
        PAGE SECTION START
    ========================================================== -->

<div class="page-body">

    <div class="page-border">

        <!-- Search -->

        <div class="search">

            <img src="{{ asset('assets/images/search.png') }}" alt="varasa search icon">

            <input type="text" name="search" id="search" placeholder="Search" autofocus>

        </div>


        <!-- Settings Section -->

        <div class="setting">


            <!-- =========================================================
                    LEFT SETTINGS MENU
                ========================================================== -->

            <div class="setting-left">

                <div class="setting-btns">

                    <button class="active-btn buttons" type="button">

                        <p>Privacy Policy</p>

                        <img src="{{ asset('assets/images/arrow-right-white.png') }}" alt="">

                    </button>


                    <button class="buttons" type="button">

                        <p>Terms & Condition</p>

                        <img src="{{ asset('assets/images/arrow-right-white.png') }}" alt="">

                    </button>


                    <button class="buttons" type="button">

                        <p>About Us</p>

                        <img src="{{ asset('assets/images/arrow-right-green.png') }}" alt="">

                    </button>


                    <button class="buttons" type="button">

                        <p>Contact Us</p>

                        <img src="{{ asset('assets/images/arrow-right-green.png') }}" alt="">

                    </button>

                </div>

            </div>


            <!-- =========================================================
                    RIGHT SETTINGS CONTENT
                ========================================================== -->

            <div class="setting-right">


                <!-- =====================================================
                        PRIVACY POLICY
                    ====================================================== -->

                <div class="contents Privacy-policy active_section">


                    <!-- User / Professional Tabs -->

                    <div class="user-professional">

                        <button class="user-pro-btn1 active-user-pro-btn" type="button">
                            User
                        </button>


                        <button class="user-pro-btn1" type="button">
                            Professional
                        </button>

                    </div>


                    <!-- =================================================
                            USER PRIVACY POLICY
                        ================================================== -->

                    <form id="privacyFormUser" class="privacy-form user-pro-contents1 active-user-pro-contents"
                        onsubmit="return false;">

                        <h3>
                            User Privacy Policy
                        </h3>


                        <div class="Published">

                            <button type="button">
                                v1.1.0
                            </button>


                            <p>
                                Published on
                                <span>
                                    February, 2023
                                </span>
                            </p>

                        </div>


                        <div class="policy_text_area">


                            <!-- Quill Editor -->

                            <div class="quill-editor" style="height: 300px;"></div>


                            <!-- Hidden Data Storage -->

                            <textarea class="quill-editor-area" style="display: none;"
                                data-content="{{ $userPrivacyPolicy->privacy_policy_description ?? '' }}"></textarea>


                        </div>

                    </form>


                    <!-- =================================================
                            PROFESSIONAL PRIVACY POLICY
                        ================================================== -->

                    <form id="privacyFormProfessional" class="privacy-form user-pro-contents1" onsubmit="return false;">

                        <h3>
                            Professional Privacy Policy
                        </h3>


                        <div class="Published">

                            <button type="button">
                                v1.1.0
                            </button>


                            <p>
                                Published on
                                <span>
                                    February, 2023
                                </span>
                            </p>

                        </div>


                        <div class="policy_text_area">


                            <!-- Quill Editor -->

                            <div class="quill-editor" style="height: 300px;"></div>


                            <!-- Hidden Data Storage -->

                            <textarea class="quill-editor-area" style="display: none;"
                                data-content="{{ $professionalPrivacyPolicy->privacy_policy_description ?? '' }}"></textarea>


                        </div>

                    </form>


                    <!-- Save Privacy -->

                    <button id="savePrivacyPolicy" class="save" type="button">
                        Save Privacy Policies
                    </button>


                </div>

                <!-- =====================================================
                        TERMS & CONDITION
                    ====================================================== -->

                <div class="contents Privacy-policy ">


                    <!-- User / Professional Tabs -->

                    <div class="user-professional">

                        <button class="user-pro-btn3 active-user-pro-btn" type="button">
                            User
                        </button>


                        <button class="user-pro-btn3" type="button">
                            Professional
                        </button>

                    </div>


                    <!-- =================================================
                            USER PRIVACY POLICY
                        ================================================== -->

                    <form id="TermsFormUser" class="privacy-form user-pro-contents3 active-user-pro-contents"
                        onsubmit="return false;">

                        <h3>
                            User Terms & Condition
                        </h3>


                        <div class="Published">

                            <button type="button">
                                v1.1.0
                            </button>


                            <p>
                                Published on
                                <span>
                                    February, 2023
                                </span>
                            </p>

                        </div>


                        <div class="policy_text_area">


                            <!-- Quill Editor -->

                            <div class="quill-editor" style="height: 300px;"></div>


                            <!-- Hidden Data Storage -->

                            <textarea class="quill-editor-area" style="display: none;" data-content=""></textarea>


                        </div>

                    </form>


                    <!-- =================================================
                            PROFESSIONAL TERMS CONDITION
                        ================================================== -->

                    <form id="termsFormProfessional" class="privacy-form user-pro-contents3" onsubmit="return false;">

                        <h3>
                            Professional Terms & Condition
                        </h3>


                        <div class="Published">

                            <button type="button">
                                v1.1.0
                            </button>


                            <p>
                                Published on
                                <span>
                                    February, 2023
                                </span>
                            </p>

                        </div>


                        <div class="policy_text_area">


                            <!-- Quill Editor -->

                            <div class="quill-editor" style="height: 300px;"></div>


                            <!-- Hidden Data Storage -->

                            <textarea class="quill-editor-area" style="display: none;" data-content=""></textarea>


                        </div>

                    </form>


                    <!-- Save terms -->

                    <button id="saveTermsConditon" class="save" type="button">
                        Save Terms & Condition
                    </button>


                </div>



                <!-- =====================================================
                        ABOUT US
                    ====================================================== -->

                <div class="contents About-us">


                    <!-- User / Professional Tabs -->

                    <div class="user-professional">

                        <button class="user-pro-btn2 active-user-pro-btn" type="button">
                            User
                        </button>


                        <button class="user-pro-btn2" type="button">
                            Professional
                        </button>

                    </div>


                    <!-- =================================================
                            USER ABOUT US
                        ================================================== -->

                    <form id="aboutFormUser" class="privacy-form user-pro-contents2 active-user-pro-contents"
                        onsubmit="return false;">

                        <h3>
                            User About Us
                        </h3>


                        <div class="policy_text_area">


                            <!-- Quill Editor -->

                            <div class="quill-editor" style="height: 300px;"></div>


                            <!-- Hidden Data -->

                            <textarea class="quill-editor-area" style="display: none;"
                                data-content="{{ $userAbout->about_description ?? '' }}"></textarea>


                        </div>

                    </form>


                    <!-- =================================================
                            PROFESSIONAL ABOUT US
                        ================================================== -->

                    <form id="aboutFormProfessional" class="privacy-form user-pro-contents2" onsubmit="return false;">

                        <h3>
                            Professional About Us
                        </h3>


                        <div class="policy_text_area">


                            <!-- Quill Editor -->

                            <div class="quill-editor" style="height: 300px;"></div>


                            <!-- Hidden Data -->

                            <textarea class="quill-editor-area" style="display: none;"
                                data-content="{{ $professionalAbout->about_description ?? '' }}"></textarea>


                        </div>

                    </form>


                    <!-- Save About Us -->

                    <button id="saveAboutUs" class="save" type="button">
                        Save About Us
                    </button>


                </div>


                <!-- =====================================================
                        CONTACT US
                    ====================================================== -->

                <div class="contents Contact-us">


                    <form id="contactUsForm">


                        <h3>
                            Contact Us
                        </h3>


                        <div class="contact-us-input">


                            <img src="{{ asset('assets/images/call.png') }}" alt="varasa call icon">


                            <input class="contact-input" type="text" name="contactUs" id="contactUs"
                                placeholder="665656">


                            <img class="contact-edit" src="{{ asset('assets/images/edit-2.png') }}"
                                alt="varasa edit icon">


                        </div>


                        <button id="saveContactUs" class="save" type="submit">
                            Save
                        </button>


                    </form>


                </div>


            </div>

        </div>

    </div>

</div>


<!-- =========================================================
        PAGE SECTION END
    ========================================================== -->


<!-- =========================================================
        QUILL CSS
    ========================================================== -->

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


<!-- =========================================================
        QUILL JS
    ========================================================== -->

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>


<!-- =========================================================
        BUTTON LOADING CSS
    ========================================================== -->

<style>
    .save {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }


    .save:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }


    .btn-loader {
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255, 255, 255, 0.4);
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: buttonSpin 0.7s linear infinite;
    }


    @keyframes buttonSpin {

        to {
            transform: rotate(360deg);
        }

    }
</style>


<!-- =========================================================
        JAVASCRIPT
    ========================================================== -->

<script>
    document.addEventListener('DOMContentLoaded', function () {


            /*
            |--------------------------------------------------------------------------
            | CSRF TOKEN
            |--------------------------------------------------------------------------
            */

            var csrfToken = '{{ csrf_token() }}';


            /*
            |--------------------------------------------------------------------------
            | QUILL EDITOR INITIALIZATION
            |--------------------------------------------------------------------------
            |
            | Default Quill toolbar.
            | Your existing editor design is preserved.
            |
            */

            var editorDivs = document.querySelectorAll(
                '.quill-editor'
            );


            editorDivs.forEach(function (editorDiv) {


                /*
                |--------------------------------------------------------------------------
                | FIND RELATED TEXTAREA
                |--------------------------------------------------------------------------
                */

                var policyTextArea = editorDiv.parentElement;


                var textarea = policyTextArea.querySelector(
                    '.quill-editor-area'
                );


                /*
                |--------------------------------------------------------------------------
                | INITIALIZE QUILL
                |--------------------------------------------------------------------------
                */

                var quill = new Quill(
                    editorDiv,
                    {
                        theme: 'snow'
                    }
                );


                /*
                |--------------------------------------------------------------------------
                | GET INITIAL HTML CONTENT
                |--------------------------------------------------------------------------
                |
                | Blade automatically escapes attribute content.
                | Browser dataset returns the original HTML value.
                |
                */

                var initialContent = '';


                if (textarea) {

                    initialContent =
                        textarea.getAttribute(
                            'data-content'
                        ) || '';

                }


                /*
                |--------------------------------------------------------------------------
                | LOAD CONTENT INTO QUILL
                |--------------------------------------------------------------------------
                */

                if (initialContent) {

                    quill.root.innerHTML =
                        initialContent;

                }


                /*
                |--------------------------------------------------------------------------
                | STORE INITIAL VALUE
                |--------------------------------------------------------------------------
                */

                if (textarea) {

                    textarea.value =
                        quill.root.innerHTML;

                }


                /*
                |--------------------------------------------------------------------------
                | UPDATE TEXTAREA ON EDIT
                |--------------------------------------------------------------------------
                */

                quill.on(
                    'text-change',
                    function () {

                        if (textarea) {

                            textarea.value =
                                quill.root.innerHTML;

                        }

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | STORE QUILL INSTANCE
                |--------------------------------------------------------------------------
                */

                editorDiv.quill = quill;


            });


            /*
            |--------------------------------------------------------------------------
            | BUTTON LOADING START
            |--------------------------------------------------------------------------
            */

            function startButtonLoading(button) {


                if (!button) {
                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | PREVENT DOUBLE CLICK
                |--------------------------------------------------------------------------
                */

                if (button.disabled) {
                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | STORE ORIGINAL TEXT
                |--------------------------------------------------------------------------
                */

                button.dataset.originalHtml =
                    button.innerHTML;


                button.disabled = true;


                button.innerHTML =
                    '<span class="btn-loader"></span>' +
                    '<span>Saving...</span>';


            }


            /*
            |--------------------------------------------------------------------------
            | BUTTON LOADING STOP
            |--------------------------------------------------------------------------
            */

            function stopButtonLoading(button) {


                if (!button) {
                    return;
                }


                button.disabled = false;


                if (button.dataset.originalHtml) {

                    button.innerHTML =
                        button.dataset.originalHtml;

                }


            }


            /*
            |--------------------------------------------------------------------------
            | GET ERROR MESSAGE
            |--------------------------------------------------------------------------
            */

            function getErrorMessage(responseData) {


                if (!responseData) {

                    return 'Something went wrong.';

                }


                /*
                |--------------------------------------------------------------------------
                | LARAVEL VALIDATION ERRORS
                |--------------------------------------------------------------------------
                */

                if (responseData.errors) {


                    var messages = [];


                    Object.keys(
                        responseData.errors
                    ).forEach(
                        function (key) {


                            var errors =
                                responseData.errors[key];


                            if (
                                Array.isArray(errors)
                            ) {


                                errors.forEach(
                                    function (message) {

                                        messages.push(
                                            message
                                        );

                                    }
                                );


                            }


                        }
                    );


                    if (
                        messages.length > 0
                    ) {

                        return messages.join(
                            '\n'
                        );

                    }


                }


                return (
                    responseData.message ||
                    'Something went wrong.'
                );


            }


            /*
            |--------------------------------------------------------------------------
            | REUSABLE AJAX UPDATE FUNCTION
            |--------------------------------------------------------------------------
            |
            | Usage:
            |
            | ajaxUpdate({
            |     url: '...',
            |     button: this,
            |     data: {},
            |     successMessage: '...'
            | });
            |
            */

            async function ajaxUpdate(options) {


                options = options || {};


                var url =
                    options.url || '';


                var button =
                    options.button || null;


                var data =
                    options.data || {};


                var method =
                    options.method || 'POST';


                var successMessage =
                    options.successMessage ||
                    'Updated successfully!';


                /*
                |--------------------------------------------------------------------------
                | CHECK URL
                |--------------------------------------------------------------------------
                */

                if (!url) {


                    console.error(
                        'AJAX Error: URL is required.'
                    );


                    alert(
                        'Update URL is missing.'
                    );


                    return null;


                }


                /*
                |--------------------------------------------------------------------------
                | START BUTTON LOADING
                |--------------------------------------------------------------------------
                */

                startButtonLoading(
                    button
                );


                try {


                    /*
                    |--------------------------------------------------------------------------
                    | FETCH REQUEST
                    |--------------------------------------------------------------------------
                    */

                    var response = await fetch(
                        url,
                        {

                            method: method,

                            headers: {

                                'Content-Type':
                                    'application/json',

                                'Accept':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    csrfToken,

                                'X-Requested-With':
                                    'XMLHttpRequest'

                            },

                            body: JSON.stringify(
                                data
                            )

                        }
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | GET RESPONSE AS TEXT FIRST
                    |--------------------------------------------------------------------------
                    |
                    | This prevents:
                    | Unexpected token < in JSON
                    |
                    */

                    var responseText =
                        await response.text();


                    var responseData = null;


                    /*
                    |--------------------------------------------------------------------------
                    | PARSE JSON SAFELY
                    |--------------------------------------------------------------------------
                    */

                    if (responseText) {


                        try {

                            responseData =
                                JSON.parse(
                                    responseText
                                );

                        } catch (error) {


                            console.error(
                                'Invalid server response:',
                                responseText
                            );


                            throw new Error(
                                'Server returned an invalid response. Please check Laravel logs.'
                            );


                        }


                    }


                    /*
                    |--------------------------------------------------------------------------
                    | HTTP ERROR
                    |--------------------------------------------------------------------------
                    */

                    if (!response.ok) {


                        throw new Error(
                            getErrorMessage(
                                responseData
                            )
                        );


                    }


                    /*
                    |--------------------------------------------------------------------------
                    | CUSTOM ERROR RESPONSE
                    |--------------------------------------------------------------------------
                    */

                    if (
                        responseData &&
                        responseData.success === false
                    ) {


                        throw new Error(
                            getErrorMessage(
                                responseData
                            )
                        );


                    }


                    /*
                    |--------------------------------------------------------------------------
                    | SUCCESS
                    |--------------------------------------------------------------------------
                    */

                    alert(
                        (
                            responseData &&
                            responseData.message
                        )
                            ?
                            responseData.message
                            :
                            successMessage
                    );


                    return responseData;


                } catch (error) {


                    console.error(
                        'AJAX Update Error:',
                        error
                    );


                    alert(
                        error.message ||
                        'Something went wrong.'
                    );


                    return null;


                } finally {


                    /*
                    |--------------------------------------------------------------------------
                    | RESTORE BUTTON
                    |--------------------------------------------------------------------------
                    */

                    stopButtonLoading(
                        button
                    );


                }


            }


            /*
            |--------------------------------------------------------------------------
            | MAKE FUNCTION GLOBAL
            |--------------------------------------------------------------------------
            */

            window.ajaxUpdate =
                ajaxUpdate;


            /*
            |--------------------------------------------------------------------------
            | SAVE PRIVACY POLICY
            |--------------------------------------------------------------------------
            */

            var savePrivacyButton =
                document.getElementById(
                    'savePrivacyPolicy'
                );


            if (savePrivacyButton) {


                savePrivacyButton.addEventListener(
                    'click',
                    async function () {


                        var userPrivacyTextarea =
                            document.querySelector(
                                '#privacyFormUser .quill-editor-area'
                            );


                        var professionalPrivacyTextarea =
                            document.querySelector(
                                '#privacyFormProfessional .quill-editor-area'
                            );


                        await ajaxUpdate(
                            {


                                url:
                                    '{{ url('/settings/save-privacy-policies') }}',


                                method:
                                    'POST',


                                button:
                                    this,


                                data: {


                                    user_privacy_policy:
                                        userPrivacyTextarea
                                            ?
                                            userPrivacyTextarea.value
                                            :
                                            '',


                                    professional_privacy_policy:
                                        professionalPrivacyTextarea
                                            ?
                                            professionalPrivacyTextarea.value
                                            :
                                            ''


                                },


                                successMessage:
                                    'Privacy Policies saved successfully!'


                            }
                        );


                    }
                );


            }



            /*
            |--------------------------------------------------------------------------
            | SAVE Terms & Condition
            |--------------------------------------------------------------------------
            */

            var saveTermsButton =
                document.getElementById(
                    'saveTermsConditon'
                );


            if (saveTermsButton) {


                saveTermsButton.addEventListener(
                    'click',
                    async function () {


                        var userTermsTextarea =
                            document.querySelector(
                                '#TermsFormUser .quill-editor-area'
                            );


                        var professionalTermsTextarea =
                            document.querySelector(
                                '#termsFormProfessional .quill-editor-area'
                            );


                        await ajaxUpdate(
                            {


                                url:
                                    '{{ url('/settings/save-terms-condition') }}',


                                method:
                                    'POST',


                                button:
                                    this,


                                data: {


                                    user_terms_condition:
                                        userTermsTextarea
                                            ?
                                            userTermsTextarea.value
                                            :
                                            '',


                                    professional_terms_condition:
                                        professionalTermsTextarea
                                            ?
                                            professionalTermsTextarea.value
                                            :
                                            ''


                                },


                                successMessage:
                                    'Terms & Conditon saved successfully!'


                            }
                        );


                    }
                );


            }


            /*
            |--------------------------------------------------------------------------
            | SAVE ABOUT US
            |--------------------------------------------------------------------------
            */

            var saveAboutButton =
                document.getElementById(
                    'saveAboutUs'
                );


            if (saveAboutButton) {


                saveAboutButton.addEventListener(
                    'click',
                    async function () {


                        var userAboutTextarea =
                            document.querySelector(
                                '#aboutFormUser .quill-editor-area'
                            );


                        var professionalAboutTextarea =
                            document.querySelector(
                                '#aboutFormProfessional .quill-editor-area'
                            );


                        await ajaxUpdate(
                            {


                                url:
                                    '{{ url('settings/save-about-us') }}',


                                method:
                                    'POST',


                                button:
                                    this,


                                data: {


                                    user_about:
                                        userAboutTextarea
                                            ?
                                            userAboutTextarea.value
                                            :
                                            '',


                                    professional_about:
                                        professionalAboutTextarea
                                            ?
                                            professionalAboutTextarea.value
                                            :
                                            ''


                                },


                                successMessage:
                                    'About Us saved successfully!'


                            }
                        );


                    }
                );


            }


            /*
            |--------------------------------------------------------------------------
            | SAVE CONTACT US
            |--------------------------------------------------------------------------
            */

            var contactUsForm =
                document.getElementById(
                    'contactUsForm'
                );


            if (contactUsForm) {


                contactUsForm.addEventListener(
                    'submit',
                    async function (event) {


                        event.preventDefault();


                        var contactInput =
                            document.getElementById(
                                'contactUs'
                            );


                        var saveContactButton =
                            document.getElementById(
                                'saveContactUs'
                            );


                        var contactValue =
                            contactInput
                                ?
                                contactInput.value.trim()
                                :
                                '';


                        /*
                        |--------------------------------------------------------------------------
                        | BASIC VALIDATION
                        |--------------------------------------------------------------------------
                        */

                        if (!contactValue) {


                            alert(
                                'Please enter contact information.'
                            );


                            return;


                        }


                        /*
                        |--------------------------------------------------------------------------
                        | AJAX UPDATE
                        |--------------------------------------------------------------------------
                        */

                        await ajaxUpdate(
                            {


                                url:
                                    '{{ url('/save-contact-us') }}',


                                method:
                                    'POST',


                                button:
                                    saveContactButton,


                                data: {


                                    contact_us:
                                        contactValue


                                },


                                successMessage:
                                    'Contact information saved successfully!'


                            }
                        );


                    }
                );


            }


        });

</script>

@endsection