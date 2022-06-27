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
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="card-body">
                            <h3>Emergency Alerts</h3>
                            <h6 class="card-subtitle mb-0">
                                check the difference from last year
                            </h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 border-end align-self-center">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="col-8 p-0 align-self-center">
                                    <h3 class="mb-0">1250</h3>
                                    <h5 class="text-muted mb-0">2021</h5>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="
                              round
                              text-white
                              d-inline-block
                              text-center
                              rounded-circle
                              bg-success
                            ">
                                        <i class="mdi mdi-chart-line"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 align-self-center">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="col-8 p-0 align-self-center">
                                    <h3 class="mb-0">15478</h3>
                                    <h5 class="text-muted mb-0">2022</h5>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="
                              round
                              text-white
                              d-inline-block
                              text-center
                              rounded-circle
                              bg-inverse
                            ">
                                        <i class="mdi mdi-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
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

<!--This page JavaScript -->
<!-- chartist chart -->
<script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<!-- Chart JS -->
<script>
    $(function() {
        "use strict";

        // -----------------------------------------------------------------------
        // Realtime chart
        // -----------------------------------------------------------------------

        // -----------------------------------------------------------------------
        // Ample vs Pixel
        // -----------------------------------------------------------------------

        var sales_of_ample_vs_pixel = {
            series: [{
                    name: "Year 2021 ",
                    data: [0, 1, 1, 10, 24, 6, 12, 4, 21, 15, 44, 24],
                },
                {
                    name: "Year 2022 ",
                    data: [
                        0, 4, 3, 24, 9, 10, 18, 15, 44, 17, 19, 26,
                    ],
                },
            ],
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
        var chart_line_overview = new ApexCharts(
            document.querySelector("#sales-of-ample-vs-pixel"),
            sales_of_ample_vs_pixel
        );
        chart_line_overview.render();
    });
</script>