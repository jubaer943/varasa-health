@extends('master')

@section('content')
    @include('nav')
    <!-- page section start -->
    <div class="page-body">
        <div class="search-user">
            <img src="assets/images/search.png" alt="varasa search icon">
            <input type="text" name="search" id="search" placeholder="Search">
        </div>
        <div class="user-filter-btn">
            <div class="user-left-btn">
                <button data-filter="0">All Professional</button>
                <button data-filter="1">Nurse</button>
                <button data-filter="2">Physiotherpist</button>
                <button data-filter="3">Caregiver</button>
                <button data-filter="4">Active Professionals</button>
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
                <tbody id="professionalTable"></tbody>
            </table>
            <!-- user table -->
        </div>
    </div>
    <!-- page section end -->
    </div>
    </div>
    <script>
        function ChangeStatus(professionalId) {
            let action = $("#action_" + professionalId).prop("checked") ? 1 : 0;

            $.ajax({
                url: "{{ route('professional.action') }}",
                type: "POST",
                data: {
                    id: professionalId,
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

            function fetchProfessionals() {
                let filters = $(".user-filter-btn button.active").attr("data-filter") || 0;
                let search = $("#search").val();
                $.ajax({
                    url: "{{ route('professional.index') }}",
                    type: "GET",
                    data: {
                        filter: filters,
                        search: search
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {

                        if (response.professionals.length === 0) {
                            $("#professionalTable").html(` 
                                        <tr>
                                            <td colspan = "8" class = "text-center" > No Profesional found. </td>
                                        </tr>
                                `);
                        } else {
                            $("#professionalTable").html(response.professionals.map(professional =>
                                `
                                    <tr>
                                    <td>${professional.professional_id}</td>
                                    <td><img src="assets/images/profile icon.png" alt="Profile Picture"></td>
                                    <td>${professional.full_name}</td>
                                    <td>${professional.email}</td>
                                    <td>${professional.phone}</td>
                                    <td>
                                        <label class="switch">
                                            <input id="action_${professional.id}" type="checkbox" ${professional.status == 1 ? 'checked' : ''} value="1" onchange="ChangeStatus(${professional.id})">
                                            <span class="slider slider-green"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <a href="professional/profile/${professional.id}" class="see-more"><p>See More</p></a>
                                    </td>
                                </tr>                              
                                    
                                    `
                            ).join(""));
                        }
                        console.log(response);

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

                fetchProfessionals();
            });

            $("#search").on("keyup", function() {
                fetchProfessionals();
            });

            fetchProfessionals();

        });
    </script>
@endsection
