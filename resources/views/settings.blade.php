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
                        <p>Refund Policy</p>
                        <img src="{{ asset('assets/images/arrow-right-green.png') }}" alt="">
                    </button>

                    <button class="buttons" type="button">
                        <p>About Us</p>
                        <img src="{{ asset('assets/images/arrow-right-green.png') }}" alt="">
                    </button>


                    <button class="buttons" type="button">

                        <p>Contact & Website Info</p>

                        <img src="{{ asset('assets/images/arrow-right-green.png') }}" alt="">

                    </button>


                    <button class="buttons" type="button">

                        <p>App Download Links</p>

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
                                data-content="{{ $userPrivacyPolicy->description ?? '' }}"></textarea>


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
                                data-content="{{ $professionalPrivacyPolicy->description ?? '' }}"></textarea>


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
                            <textarea class="quill-editor-area" style="display: none;"
                                data-content="{{ $userTermsCondition->description ?? '' }}"></textarea>


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
                            <textarea class="quill-editor-area" style="display: none;"
                                data-content="{{ $professionalTermsCondition->description ?? '' }}"></textarea>
                        </div>
                    </form>

                    <!-- Save terms -->
                    <button id="saveTermsConditon" class="save" type="button">
                        Save Terms & Condition
                    </button>
                </div>

                <!-- =====================================================
                        REFUND POLICY
                    ====================================================== -->

                <div class="contents Refund-policy">
                    <form id="refundPolicyForm" class="privacy-form" onsubmit="return false;">
                        <h3>
                            Cancellation & Refund Policy
                        </h3>

                        <div class="Published">
                            <button type="button">v1.0.0</button>
                            <p>Published on <span>Website</span></p>
                        </div>

                        <div class="policy_text_area">
                            <!-- Quill Editor -->
                            <div class="quill-editor" style="height: 320px;"></div>

                            <!-- Hidden Data Storage -->
                            <textarea class="quill-editor-area" style="display: none;"
                                data-content="{{ $refundPolicy->description ?? '' }}"></textarea>
                        </div>

                        <!-- Save refund policy -->
                        <button id="saveRefundPolicy" class="save" type="button" style="margin-top: 25px;">
                            Save Refund Policy
                        </button>
                    </form>
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

                    <form id="contactUsForm" onsubmit="return false;">

                        <h3>
                            Contact & Public Website Info
                        </h3>

                        <p style="font-size: 13px; color: #64748b; margin-top: 5px; margin-bottom: 20px;">
                            Manage emergency helplines, WhatsApp dispatch, support email, Dhaka clinic address, service coverage, and social media links displayed across the public landing page.
                        </p>

                        <!-- Primary Helpline Phone -->
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">
                                Primary Helpline Phone Number *
                            </label>
                            <div class="contact-us-input" style="margin-top: 0;">
                                <input class="contact-input" type="text" name="helpline_number" id="contactUs"
                                    value="{{ $siteSettings['helpline_number'] ?? $contactUs->description ?? '01859-382953' }}"
                                    placeholder="01859-382953">
                            </div>
                        </div>

                        <!-- Alternate Helpline Phone -->
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">
                                Secondary / Alternate Phone Number
                            </label>
                            <div class="contact-us-input" style="margin-top: 0;">
                                <input class="contact-input" type="text" name="helpline_alt" id="helplineAlt"
                                    value="{{ $siteSettings['helpline_alt'] ?? '01859-382253' }}"
                                    placeholder="01859-382253">
                            </div>
                        </div>

                        <!-- WhatsApp Dispatch Number -->
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">
                                WhatsApp Dispatch Number (with country code) *
                            </label>
                            <div class="contact-us-input" style="margin-top: 0;">
                                <input class="contact-input" type="text" name="whatsapp_number" id="whatsappNumber"
                                    value="{{ $siteSettings['whatsapp_number'] ?? '8801859382953' }}"
                                    placeholder="8801859382953">
                            </div>
                        </div>

                        <!-- WhatsApp Message Template -->
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">
                                WhatsApp Default Message Template
                            </label>
                            <div class="contact-us-input" style="margin-top: 0;">
                                <input class="contact-input" type="text" name="whatsapp_message" id="whatsappMessage"
                                    value="{{ $siteSettings['whatsapp_message'] ?? 'Hello Varasa Health, I would like to inquire about booking a home caregiver or nurse.' }}"
                                    placeholder="Hello Varasa Health, I would like to inquire about booking a home caregiver or nurse.">
                            </div>
                            <span style="font-size: 11px; color: #64748b; margin-top: 4px; display: block;">
                                Pre-filled text that appears when clients click the floating WhatsApp button or chat links.
                            </span>
                        </div>

                        <!-- Support Email -->
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">
                                Support Email Address
                            </label>
                            <div class="contact-us-input" style="margin-top: 0;">
                                <input class="contact-input" type="email" name="support_email" id="supportEmail"
                                    value="{{ $siteSettings['support_email'] ?? 'support@varasahealth.com' }}"
                                    placeholder="support@varasahealth.com">
                            </div>
                        </div>

                        <!-- Office Address -->
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">
                                Dhaka Office / Clinic Address
                            </label>
                            <div class="contact-us-input" style="margin-top: 0;">
                                <input class="contact-input" type="text" name="office_address" id="officeAddress"
                                    value="{{ $siteSettings['office_address'] ?? 'House 57, Road 25, Block A, Banani, Dhaka' }}"
                                    placeholder="House 57, Road 25, Block A, Banani, Dhaka">
                            </div>
                        </div>

                        <!-- Service Coverage Area -->
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">
                                Service Coverage Notice (Top Bar)
                            </label>
                            <div class="contact-us-input" style="margin-top: 0;">
                                <input class="contact-input" type="text" name="service_area" id="serviceArea"
                                    value="{{ $siteSettings['service_area'] ?? 'Serving All Zones Across Dhaka Metro' }}"
                                    placeholder="Serving All Zones Across Dhaka Metro">
                            </div>
                        </div>

                        <!-- Social Media: Facebook & LinkedIn -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 18px;">
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">
                                    Facebook Page URL
                                </label>
                                <div class="contact-us-input" style="margin-top: 0;">
                                    <input class="contact-input" type="url" name="facebook_url" id="facebookUrl"
                                        value="{{ $siteSettings['facebook_url'] ?? 'https://facebook.com' }}"
                                        placeholder="https://facebook.com/varasahealth">
                                </div>
                            </div>
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">
                                    LinkedIn Page URL
                                </label>
                                <div class="contact-us-input" style="margin-top: 0;">
                                    <input class="contact-input" type="url" name="linkedin_url" id="linkedinUrl"
                                        value="{{ $siteSettings['linkedin_url'] ?? 'https://linkedin.com' }}"
                                        placeholder="https://linkedin.com/company/varasahealth">
                                </div>
                            </div>
                        </div>

                        <!-- Landing Page Hero Headline -->
                        <div style="margin-bottom: 18px;">
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">
                                Landing Page Hero Headline
                            </label>
                            <div class="contact-us-input" style="margin-top: 0;">
                                <input class="contact-input" type="text" name="hero_title" id="heroTitle"
                                    value="{{ $siteSettings['hero_title'] ?? 'Professional Healthcare & Nursing Care at Your Home' }}"
                                    placeholder="Professional Healthcare & Nursing Care at Your Home">
                            </div>
                        </div>

                        <!-- Landing Page Hero Subtitle -->
                        <div style="margin-bottom: 25px;">
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">
                                Landing Page Hero Subtitle
                            </label>
                            <div class="contact-us-input" style="margin-top: 0;">
                                <input class="contact-input" type="text" name="hero_subtitle" id="heroSubtitle"
                                    value="{{ $siteSettings['hero_subtitle'] ?? 'Verified male & female nurses, elderly caregivers, physiotherapists, and diagnostic testing delivered directly to your doorstep in Dhaka.' }}"
                                    placeholder="Verified male & female nurses...">
                            </div>
                        </div>

                        <button id="saveContactUs" class="save" type="submit">
                            Save Contact & Website Info
                        </button>

                    </form>

                </div>


                <!-- =====================================================
                        APP DOWNLOAD LINKS
                    ====================================================== -->

                <div class="contents App-download-links">

                    <form id="appLinksForm" onsubmit="return false;">

                        <h3>
                            App Download Links
                        </h3>

                        <p style="font-size: 13px; color: #64748b; margin-top: 5px; margin-bottom: 20px;">
                            Configure your Android Google Play Store and iOS Apple App Store download URLs. When a URL is saved, its download card/button will automatically show on the public website. If empty, the card is hidden.
                        </p>

                        <!-- Android Input -->
                        <div style="margin-bottom: 20px;">
                            <label style="display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 600; color: #334155; margin-bottom: 8px;">
                                <img src="{{ asset('assets/images/android logo.png') }}" style="width: 18px; height: 18px;" alt="Android">
                                <span>Google Play Store URL (Android)</span>
                            </label>
                            <div class="contact-us-input" style="margin-top: 0;">
                                <input class="contact-input" type="url" name="android_url" id="androidUrl"
                                    value="{{ $androidUrl ?? '' }}"
                                    placeholder="https://play.google.com/store/apps/details?id=com.varasahealth.app">
                            </div>
                        </div>

                        <!-- iOS Input -->
                        <div style="margin-bottom: 25px;">
                            <label style="display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 600; color: #334155; margin-bottom: 8px;">
                                <img src="{{ asset('assets/images/ios logo.png') }}" style="width: 18px; height: 18px;" alt="iOS">
                                <span>Apple App Store URL (iOS)</span>
                            </label>
                            <div class="contact-us-input" style="margin-top: 0;">
                                <input class="contact-input" type="url" name="ios_url" id="iosUrl"
                                    value="{{ $iosUrl ?? '' }}"
                                    placeholder="https://apps.apple.com/app/varasa-health/id123456789">
                            </div>
                        </div>

                        <button id="saveAppLinks" class="save" type="submit">
                            Save App Links
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
            | SAVE REFUND POLICY
            |--------------------------------------------------------------------------
            */

            var saveRefundButton = document.getElementById('saveRefundPolicy');

            if (saveRefundButton) {
                saveRefundButton.addEventListener('click', async function () {
                    var refundTextarea = document.querySelector('#refundPolicyForm .quill-editor-area');

                    await ajaxUpdate({
                        url: '{{ url('/settings/save-refund-policy') }}',
                        method: 'POST',
                        button: this,
                        data: {
                            refund_policy: refundTextarea ? refundTextarea.value : ''
                        },
                        successMessage: 'Cancellation & Refund Policy saved successfully!'
                    });
                });
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


                        var contactValue = contactInput ? contactInput.value.trim() : '';
                        var helplineAlt = document.getElementById('helplineAlt') ? document.getElementById('helplineAlt').value.trim() : '';
                        var whatsappNumber = document.getElementById('whatsappNumber') ? document.getElementById('whatsappNumber').value.trim() : '';
                        var whatsappMessage = document.getElementById('whatsappMessage') ? document.getElementById('whatsappMessage').value.trim() : '';
                        var supportEmail = document.getElementById('supportEmail') ? document.getElementById('supportEmail').value.trim() : '';
                        var officeAddress = document.getElementById('officeAddress') ? document.getElementById('officeAddress').value.trim() : '';
                        var serviceArea = document.getElementById('serviceArea') ? document.getElementById('serviceArea').value.trim() : '';
                        var facebookUrl = document.getElementById('facebookUrl') ? document.getElementById('facebookUrl').value.trim() : '';
                        var linkedinUrl = document.getElementById('linkedinUrl') ? document.getElementById('linkedinUrl').value.trim() : '';
                        var heroTitle = document.getElementById('heroTitle') ? document.getElementById('heroTitle').value.trim() : '';
                        var heroSubtitle = document.getElementById('heroSubtitle') ? document.getElementById('heroSubtitle').value.trim() : '';

                        /*
                        |--------------------------------------------------------------------------
                        | BASIC VALIDATION
                        |--------------------------------------------------------------------------
                        */

                        if (!contactValue) {
                            alert('Please enter a primary helpline phone number.');
                            return;
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | AJAX UPDATE
                        |--------------------------------------------------------------------------
                        */

                        await ajaxUpdate({
                            url: '{{ url('/save-contact-us') }}',
                            method: 'POST',
                            button: saveContactButton,
                            data: {
                                contact_us: contactValue,
                                helpline_number: contactValue,
                                helpline_alt: helplineAlt,
                                whatsapp_number: whatsappNumber,
                                whatsapp_message: whatsappMessage,
                                support_email: supportEmail,
                                office_address: officeAddress,
                                service_area: serviceArea,
                                facebook_url: facebookUrl,
                                linkedin_url: linkedinUrl,
                                hero_title: heroTitle,
                                hero_subtitle: heroSubtitle
                            },
                            successMessage: 'Website & Contact information saved successfully!'
                        });


                    }
                );


            }


            /*
            |--------------------------------------------------------------------------
            | SAVE APP DOWNLOAD LINKS
            |--------------------------------------------------------------------------
            */
            var appLinksForm = document.getElementById('appLinksForm');
            if (appLinksForm) {
                appLinksForm.addEventListener('submit', async function (e) {
                    e.preventDefault();
                    var androidInput = document.getElementById('androidUrl');
                    var iosInput = document.getElementById('iosUrl');
                    var saveBtn = document.getElementById('saveAppLinks');

                    await ajaxUpdate({
                        url: '{{ route('save.app.links') }}',
                        method: 'POST',
                        button: saveBtn,
                        data: {
                            android_url: androidInput ? androidInput.value.trim() : '',
                            ios_url: iosInput ? iosInput.value.trim() : ''
                        },
                        successMessage: 'App download links saved successfully!'
                    });
                });
            }

        });

</script>

@endsection