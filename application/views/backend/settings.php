<style>
	  .dropify-wrapper .dropify-message p{
		  text-align: center;
	  }
 </style>
   <div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Site Settings</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=$url;?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Site Settings</li>
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
            <?=form_open_multipart('',array('class'=>'m-t-40 form-material','novalidate'=>""));?>

            <div class="card card-outline-info">
               <div class="card-header" style="background-color: #00641e">
                    <h4 class="m-b-0 text-white">Site Settings</h4>
                </div>
                <div class="card-body">

                       	<div class="form-group">
                       	<div class="row">
							
							<div class="col-lg-6 col-md-6">
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">Logo</h4>
										
										<input type="file" id="input-file-disable-remove" class="dropify" data-show-remove="false" name="logo" data-default-file="<?=$root;?>resources/uploads/logo/<?php echo $data->site_logo;?>" />
										
									</div>
								</div>
							</div>
						</div>
						</div>

                        <div class="form-group">
                        <div class="row">
                            
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Logo Small</h4>
                                        
                                        <input type="file" id="input-file-disable-remove" class="dropify" data-show-remove="false" name="logo_small" data-default-file="<?=$root;?>resources/uploads/logo/<?php echo $data->site_logo_small;?>" />
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                        <div class="row">
                            
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Site Favicon</h4>
                                        
                                        <input type="file" id="input-file-disable-remove" class="dropify" data-show-remove="false" name="favicon" data-default-file="<?=$root;?>resources/uploads/favicon/<?php echo $data->site_favicon;?>" />
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <h5>Title <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="title" class="form-control" required data-validation-required-message="This field is required" placeholder="Title" value="<?php if(set_value('title') != ''){ echo set_value('title');}else{ echo $data->site_title;}?>"> 
                                <div class="text-danger"><?php echo form_error('title');?></div>
                                </div>
                            
                        </div>
                        <div class="form-group">
                            <h5>Email Address </h5>
                            <div class="controls">
                                <input type="text" class="form-control" placeholder="Email Address" data-validation-regex-regex="([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})" data-validation-regex-message="Please enter the valid email address." name="email" value="<?php if(set_value('email') != ''){ echo set_value('email');}else{ echo $data->email;}?>"> 
                                <div class="text-danger"><?php echo form_error('email');?></div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <h5>Show Email</h5>
                            <div class="controls ">
                            <div class="switchery-demo m-b-20">
                                <input  name="show_email" <?php if($data->show_email==1) echo "checked"; ?> value="1" type="checkbox" class="js-switch" data-color="#26c6da" data-secondary-color="#f62d51" />
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Mobile Number</h5>
                            <div class="controls">
                                <input type="text" name="mobile" class="form-control" required data-validation-required-message="This field is required" placeholder="Mobile Number" value="<?php if(set_value('mobile') != ''){ echo set_value('mobile');}else{ echo $data->mobile;}?>"> 
                                <div class="text-danger"><?php echo form_error('mobile');?></div>
                                </div>
                            
                        </div>
                        <div class="form-group ">
                            <h5>Show Mobile</h5>
                            <div class="controls ">
                            <div class="switchery-demo m-b-20">
                                <input  name="show_mobile" <?php if($data->show_mobile==1) echo "checked"; ?> value="1" type="checkbox" class="js-switch" data-color="#26c6da" data-secondary-color="#f62d51" />
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Address</h5>
                            <div class="controls">
                                <textarea name="address" id="address" class="form-control"  placeholder="Address"><?php if(set_value('address') != ''){ echo set_value('address');}else{ echo $data->address;}?></textarea>
                            <div class="text-danger"><?php echo form_error('address');?></div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <h5>Show address</h5>
                            <div class="controls ">
                            <div class="switchery-demo m-b-20">
                                <input  name="show_address" <?php if($data->show_address==1) echo "checked"; ?> value="1" type="checkbox" class="js-switch" data-color="#26c6da" data-secondary-color="#f62d51" />
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Copy Rights </h5>
                            <div class="controls">
                                <textarea name="rights" id="rights" class="form-control"  placeholder="Copy Rights"><?php if(set_value('rights') != ''){ echo set_value('rights');}else{ echo $data->copy_right;}?></textarea>
                            <div class="text-danger"><?php echo form_error('rights');?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Twitter URL </h5>
                            <div class="controls">
                                <input type="text" class="form-control" placeholder="Twitter URL" data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*" data-validation-regex-message="Only Valid URL's" name="twitter"  value="<?php if(set_value('twitter') != ''){ echo set_value('twitter');}else{ echo $data->twitter;}?>">
                                <div class="text-danger"><?php echo form_error('twitter');?></div>
                            </div>
                        </div>


                        <div class="form-group">
                            <h5>LinkedIn URL </h5>
                            <div class="controls">
                                <input type="text" class="form-control" placeholder="LinkedIn URL" data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*" data-validation-regex-message="Only Valid URL's" name="linkedin"  value="<?php if(set_value('linkedin') != ''){ echo set_value('linkedin');}else{ echo $data->linkedin;}?>">
                                <div class="text-danger"><?php echo form_error('linkedin');?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Facebook URL </h5>
                            <div class="controls">
                                <input type="text" class="form-control" placeholder="Facebook URL" data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*" data-validation-regex-message="Only Valid URL's" name="facebook"  value="<?php if(set_value('facebook') != ''){ echo set_value('facebook');}else{ echo $data->facebook;}?>">
                                <div class="text-danger"><?php echo form_error('facebook');?></div>
                            </div>
                        </div>

                         <div class="form-group">
                            <h5>Instagram URL </h5>
                            <div class="controls">
                                <input type="text" class="form-control" placeholder="Instagram URL" data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*" data-validation-regex-message="Only Valid URL's" name="instagram"  value="<?php if(set_value('instagram') != ''){ echo set_value('instagram');}else{ echo $data->instagram;}?>">
                                <div class="text-danger"><?php echo form_error('instagram');?></div>
                            </div>
                        </div>

                       

                        <div class="form-group">
                            <h5>Support URL </h5>
                            <div class="controls">
                                <input type="text" class="form-control" placeholder="Support Page URL" data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*" data-validation-regex-message="Only Valid URL's" name="support_page"  value="<?php if(set_value('support_page') != ''){ echo set_value('support_page');}else{ echo $data->support_page;}?>">
                                <div class="text-danger"><?php echo form_error('support_page');?></div>
                            </div>
                        </div>

                      <?php /* ?>


                        <div class="form-group">
                            <h5 for="currency">Currency</h5>
                            <input type="text" name="currency" class="form-control currency"  placeholder="Enter Currency Symbol" value="<?php echo $data->currency; ?>">
                        </div>

                        <div class="form-group">
                            <h5 for="currency_position">Currency Position</h5>

                            <label style="float: left;width: 100%;">
                            <input type="radio" name="currency_position" id="currency_position" class=" currency_position_1" <?php if($data->currency_position==1) echo "checked"; ?> placeholder="Enter Currency Position" value="1"> Left
                            </label>

                            <label style="float: left;width: 100%;">
                            <input type="radio" name="currency_position" id="currency_position" class=" currency_position_2" <?php if($data->currency_position==2) echo "checked"; ?>  placeholder="Enter Currency Position" value="2"> Right
                            </label>
                        </div>

                        <div class="form-group">
                            <h5 for="currency_space">Put a space after/before currency?</h5>


                            <div class="controls ">
                                <div class="switchery-demo m-b-20">
                                    <input  name="currency_space" <?php if($data->currency_space==1) echo "checked"; ?> value="1" type="checkbox" class="js-switch" data-color="#26c6da" data-secondary-color="#f62d51" />
                                </div>
                            </div>
                           
                           
                        </div>

                        <?php */ ?>
                        
                        
                </div>
            </div>


            <?php echo $meta; ?>



            <div class="text-xs-right">
                <button type="submit" class="btn btn-info">Submit</button>
                <button type="reset" class="btn btn-inverse">Cancel</button>
            </div>
         <?=form_close();?>

         <div class="col-md-12" style="margin-bottom: 20px;"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
