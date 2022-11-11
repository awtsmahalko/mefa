<?php
$user_data = Users::dataOf($_GET['user_id']);

$is_same_user = $user_data['user_id'] == $_SESSION['user']['id'];
?>
<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Resident Location</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Resident Location</li>
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
                    <input type="hidden" id="user_id" value="<?= $user_data['user_id'] ?>">
                    <input type="hidden" id="user_name" value="<?= $user_data['user_fullname'] ?>">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Coordinates</div>
                                </div>
                                <input type="text" class="form-control" id="user_coordinates" value="<?= $user_data['user_resident_coordinates'] ?>" readonly>
                            </div>
                            <!-- <button class="btn btn-primary rounded-pill" id="add-user"><i data-feather="plus" class="feather-sm fill-white me-0 me-md-1"></i> <span class="font-weight-medium fs-3">Add Users</span></button> -->
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Radius (km)</div>
                                </div>
                                <input type="number" class="form-control" id="user_radius" value="<?= $user_data['user_radius'] ?>" min=".01" step=".01" onchange="init_map()" <?= $is_same_user ? '' : 'readonly'; ?>>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-2 mr-sm-2">
                                <button class="btn btn-success rounded-pill" id="btn-update-coords" onclick="updateCoordinates()" <?= $is_same_user ? '' : 'disabled'; ?>><i data-feather="check" class="feather-sm fill-white me-0 me-md-1"></i> <span class="font-weight-medium fs-3">Save Coordinates</span></button>
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
    var user_name = $("#user_name").val();
    var zoom = 14;
    $(document).ready(function() {
        init_map();
    });

    function init_map() {
        var user_radius = $("#user_radius").val();
        var user_coordinates = $("#user_coordinates").val();
        var split_coords = user_coordinates.split(",");
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
        var icon = {
            url: "../assets/images/home_marker.png", // url
            scaledSize: new google.maps.Size(100, 100), // scaled size
            // origin: new google.maps.Point(0, 0), // origin
            //anchor: new google.maps.Point(0, 0) // anchor
        };
        var marker;
        marker = new google.maps.Marker({
            // icon: icon,
            position: pos, //new google.maps.LatLng(lat, long),
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            label: user_name
        });

        circle_radius = user_radius * 1000;
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
            $("#user_coordinates").val(marker_position);
            map.setCenter(marker.getPosition());
            circle.setMap(map);
            circle.bindTo('center', marker, 'position');
        });
    }

    function updateCoordinates() {
        var $_userId = document.getElementById("user_id").value;
        var $_userCoordinates = document.getElementById("user_coordinates").value;
        var $_userRadius = document.getElementById("user_radius").value;

        $.post("controller/ajax.php?q=Users&m=updateResidentCoordinates", {
            user_resident_coordinates: $_userCoordinates,
            user_radius: $_userRadius,
            user_id: $_userId
        }, function(data, status) {
            success_update();
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC232qKEVqI5x0scuj9UGEVUNdB98PiMX0&callback=init_map"></script>