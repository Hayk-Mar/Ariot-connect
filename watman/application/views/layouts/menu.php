<body data-theme="light" data-layout-mode="horizontal" data-topbar-color="dark" data-menu-position="fixed">

    <!-- Begin page -->
    <div id="wrapper">


        <!-- Topbar Start -->
        <div class="navbar-custom">
            <div class="container-fluid">
                <ul class="list-unstyled topnav-menu float-end mb-0">


                    <li class="dropdown d-none d-lg-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                            <i class="fe-maximize noti-icon"></i>
                        </a>
                    </li>

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="pro-user-name ms-1">
                                <?php echo $this->user['user']['fullName'] ?> <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end profile-dropdown ">

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a href="<?php echo base_url(); ?>account" class="dropdown-item notify-item">
                                <i class="fe-user"></i>
                                <span>Account</span>
                            </a>
                            <a href="<?php echo base_url(); ?>auth/logout" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </li>
    
                    <li class="dropdown notification-list">
                        <a href="<?php echo base_url(); ?>settings" class="nav-link right-bar-toggle waves-effect waves-light">
                            <i class="icon-equalizer noti-icon"></i>
                        </a>
                    </li>
    
                    <li class="dropdown notification-list">
                        <a href="<?php echo base_url(); ?>logs" class="nav-link right-bar-toggle waves-effect waves-light">
                            <i class="icon-notebook noti-icon"></i>
                        </a>
                    </li>
    
                    <li class="dropdown notification-list">
                        <a href="<?php echo base_url(); ?>statistics" class="nav-link right-bar-toggle waves-effect waves-light">
                            <i class="icon-chart noti-icon"></i>
                        </a>
                    </li>
                </ul>

                <!-- LOGO -->
                <div class="logo-box">

                    <a href="<?php echo base_url(); ?>" class="logo logo-light text-center">
                        <span class="logo-sm">
                            <img src="<?php echo base_url(); ?>assets/images/Watman-Logo.png" alt="" height="50">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo base_url(); ?>assets/images/Watman-Logo.png" alt="" height="50">
                        </span>
                    </a>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- end Topbar -->