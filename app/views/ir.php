<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Incident Report</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Incident Report</li>
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
                            <h4 class="card-title mb-0">Manage Incident Reports</h4>
                        </div>
                        <div class="col-md-3">
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
                                    <th>Area</th>
                                    <th>Fire In</th>
                                    <th>Fireout</th>
                                    <th>Narative Report</th>
                                    <th>Filed By</th>
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

</div>
<div class="modal fade" id="modalFileIR" tabindex="-1" role="dialog" aria-labelledby="addFileIR" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title text-white">File Incident Report</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="notes-box">
                    <div class="notes-content">
                        <form action="javascript:void(0);" id="addFileIR">
                            <input type="hidden" id="ir_id" />
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="ir-area">
                                        <label>Area of fire</label>
                                        <input type="text" id="ir-has-area" class="form-control" autocomplete="off"
                                            placeholder="Barangay 1" />
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="ir-fireoutdate">
                                        <label>Fireout Datetime</label>
                                        <input type="datetime-local" id="ir-has-fireoutdate" class="form-control"
                                            autocomplete="off" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="ir-report">
                                        <label>Narative Report</label>
                                        <textarea id="ir-has-report" class="form-control" minlength="10"
                                            rows="5"></textarea>
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
                <button id="btn-add-ir" class="btn btn-info">
                    Add
                </button>
            </div>
        </div>
    </div>
</div>
<!--This page plugins -->
<script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
<!-- <script src="../dist/js/pages/datatable/datatable-basic.init.js"></script> -->
<script>
    showIRs();

    function showIRs() {
        $("#dt_department").DataTable().destroy();
        $('#dt_department').DataTable({
            "processing": true,
            "ajax": {
                "type": "POST",
                "url": "controller/ajax.php?q=IncidentReport&m=datatable",
                "dataSrc": "data",
            },
            "columns": [{
                "data": "count"
            },
            {
                "render": function(data, type, row, meta) {
                    return '<button class="btn btn-info rounded-pill" onclick=\'viewIR(' + row.ir_id + ',"' + row.ir_area + '","' + row.ir_fireout + '","' + row.ir_report + '")\'><span class="fa fa-file"></span></button> <button class="btn btn-secondary rounded-pill" data-items=\'' + JSON.stringify(row) + '\' onclick=\'printIR(this)\'><span class="fa fa-print"></span></button>';
                },
            },
            {
                "data": "ir_area"
            },
            {
                "data": "ir_firein_"
            },
            {
                "data": "ir_fireout_"
            },
            {
                "data": "ir_report"
            },
            {
                "data": "reported_by"
            }
            ]
        });
    }

    function viewIR(ir_id, area, fireout, report) {
        var btn_department = document.getElementById("btn-add-ir");
        btn_department.innerHTML = "Edit";

        assignValues(ir_id, area, fireout, report);
        $("#modalFileIR").modal("show");

    }

    function printIR(el) {
        const srcValue = el.getAttribute("data-items");
        const row_data = JSON.parse(srcValue);
        console.log(row_data);
        var html_page = '<!DOCTYPE html>' +
            '<html>' +
            '<head>' +
            '<title>Fire Incident Report</title>' +
            '<style>' +
            'body {font-family: Arial, sans-serif;}' +
            'h1 {text-align: center;text-transform: uppercase;font-size: 28px;margin-top: 30px;margin-bottom: 30px;}' +
            'h2 {text-align: center;text-transform: uppercase;font-size: 15px;margin-top: unset;margin-bottom: unset;}' +
            'h4 {text-align: center;font-size: 15px;margin-top: unset;margin-bottom: unset;font-weight: unset;}' +
            '.img-left {float: left;width: 100px;margin-top: 30px;margin-left: 30px;}' +
            '.img-right {float: right;width: 100px;margin-top: 30px;margin-right: 30px;}' +
            'label {font-weight: bold;display: block;margin-top: 20px;margin-bottom: 5px;}' +
            'input[type="text"],input[type="date"],input[type="time"] {display: block;width: 100%;padding: 10px;border: 1px solid #ccc;border-radius: 5px;font-size: 16px;margin-bottom: 20px;}' +
            'textarea {display: block;width: 100%;padding: 10px;border: 1px solid #ccc;border-radius: 5px;font-size: 16px;margin-bottom: 20px;}' +
            'input[type="submit"] {background-color: #4CAF50;color: #fff;border: none;border-radius: 5px;padding: 10px 20px;font-size: 16px;cursor: pointer;margin-top: 20px;}' +
            'form {padding:0 10%}' +
            '@media print {input[type="submit"] {display: none;}}' +
            '</style>' +
            '</head>' +
            '<body>' +
            '<img src="../assets/images/background/bfp.png" class="img-left">' +
            '<img src="../assets/images/background/dilg.png" class="img-right">' +
            '<h4>Republic of the Philippines</h4>' +
            '<h4>Department of the Interior and Local Government</h4>' +
            '<h2>BUREAU OF FIRE PROTECTION</h2>' +
            '<h4>Regional Office - VI</h4>' +
            '<h4>Blk 19A, 4th Main Avenue, Phase 3</h4>' +
            '<h4>Alta Tierra Village, Brgy. M. V. Hechanova, Jaro, Iloilo City</h4>' +
            '<h4>Tel / Fax No. (033) 337-69-18</h4>' +
            '<h1>Fire Incident Report</h1>' +
            '<form>' +
            '<p>Fire In     : ' + row_data.ir_firein_ + '</p>' +
            '<p>Area        : ' + row_data.ir_area + '</p>' +
            '<p>Fire Out    : ' + row_data.ir_fireout_ + '</p>' +
            '<hr>' +
            '<label>Narative Report:</label>' +
            '<p>' + row_data.ir_report + '</p><br>' +
            '<label>Filed by:</label>' +
            '<p>' + row_data.reported_by + '</p><br>' +
            '</form>' +
            '</body>' +
            '</html>';
        var newWindow = window.open('', '', 'width=1300,height=400');
        newWindow.document.write(html_page);
        setTimeout(function() {
            newWindow.print();
        }, 500)
    }

    function assignValues(ir_id = 0, area = "", fireout = "", report = '') {
        document.getElementById("ir_id").value = ir_id;
        document.getElementById("ir-has-area").value = area;
        document.getElementById("ir-has-fireoutdate").value = fireout;
        document.getElementById("ir-has-report").value = report;
    }

    // Button add
    $("#btn-add-ir").on("click", function(event) {
        event.preventDefault();
        /* Act on the event */

        var $ir_id = document.getElementById("ir_id").value;
        var $area = document.getElementById("ir-has-area").value;
        var $fireout = document.getElementById("ir-has-fireoutdate").value;
        var $report = document.getElementById("ir-has-report").value;

        $.post("controller/ajax.php?q=IncidentReport&m=edit", {
            ir_id: $ir_id,
            area: $area,
            fireout: $fireout,
            report: $report,
        }, function(data, status) {
            $("#modalFileIR").modal("hide");
            showIRs();
            success_update();
        });

    });
</script>