@extends('master')

@section('content')
    @include('nav')
    <!-- page section start -->
    <div class="page-body">
        <a class="go_back" href="SubAdmin.html">
            <img src="{{ asset('assets/images/arrow-left.png') }}" alt="varasa arrow-left icon">
            <p>Back</p>
        </a>

        <form action="{{ route('sub-admin.permissoin', ['admin_id' => $admin_id]) }}" method="POST" class="page-border">
            <!-- user info start -->
            @csrf
            <div class="user-info">
                <div class="user-name">
                    <h2>Sub Admin Presentation</h2>
                </div>

                <div class="presentation">
                    <div>
                        <p>Our Service</p>
                        <input type="checkbox" name="service" {{ $permissions->our_service == 1 ? 'checked' : '' }}
                            value="1" id="service">
                        <label for="service" class="presentation-label"></label>
                    </div>
                    <div>
                        <p>Orders</p>
                        <input type="checkbox" name="orders" value="1" id="Orders"
                            {{ $permissions->orders == 1 ? 'checked' : '' }}>
                        <label for="Orders" class="presentation-label"></label>
                    </div>
                    <div>
                        <p>My Profile</p>
                        <input type="checkbox" name="profile" value="1" id="Profile"
                            {{ $permissions->my_profile == 1 ? 'checked' : '' }}>
                        <label for="Profile" class="presentation-label"></label>
                    </div>
                    <div>
                        <p>Users</p>
                        <input type="checkbox" name="users" value="1" id="Users"
                            {{ $permissions->users == 1 ? 'checked' : '' }}>
                        <label for="Users" class="presentation-label"></label>
                    </div>
                    <div>
                        <p>Professionals</p>
                        <input type="checkbox" name="professionals" value="1" id="Professionals"
                            {{ $permissions->professionals == 1 ? 'checked' : '' }}>
                        <label for="Professionals" class="presentation-label"></label>
                    </div>
                    <div>
                        <p>Settings</p>
                        <input type="checkbox" name="settings" value="1" id="Settings"
                            {{ $permissions->settings == 1 ? 'checked' : '' }}>
                        <label for="Settings" class="presentation-label"></label>
                    </div>
                    <div>
                        <p>Notifications</p>
                        <input type="checkbox" name="notifications" value="1" id="Notifications"
                            {{ $permissions->notifications == 1 ? 'checked' : '' }}>
                        <label for="Notifications" class="presentation-label"></label>
                    </div>
                </div>
                <button type="submit" class="button">Save</button>
            </div>
            <!-- user info end -->
        </form>
    </div>
    <!-- page section end -->
    </div>
    </div>
    <script>
        const presentation_label = document.querySelectorAll(".presentation-label");
        if (presentation_label) {
            presentation_label.forEach((elem) => {

                var checkMarkGreenImage = "{{ asset('assets/images/check mark green.png') }}";
                var checkMarkWhiteImage = "{{ asset('assets/images/check mark white.png') }}";


                const checkbox = document.querySelector(`#${elem.getAttribute('for')}`);

                if (checkbox && checkbox.checked) {
                    elem.innerHTML = `<img class="admin-check-mark" src="${checkMarkWhiteImage}" alt="check mark">`;
                } else {
                    elem.innerHTML = `<img class="admin-check-mark" src="${checkMarkGreenImage}" alt="check mark">`;
                }

                checkbox.addEventListener("change", () => {
                    if (checkbox.checked) {
                        elem.innerHTML =
                            `<img class="admin-check-mark" src="${checkMarkWhiteImage}" alt="check mark">`;
                    } else {
                        elem.innerHTML =
                            `<img class="admin-check-mark" src="${checkMarkGreenImage}" alt="check mark">`;
                    }
                });
            });
        }
    </script>
@endsection
