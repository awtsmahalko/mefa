<?php
$department_data = Departments::dataOf($_GET['department_id']);
?>
<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Department Location</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Department Location</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <!-- -------------------------------------------------------------- -->
    <!-- Start Page Content -->
    <!-- -------------------------------------------------------------- -->
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="border-bottom title-part-padding">
                    <input type="hidden" id="department_id" value="<?= $department_data['department_id'] ?>">
                    <input type="hidden" id="department_name" value="<?= $department_data['department_name'] ?>">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Coordinates</div>
                                </div>
                                <input type="text" class="form-control" id="department_coordinates" value="<?= $department_data['department_coordinates'] ?>" readonly>
                            </div>
                            <!-- <button class="btn btn-primary rounded-pill" id="add-department"><i data-feather="plus" class="feather-sm fill-white me-0 me-md-1"></i> <span class="font-weight-medium fs-3">Add Department</span></button> -->
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Radius (km)</div>
                                </div>
                                <input type="number" class="form-control" id="department_radius" value="<?= $department_data['department_radius'] ?>" min=".01" step=".01" onchange="init_map()">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-2 mr-sm-2">
                                <button class="btn btn-success rounded-pill" id="btn-update-coords" onclick="updateCoordinates()"><i data-feather="check" class="feather-sm fill-white me-0 me-md-1"></i> <span class="font-weight-medium fs-3">Save Coordinates</span></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div style="border: 1px solid #ddd;width: 100%;padding: 0px;">
                        <div id="map_canvas" style="height:450px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script src=" https://demos.wrappixel.com/premium-admin-templates/bootstrap/materialpro-bootstrap/package/assets/libs/gmaps/gmaps.min.js">
</script> -->
<script type="text/javascript">
    var department_name = $("#department_name").val();
    var zoom = 12;
    $(document).ready(function() {
        init_map();
    });

    function init_map() {
        var department_radius = $("#department_radius").val();
        var department_coordinates = $("#department_coordinates").val();
        var split_coords = department_coordinates.split(",");
        var lat = split_coords[0] * 1;
        var lng = split_coords[1] * 1;
        var pos = {
            lat: lat,
            lng: lng
        };

        // center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
        var options = {
            zoom: zoom,
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

        map = new google.maps.Map(document.getElementById("map_canvas"), options);

        var marker;
        marker = new google.maps.Marker({
            position: pos, //new google.maps.LatLng(lat, long),
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            label: department_name
        });

        circle_radius = department_radius * 1000;
        var circle = new google.maps.Circle({
            radius: circle_radius,
            center: pos, //new google.maps.LatLng(lat, long),
            fillColor: '#FF0000',
            fillOpacity: 0.2,
            strokeColor: '#FF0000',
            strokeOpacity: 0.6
        });

        circle.setMap(map);
        drag_listener(marker, map, circle);

    }

    function drag_listener(marker, map, circle) {
        marker.addListener('drag', function() {
            circle.setMap(null);
        });

        marker.addListener('dragend', function(e) {
            map.setZoom(zoom);
            var marker_position = e.latLng.lat() + "," + e.latLng.lng();
            $("#department_coordinates").val(marker_position);
            map.setCenter(marker.getPosition());
            circle.setMap(map);
            circle.bindTo('center', marker, 'position');
        });
    }

    function updateCoordinates() {
        var $_departmentId = document.getElementById("department_id").value;
        var $_departmentCoordinates = document.getElementById("department_coordinates").value;
        var $_departmentRadius = document.getElementById("department_radius").value;

        $.post("controller/ajax.php?q=Departments&m=updateCoordinates", {
            department_coordinates: $_departmentCoordinates,
            department_radius: $_departmentRadius,
            department_id: $_departmentId
        }, function(data, status) {
            success_update();
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC232qKEVqI5x0scuj9UGEVUNdB98PiMX0&callback=init_map"></script>