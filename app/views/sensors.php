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
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sensor Code</th>
                                    <th>Holder</th>
                                    <th>Address</th>
                                    <th>Map</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>458cd</td>
                                    <td>Rino</td>
                                    <td>Bacolod City</td>
                                    <td><a href="sa"><i class="mdi mdi-google-maps"></i></a></td>
                                </tr>

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
                    <h5 class="modal-title text-white">Add Posts</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="notes-box">
                        <div class="notes-content">
                            <form action="javascript:void(0);" id="addnotesmodalTitle">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="note-title">
                                            <label>Sensor Code</label>
                                            <input type="text" id="note-has-title" class="form-control" minlength="25" placeholder="Sensor Code" />
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="note-category">
                                            <label>Owner</label>
                                            <select id="note-has-category" class="form-select">
                                                <option value=""> Please Select </option>
                                                <option value="A"> Announcement </option>
                                                <option value="I"> Important </option>
                                            </select>
                                            <div style="font-size: .875em;color: #fc4b6c;display:none;" id="category-error">Please select a category!</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="note-description">
                                            <label>Description</label>
                                            <textarea id="note-has-description" class="form-control" minlength="60" placeholder="Description" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">
                        Discard
                    </button>
                    <button id="btn-n-add" class="btn btn-info" disabled>
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
<script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>
<script>
    $("#add-sensor").on("click", function(event) {
        $("#addsensormodal").modal("show");
        $("#btn-n-save").hide();
        $("#btn-n-add").show();
    });
</script>