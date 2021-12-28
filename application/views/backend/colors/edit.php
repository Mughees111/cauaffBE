<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Colors Management</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $url."admin";?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $url."admin/colors";?>">Colors</a></li>
                <li class="breadcrumb-item active">Edit color</li>
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
            <?=form_open_multipart('',array('class'=>'form-material','novalidate'=>""));?>

            <div class="card">
               

                <div class="card-header">
                    <h4 class="m-b-0 text-white">Information
                        
                    </h4>
                </div>
                 <div class="card-body "   >

                    <?php $input = "forground_color"; ?>
                    <div class="form-group <?=(form_error($input) !='')?'error':'';?>">
                        <h5>Forground Color <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="color" name="<?php echo $input; ?>" class="form-control form-control-line" placeholder="Color" value="<?php if(set_value($input) != ''){ echo set_value($input);} else echo $data->forground_color; ?>">
                            <div class="text-danger"><?php echo form_error($input);?></div>
                        </div>
                    </div>

                    <?php $input = "background_color"; ?>
                    <div class="form-group <?=(form_error($input) !='')?'error':'';?>">
                        <h5>Background Color <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="color" name="<?php echo $input; ?>" class="form-control form-control-line" placeholder="Color" value="<?php if(set_value($input) != ''){ echo set_value($input);} else echo $data->background_color; ?> ?>">
                            <div class="text-danger"><?php echo form_error($input);?></div>
                        </div>
                    </div>




                    

                </div>
            </div>
            <div class="card-body">
                <div class="text-xs-right">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <a href="<?=$url;?>admin/colors" class="btn btn-inverse">Cancel</a>
                </div>
            </div>
            <?=form_close();?>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->

</div>