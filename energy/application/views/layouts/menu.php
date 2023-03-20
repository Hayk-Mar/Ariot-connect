<body>
    <div id="wrapper">

        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-right mb-0">
                <li class="dropdown notification-list">

                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="pro-user-name ms-1">
                            <?= $this->user['user']['fullName'] ?> <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                        <div class="dropdown-divider"></div>

                        <a href="<?= base_url(); ?>account" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>Account</span>
                        </a>
                        <a href="<?= base_url(); ?>auth/logout" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>


            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="<?= base_url(); ?>" class="logo logo-light text-center">
                    <span class="logo-sm">
                        <img src="<?= base_url(); ?>assets/images/Ariot-Logos-small.png" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= base_url(); ?>assets/images/Ariot-Logos.png" alt="" height="50">
                    </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile waves-effect waves-light">
                        <i class="fe-menu"></i>
                    </button>
                </li>
            </ul>
        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div>

                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <ul class="metismenu" id="side-menu">

                        <li class="menu-title">Navigation</li>

                        <?php if (!empty($this->raspberries)) { ?>
                            <li>
                                <a href="<?= base_url(); ?>">
                                    <i class="icon-screen-desktop noti-icon"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= base_url(); ?>statistics">
                                    <i class="icon-chart noti-icon"></i>
                                    <span> Statistics </span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= base_url(); ?>logs">
                                    <i class="icon-notebook noti-icon"></i>
                                    <span> Logs </span>
                                </a>
                            </li>
                        <?php } ?>

                        <li>
                            <a href="<?= base_url(); ?>settings">
                                <i class="icon-equalizer noti-icon"></i>
                                <span> Settings </span>
                            </a>
                        </li>

                    </ul>

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>