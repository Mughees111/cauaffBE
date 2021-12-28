<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
               
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Managers Management</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $url."admin";?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Managers</li>
                            </ol>
                            <a href="<?php echo $url;?>admin/add-admin">
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
                                <h4 class="card-title">Managers</h4>
                                
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Site</th>
                                                <th>Email</th>
                                                <th>Roles</th>
                                                <th>Status</th>
                                                <th>Data & Time</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Site</th>
                                                <th>Email</th>
                                                <th>Roles</th>
                                                <th>Status</th>
                                                <th>Data & Time</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php foreach($admins->result() as $client){

                                            $roles = $this->db->where('admin_id',$client->id)->get('admin_roles')->result_object();

                                            $is_super_admin = 0; 
                                            foreach($roles as $role)
                                                if($role->role==-1)
                                                {
                                                    $is_super_admin=1;
                                                    

                                                    break;
                                                }

                                            ?>
                                        <tr>
                                            <td>
                                                <?php echo $client->name;?>
                                            </td>
                                            <td>
                                                <?php echo $client->email;?>
                                            </td>
                                            <td>
                                                <?php 
                                                if($is_super_admin == 1)
                                                {
                                                    echo '<span class="btn btn-success">Super Admin</span>';
                                                }
                                                else
                                                {
                                                    foreach($roles as $role)
                                                    {
                                                        echo '<span class="btn btn-warning m-l-5 m-t-5">'.get_role_name($role->role).'</span>';
                                                    }
                                                }

                                                 ?>
                                            </td>
                                           
                                        	<td>
                                        		<?php if($client->status == 0){?>
                                                    <a href="<?php echo $url.'admin/manager-status/'.$client->id.'/'.$client->status;?>" ><span class="btn btn-danger">Inactive</span></a>
                                        		<?php }else{?>
                                                    <a href="<?php echo $url.'admin/manager-status/'.$client->id.'/'.$client->status;?>" ><span class="btn btn-success">Active</span></a>
                                        		<?php } ?>
                                        	</td>


                                        	<td >
                                        		<?php echo date('d M, Y, h:i A',strtotime($client->created_at));?>
                                        	</td>
                                            <td>

                                                <?php if($client->id!=1){ ?>

                                                <a title="roles" href="<?php echo $url;?>admin/edit-manager-roles/<?php echo $client->id;?>"><div class="btn btn-info btn-circle"><i class="mdi mdi-lock"></i></div></a>

                                                <a href="<?php echo $url;?>admin/edit-manager/<?php echo $client->id;?>"><div class="btn btn-info btn-circle"><i class="mdi mdi-pencil"></i></div></a>
                                                <a class="deleted" href="javascript:void(0);" data-url="<?php echo $url;?>admin/delete-manager/<?php echo $client->id;?>"><div class="btn btn-info btn-circle"><i class="mdi mdi-delete"></i></div></a>

                                            <?php }else { echo "Unavailable for this Admin"; } ?> 
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