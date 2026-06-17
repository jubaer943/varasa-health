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
                <button class="active">All Sub Admin</button>
            </div>
            <a href="{{ route('sub-admin.add') }}" class="add-presentation">
                <img src="assets/images/plus white.png" alt="varasa plus icon">
                <p>Add Sub Admin</p>
            </a>
        </div>
        <div class="user-table">
            <!-- user table -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Reg. Date</th>
                        <th>Approval</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="adminTable">
            </table>
            <!-- user table -->
        </div>
    </div>
    <!-- page section end -->
    </div>
    </div>

    <script>
        function ChangeStatus(adminId) {
            let action = $("#action_" + adminId).prop("checked") ? 1 : 0;

            $.ajax({
                url: "{{ route('sub-admin.action') }}",
                type: "POST",
                data: {
                    id: adminId,
                    status: action
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function(response) {
                    alert(`Status ${response.new_status == 1 ?'activated' : 'deactivated'} successfully!`);
                },
                error: function(xhr) {
                    console.error("Error:", xhr.responseText);
                }
            })
        }
        $(document).ready(function() {

            function fetchSubAdmin() {
                let search = $("#search").val();

                $.ajax({
                    url: "{{ route('sub-admin.index') }}",
                    type: "GET",
                    data: {
                        search: search,
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        if (response.admins.length == 0) {
                            $("#adminTable").html(`
                                <tr>
                                  <td colspan="7">No sub-admins found.</td>
                               </tr>
                            `);
                        } else {
                            let i = 1;
                            $("#adminTable").html(response.admins.map(admin => `
                            <tr>
                                <td>${i++}</td>
                                <td>${admin.name}</td>
                                <td>${admin.email}</td>
                                <td>${new Date(admin.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' })}</td>

                                <td>
                                    <label class="switch">
                                        <input type="checkbox" id="action_${admin.id}" ${admin.status == 1 ? 'checked': ''} onchange="ChangeStatus(${admin.id})">
                                        <span class="slider slider-green"></span>
                                    </label>
                                </td>
                                <td>
                                    <a href="sub-admin/presentation/${admin.id}" class="see-more">
                                        <p>Permission</p>
                                    </a>
                                </td>
                            </tr>
                            `).join(""));
                        }

                    },
                    error: function(xhr) {
                        console.error("error:", xhr.responseText);

                    }
                });
            }

            $("#search").on("keyup", function() {
                fetchSubAdmin();
            })

            fetchSubAdmin();


        });
    </script>
@endsection
