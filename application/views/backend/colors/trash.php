<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Colors Trash Management</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $url."admin";?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo $url."admin/colors";?>">Colors</a></li>
                    <li class="breadcrumb-item active">Colors Trash</li>
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
                    <h4 class="card-title">Colors</h4>
                    
                    <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Color</th>
                                    <th>Data & Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Color</th>
                                    <th>Data & Time</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php foreach($colors->result() as $color){

                            ?>
                            <tr>
                                <td style="background: <?php echo $color->background_color; ?>; color: <?php echo $color->forground_color; ?>;">
                                    Background: <?php echo $color->background_color;?> / Foreground: <?php echo $color->forground_color;?>
                                </td>

                            	<td >
                            		<?php echo date('d M, Y, h:i A',strtotime($color->created_at));?>
                            	</td>
                                <td>

                                   <a title="Restore" href="<?php echo $url;?>admin/restore-color/<?php echo $color->id;?>"><div class="btn btn-info btn-circle"><i class="mdi mdi-file-restore"></i></div></a>


                                    <a title="Delete Permanently" href="<?php echo $url;?>admin/remove-color/<?php echo $color->id;?>"><div class="btn btn-info btn-circle"><i class="mdi mdi-delete"></i></div></a>
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