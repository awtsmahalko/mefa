<style>
    .timeline {
        position: relative;
        padding: 5px;
        list-style: none;
        max-width: 1200px;
        margin: 0 auto;
    }
</style>
<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Dashboard</h3>
        <ol class="breadcrumb mb-0 p-0 bg-transparent">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- Row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="border-bottom title-part-padding">
                    <div class="row col-md-12">
                        <h2>Today's live Fire Alerts </h2>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div id="dashboard_map_canvas" style="height:600px;"></div>
                        </div>
                        <div class="col-md-4">
                            <div style="max-height:600px;overflow-x:hidden;">
                                <ul class="timeline timeline-left" id="result">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card-body">
                            <h3>Fire Alerts</h3>
                            <h6 class="card-subtitle mb-0">
                                Monthly fire alert in 2 years
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div id="sales-of-ample-vs-pixel" style="height: 350px"></div>
                </div>
            </div>
        </div>
    </div>
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
                            <input type="hidden" id="notif_id" />
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
<style type="text/css">
    .labels {
        color: white;
        background-color: red;
        font-family: "Lucida Grande", "Arial", sans-serif;
        font-size: 10px;
        text-align: center;
        width: 10px;
        white-space: nowrap;
    }
</style>

<script>
    var session_user_category = "<?=$_SESSION['user']['category']?>";
    if (typeof (EventSource) !== "undefined") {
        var source = new EventSource("api/sse.php");
        source.onmessage = function(event) {
            var json_data = JSON.parse(event.data);
            if (json_data.lists.length > 0) {
                for (let listIndex = 0; listIndex < json_data.lists.length; listIndex++) {
                    const listElem = json_data.lists[listIndex];
                    dashboard_map_marker(listElem.lat, listElem.lng, listElem.label, listElem.address);
                }
                newSeries();
                swal("Fire Alert!", "New Fire alert is being detected!", "warning");

            }
        };
    } else {
        document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
    }
    $(document).ready(function() {
        dashboard_init_map();
        // swal({
        //     title: 'Custom width, padding, color, background.',
        //     width: 600,
        //     padding: '3em',
        //     color: '#716add',
        //     background: '#fff url(/images/trees.png)',
        //     backdrop: `
        //             rgba(0,0,123,0.4)
        //             url("../assets/images/fire-joypixels.gif")
        //             left top
        //             no-repeat
        //             `
        // })
    });

    function dashboard_map_marker(lat, lng, label, address = '', is_location = 0, radius = 2, notif_id = 0, status = 0, has_notif = 0) {
        var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
        var pos = {
            lat: lat,
            lng: lng
        };
        var icon = {
            url: "../assets/images/fire-joypixels.gif", // url
            scaledSize: new google.maps.Size(25, 25), // scaled size
        };
        var marker_option = {
            position: pos,
            map: dashboard_map,
            draggable: false,
            animation: google.maps.Animation.DROP,
        };

        if (is_location == 1) {
            marker_option['label'] = label;
            marker = new google.maps.Marker(marker_option);

            circle_radius = radius * 1000;
            var circle = new google.maps.Circle({
                radius: circle_radius,
                center: pos, //new google.maps.LatLng(lat, long),
                fillColor: '#FF0000',
                fillOpacity: 0.2,
                strokeColor: '#FF0000',
                strokeOpacity: 0.6
            });
            circle.setMap(dashboard_map);
        } else {
            marker_option['icon'] = icon;
            if (status == 0) {
                marker = new google.maps.Marker(marker_option);
                var button_fire_out = session_user_category == 'R' ? '' : '<button class="btn btn-default btn-xs" onclick="fireOut(' + notif_id + ')"><span class="fa fa-check"></span> Fire Out</button>';
                var fire_responded = '<span class="badge bg-warning text-dark">Fire not yet responded</span>';
            } else {
                var button_fire_out = '';
                var button_ir = '';
                var fire_responded = '<span class="badge bg-success">Fire already responded</span>';
            }

            if (has_notif == 0) {
                var button_ir = '';
                if (session_user_category == 'F') {
                    button_ir = '<button class="btn btn-secondary btn-xs" onclick="fileIR(' + notif_id + ')"><span class="fa fa-file"></span> File IR</button>';
                }
            }

            var li_label = '<li class="timeline-inverted timeline-item">' +
                '<div class="timeline-badge success">' +
                '<img src="../assets/images/fire-joypixels.gif" alt="img" class="img-fluid">' +
                '</div>' +
                '<div class="timeline-panel">' +
                // '<h4 class="timeline-title">' + address + '</h4>' +
                '<div class="timeline-heading">' +
                '<p>' + button_fire_out + " " + button_ir + '</p>' +
                '<p>' +
                '<small class="text-muted"><i class="fa fa-clock-o"></i> ' + label + '</small>' +
                '</p>' +
                '</div>' +
                '<div class="timeline-body">' +
                '<p>' + address + '</p>' + fire_responded +
                '</div>' +
                '</div>' +
                '</li>';
            $("#result").prepend(li_label);
        }


        // circle_radius = 15;
        // var circle = new google.maps.Circle({
        //     radius: circle_radius,
        //     center: new google.maps.LatLng(lat, lng),
        //     fillColor: '#FF0000',
        //     fillOpacity: 1,
        //     strokeColor: '#FF0000',
        //     strokeOpacity: 1
        // });

        // circle.setMap(dashboard_map);

        //document.getElementById("result").innerHTML += label + "<br>";
        // const address = await getCoordinates3(lat + "," + lng);
    }

    function location_marker() {

        $.post("controller/ajax.php?q=Users&m=rnPcoordinates", {}, function(data, status) {

            var response = JSON.parse(data);
            for (let mapIndex = 0; mapIndex < response.length; mapIndex++) {
                const mapElem = response[mapIndex];

                dashboard_map_marker(mapElem.lat, mapElem.lng, mapElem.marker, 'mapElem.address', 1, mapElem.radius);
            }

        });
    }

    function dashboard_init_map() {
        var property_radius = 2;
        var coordinates = global_coords != '' ? global_coords : "10.642612789500305,122.93891728037974";
        var split_coords = coordinates.split(",");
        var lat = split_coords[0] * 1;
        var lng = split_coords[1] * 1;
        var pos = {
            lat: lat,
            lng: lng
        };

        // center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
        var options = {
            zoom: 14,
            center: pos,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [{
                featureType: "poi",
                elementType: "labels",
                stylers: [{
                    visibility: "off"
                }]

            }]
        };

        dashboard_map = new google.maps.Map(document.getElementById("dashboard_map_canvas"), options);
        location_marker();
        var marker;
        $.post("controller/ajax.php?q=Notifications&m=dailyAlert", {}, function(data, status) {

            $("#result").html("");
            var response = JSON.parse(data);
            for (let mapIndex = 0; mapIndex < response.data.lists.length; mapIndex++) {
                const mapElem = response.data.lists[mapIndex];

                dashboard_map_marker(mapElem.lat, mapElem.lng, mapElem.label, mapElem.address, 0, 0, mapElem.id, mapElem.status);
                newSeries();
            }

        });
    }

    function fireOut(notif_id) {
        swal({
            title: "Are you sure?",
            text: "You are about to fire out this alert!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, fire out!",
            cancelButtonText: "No",
        },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: "POST",
                        data: {
                            notif_id: notif_id
                        },
                        url: "controller/ajax.php?q=Notifications&m=fire_out",
                        success: function(data) {
                            dashboard_init_map();
                        }
                    });
                }
            });
    }

    function fileIR(notif_id) {
        document.getElementById("notif_id").value = notif_id;
        document.getElementById("ir-has-area").value = '';
        document.getElementById("ir-has-fireoutdate").value = '';
        document.getElementById("ir-has-report").value = '';
        $("#modalFileIR").modal('show');
    }

    // Button add
    $("#btn-add-ir").on("click", function(event) {
        event.preventDefault();
        /* Act on the event */

        var $notif_id = document.getElementById("notif_id").value;
        var $area = document.getElementById("ir-has-area").value;
        var $fireout = document.getElementById("ir-has-fireoutdate").value;
        var $report = document.getElementById("ir-has-report").value;

        $.post("controller/ajax.php?q=IncidentReport&m=add", {
            notif_id: $notif_id,
            area: $area,
            fireout: $fireout,
            report: $report,
        }, function(data, status) {
            $("#modalFileIR").modal("hide");
            success_add();
            location.reload();
        });

    });
