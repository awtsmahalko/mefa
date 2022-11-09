<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Fire Department</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Fire Department</li>
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
                            <h4 class="card-title mb-0">Manage Fire Departments</h4>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary rounded-pill" id="add-department"><i data-feather="plus" class="feather-sm fill-white me-0 me-md-1"></i> <span class="font-weight-medium fs-3">Add Department</span></button>
                            <!-- <a href="javascript:void(0)" class="nav-link btn-primary rounded-pill d-flex align-items-center px-3" id="add-department">
                                <i data-feather="plus" class="feather-sm fill-white me-0 me-md-1"></i><span class="d-none d-md-block font-weight-medium fs-3">Add Department</span></a>
                            <a href="javascript:void(0)" class="nav-link btn-primary rounded-pill d-flex align-items-center px-3" id="add-department">
                                <i data-feather="plus" class="feather-sm fill-white me-0 me-md-1"></i><span class="d-none d-md-block font-weight-medium fs-3">Add Department</span></a> -->
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dt_department" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>Code</th>
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
    <!-- -------------------------------------------------------------- -->
    <!-- End PAge Content -->
    <!-- -------------------------------------------------------------- -->

    <div class="modal fade" id="adddepartmentmodal" tabindex="-1" role="dialog" aria-labelledby="addnotesmodalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white">Add Department</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="notes-box">
                        <div class="notes-content">
                            <form action="javascript:void(0);" id="addnotesmodalTitle">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="department-name">
                                            <label>Department Name</label>
                                            <input type="text" id="department-has-name" class="form-control" minlength="6" autocomplete="off" placeholder="Department Name" />
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="department-coordinates">
                                            <label>Coordinates</label>
                                            <input type="text" id="department-has-coordinates" class="form-control" autocomplete="off" placeholder="100.01215,121.021" />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="department-address">
                                            <label>Address</label>
                                            <textarea id="department-has-address" class="form-control" minlength="10" placeholder="address" rows="3"></textarea>
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
                    <button id="btn-add-department" class="btn btn-info">
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
    showDepartments();

    function showDepartments() {
        $("#dt_department").DataTable().destroy();
        $('#dt_department').DataTable({
            "processing": true,
            "ajax": {
                "type": "POST",
                "url": "controller/ajax.php?q=Departments&m=datatable",
                "dataSrc": "data",
            },
            "columns": [{
                    "data": "count"
                },
                {
                    "render": function(data, type, row, meta) {
                        return '<button class="btn btn-info rounded-pill"><span class="fa fa-edit"></span></button> <button class="btn btn-danger rounded-pill"><span class="fa fa-trash"></span></button>';
                    },
                },
                {
                    "data": "department_code"
                },
                {
                    "data": "department_name"
                },
                {
                    "data": "address"
                },
                {
                    "render": function(data, type, row, meta) {
                        return '<button class="btn btn-success rounded-pill"><span class="fa fa-map-marker"></span></button>';
                    },
                },
                {
                    "data": "date_added"
                }
            ]
        });
    }
    $("#add-department").on("click", function(event) {
        $("#adddepartmentmodal").modal("show");
        $("#btn-n-save").hide();
        $("#btn-add-department").show();
    });

    // Button add
    $("#btn-add-department").on("click", function(event) {
        event.preventDefault();
        /* Act on the event */

        var $_departmentName = document.getElementById("department-has-name").value;
        var $_departmentCoordinates = document.getElementById("department-has-coordinates").value;
        var $_departmentAddress = document.getElementById("department-has-address").value;

        $.post("controller/ajax.php?q=Departments&m=add", {
            department_name: $_departmentName,
            department_coordinates: $_departmentCoordinates,
            department_address: $_departmentAddress,
        }, function(data, status) {
            $("#adddepartmentmodal").modal("hide");
            showDepartments();
        });

    });
</script>