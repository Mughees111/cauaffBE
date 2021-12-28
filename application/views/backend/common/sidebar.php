
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User Profile-->
                <div class="user-profile">
                    <div class="user-pro-body">
                        <div><img src="<?php echo base_url(); ?>resources/uploads/profiles/<?php echo $this->session->userdata("admin_profile_pic"); ?>" alt="user-img" class="img-circle"></div>
                        <div class="dropdown">
                            <a  href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata("admin_name")?$this->session->userdata("admin_name"):"Admin"; ?> <span class="caret"></span></a>
                            <div class="dropdown-menu animated flipInY">
                                <!-- text-->
                                <a href="<?php echo base_url()."admin/my-profile"; ?>" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                                <!-- text-->
                                <?php /* ?>
                                <div class="dropdown-divider"></div>

                                <a href="<?php echo $url."admin/";?>company-details" class="dropdown-item"><i class="ti-user"></i> Manage Company</a>
                                <?php 
                                */ ?>

                                <div class="dropdown-divider"></div>
                                <!-- text-->
                                <?php if(check_role(2)){ ?>
                                <a href="<?php echo base_url()."admin/settings"; ?>" class="dropdown-item"><i class="ti-settings"></i> Setting</a>
                                <?php } ?>
                                <!-- text-->
                                <div class="dropdown-divider"></div>
                                <!-- text-->
                                <a href="<?php echo base_url().'admin/logout'; ?>" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                                <!-- text-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
						<li class="<?=($active == 'dashboard')?'active':'';?>"> <a class="waves-effect waves-dark" href="<?php echo base_url().'admin/dashboard';?>" aria-expanded="false"><i class="fa fa-dashboard"></i><span class="hide-menu">Dashboard</span></a>
						</li>
                       
                    <?php if(check_role(1)){ ?>

                        <li class="<?=($active == 'push')?'active':'';?>"> 
                            <a class="
                            waves-effect waves-dark" 
                            href="<?php
                            echo base_url()."admin/push-notifications";
                             ?>"
                            >
                            <span>
                             <i class="fa fa-paper-plane"></i>   Send Push
                            </span>
                        </a>
                        </li>

                    <?php } ?>

                     <?php if(check_role(10) && 2==3){ ?>

                        <li class="<?=($active == 'chat')?'active':'';?>"> 
                            <a class="
                            waves-effect waves-dark" 
                            href="<?php
                            echo base_url()."admin/chat";
                             ?>"
                            >
                            <span>
                             <i class="fa fa-comments"></i>   Chat
                            </span>
                        </a>
                        </li>

                    <?php } ?>


                    <li class="<?=($active == 'chat')?'active':'';?>"> 
                            <a class="
                            waves-effect waves-dark" 
                            href="<?php
                            echo base_url()."admin/issues";
                             ?>"
                            >
                            <span>
                             <i class="fa fa-warning"></i>   Issues
                            </span>
                        </a>
                    </li>

                    <?php if(check_role(1)){ ?>
                        <li class="<?=($active == 'color')?'active':'';?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-apple-keyboard-command"></i><span class="hide-menu">Colors</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="<?=($sub == 'color')?'active':'';?>"><a class="<?=($sub == 'colors')?'active':'';?>" href="<?php echo $url."admin/";?>colors">Colors <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo count_listing("colors",false); ?>
                                </span></a></li>
                                <li class="<?=($sub == 'add-color')?'active':'';?>"><a class="<?=($sub == 'add-color')?'active':'';?>" href="<?php echo $url."admin/";?>add-color">Add New Color</a></li>
                                <li class="<?=($sub == 'trash')?'active':'';?>"><a class="<?=($sub == 'trash')?'active':'';?>" href="<?php echo $url."admin/";?>trash-colors">Trash <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo count_listing("colors",true); ?>
                                </span></a></li>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if(check_role(1)){ ?>
                        <li class="<?=($active == 'category')?'active':'';?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-apple-keyboard-command"></i><span class="hide-menu">Categories</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="<?=($sub == 'category')?'active':'';?>"><a class="<?=($sub == 'categories')?'active':'';?>" href="<?php echo $url."admin/";?>categories">Categories <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo count_listing("categories",false); ?>
                                </span></a></li>
                                <li class="<?=($sub == 'add-category')?'active':'';?>"><a class="<?=($sub == 'add-category')?'active':'';?>" href="<?php echo $url."admin/";?>add-category">Add New Category</a></li>
                                <li class="<?=($sub == 'trash')?'active':'';?>"><a class="<?=($sub == 'trash')?'active':'';?>" href="<?php echo $url."admin/";?>trash-categories">Trash <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo count_listing("categories",true); ?>
                                </span></a></li>
                            </ul>
                        </li>
                    <?php } ?>

					<?php if(check_role(4) && 2==3){ ?>
                        <li class="<?=($active == 'brands')?'active':'';?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-bars"></i><span class="hide-menu">Brands</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="<?=($sub == 'brands')?'active':'';?>"><a class="<?=($sub == 'brands')?'active':'';?>" href="<?php echo $url."admin/";?>brands">Brands <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo count_listing("brands",false); ?>
                                </span></a></li>
                                <li class="<?=($sub == 'add-brand')?'active':'';?>"><a class="<?=($sub == 'add-brand')?'active':'';?>" href="<?php echo $url."admin/";?>add-brand">Add New Brand</a></li>
                                <li class="<?=($sub == 'trash')?'active':'';?>"><a class="<?=($sub == 'trash')?'active':'';?>" href="<?php echo $url."admin/";?>trash-brands">Trash <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo count_listing("brands",true); ?>
                                </span></a></li>
                            </ul>
                        </li>
                    <?php } ?>




                    <?php if(check_role(4) && 2==3){ ?>
                        <li class="<?=($active == 'keys')?'active':'';?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-key"></i><span class="hide-menu">Survey Keys</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="<?=($sub == 'keys')?'active':'';?>"><a class="<?=($sub == 'keys')?'active':'';?>" href="<?php echo $url."admin/";?>keys">Survey Keys <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo count_listing("keyys",false); ?>
                                </span></a></li>
                                <li class="<?=($sub == 'add-key')?'active':'';?>"><a class="<?=($sub == 'add-key')?'active':'';?>" href="<?php echo $url."admin/";?>add-key">Add New Key</a></li>
                                <li class="<?=($sub == 'trash')?'active':'';?>"><a class="<?=($sub == 'trash')?'active':'';?>" href="<?php echo $url."admin/";?>trash-keys">Trash <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo count_listing("keyys",true); ?>
                                </span></a></li>
                            </ul>
                        </li>
                    <?php } ?>


                    <?php if(check_role(8) && 2==3){ ?>
                        <li class="<?=($active == 'surveys')?'active':'';?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-tv"></i><span class="hide-menu">Surveys</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="<?=($sub == 'surveys')?'active':'';?>"><a class="<?=($sub == 'surveys')?'active':'';?>" href="<?php echo $url."admin/";?>surveys">Surveys <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo count_listing("surveys",false); ?>
                                </span></a></li>
                                <li class="<?=($sub == 'add-survey')?'active':'';?>"><a class="<?=($sub == 'add-survey')?'active':'';?>" href="<?php echo $url."admin/";?>add-survey">Add New Survey</a></li>
                                <li class="<?=($sub == 'trash')?'active':'';?>"><a class="<?=($sub == 'trash')?'active':'';?>" href="<?php echo $url."admin/";?>trash-surveys">Trash <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo count_listing("surveys",true); ?>
                                </span></a></li>
                            </ul>
                        </li>
                    <?php } ?>



                    <?php if(check_role(9) && 2==3){ ?>
                        <li class="<?=($active == 'filled_surveys')?'active':'';?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-bars"></i><span class="hide-menu">Filled Surveys</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="<?=($sub == 'filled_surveys')?'active':'';?>"><a class="<?=($sub == 'filled_surveys')?'active':'';?>" href="<?php echo $url."admin/";?>filled_surveys">Filled Surveys <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo count_listing("filled_surveys",false); ?>
                                </span></a></li>
                                
                            </ul>
                        </li>
                    <?php } ?>

              



                   
                    <?php if(check_role(6) && 2==3){ ?>
                        <li class="<?=($active == 'pages')?'active':'';?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-file-o"></i><span class="hide-menu">Pages</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="<?=($sub == 'pages')?'active':'';?>"><a class="<?=($sub == 'pages')?'active':'';?>" href="<?php echo $url."admin/";?>pages">Pages <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo count_listing("pages",false); ?>
                                </span></a></li>
                                <li class="<?=($sub == 'add-page')?'active':'';?>"><a class="<?=($sub == 'add-page')?'active':'';?>" href="<?php echo $url."admin/";?>add-page">Add New Page</a></li>
                                <li class="<?=($sub == 'trash')?'active':'';?>"><a class="<?=($sub == 'trash')?'active':'';?>" href="<?php echo $url."admin/";?>trash-pages">Trash <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo count_listing("pages",true); ?>
                                </span></a></li>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if(check_role(7)){ ?>
                        <li class="<?=($active == 'users')?'active':'';?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Users</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="<?=($sub == 'users')?'active':'';?>"><a class="<?=($sub == 'users')?'active':'';?>" href="<?php echo $url."admin/";?>users">Users <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo $this->db->where("is_deleted",0)->count_all_results("users"); ?>
                                </span></a></li>
                                <li class="<?=($sub == 'add-user')?'active':'';?>"><a class="<?=($sub == 'add-user')?'active':'';?>" href="<?php echo $url."admin/";?>add-user">Add New User</a></li>
                                <li class="<?=($sub == 'trash')?'active':'';?>"><a class="<?=($sub == 'trash')?'active':'';?>" href="<?php echo $url."admin/";?>trash-users">Trash <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo $this->db->where("is_deleted",1)->count_all_results("users"); ?>
                                </span></a></li>
                            </ul>
                        </li>
                    <?php } ?>


                     <?php if(check_role(-1) && 2==3){ ?>
                        <li class="<?=($active == 'admins')?'active':'';?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-lock"></i><span class="hide-menu">Admins & Managers</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="<?=($sub == 'admins')?'active':'';?>"><a class="<?=($sub == 'admins')?'active':'';?>" href="<?php echo $url."admin/";?>admins">Admins <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo count_listing("admin",false); ?>
                                </span></a></li>
                                <li class="<?=($sub == 'add-admin')?'active':'';?>"><a class="<?=($sub == 'add-admin')?'active':'';?>" href="<?php echo $url."admin/";?>add-admin">Add New Admin</a></li>
                                <li class="<?=($sub == 'trash-admins')?'active':'';?>"><a class="<?=($sub == 'trash-admins')?'active':'';?>" href="<?php echo $url."admin/";?>trash-admins">Trash <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo count_listing("admin",true); ?>
                                </span></a></li>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if( 2==3 &&  check_role(9)){ ?>
                        <li class="<?=($active == 'managers')?'active':'';?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-lock"></i><span class="hide-menu">Managers</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="<?=($sub == 'managers')?'active':'';?>"><a class="<?=($sub == 'managers')?'active':'';?>" href="<?php echo $url."admin/";?>managers">Managers <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo $this->db->where("type",2)->where("is_deleted",0)->count_all_results("admins"); ?>
                                </span></a></li>
                                <li class="<?=($sub == 'add-admin')?'active':'';?>"><a class="<?=($sub == 'add-admin')?'active':'';?>" href="<?php echo $url."admin/";?>add-manager">Add New Manager</a></li>
                                <li class="<?=($sub == 'trash-managers')?'active':'';?>"><a class="<?=($sub == 'trash-managers')?'active':'';?>" href="<?php echo $url."admin/";?>trash-managers">Trash <span class="badge badge-pill badge-cyan ml-auto">
                                    <?php echo $this->db->where("type",2)->where("is_deleted",1)->count_all_results("admins"); ?>
                                </span></a></li>
                            </ul>
                        </li>
                    <?php } ?>



                    


                    <li class="nav-small-cap">--- Other</li>
                    
                    <li> <a class="waves-effect waves-dark" href="<?php echo $url.'admin/logout'; ?>" aria-expanded="false"><i class="fa fa-circle-o text-success"></i><span class="hide-menu">Log Out</span></a></li>
                       
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ==============================================================