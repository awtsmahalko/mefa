<header class="topbar" data-navbarbg="skin3">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin3">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="index.html">
                <!-- Logo icon -->
                <b class="logo-icon">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <span class="round rounded-circle text-white d-inline-block text-center bg-primary"><img src="../assets/images/fire-joypixels.gif" alt="img" class="img-fluid"></span>
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text" style="font-weight: 900;font-size: xx-large;">RTFAA</span>
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav me-auto">
                <!-- This is  -->
                <li class="nav-item">
                    <a class="
                    nav-link
                    sidebartoggler
                    d-none d-md-block
                    waves-effect waves-dark
                  " href="javascript:void(0)"><i class="ti-menu"></i></a>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav">
                <!-- ============================================================== -->
                <!-- Comment -->
                <!-- ============================================================== -->
                <?php if($views_file != 'dashboard') { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-message"></i>
                        <div class="notify">
                            <span class="heartbit"></span> <span class="point"></span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end mailbox dropdown-menu-animate-up">
                        <ul class="list-style-none">
                            <li>
                                <div class="border-bottom rounded-top py-3 px-4">
                                    <div class="mb-0 font-weight-medium fs-4">
                                        Notifications
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="message-center notifications position-relative" style="height: 200px" id="notif_messages">
                                </div>
                            </li>
                            <li>
                                <a class="nav-link border-top text-center text-dark pt-3" href="index.php?q=dashboard">
                                    <strong>Check all notifications</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php } ?>
                <!-- ============================================================== -->
                <!-- End Comment -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="../assets/images/users/default-user.jpeg" alt="user" width="30" class="profile-pic rounded-circle" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end user-dd animated flipInY">
                        <div class="d-flex no-block align-items-center p-3 bg-info text-white mb-2">
                            <div class="">
                                <img src="../assets/images/users/default-user.jpeg" alt="user" class="rounded-circle" width="60" />
                            </div>
                            <div class="ms-2">
                                <h4 class="mb-0 text-white"><?= $_SESSION['user']['name'] ?></h4>
                                <!-- <p class="mb-0">varun@gmail.com</p> -->
                            </div>
                        </div>
                        <a class="dropdown-item" href="index.php?q=profile"><i data-feather="user" class="feather-sm text-info me-1 ms-1"></i>
                            My Profile</a>
                        <div class="dropdown-divider"></div>
                        <!-- <a class="dropdown-item" href="#"><i data-feather="settings" class="feather-sm text-warning me-1 ms-1"></i>
                            Account Setting</a>
                        <div class="dropdown-divider"></div> -->
                        <a class="dropdown-item" href="#" onclick="logout()"><i data-feather="log-out" class="feather-sm text-danger me-1 ms-1"></i>
                            Logout</a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>