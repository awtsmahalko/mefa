<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Users</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Users</li>
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
                            <h4 class="card-title mb-0">Manage Users</h4>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary rounded-pill pull-right" id="add-user" style="float: right;"><i data-feather="plus" class="feather-sm fill-white me-0 me-md-1"></i> <span class="font-weight-medium fs-3">Add User</span></button>
                            <!-- <a href="javascript:void(0)" class="nav-link btn-primary rounded-pill d-flex align-items-center px-3" id="add-user">
                                <i data-feather="plus" class="feather-sm fill-white me-0 me-md-1"></i><span class="d-none d-md-block font-weight-medium fs-3">Add user</span></a>
                            <a href="javascript:void(0)" class="nav-link btn-primary rounded-pill d-flex align-items-center px-3" id="add-user">
                                <i data-feather="plus" class="feather-sm fill-white me-0 me-md-1"></i><span class="d-none d-md-block font-weight-medium fs-3">Add user</span></a> -->
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dt_users" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Date Added</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------------------------- -->
    <!-- End PAge Content -->
    <!-- -------------------------------------------------------------- -->
    <div class="modal fade" id="addusermodal" tabindex="-1" role="dialog" aria-labelledby="addUserForm" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <form id="addUserForm">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title text-white">Add Fire Officer</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="notes-box">
                            <div class="notes-content">
                                <input type="hidden" id="user_id" />
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="user-name">
                                            <label>Fire Officer Name</label>
                                            <input name="user_fullname" type="text" id="user-has-name" class="form-control" minlength="6" autocomplete="off" placeholder="Fire officer name" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="user-department-id">
                                            <label>Fire user</label>
                                            <select name="department_id" id="user-has-department-id" class="form-control select2" required>
                                                <option value="">&mdash; Please Select &mdash;</option>
                                                <?= Departments::option() ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="user-username">
                                                <label>Username</label>
                                                <input name="username" type="text" id="user-has-username" class="form-control" autocomplete="off" required />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="user-password">
                                                <label>Password</label>
                                                <input name="password" type="password" id="user-has-password" class="form-control" autocomplete="off" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" id="btn-add-user" class="btn btn-info">
                            Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--This page plugins -->
<script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
<script>
    showUsers();

    function showUsers() {
        $("#dt_users").DataTable().destroy();
        $('#dt_users').DataTable({
            "processing": true,
            "ajax": {
                "type": "POST",
                "url": "controller/ajax.php?q=Users&m=datatable",
                "dataSrc": "data",
            },
            "columns": [{
                    "data": "count"
                },
                {
                    "render": function(data, type, row) {
                        return '<div class="d-flex align-items-center">' +
                            '<img src="../assets/images/users/default-user.jpeg" class="rounded-circle" alt="user" width="45">' +
                            '<div class="ms-3">' +
                            '<div class="user-meta-info">' +
                            '<h6 class="user-name mb-0 font-weight-medium">' + row.user_fullname + '</h6>' +
                            '<small class="user-work text-muted">' + (row.user_category == 'R' ? 'Resident' : row.user_category == 'F' ? 'Fire Officer' : 'Admin') + '</small>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    },
                },
                {
                    "render": function(data, type, row) {
                        if (row.user_category == 'F') {
                            var address = row.department.department_name;
                            var station = '<small class="user-work text-muted">' + row.department.department_address + '</small>';
                            var show_location = "showDepartment(" + row.department.department_id + ")";
                        } else {
                            var address = row.user_address;
                            var station = "";
                            var show_location = "showResident(" + row.user_id + ")";
                        }
                        return '<div class="d-flex align-items-center">' +
                            '<button class="btn btn-success rounded-pill" onclick="' + show_location + '"><span class="fa fa-map-marker"></span></button>' +
                            '<div class="ms-3">' +
                            '<div class="user-meta-info">' +
                            '<h6 class="user-name mb-0 font-weight-medium">' + address + '</h6>' +
                            station +
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

    function showResident(user_id) {
        window.location = "index.php?q=resident_location&user_id=" + user_id;
    }

    function showDepartment(department_id) {
        window.location = "index.php?q=department_location&department_id=" + department_id;
    }

    $("#add-user").on("click", function(event) {
        $("#addusermodal").modal("show");
        $("#btn-n-save").hide();
        $("#btn-add-user").show();
    });

    $("#addUserForm").on("submit", function(event) {
        event.preventDefault();
        /* Act on the event */

        // var $_userId = document.getElementById("user_id").value;
        // var $_userName = document.getElementById("user-has-name").value;
        // var $_userDepartmentId = document.getElementById("user-has-department-id").value;
        // var $_userUsername = document.getElementById("user-has-username").value;
        // var $_userPAssword = document.getElementById("user-has-password").value;

        $.post("controller/ajax.php?q=Users&m=addFireOfficer", $("#addUserForm").serialize(), function(data, status) {
            showUsers();
            if (data == 1) {
                success_add();
                $("#addusermodal").modal("hide");
            } else if (data == 2) {
                username_exists()
            } else {
                failed_query(data);
            }
        });

        // $.post("controller/ajax.php?q=Users&m=addFireOfficer", {
        //     user_id: $_userId,
        //     user_fullname: $_userName,
        //     department_id: $_userDepartmentId,
        //     username: $_userUsername,
        //     password: $_userPAssword,
        // }, function(data, status) {
        //     alert(data);
        //     $("#addusermodal").modal("hide");
        //     showUsers();
        // });

    });
</script>