<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Sensor GIS Mapping</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Sensor GIS Mapping</li>
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="border-bottom title-part-padding">
                    <h4 class="card-title mb-0">Markers</h4>
                </div>
                <div class="card-body">
                    <div id="map_2" class="gmaps"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------------------------- -->
    <!-- End PAge Content -->
    <!-- -------------------------------------------------------------- -->
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoliAneRffQDyA7Ul9cDk3tLe7vaU4yP8"></script>
<script src="https://demos.wrappixel.com/premium-admin-templates/bootstrap/materialpro-bootstrap/package/assets/libs/gmaps/gmaps.min.js"></script>
<script>
    $(function() {
        //******************************************//
        // Markers
        //******************************************//
        var map_2;
        map_2 = new GMaps({
            div: "#map_2",
            lat: -12.043333,
            lng: -77.028333,
        });
        map_2.addMarker({
            lat: -12.043333,
            lng: -77.03,
            title: "Lima",
            details: {
                database_id: 42,
                author: "HPNeo",
            },
            click: function(e) {
                if (console.log) console.log(e);
                alert("You clicked in this marker");
            },
        });
        map_2.addMarker({
            lat: -12.042,
            lng: -77.028333,
            title: "Marker with InfoWindow",
            infoWindow: {
                content: "<p>HTML Content</p>",
            },
        });
    });
</script>