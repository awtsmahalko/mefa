<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Properties Location</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Properties Location</li>
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
                    <div class="row col-md-12">
                        <div class="col-md-9">
                            <h4 class="card-title mb-0">Manage Properties</h4>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary rounded-pill" id="add-property"><i data-feather="plus" class="feather-sm fill-white me-0 me-md-1"></i> <span class="font-weight-medium fs-3">Add Properties</span></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div style="border: 1px solid #ddd;width: 65%;padding: 0px;">
                        <div id="map_canvas"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://demos.wrappixel.com/premium-admin-templates/bootstrap/materialpro-bootstrap/package/assets/libs/gmaps/gmaps.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        init_map();
    });

    function init_map() {
        var pos = {
            lat: 10.682769028920585,
            lng: 122.9436225232788
        };

        // center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
        var options = {
            zoom: 8,
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

        lat = 10.68276902892;
        long = 122.9435232788;
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, long),
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            label: "mark "
        });

        circle_radius = 10.24 * 1000;
        var circle = new google.maps.Circle({
            radius: circle_radius,
            center: new google.maps.LatLng(lat, long),
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
            map.setZoom(8);
            var marker_position = e.latLng.lat() + "," + e.latLng.lng();
            map.setCenter(marker.getPosition());
            circle.setMap(map);
            circle.bindTo('center', marker, 'position');
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC232qKEVqI5x0scuj9UGEVUNdB98PiMX0&callback=init_map"></script>