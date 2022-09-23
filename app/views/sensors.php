<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Sensor Devices</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Sensor Devices</li>
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
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title mb-0">Manage Sensors</h4>
                        </div>
                        <div class="col-md-2">
                            <a href="javascript:void(0)" class="nav-link btn-primary rounded-pill d-flex align-items-center px-3" id="add-sensor">
                                <i data-feather="plus" class="feather-sm fill-white me-0 me-md-1"></i><span class="d-none d-md-block font-weight-medium fs-3">Add Sensor</span></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dt_sensors" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sensor Code</th>
                                    <!-- <th>Holder</th>
                                    <th>Property</th> -->
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

    <div class="modal fade" id="addsensormodal" tabindex="-1" role="dialog" aria-labelledby="addnotesmodalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white">Add Sensor</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="notes-box">
                        <div class="notes-content">
                            <form action="javascript:void(0);" id="addnotesmodalTitle">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="sensor-code">
                                            <label>Sensor Code</label>
                                            <input type="text" id="sensor-has-code" class="form-control" minlength="6" maxlength="6" autocomplete="off" placeholder="Sensor Code" />
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="sensor-location">
                                            <label>Location</label>
                                            <input type="text" id="sensor-has-location" class="form-control" minlength="6" maxlength="6" autocomplete="off" placeholder="Sensor location" />
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="sensor-coordinates">
                                            <label>Coordinates</label>
                                            <input type="text" id="sensor-has-coordinates" class="form-control" minlength="6" maxlength="6" autocomplete="off" placeholder="Sensor Coordinates" />
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-12 mb-3">
                                        <div class="sensor-owner">
                                            <label>Owner</label>
                                            <select id="sensor-has-owner" class="form-select"><?= Users::combo() ?></select>
                                            <div style="font-size: .875em;color: #fc4b6c;display:none;" id="owner-error">Please select an Owner!</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="sensor-property">
                                            <label>Property</label>
                                            <select id="sensor-has-property" class="form-select"><?= Users::combo() ?></select>
                                            <div style="font-size: .875em;color: #fc4b6c;display:none;" id="property-error">Please select a Property!</div>
                                        </div>
                                    </div> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button id="btn-add-sensor" class="btn btn-info">
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
    showSensors();

    function showSensors() {
        $("#dt_sensors").DataTable().destroy();
        $('#dt_sensors').DataTable({
            "processing": true,
            "ajax": {
                "type": "POST",
                "url": "controller/ajax.php?q=Sensors&m=datatable",
                "dataSrc": "data",
            },
            "columns": [{
                    "data": "count"
                },
                {
                    "data": "sensor_code"
                },
                // {
                //     "data": "holder"
                // },
                // {
                //     "data": "property"
                // },
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
    $("#add-sensor").on("click", function(event) {
        $("#addsensormodal").modal("show");
        $("#btn-n-save").hide();
        $("#btn-add-sensor").show();
    });

    // Button add
    $("#btn-add-sensor").on("click", function(event) {
        event.preventDefault();
        /* Act on the event */

        var $_sensorCode = document.getElementById("sensor-has-code").value;
        var $_sensorLocation = document.getElementById("sensor-has-location").value;
        var $_sensorCoordinates = document.getElementById("sensor-has-coordinates").value;
        // var $_sensorOwner = document.getElementById("sensor-has-owner").value;
        // var $_sensorProperty = document.getElementById("sensor-has-property").value;

        // var $_sensorOwnerError = document.getElementById("owner-error");
        // var $_sensorPropertyError = document.getElementById("property-error");
        // if ($_sensorOwner == "") {
        //     $_sensorOwnerError.style.display = "block";
        // } else if ($_sensorProperty == "") {
        //     $_sensorPropertyError.style.display = "block";
        // } else {
        // $_sensorOwnerError.style.display = "none";
        // $_sensorPropertyError.style.display = "none";
        $.post("controller/ajax.php?q=Sensors&m=add", {
            sensor_code: $_sensorCode,
            sensor_location: $_sensorLocation,
            sensor_coordinates: $_sensorCoordinates,
            // sensor_owner: $_sensorOwner,
            // sensor_property: $_sensorProperty,
        }, function(data, status) {
            $("#addsensormodal").modal("hide");

            showSensors();

        });
        // }
    });
</script>