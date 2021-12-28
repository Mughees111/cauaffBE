<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Keys Management</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $url."admin";?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Keys</li>
                </ol>
                <a href="<?php echo $url;?>admin/add-key">
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
                    <h4 class="card-title">Keys</h4>
                    
                    <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Key</th>
                                    <th>Users</th>
                                    <th>Status</th>
                                    <th>Data & Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Key</th>
                                    <th>Users</th>
                                    <th>Status</th>
                                    <th>Data & Time</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php foreach($keys->result() as $key){

                               
                                  $user_keys = $this->db->where("key_id",$key->id)->get("user_keys")->result_object();
                            ?>
                            <tr>
                                <td>
                                    <?php echo $key->title;?>
                                </td>
                                <td>
                                <?php foreach($user_keys as $user_key) 
                                    {

                                        $user = $this->db->where("id",$user_key->user_id)->where("status",1)->where("is_deleted",0)->get("users")->result_object()[0];

                                        echo "<span style='margin-bottom:5px; margin-right:5px' class='btn btn-sm btn-info'>".$user->first_name. ' '.$user->last_name. ' |  '.$user->key_code."</span>";
                                    }
                                ?>
                               </td>
                            	<td>
                            		<?php if($key->status == 0){?>
                                        <a href="<?php echo $url.'admin/key-status/'.$key->id.'/'.$key->status;?>" ><span class="btn btn-danger">Inactive</span></a>
                            		<?php }else{?>
                                        <a href="<?php echo $url.'admin/key-status/'.$key->id.'/'.$key->status;?>" ><span class="btn btn-success">Active</span></a>
                            		<?php } ?>
                            	</td>


                            	<td >
                            		<?php echo date('d M, Y, h:i A',strtotime($key->created_at));?>
                            	</td>
                                <td>

                                    <a href="<?php echo $url."admin/";?>edit-key/<?php echo $key->id;?>"><div class="btn btn-info btn-circle"><i class="mdi mdi-pencil"></i></div></a>
                                    <a class="deleted" href="javascript:void(0);" data-url="<?php echo $url;?>admin/delete-key/<?php echo $key->id;?>"><div class="btn btn-info btn-circle"><i class="mdi mdi-delete"></i></div></a>
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