<?php $title = 'Admin'; ?>
<?php include('header.php'); ?>
            <link rel="stylesheet" href="js/lib/datatables/css/datatables_beoro.css">
            <link rel="stylesheet" href="js/lib/datatables/extras/TableTools/media/css/TableTools.css">
            <h3>Admin</h3>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="w-box w-box-orange">
                            <div class="w-box-header">
                                <a href="javascript.void(0)" class="btn btn-inverse btn-mini" data-toggle="modal" data-target="#newadmin">New</a>
                            </div>
                            <div class="w-box-content">
                                <table class="table table-striped table-condensed dt_colVis_Reorder">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>UserName</th>
                                        <th>Is Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                               <?php
                                   include_once('../classes/Helper.php');
                                   include_once('../classes/Admin.php');
                                   include_once('../classes/Connection.php');
                                   $Conn = Connection::get_DefaultConnection();
                                   $Admins = Admin::LoadCollection($Conn);
                                   foreach($Admins as $Admin){
                               ?>
                                    <tr><td><?php echo $Admin->get_Id(); ?></td><td><?php echo $Admin->UserName; ?></td><td><?php echo Helper::getBooleanTextValue($Admin->IsActive); ?></td><td><a href="editadmin.php?Id=<?php echo $Admin->get_Id(); ?>">Edit</a> <a href="processdeleteadmin.php?Id=<?php echo $Admin->get_Id(); ?>">Delete</a></td></tr>
                                    <?php
                                    }
                                ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
            <!-- modal new admin -->
            <div class="modal fade" id="newadmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">New Admin</h4>
                  </div>
                  <div class="modal-body">
                    <form name="frmNewAdmin" id="frmNewAdmin" method="POST" action="processnewadmin.php">
                        <div class="input-group">
                            <label class="control-label required">UserName <span class="required">*</span></label>
                            <input type="text" name="UserName" class="form-control" placeholder="UserName" aria-describedby="basic-addon1" />
                        </div>

                        <div class="input-group">
                            <label class="control-label required">Password</label>
                            <input type="password" name="Password" class="form-control" placeholder="Password" aria-describedby="basic-addon2" />
                        </div>

                        <div class="input-group">
                            <label class="control-label required">Confirm Password</label>
                            <input type="password" name="ConfirmPassword" class="form-control" placeholder="Password" aria-describedby="basic-addon2" />
                        </div>

                        <div class="input-group">
                            <label class="control-label">Is Active</label>
                            <input type="checkbox" name="IsActive" class="form-control" aria-describedby="basic-addon2" />
                        </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$(this).attr('onclick','');$('#frmNewAdmin').submit();">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end of modal new admin -->
<?php include('footer.php'); ?>
            <script src="js/lib/datatables/js/jquery.dataTables.min.js"></script>
            <script src="js/lib/datatables/extras/ColReorder/media/js/ColReorder.min.js"></script>
            <script src="js/lib/datatables/extras/ColVis/media/js/ColVis.min.js"></script>
            <script src="js/lib/datatables/extras/TableTools/media/js/TableTools.min.js"></script>
            <script src="js/lib/datatables/extras/TableTools/media/js/ZeroClipboard.js"></script>
            <script src="js/lib/datatables/js/jquery.dataTables.bootstrap.min.js"></script>
            <script src="js/beoro_datatables.js"></script>