<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Issues Management</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $url."admin";?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Issues</li>
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
                    <h4 class="card-title">Issues</h4>
                    
                    <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Issue Type</th>
                                    <th>Issue</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Issue Type</th>
                                    <th>Issue</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php foreach($issues->result() as $issue){

                                $user = $this->db->where('id',$issue->user_id)
                                ->get('users')
                                ->result_object()[0];

                            ?>
                            <tr>
                                <td>
                                    <?php echo $issue->id; ?>
                                </td>
                                <td>
                                    <?php echo $issue->name; ?>
                                </td>
                                <td>
                                    <?php echo $issue->phone; ?>
                                </td>
                                <td>
                                    <?php echo $issue->email; ?>
                                </td>
                                <td>
                                    <?php echo $issue->issue; ?>
                                </td>
                                <td>
                                    <?php echo $issue->des; ?>
                                </td>

                                <td>
                                    <?php echo $user->first_name.' '.$user->last_name; ?>
                                </td>
                               
                            	<td>
                            		<?php if($issue->status == 0){?>
                                        <a href="<?php echo $url.'admin/issues/status/'.$issue->id.'/1';?>" ><span class="btn btn-danger">Unsolved</span></a>
                            		<?php }else{?>
                                        <a href="<?php echo $url.'admin/issues/status/'.$issue->id.'/0';?>" ><span class="btn btn-success">Solved</span></a>
                            		<?php } ?>
                            	</td>


                            	<td >
                            		<?php echo date('d M, Y, h:i A',strtotime($issue->created_at));?>
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