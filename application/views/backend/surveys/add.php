<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Surveys Management</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $url."admin";?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $url."admin/surveys";?>">Surveys</a></li>
                <li class="breadcrumb-item active">Add New Survey</li>
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
                    
                    <?php $input = "title"; ?>
                    <div class="form-group <?=(form_error($input) !='')?'error':'';?>">
                        <h5>Survey Name <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="<?php echo $input; ?>" class="form-control form-control-line" required data-validation-required-message="This field is required" placeholder="Survey Name" value="<?php if(set_value($input) != ''){ echo set_value($input);}else echo $prev->title;?>" >
                            <div class="text-danger"><?php echo form_error($input);?></div>
                        </div>

                    </div>



                    <?php $input = "link"; ?>
                    <div class="form-group <?=(form_error($input) !='')?'error':'';?>">
                        <h5>Survey Link <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="url" name="<?php echo $input; ?>" class="form-control form-control-line" required data-validation-required-message="This field is required" placeholder="URL to fill survey" value="<?php if(set_value($input) != ''){ echo set_value($input);}else echo $prev->link;?>" >
                            <div class="text-danger"><?php echo form_error($input);?></div>
                        </div>

                    </div>



                     <div class="form-group ask_users_list">
                        <label for="recipient-name" class="control-label">Key(s):</label>
                        <select class="select2 m-b-10 select2-multiple" name="keys[]" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                            <?php 
                            $keys = $this->db->where("is_deleted",0)->where("status",1)->get('keyys')->result_object();
                            foreach($keys as $key){?>
                                <option value="<?php echo $key->id;?>"><?php echo $key->title; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    
                    <?php $input = "description"; ?>
                    <div class="form-group <?=(form_error($input) !='')?'error':'';?>">
                        <h5>Description  <small>Admin use only</small></h5>
                        <div class="controls">
                            <textarea class="mymce form-control form-control-line" id="mymce" name="<?php echo $input; ?>" ><?php if(set_value($input) != ''){ echo set_value($input);}?></textarea>
                            <div class="text-danger"><?php echo form_error($input);?></div>
                        </div>
                    </div>

                </div>
            </div>
            <?php echo $meta;?>
            <div class="card-body">
                <div class="text-xs-right">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <a href="<?=$url;?>admin/surveys" class="btn btn-inverse">Cancel</a>
                </div>
            </div>
            <?=form_close();?>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->

</div>