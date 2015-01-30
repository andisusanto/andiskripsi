<?php $title = 'Applicant'; ?>
<?php include('header.php'); ?>
            <link rel="stylesheet" href="js/lib/datatables/css/datatables_beoro.css">
            <link rel="stylesheet" href="js/lib/datatables/extras/TableTools/media/css/TableTools.css">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="w-box w-box-orange">
                            <div class="w-box-header">
                                <a href="javascript.void(0)" class="btn btn-inverse btn-mini" data-toggle="modal" data-target="#newapplicant">New</a>
                            </div>
                            <div class="w-box-content">
                                <table class="table table-striped table-condensed dt_colVis_Reorder">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Date Of Birth</th>
                                        <th>Place Of Birth</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                        <th>UserName</th>
                                        <th>Is Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                               <?php
                                   include_once('../classes/Helper.php');
                                   include_once('../classes/Applicant.php');
                                   include_once('../classes/Connection.php');
                                   $Conn = Connection::get_DefaultConnection();
                                   $Applicants = Applicant::LoadCollection($Conn);
                                   foreach($Applicants as $Applicant){
                               ?>
                                    <tr>
                                    <td><?php echo $Applicant->get_Id(); ?></td>
                                    <td><?php echo $Applicant->Name; ?></td>
                                    <td><?php echo date('Y-m-d',$Applicant->DateOfBirth); ?></td>
                                    <td><?php echo $Applicant->PlaceOfBirth; ?></td>
                                    <td><?php echo $Applicant->Address; ?></td>
                                    <td><?php echo $Applicant->PhoneNumber; ?></td>
                                    <td><?php echo $Applicant->UserName; ?></td>
                                    <td><?php echo Helper::getBooleanTextValue($Applicant->IsActive); ?></td>
                                    <td><a href="processdeleteapplicant.php?Id=<?php echo $Applicant->get_Id(); ?>">Delete</a> <a href="editapplicant.php?Id=<?php echo $Applicant->get_Id(); ?>">Edit</a></td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
            <!-- modal new applicant -->
            <div class="modal fade" id="newapplicant" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">New Applicant</h4>
                  </div>
                  <div class="modal-body">
                    <form name="frmNewApplicant" id="frmNewApplicant" method="POST" action="processnewapplicant.php">
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
                    <button type="button" class="btn btn-primary" onclick="$(this).attr('onclick','');$('#frmNewApplicant').submit();">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end of modal new applicant -->
<?php include('footer.php'); ?>
            <script src="js/lib/datatables/js/jquery.dataTables.min.js"></script>
            <script src="js/lib/datatables/extras/ColReorder/media/js/ColReorder.min.js"></script>
            <script src="js/lib/datatables/extras/ColVis/media/js/ColVis.min.js"></script>
            <script src="js/lib/datatables/extras/TableTools/media/js/TableTools.min.js"></script>
            <script src="js/lib/datatables/extras/TableTools/media/js/ZeroClipboard.js"></script>
            <script src="js/lib/datatables/js/jquery.dataTables.bootstrap.min.js"></script>
            <script src="js/beoro_datatables.js"></script>