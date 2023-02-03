<?php
include 'core/config.php';
if (!isset($_SESSION['user']['id'])) {
    header("location:authentication.php");
}
$views_file = isset($_GET['q']) ?  $_GET['q'] : 'dashboard';
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, material admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, material design, material dashboard bootstrap 5 dashboard template" />
    <meta name="description" content="MaterialPro is powerful and clean admin dashboard template, inpired from Google's Material Design" />
    <meta name="robots" content="noindex,nofollow" />
    <title>RTFAA</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/materialpro/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png" />
    <link rel="stylesheet" href="../assets/libs/apexcharts/dist/apexcharts.css" />

    <link href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css" />
    <!-- container-scroller -->
    <link rel="stylesheet" href="../assets/plugins/sweet-alert/sweetalert.css">
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- apps -->
    <script src="../dist/js/app.min.js"></script>
    <script src="../dist/js/app.init.dark.js"></script>
    <script src="../dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/feather.min.js"></script>
    <script src="../dist/js/custom.min.js"></script>
    <script src="../assets/plugins/sweet-alert/sweetalert.js"></script>
    <script>
        var global_coords = '';
        getLocation();

        function success_add() {
            swal("Success!", "Successfully added entry!", "success");
        }

        function success_update() {
            swal("Success!", "Successfully updated entry!", "success");
        }

        function success_delete() {
            swal("Success!", "Successfully deleted entry!", "success");
        }

        function entry_already_exists() {
            swal("Cannot proceed!", "Entry already exists!", "warning");
        }

        function username_exists() {
            swal("Cannot proceed!", "Username already taken!", "warning");
        }

        function release_first() {
            swal("Cannot proceed!", "Save transaction first!", "warning");
        }

        function failed_query(data) {
            swal("Failed to execute query!", data, "warning");
            //alert('Something is wrong. Failed to execute query. Please try again.');
        }

        function logout() {
            swal({
                    title: "Are you sure?",
                    text: "Your session will expire!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, sign me out!",
                    cancelButtonText: "No, stay me in!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: "POST",
                            url: "controller/ajax.php?q=Authentication&m=logout",
                            success: function(data) {
                                location.reload();
                            }
                        });
                    } else {
                        swal("Cancelled", "Your session still active", "warning");
                    }
                });
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                global_coords = "";
            }
        }

        function showPosition(position) {
            global_coords = position.coords.latitude + "," + position.coords.longitude;


            $.post("controller/ajax.php?q=Users&m=updateCurrenLocation", {
                coordinates: global_coords
            }, function(data, status) {

            });
            // var google_map_pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            // var google_maps_geocoder = new google.maps.Geocoder();
            // google_maps_geocoder.geocode({
            //         'latLng': google_map_pos
            //     },
            //     function(results, status) {
            //         if (status == google.maps.GeocoderStatus.OK && results[0]) {
            //             console.log(results[0].formatted_address);
            //         }
            //     }
            // );
        }
    </script>
    <style>
        #main-wrapper[data-layout=horizontal] .left-sidebar[data-sidebarbg=skin5] .sidebar-nav ul .sidebar-item.selected>.sidebar-link,
        #main-wrapper[data-layout=vertical] .left-sidebar[data-sidebarbg=skin5] .sidebar-nav ul .sidebar-item.selected>.sidebar-link {
            background-color: #f64b6c;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z" stroke="#1e88e5" stroke-width="2"></path>
            <path d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34" stroke="#1e88e5" stroke-width="2"></path>
            <path id="teabag" fill="#1e88e5" fill-rule="evenodd" clip-rule="evenodd" d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z"></path>
            <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="#1e88e5"></path>
            <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke="#1e88e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->

        <?php include_once 'template/header.php'; ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include_once 'template/sidebar.php'; ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <?php include_once 'views/' . $views_file . '.php'; ?>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                All Rights Reserved by MEFA.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->
    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <?php if($views_file != 'dashboard') { ?>
    <script>
        if (typeof(EventSource) !== "undefined") {
            var source = new EventSource("api/sse.php");
            source.onmessage = function(event) {
                var json_data = JSON.parse(event.data);
                if (json_data.lists.length > 0) {
                    for (let listIndex = 0; listIndex < json_data.lists.length; listIndex++) {
                        const listElem = json_data.lists[listIndex];
                        var notif_messages = '<a href="index.php?q=dashboard" class="message-item d-flex align-items-center border-bottom px-3 py-2">'+
                            '<span class="btn btn-light-danger text-danger btn-circle">'+
                                '<img src="../assets/images/fire-joypixels.gif" alt="img" class="img-fluid">'+
                            '</span>'+
                            '<div class="w-75 d-inline-block v-middle ps-3">'+
                                '<h5 class="message-title mb-0 mt-1 fs-3 fw-bold">Fire Alert</h5>'+
                                '<span class="fs-2 text-nowrap d-block time text-truncate fw-normal text-muted mt-1">'+listElem.message+'</span>'+
                                '<span class="fs-2 text-nowrap d-block subtext text-muted">'+listElem.date_time+'</span>'+
                            '</div>'+
                        '</a>';
                        $("#notif_messages").prepend(notif_messages);
                    }
                    swal("Fire Alert!", "New Fire alert is being detected!", "warning");
                }
            };
        } else {
            swal("Oops!", "SSE is not supported!", "warning");
        }
        loadNotifications();
        function loadNotifications(){
            $.post("controller/ajax.php?q=Notifications&m=dailyAlert", {}, function(data, status) {
                var response = JSON.parse(data);
                for (let mapIndex = 0; mapIndex < response.data.lists.length; mapIndex++) {
                    const mapElem = response.data.lists[mapIndex];
                    var notif_messages = '<a href="index.php?q=dashboard" class="message-item d-flex align-items-center border-bottom px-3 py-2">'+
                        '<span class="btn btn-light-danger text-danger btn-circle">'+
                            '<img src="../assets/images/fire-joypixels.gif" alt="img" class="img-fluid">'+
                        '</span>'+
                        '<div class="w-75 d-inline-block v-middle ps-3">'+
                            '<h5 class="message-title mb-0 mt-1 fs-3 fw-bold">Fire Alert</h5>'+
                            '<span class="fs-2 text-nowrap d-block time text-truncate fw-normal text-muted mt-1">'+mapElem.message+'</span>'+
                            '<span class="fs-2 text-nowrap d-block subtext text-muted">'+mapElem.date_time+'</span>'+
                        '</div>'+
                    '</a>';
                    $("#notif_messages").prepend(notif_messages);
                }
            });
        }
    </script>
    <?php } ?>
</body>

</html>