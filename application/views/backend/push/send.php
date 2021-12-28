<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Push Notification Management</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $url."admin";?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $url."admin/push-notification";?>">Send Push Notification</a></li>
            </ol>
        </div>
    </div>
   
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <?=form_open_multipart(base_url()."admin/push-notifications/send",array('class'=>'form-material','novalidate'=>""));?>
            <div class="card">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Push Notification
                    </h4>
                </div>
                <div class="card-body">
                    

                    <div class="form-group <?=(form_error('title') !='')?'error':'';?>">
                        <h5>Title  <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="title" class="form-control form-control-line" required data-validation-required-message="This field is required" placeholder="Title" >
                            <div class="text-danger"><?php echo form_error('title');?></div>
                        </div>
                    </div>


                    <div class="form-group ">
                        <h5>Short Description</h5>
                        <div class="controls">
                            <input type="text" name="short_description" class="form-control form-control-line" required data-validation-required-message="This field is required" placeholder="Short Description" >
                            <div class="text-danger"><?php echo form_error('short_description');?></div>
                        </div>
                    </div>
                    <div class="form-group <?=(form_error('all_users') !='')?'error':'';?>">
                        <div class="controls">
                            <label>
                            <input onclick="checked_or_not(this)" type="checkbox" name="all_users"  value="1" > All Users</label>
                        </div>
                    </div>

                    <div class="form-group ask_users_list">
                        <label for="recipient-name" class="control-label">Users:</label>
                        <select class="select2 m-b-10 select2-multiple" name="users[]" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                            <?php 
                            $drivers = $this->db->where("is_deleted",0)->where("status",1)->get('users')->result_object();
                            foreach($drivers as $driver){?>
                                <option value="<?php echo $driver->id;?>"><?php echo $driver->name;?></option>
                            <?php } ?>
                        </select>
                    </div>


                </div>
            </div>
            <div class="card-body">
                <div class="text-xs-right">
                    <button type="submit" class="btn btn-info">Send</button>
                </div>
            </div>
            <?=form_close();?>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->

</div>