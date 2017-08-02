<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">GeoFencer</a>
            </div>
            <!-- /.navbar-header -->

           
              <?php if($logged) { ?>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <!-- <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                          
                        </li> -->
                        <li>
                            <a href="<?php echo site_url('manager/setfencer'); ?>"><i class="fa fa-dashboard fa-fw"></i> Fence a Location</a>
                        </li>
                        
                        <!-- <li>
                            <a href="<?php //echo site_url('manager/alluserfencechecks'); ?>"><i class="fa fa-table fa-fw"></i> Browse</a>
                        </li> -->

                        <li>
                            <a href="<?php echo site_url('auth/'); ?>"><i class="fa fa-user fa-fw"></i> Users</a>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Browse Check Details<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('manager/browsechecksbyuser'); ?>">Browse by User</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('manager/alluserfencechecks'); ?>">All Users</a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="<?php echo site_url('auth/logout'); ?>"><i class="fa fa-lock fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
              <?php } ?>
            <!-- /.navbar-static-side -->
        </nav>

         <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $page_title; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">