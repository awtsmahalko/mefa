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
                        <h6 class="card-subtitle"><?= $_SESSION['user']['category'] == 'R' ? "Resident" : ($_SESSION['user']['category'] == 'F' ? 'Fire Officer' : "Admin"); ?></h6>
                    </center>
                </div>
                <?php if ($_SESSION['user']['category'] == 'R') { ?>
                    <div>
                        <hr />
                    </div>
                    <div class="card-body">
                        <small class="text-muted pt-2 db">Address</small>
                        <h6><?= $user_data['user_address'] ?></h6>
                        <div class="map-box">
                            <iframe src="https://www.google.com/maps/embed/v1/view?key=AIzaSyC232qKEVqI5x0scuj9UGEVUNdB98PiMX0&center=<?= $user_data['user_resident_coordinates'] ?>&zoom=18&maptype=satellite" width="100%" height="150" frameborder="0" style="border: 0" allowfullscreen></iframe>
                        </div>
                        <button class="btn btn-success btn-block" onclick="showResident(<?= $user_data['user_id'] ?>)" type="button">
                            <span class="fa fa-map-marker"></span> Change Resident Location
                        </button>
                    </div>
                <?php } ?>
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
                    <?php if ($_SESSION['user']['category'] == 'R') { ?>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-property-tab" data-bs-toggle="pill" href="#user-property" role="tab" aria-controls="pills-setting" aria-selected="false">Properties</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-settings-tab" data-bs-toggle="pill" href="#account-settings" role="tab" aria-controls="pills-settings" aria-selected="false">Account Settings</a>
                    </li>
                </ul>
                <!-- Tabs -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="card-body">
                            <form id="frm_profile" class="form-horizontal form-material" autocomplete="off">
                                <input type="hidden" value="<?= $user_data['user_id'] ?>" name="user_id">
                                <div class="mb-3">
                                    <label class="col-md-12">Full Name</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?= $user_data['user_fullname'] ?>" class="form-control form-control-line" name="user_fullname" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="col-md-12">Phone No</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?= $user_data['user_mobile'] ?>" class="form-control form-control-line" name="user_mobile" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="col-md-12">Address</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?= $user_data['user_address'] ?>" class="form-control form-control-line" name="user_address" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" value="<?= $user_data['user_email'] ?>" class="form-control form-control-line" name="user_email" required />
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
                    <div class="tab-pane fade" id="account-settings" role="tabpanel" aria-labelledby="pills-settings-tab">
                        <div class="card-body">
                            <form id="frm_settings" class="form-horizontal form-material" autocomplete="off">
                                <input type="hidden" value="<?= $user_data['user_id'] ?>" name="user_id">
                                <div class="mb-3">
                                    <label class="col-md-12">Username</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?= $user_data['username'] ?>" class="form-control form-control-line" name="user_fullname" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="col-md-12">Password</label>
                                    <div class="col-md-12">
                                        <input type="password" class="form-control form-control-line" name="password" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="col-md-12">Retype Password</label>
                                    <div class="col-md-12">
                                        <input type="password" class="form-control form-control-line" name="password2" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success" type="submit">
                                            Update Account
                                        </button>
                                    </div>
                                </div>
                            </form>
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
                                <input type="hidden" id="property_id" />
                                <div class="col-md-12 mb-3">
                                    <div class="property-name">
                                        <label>Property Name</label>
                                        <input type="text" id="property-has-name" class="form-control" minlength="6" autocomplete="off" placeholder="Property Name" />
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="property-coordinates">
                                        <label>Coordinates</label>
                                        <input type="text" id="property-has-coordinates" class="form-control" autocomplete="off" readonly placeholder="100.01215,121.021" />
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
                        return '<button class="btn btn-info rounded-pill" onclick=\'editProperty("' + row.property_id + '","' + row.property_name + '","' + row.address + '","' + row.coordinates + '")\'><span class="fa fa-edit"></span></button> <button class="btn btn-danger rounded-pill"><span class="fa fa-trash"></span></button>';
                    },
                },
                {
                    "data": "property_name"
                },
                {
                    "render": function(data, type, row, meta) {
                        return '<div class="d-flex align-items-center">' +
                            '<button class="btn btn-success rounded-pill" onclick="showLocation(' + row.property_id + ')"><span class="fa fa-map-marker"></span></button>' +
                            '<div class="ms-3">' +
                            '<div class="user-meta-info">' +
                            '<h6 class="user-name mb-0 font-weight-medium">' + row.address + '</h6>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    },
                },
                {
                    "data": "date_added"
                }
            ]
        });
    }
    $("#add-property").on("click", function(event) {
        proprtyAssign();
        $("#addpropertymodal").modal("show");

        $("#btn-n-save").hide();
        var btn_property = document.getElementById("btn-add-property");
        btn_property.innerHTML = "Add";
        btn_property.style.display = "block";

    });

    $("#frm_profile").on("submit", function(e) {
        e.preventDefault();
        $.post("controller/ajax.php?q=Users&m=updateProfile", $("#frm_profile").serialize(), function(data, status) {
            if (data == 1) {
                success_update();
            } else {
                failed_query(data);
            }
        });
    });

    // Button add
    $("#btn-add-property").on("click", function(event) {
        event.preventDefault();
        /* Act on the event */

        var $_propertyId = document.getElementById("property_id").value;
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
            property_id: $_propertyId
        }, function(data, status) {
            $("#addpropertymodal").modal("hide");
            showProperties();
        });
        // }
    });

    function editProperty(id, name, address, coordinates) {
        var btn_property = document.getElementById("btn-add-property");
        btn_property.innerHTML = "Edit";

        proprtyAssign(id, name, address, coordinates);

        $("#addpropertymodal").modal("show");
    }

    function proprtyAssign(id = 0, name = "", address = "", coordinates = global_coords) {
        document.getElementById("property_id").value = id;
        document.getElementById("property-has-name").value = name;
        document.getElementById("property-has-coordinates").value = coordinates;
        document.getElementById("property-has-address").value = address;
    }

    function showResident(user_id) {
        window.location = "index.php?q=resident_location&user_id=" + user_id;
    }

    function showLocation(property_id) {
        window.location = "index.php?q=properties_location&property_id=" + property_id;
    }
</script>