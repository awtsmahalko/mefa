<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile position-relative" style="
              background: url(../assets/images/background/user-info.jpg)
                no-repeat;
            ">
            <!-- User profile image -->
            <div class="profile-img">
                <br>
            </div>
            <!-- User profile text-->
            <div class="profile-text pt-1 ">
                <a href="#" class="w-100 text-white d-block position-relative"><?= $_SESSION['user']['name'] ?></a>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Personal</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="index.php">
                        <i class="mdi mdi-gauge"></i>
                        <span class="hide-menu">Dashboard </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="index.php?q=profile">
                        <i class="mdi mdi-account-circle"></i>
                        <span class="hide-menu">Profile </span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">MASTER DATA</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="index.php?q=users">
                        <i class="mdi mdi-account-multiple"></i>
                        <span class="hide-menu">USERS </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="index.php?q=post">
                        <i class="mdi mdi-content-paste"></i>
                        <span class="hide-menu">POSTS </span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">DEVICES</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="index.php?q=sensors">
                        <i class="mdi mdi-image-filter-tilt-shift"></i>
                        <span class="hide-menu">SMOKE SENSORS </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="index.php?q=sensorsmap">
                        <i class="mdi mdi-google-maps"></i>
                        <span class="hide-menu">SENSOR MAPPING </span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Extra</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="auth/logout.php" aria-expanded="false"><i class="mdi mdi-directions"></i><span class="hide-menu">Log Out</span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>