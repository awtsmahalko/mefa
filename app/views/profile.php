            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Profile Page</h3>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Profile Page</li>
                    </ol>
                </div>
                <div class="col-md-7 col-12 align-self-center d-none d-md-block">
                    <div class="d-flex mt-2 justify-content-end">
                        <div class="d-flex me-3 ms-2">
                            <div class="chart-text me-2">
                                <h6 class="mb-0"><small>THIS MONTH</small></h6>
                                <h4 class="mt-0 text-info">$58,356</h4>
                            </div>
                            <div class="spark-chart">
                                <div id="monthchart"></div>
                            </div>
                        </div>
                        <div class="d-flex ms-2">
                            <div class="chart-text me-2">
                                <h6 class="mb-0"><small>LAST MONTH</small></h6>
                                <h4 class="mt-0 text-primary">$48,356</h4>
                            </div>
                            <div class="spark-chart">
                                <div id="lastmonthchart"></div>
                            </div>
                        </div>
                    </div>
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
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="mt-4">
                                    <img src="../assets/images/users/default-user.jpeg" class="rounded-circle" width="150" height="150" />
                                    <h4 class="card-title mt-2"><?= $_SESSION['user']['name'] ?></h4>
                                    <h6 class="card-subtitle"><?= $_SESSION['user']['category'] ?></h6>
                                </center>
                            </div>
                            <div>
                                <hr />
                            </div>
                            <div class="card-body">
                                <small class="text-muted">Email address </small>
                                <h6>hannagover@gmail.com</h6>
                                <small class="text-muted pt-4 db">Phone</small>
                                <h6>+91 654 784 547</h6>
                                <small class="text-muted pt-4 db">Address</small>
                                <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6>
                                <div class="map-box">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border: 0" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-setting-tab" data-bs-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Setting</a>
                                </li>
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-6 b-r">
                                                <strong>Full Name</strong>
                                                <br />
                                                <p class="text-muted"><?= $_SESSION['user']['name'] ?></p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r">
                                                <strong>Mobile</strong>
                                                <br />
                                                <p class="text-muted">(123) 456 7890</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r">
                                                <strong>Email</strong>
                                                <br />
                                                <p class="text-muted">johnathan@admin.com</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6">
                                                <strong>Location</strong>
                                                <br />
                                                <p class="text-muted">London</p>
                                            </div>
                                        </div>
                                        <hr />
                                        <p class="mt-4">
                                            Donec pede justo, fringilla vel, aliquet nec, vulputate
                                            eget, arcu. In enim justo, rhoncus ut, imperdiet a,
                                            venenatis vitae, justo. Nullam dictum felis eu pede
                                            mollis pretium. Integer tincidunt.Cras dapibus. Vivamus
                                            elementum semper nisi. Aenean vulputate eleifend tellus.
                                            Aenean leo ligula, porttitor eu, consequat vitae,
                                            eleifend ac, enim.
                                        </p>
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. Lorem Ipsum has been the
                                            industry's standard dummy text ever since the 1500s,
                                            when an unknown printer took a galley of type and
                                            scrambled it to make a type specimen book. It has
                                            survived not only five centuries
                                        </p>
                                        <p>
                                            It was popularised in the 1960s with the release of
                                            Letraset sheets containing Lorem Ipsum passages, and
                                            more recently with desktop publishing software like
                                            Aldus PageMaker including versions of Lorem Ipsum.
                                        </p>
                                        <hr />
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">
                                        <form class="form-horizontal form-material">
                                            <div class="mb-3">
                                                <label class="col-md-12">Full Name</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line" />
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-email" class="col-md-12">Email</label>
                                                <div class="col-md-12">
                                                    <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email" />
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-md-12">Password</label>
                                                <div class="col-md-12">
                                                    <input type="password" value="password" class="form-control form-control-line" />
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-md-12">Phone No</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="123 456 7890" class="form-control form-control-line" />
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-md-12">Message</label>
                                                <div class="col-md-12">
                                                    <textarea rows="5" class="form-control form-control-line"></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-sm-12">Select Country</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-control-line">
                                                        <option>London</option>
                                                        <option>India</option>
                                                        <option>Usa</option>
                                                        <option>Canada</option>
                                                        <option>Thailand</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success">
                                                        Update Profile
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- -------------------------------------------------------------- -->
                <!-- End PAge Content -->
                <!-- -------------------------------------------------------------- -->
            </div>
            <!-- -------------------------------------------------------------- -->
            <!-- End Container fluid  -->