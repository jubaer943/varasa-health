@extends('master')

@section('content')
    @include('nav')
    <!-- page section start -->
    <div class="page-body">
        <div class="search-user">
            <img src="assets/images/search.png" alt="varasa search icon">
            <input type="text" name="search" id="search" placeholder="Search" autofocus>
        </div>
        <div class="user-filter-btn">
            <div class="user-left-btn">
                <button data-filter="0">All User</button>
                <button data-filter="1">Active User</button>
            </div>
            <div class="user-right-btn">
                <button class="download-type">
                    <img src="assets/images/download icon.png" alt="varasa download icon">
                </button>
                <div class="user-download-type hide-download-type">
                    <button data-filter="3">
                        <div>
                            <img src="assets/images/excel icon.png" alt="excel icon">
                            <p>Excel Download</p>
                        </div>
                        <img src="assets/images/download icon.png" alt="varasa download icon">
                    </button>
                    <button data-filter="4">
                        <div>
                            <img src="assets/images/pdf icon.png" alt="pdf icon">
                            <p>PDF Download</p>
                        </div>
                        <img src="assets/images/download icon.png" alt="varasa download icon">
                    </button>
                    <button data-filter="5">
                        <div>
                            <img src="assets/images/csv icon.png" alt="csv icon">
                            <p>CSV Download</p>
                        </div>
                        <img src="assets/images/download icon.png" alt="varasa download icon">
                    </button>
                </div>
            </div>
        </div>
        <div class="user-table">
            <!-- user table -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Profile Picture</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="userTable">





                </tbody>

            </table>
            <!-- user table -->
        </div>
    </div>
    <!-- page section end -->
    </div>
    </div>

    <script>
        function changeStatus(userId) {
            let action = $("#action_" + userId).prop("checked") ? 1 : 0;

            $.ajax({
                url: "{{ route('users.action') }}",
                type: "POST",
                data: {
                    id: userId,
                    status: action
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function(response) {
                    alert(`Status ${response.new_status == 1 ?'activated' : 'deactivated'} successfully!`);
                },
                error: function(xhr) {
                    console.error("error", xhr.responseText);
                }
            });
        }

        $(document).ready(function() {

            function fetchUser() {
                let filters = $(".user-filter-btn button.active").attr("data-filter") || 0;
                let search = $("#search").val();
                console.log(filters);

                $.ajax({
                    url: "{{ route('users.index') }}",
                    type: "GET",
                    data: {
                        filter: filters,
                        search: search
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        if (response.users.length == 0) {
                            $("#userTable").html(`
                               <tr>
                                    <td colspan="7" class="text-center">No Users found.</td>
                                </tr>
                            `);
                        } else {
                            $("#userTable").html(response.users.map(user =>
                                `
                                 <tr>
                                    <td>${user.userId}</td>
                                    <td><img src="assets/images/profile icon.png" alt="Profile Picture"></td>
                                    <td>${user.fullname}</td>
                                    <td>${user.email}</td>
                                    <td>${user.phone}</td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" id="action_${user.id}"  ${user.status == 1 ? 'checked': '' } value="1" onchange="changeStatus(${user.id})">
                                            <span class="slider slider-green"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <a href="/users/profile/${user.id}" class="see-more">
                                            <p>See More</p>
                                        </a>
                                    </td>
                                </tr>
                                `
                            ).join(""));
                        }

                    },
                    error: function(xhr) {
                        console.error("Error:", xhr.responseText);
                    }
                });
            }

            $(".user-filter-btn button").first().addClass("active");

            $(".user-filter-btn button").on("click", function() {

                $(".user-filter-btn button").removeClass("active");
                $(this).addClass("active");
                let filter = $(this).attr("data-filter");
                if (filter == 3 || filter == 5 || filter == 4) {
                    // If filter is 3 (Export), open export URL directly
                    window.open("{{ route('users.index') }}?filter=" + filter, "_blank");
                } else {
                    fetchUser(filter);
                }
                fetchUser();
            });

            $("#search").on("keyup", function() {
                fetchUser();
            })

            fetchUser();

        });
    </script>
@endsection