</script>

<!--This page JavaScript -->
<!-- chartist chart -->
<script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<!-- Chart JS -->
<script>
    var sales_of_ample_vs_pixel = {
        series: [{
            name: "Year 2021 ",
            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        },],
        chart: {
            height: 350,
            type: "area",
            stacked: false,
            fontFamily: "Poppins,sans-serif",
            zoom: {
                enabled: false,
            },
            toolbar: {
                show: false,
            },
        },
        colors: ["rgba(210, 29, 75, 0.7)", "rgba(210, 29, 75, 0.4)"],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: false,
        },
        markers: {
            size: 2,
            strokeColors: "transparent",
            colors: "#26c6da",
        },
        fill: {
            type: "solid",
            colors: ["rgba(210, 29, 75, 0.7)", "rgba(210, 29, 75, 0.4)"],
            opacity: 1,
        },
        grid: {
            strokeDashArray: 3,
            borderColor: "rgba(0,0,0,0.2)",
        },
        xaxis: {
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            categories: [
                "January",
                "Febuary",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ],
            labels: {
                style: {
                    colors: "#a1aab2",
                },
            },
        },
        yaxis: {
            labels: {
                style: {
                    colors: "#a1aab2",
                },
            },
        },
        legend: {
            show: false,
        },
        tooltip: {
            theme: "dark",
            marker: {
                show: true,
            },
        },
    };

    function renderGraph() {
        $("#sales-of-ample-vs-pixel").html("");
        var chart_line_overview = new ApexCharts(
            document.querySelector("#sales-of-ample-vs-pixel"),
            sales_of_ample_vs_pixel
        );
        chart_line_overview.render();
    }

    function newSeries() {
        $.post("controller/ajax.php?q=Notifications&m=yearlyReport", {}, function(data, status) {
            var res = JSON.parse(data);
            sales_of_ample_vs_pixel.series = res;
            renderGraph();
        });
    }
    newSeries();
</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC232qKEVqI5x0scuj9UGEVUNdB98PiMX0&callback=dashboard_init_map"></script>