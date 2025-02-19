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

                    <button class="active-btn buttons">
                        <p>Privacy Policy</p>
                        <img src="assets/images/arrow-right-white.png" alt="">
                    </button>
                    <button class="buttons">
                        <p>About Us</p>
                        <img src="assets/images/arrow-right-green.png" alt="">
                    </button>
                    <button class="buttons">
                        <p>App Info</p>
                        <img src="assets/images/arrow-right-green.png" alt="">
                    </button>
                    <button class="buttons">
                        <p>Contact Us</p>
                        <img src="assets/images/arrow-right-green.png" alt="">
                    </button>
                </div>
            </div>
            <div class="setting-right">
                <div class="contents Privacy-policy active_section">
                    <div class="user-professional">
                        <button class="user-pro-btn1 active-user-pro-btn" type="button">User</button>
                        <button class="user-pro-btn1" type="button">Professional</button>
                    </div>
                    <form class="user-pro-contents1 active-user-pro-contents" action="#">
                        <div>
                            <div>
                                <h3>Privacy Policy 1</h3>
                                <div>
                                    <img src="assets/images/edit-2.png" alt="varasa edit icon">
                                </div>
                            </div>
                        </div>
                        <div class="Published">
                            <button type="button">v1.1.0</button>
                            <p>Published on <span>February, 2023</span></p>
                        </div>
                        <button class="Download-policy" type="button">
                            <img src="assets/images/arrow-down-circle.png" alt="varasa arrow-down icon">
                            <p>Download as PDF</p>
                        </button>
                        <p>Protecting your privacy is a top priority at our parcel delivery app. We understand that you entrust us with your personal information, and we take that responsibility seriously. <br><br>

                            When you use our app, we collect and use information only as necessary to provide our services and improve your experience. This includes information such as your name, address, and delivery details. We also use cookies and similar technologies to personalize your experience and track usage data. <br><br>

                            We do not sell your information to third parties, and we only share it with our trusted partners and service providers when necessary to provide our services. We take reasonable steps to protect your information from unauthorized access, disclosure, or misuse. <br><br>

                            If you have any questions or concerns about our privacy practices, please don't hesitate to contact us. Your trust and satisfaction are important to us, and we will do everything we can to protect your privacy and ensure your peace of mind.
                        </p>
                        <button class="save" disabled type="submit">Save</button>
                    </form>
                    <form class="user-pro-contents1" action="#">
                        <div>
                            <div>
                                <h3>Privacy Policy 2</h3>
                                <div>
                                    <img src="assets/images/edit-2.png" alt="varasa edit icon">
                                </div>
                            </div>
                        </div>
                        <div class="Published">
                            <button type="button">v1.1.0</button>
                            <p>Published on <span>February, 2023</span></p>
                        </div>
                        <button class="Download-policy" type="button">
                            <img src="assets/images/arrow-down-circle.png" alt="varasa arrow-down icon">
                            <p>Download as PDF</p>
                        </button>
                        <p>Protecting your privacy is a top priority at our parcel delivery app. We understand that you entrust us with your personal information, and we take that responsibility seriously. <br><br>

                            When you use our app, we collect and use information only as necessary to provide our services and improve your experience. This includes information such as your name, address, and delivery details. We also use cookies and similar technologies to personalize your experience and track usage data. <br><br>

                            We do not sell your information to third parties, and we only share it with our trusted partners and service providers when necessary to provide our services. We take reasonable steps to protect your information from unauthorized access, disclosure, or misuse. <br><br>

                            If you have any questions or concerns about our privacy practices, please don't hesitate to contact us. Your trust and satisfaction are important to us, and we will do everything we can to protect your privacy and ensure your peace of mind.
                        </p>
                        <button class="save" disabled type="submit">Save</button>
                    </form>
                </div>
                <div class="contents About-us">
                    <div class="user-professional">
                        <button class="user-pro-btn2 active-user-pro-btn" type="button">User</button>
                        <button class="user-pro-btn2" type="button">Professional</button>
                    </div>
                    <form class="user-pro-contents2 active-user-pro-contents" action="#">
                        <div>
                            <div>
                                <h3>About Us 1</h3>
                                <div>
                                    <img src="assets/images/edit-2.png" alt="varasa edit icon">
                                </div>
                            </div>
                        </div>
                        <p>Protecting your privacy is a top priority at our parcel delivery app. We understand that you entrust us with your personal information, and we take that responsibility seriously. <br><br>

                            When you use our app, we collect and use information only as necessary to provide our services and improve your experience. This includes information such as your name, address, and delivery details. We also use cookies and similar technologies to personalize your experience and track usage data. <br><br>

                            We do not sell your information to third parties, and we only share it with our trusted partners and service providers when necessary to provide our services. We take reasonable steps to protect your information from unauthorized access, disclosure, or misuse. <br><br>

                            If you have any questions or concerns about our privacy practices, please don't hesitate to contact us. Your trust and satisfaction are important to us, and we will do everything we can to protect your privacy and ensure your peace of mind.
                        </p>
                        <button class="save" disabled type="submit">Save</button>
                    </form>
                    <form class="user-pro-contents2" action="#">
                        <div>
                            <div>
                                <h3>About Us 2</h3>
                                <div>
                                    <img src="assets/images/edit-2.png" alt="varasa edit icon">
                                </div>
                            </div>
                        </div>
                        <p>Protecting your privacy is a top priority at our parcel delivery app. We understand that you entrust us with your personal information, and we take that responsibility seriously. <br><br>

                            When you use our app, we collect and use information only as necessary to provide our services and improve your experience. This includes information such as your name, address, and delivery details. We also use cookies and similar technologies to personalize your experience and track usage data. <br><br>

                            We do not sell your information to third parties, and we only share it with our trusted partners and service providers when necessary to provide our services. We take reasonable steps to protect your information from unauthorized access, disclosure, or misuse. <br><br>

                            If you have any questions or concerns about our privacy practices, please don't hesitate to contact us. Your trust and satisfaction are important to us, and we will do everything we can to protect your privacy and ensure your peace of mind.
                        </p>
                        <button class="save" disabled type="submit">Save</button>
                    </form>
                </div>
                <div class="contents App-Info">
                    <h3>App Info</h3>
                    <div class="app-download">
                        <div>
                            <p>App Download <span>(Quantity)</span></p>
                            <div class="app-info-no">205</div>
                        </div>
                        <div>
                            <p>Active Users</p>
                            <div class="app-info-details">
                                <div class="app-info-no">205</div>
                                <a href="SettingActiveUser.html">See More</a>
                            </div>
                        </div>
                        <div>
                            <p>Active Professionals</p>
                            <div class="app-info-details">
                                <div class="app-info-no">205</div>
                                <a href="SettingReturningUser.html">See More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contents Contact-us">
                    <form action="#">
                        <div>
                            <div>
                                <h3>Contact Us</h3>
                            </div>
                        </div>
                        <div class="contact-us-input">
                            <img src="assets/images/call.png" alt="varasa call icon">
                            <input class="contact-input" disabled type="text" name="contactUs" id="contactUs" placeholder="665656">
                            <img class="contact-edit" src="assets/images/edit-2.png" alt="varasa edit icon">
                        </div>
                        <button class="save contact-save" disabled type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page section end -->
</div>
</div>
@endsection