<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Filled Surveys Management</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $url."admin";?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Filled Surveys</li>
                </ol>
                
            </div>
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
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Filled Surveys</h4>
                    
                    <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Survey</th>
                                    <th>Keys</th>
                                    <th>Survey Link</th>
                                    <th>Status</th>
                                    <th>Data & Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>User</th>
                                    <th>Survey</th>
                                    <th>Keys</th>
                                    <th>Survey Link</th>
                                    <th>Status</th>
                                    <th>Data & Time</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php 
                            $surveys=$this->db->get("filled_surveys");
                            foreach($surveys->result() as $survey){




                                $user = $this->db->where("id",$survey->user_id)->get("users")->result_object()[0];
                                $msurvey = $this->db->where("id",$survey->survey_id)->get("surveys")->result_object()[0];


                                $survey_keys = $this->db->where("survey_id",$survey->survey_id)->get("survey_keys")->result_object();





                            ?>
                            <tr>

                                <td>
                                    <?php echo   "<span style='margin-bottom:5px; margin-right:5px' class='btn btn-sm btn-info'>".$user->first_name. ' '.$user->last_name. ' |  '.$user->key_code."</span>"; ?>
                                </td>
                                <td>
                                    <?php echo $msurvey->title;?>
                                </td>

                                <td>
                                    <?php foreach($survey_keys as $survey_key) 
                                    {

                                        $key = $this->db->where("id",$survey_key->key_id)->where("status",1)->where("is_deleted",0)->get("keyys")->result_object()[0];

                                        echo "<span style='margin-bottom:5px; margin-right:5px' class='btn btn-sm btn-info'>".$key->title."</span>";
                                    }


                                     ?>
                                    
                                </td>

                                <td>
                                    <a title="<?php echo $msurvey->link;?>" href="<?php echo $msurvey->link;?>" target="_blank">Open</a>
                                </td>
                               
                            	<td>
                            		<?php if($survey->status == 0){ ?>
                                       <span class="btn btn-danger">Pending</span>
                                    <?php }elseif($survey->status == 1){ ?>
                                        <span class="btn btn-success">Approved</span>
                                    <?php }elseif($survey->status == 2){ ?>
                                        <span class="btn btn-danger">Rejected</span>
                                    <?php } ?>
                            	</td>


                            	<td >
                            		<?php echo date('d M, Y, h:i A',strtotime($survey->created_at));?>
                            	</td>
                                <td>




                                        <?php if($survey->status == 2 || $survey->status == 0){ ?>
                                            <a href="<?php echo $url.'admin/filled_surveys/status/'.$survey->id.'/1';?>" ><span class="btn btn-success">Approve</span></a>
                                        <?php } ?>

                                        <?php if($survey->status == 1 || $survey->status == 0){ ?>
                                            <a href="<?php echo $url.'admin/filled_surveys/status/'.$survey->id.'/2';?>" ><span class="btn btn-danger">Reject</span></a>
                                        <?php } ?>



                            
                                    <a class="deleted" title="Delete Permanently" href="javascript:void(0);" data-url="<?php echo $url;?>admin/filled_surveys/remove/<?php echo $survey->id;?>"><div class="btn btn-info btn-circle"><i class="mdi mdi-delete"></i></div></a>
                                </td>
                            </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>