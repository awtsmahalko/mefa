<?php
$user_data = Users::dataOf($_SESSION['user']['id']);

?>

<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Profile Page</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Profile Page</li>
        </ol>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- -------------------------------------------------------------- -->
<!-- Container fluid  -->
<!-- -------------------------------------------------------------- -->
<div class="container-fluid">
    <!-- -------------------------------------------------------------- -->
    <!-- Start Page Content -->
    <!-- -------------------------------------------------------------- -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="mt-4">
                        <img src="../assets/images/users/default-user.jpeg" class="rounded-circle" width="150" height="150" />
                        <h4 class="card-title mt-2"><?= $_SESSION['user']['name'] ?></h4>
                        <h6 class="card-subtitle"><?= $_SESSION['user']['category'] == 'R' ? "Resident" : "Admin"; ?></h6>
                    </center>
                </div>
                <div>
                    <hr />
                </div>
                <div class="card-body">
                    <small class="text-muted pt-4 db">Username</small>
                    <h6><?= $user_data['username'] ?></h6>
                    <small class="text-muted pt-4 db">Address</small>
                    <h6><?= $user_data['user_address'] ?></h6>
                    <div class="map-box">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border: 0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Tabs -->
                <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-property-tab" data-bs-toggle="pill" href="#user-property" role="tab" aria-controls="pills-setting" aria-selected="false">Properties</a>
                    </li>
                </ul>
                <!-- Tabs -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="card-body">
                            <form class="form-horizontal form-material" autocomplete="off">
                                <div class="mb-3">
                                    <label class="col-md-12">Full Name</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?= $user_data['user_fullname'] ?>" class="form-control form-control-line" name="user_fullname" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="col-md-12">Phone No</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?= $user_data['user_mobile'] ?>" class="form-control form-control-line" name="user_mobile" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="col-md-12">Address</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?= $user_data['user_address'] ?>" class="form-control form-control-line" name="user_address" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success" type="submit">
                                            Update Profile
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="user-property" role="tabpanel" aria-labelledby="pills-property-tab">
                        <div class="card-body">
                            <div class="row col-md-12">
                                <div class="col-md-6">
                                    <h4 class="card-title mb-0">Manage Properties</h4>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary rounded-pill" id="add-property"><i data-feather="plus" class="feather-sm fill-white me-0 me-md-1"></i> <span class="font-weight-medium fs-3">Add Properties</span></button>
                                </div>
                            </div>
                            <div class="row col-md-12 mt-4">
                                <div class="table-responsive">
                                    <table id="dt_properties" class="table table-striped table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th></th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Map</th>
                                                <th>Date Added</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
    <!-- -------------------------------------------------------------- -->
    <!-- End PAge Content -->
    <!-- -------------------------------------------------------------- -->
</div>
<div class="modal fade" id="addpropertymodal" tabindex="-1" role="dialog" aria-labelledby="addnotesmodalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title text-white">Add property</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="notes-box">
                    <div class="notes-content">
                        <form action="javascript:void(0);" id="addnotesmodalTitle">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="property-name">
                                        <label>Property Name</label>
                                        <input type="text" id="property-has-name" class="form-control" minlength="6" autocomplete="off" placeholder="Property Name" />
                                    </div>
                                </div>
                                <!-- 
                                <div class="col-md-12 mb-3">
                                    <div class="property-owner">
                                        <label>Owner</label>
                                        <select id="property-has-owner" class="form-select"><?= Users::combo() ?></select>
                                        <div style="font-size: .875em;color: #fc4b6c;display:none;" id="owner-error">Please select an Owner!</div>
                                    </div>
                                </div> -->

                                <div class="col-md-12 mb-3">
                                    <div class="property-coordinates">
                                        <label>Coordinates</label>
                                        <input type="text" id="property-has-coordinates" class="form-control" autocomplete="off" placeholder="100.01215,121.021" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="property-address">
                                        <label>Address</label>
                                        <textarea id="property-has-address" class="form-control" minlength="10" placeholder="address" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">
                    Close
                </button>
                <button id="btn-add-property" class="btn btn-info">
                    Add
                </button>
            </div>
        </div>
    </div>
</div>
<!-- -------------------------------------------------------------- -->
<!-- End Container fluid  -->

<!--This page plugins -->
<script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
<script>
    showProperties();

    function showProperties() {
        $("#dt_properties").DataTable().destroy();
        $('#dt_properties').DataTable({
            "processing": true,
            "ajax": {
                "type": "POST",
                "url": "controller/ajax.php?q=Properties&m=datatable",
                "dataSrc": "data",
            },
            "columns": [{
                    "data": "count"
                },
                {
                    "render": function(data, type, row, meta) {
                        return '<button class="btn btn-info rounded-pill"><i data-feather="edit" class="feather-sm fill-white me-0 me-md-1"></i></button> <button class="btn btn-danger rounded-pill"><i data-feather="trash-2" class="feather-sm fill-white me-0 me-md-1"></i></button>';
                    },
                },
                {
                    "data": "property_name"
                },
                {
                    "data": "address"
                },
                {
                    "render": function(data, type, row, meta) {
                        return '<button class="btn btn-success rounded-pill" onclick="showLocation(' + row.property_id + ')"><i data-feather="map-pin" class="feather-sm fill-white me-0 me-md-1"></i></button>';
                    },
                },
                {
                    "data": "date_added"
                }
            ]
        });
    }
    $("#add-property").on("click", function(event) {
        $("#addpropertymodal").modal("show");
        $("#btn-n-save").hide();
        $("#btn-add-property").show();
    });

    // Button add
    $("#btn-add-property").on("click", function(event) {
        event.preventDefault();
        /* Act on the event */

        var $_propertyName = document.getElementById("property-has-name").value;
        // var $_propertyOwner = document.getElementById("property-has-owner").value;
        var $_propertyCoordinates = document.getElementById("property-has-coordinates").value;
        var $_propertyAddress = document.getElementById("property-has-address").value;

        // var $_propertyOwnerError = document.getElementById("owner-error");
        var $_propertyPropertyError = document.getElementById("property-error");
        // if ($_propertyOwner == "") {
        //     $_propertyOwnerError.style.display = "block";
        // } else {
        // $_propertyOwnerError.style.display = "none";
        $.post("controller/ajax.php?q=Properties&m=add", {
            property_name: $_propertyName,
            // property_owner: $_propertyOwner,
            property_coordinates: $_propertyCoordinates,
            property_address: $_propertyAddress,
        }, function(data, status) {
            $("#addpropertymodal").modal("hide");
            showProperties();
        });
        // }
    });


    function showLocation(property_id) {
        window.location = "index.php?q=properties_location&property_id=" + property_id;
    }
</script>