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
                <button data-filter="1">Running Campaign</button>
                <button data-filter="2">Campaign History</button>
            </div>
            <a href="campaign/add" class="add-presentation">
                <img src="assets/images/plus white.png" alt="varasa plus icon">
                <p>Add Campaign</p>
            </a>
        </div>
        <div class="user-table">
            <!-- user table -->
            <table class="campaign-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Campaign Picture</th>
                        <th>Campaign Name</th>
                        <th>Start Date</th>
                        <th>end Date</th>
                        <th>Area</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="campaingTable">
                </tbody>
            </table>
            <!-- user table -->
        </div>
    </div>
    <!-- page section end -->
    </div>
    </div>

    <script>
        // $(document).ready(function() {
        //     // Fetch campaigns when the page loads
        //     fetchCampaign();

        //     // Handle filter button click
        //     $(".user-filter-btn button").on("click", function() {
        //         $(".user-filter-btn button").removeClass("active");
        //         $(this).addClass("active");
        //         fetchCampaign();
        //     });
        // });

        function changeStatus(userId) {
            let action = $("#action_" + userId).prop("checked") ? 1 : 0;

            $.ajax({
                url: "{{ route('campaign.action') }}",
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
                    fetchCampain();
                },
                error: function(xhr) {
                    console.error("error", xhr.responseText);
                }
            });
        }

        function deleteCampaing(userId) {
            let confirmDelete = confirm("Are you sure? Do you really want to delete this?");
            if (confirmDelete) {
                $.ajax({
                    url: "{{ route('campaign.delete') }}",
                    type: "POST",
                    data: {
                        id: userId,
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        alert(`deleted successfully!`);
                        fetchCampain();
                    },
                    error: function(xhr) {
                        console.error("error", xhr.responseText);
                    }
                });
            }
        }

        function fetchCampain() {
            let filters = $(".user-filter-btn button.active").attr("data-filter") || 1;
            let search = $("#search").val();
            console.log(filters);

            $.ajax({
                url: "{{ route('campaign.index') }}",
                type: "GET",
                cache: false,
                data: {
                    filter: filters,
                    search: search
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function(response) {
                    console.log(response);
                    if (response.campaigns.length == 0) {
                        $("#campaingTable").html(`
                       <tr>
                            <td colspan="8" class="text-center">No Users found.</td>
                        </tr>
                    `);
                    } else {
                        $("#campaingTable").html(response.campaigns.map(campaign =>
                            `
                            <tr>
                                <td>${campaign.id}</td>
                                <td>
                                    <img class="campaign-bg" src="/storage/${campaign.campaign_banner}" 
                                        alt="varasa campaign bg image" style="object-fit:contain">
                                </td>
                                <td>${campaign.name}</td>
                                <td>${campaign.start_at}</td>
                                <td>${campaign.end_at}</td>
                                <td>${campaign.area}</td>
                                <td>
                                    ${campaign.status == 2 ? 'Finished' : 
                                        `<label class="switch">
                                                                                                                                                <input type="checkbox" ${campaign.status ? 'checked' : ''} 
                                                                                                                                                    id="action_${campaign.id}" onchange="changeStatus(${campaign.id})">
                                                                                                                                                <span class="slider slider-green"></span>
                                                                                                                                            </label>`}
                                </td>
                                <td>
                                    <img class="campaign-delete" src="assets/images/delete.png" 
                                        onclick="deleteCampaing(${campaign.id})" alt="delete icon">
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
        $(document).ready(function() {
            $(".user-filter-btn button").first().addClass("active");

            $(".user-filter-btn button").on("click", function() {

                $(".user-filter-btn button").removeClass("active");
                $(this).addClass("active");

                fetchCampain();
            });
            fetchCampain();
            $("#search").on("keyup", function() {
                fetchCampain();
                console.log($("#search").val());

            })

        });
    </script>
@endsection
