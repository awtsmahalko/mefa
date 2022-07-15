<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Properties</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Properties</li>
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
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="border-bottom title-part-padding">
                    <div class="row col-md-12">
                        <div class="col-md-9">
                            <h4 class="card-title mb-0">Manage Properties</h4>
                        </div>
                        <div class="col-md-3">
                            <a href="javascript:void(0)" class="nav-link btn-primary rounded-pill d-flex align-items-center px-3" id="add-property">
                                <i data-feather="plus" class="feather-sm fill-white me-0 me-md-1"></i><span class="d-none d-md-block font-weight-medium fs-3">Add Properties</span></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dt_properties" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Holder</th>
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
    <!-- -------------------------------------------------------------- -->
    <!-- End PAge Content -->
    <!-- -------------------------------------------------------------- -->

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

                                    <div class="col-md-12 mb-3">
                                        <div class="property-owner">
                                            <label>Owner</label>
                                            <select id="property-has-owner" class="form-select"><?= Users::combo() ?></select>
                                            <div style="font-size: .875em;color: #fc4b6c;display:none;" id="owner-error">Please select an Owner!</div>
                                        </div>
                                    </div>

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
</div>

<!--This page plugins -->
<script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
<!-- <script src="../dist/js/pages/datatable/datatable-basic.init.js"></script> -->
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
                    "data": "property_code"
                },
                {
                    "data": "property_name"
                },
                {
                    "data": "holder"
                },
                {
                    "data": "address"
                },
                {
                    "data": "map"
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
        var $_propertyOwner = document.getElementById("property-has-owner").value;
        var $_propertyCoordinates = document.getElementById("property-has-coordinates").value;
        var $_propertyAddress = document.getElementById("property-has-address").value;

        var $_propertyOwnerError = document.getElementById("owner-error");
        var $_propertyPropertyError = document.getElementById("property-error");
        if ($_propertyOwner == "") {
            $_propertyOwnerError.style.display = "block";
        } else {
            $_propertyOwnerError.style.display = "none";
            $.post("controller/ajax.php?q=Properties&m=add", {
                property_name: $_propertyName,
                property_owner: $_propertyOwner,
                property_coordinates: $_propertyCoordinates,
                property_address: $_propertyAddress,
            }, function(data, status) {
                $("#addpropertymodal").modal("hide");
                showProperties();
            });
        }
    });
</script>