<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Surveys Management</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $url."admin";?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Surveys</li>
                </ol>
                <a href="<?php echo $url;?>admin/add-survey">
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
                </a>
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
                    <h4 class="card-title">Surveys</h4>
                    
                    <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
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
                                    <th>Survey</th>
                                    <th>Keys</th>
                                    <th>Survey Link</th>
                                    <th>Status</th>
                                    <th>Data & Time</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php foreach($surveys->result() as $survey){

                                $survey_keys = $this->db->where("survey_id",$survey->id)->get("survey_keys")->result_object();





                            ?>
                            <tr>
                                <td>
                                    <?php echo $survey->title;?>
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
                                    <a title="<?php echo $survey->link;?>" href="<?php echo $survey->link;?>" target="_blank">Open</a>
                                </td>
                               
                            	<td>
                            		<?php if($survey->status == 0){?>
                                        <a href="<?php echo $url.'admin/survey-status/'.$survey->id.'/'.$survey->status;?>" ><span class="btn btn-danger">Inactive</span></a>
                            		<?php }else{?>
                                        <a href="<?php echo $url.'admin/survey-status/'.$survey->id.'/'.$survey->status;?>" ><span class="btn btn-success">Active</span></a>
                            		<?php } ?>
                            	</td>


                            	<td >
                            		<?php echo date('d M, Y, h:i A',strtotime($survey->created_at));?>
                            	</td>
                                <td>

                                    <a href="<?php echo $url."admin/";?>edit-survey/<?php echo $survey->id;?>"><div class="btn btn-info btn-circle"><i class="mdi mdi-pencil"></i></div></a>
                                    <a class="deleted" href="javascript:void(0);" data-url="<?php echo $url;?>admin/delete-survey/<?php echo $survey->id;?>"><div class="btn btn-info btn-circle"><i class="mdi mdi-delete"></i></div></a>
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