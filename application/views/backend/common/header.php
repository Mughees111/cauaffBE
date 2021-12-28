<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header" style="background: #848484 !important;">
            <a class="navbar-brand" href="<?php echo base_url()."admin"; ?>">
                <!-- Logo icon --><b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img style="width: 40px;" src="<?php echo base_url(); ?>resources/uploads/logo/<?php echo $settings->site_logo_small; ?>" alt="<?php echo $settings->site_title; ?>" class="dark-logo" />
                    <!-- Light Logo icon -->
                    <img style="width: 40px;" src="<?php echo base_url(); ?>resources/uploads/logo/<?php echo $settings->site_logo_small; ?>" alt="<?php echo $settings->site_title; ?>" class="light-logo" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text --><span>
                 <!-- dark Logo text -->
                 <img style="width: 70px;" src="<?php echo base_url(); ?>resources/uploads/logo/<?php echo $settings->site_logo; ?>" alt="<?php echo $settings->site_title; ?>" class="dark-logo" />
                 <!-- Light Logo text -->    
                 <img style="width: 70px;" src="<?php echo base_url(); ?>resources/uploads/logo/<?php echo $settings->site_logo; ?>" class="light-logo" alt="<?php echo $settings->site_title; ?>" /></span> </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler d-block d-sm-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <li class="nav-item" style="display: none;">
                    <form class="app-search d-none d-md-block d-lg-block">
                        <input type="text" class="form-control" placeholder="Search & enter">
                    </form>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
        </div>
    </nav>
</header>