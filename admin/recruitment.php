<?php $title = 'Recruitment'; ?>
<?php include('header.php'); ?>
            <link rel="stylesheet" href="js/lib/datatables/css/datatables_beoro.css">
            <link rel="stylesheet" href="js/lib/datatables/extras/TableTools/media/css/TableTools.css">
            <h3>Recruitment</h3>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="w-box w-box-orange">
                            <div class="w-box-header">
                                <a href="javascript.void(0)" class="btn btn-inverse btn-mini" data-toggle="modal" data-target="#newrecruitment">New</a>
                            </div>
                            <div class="w-box-content">
                                <table class="table table-striped table-condensed dt_colVis_Reorder">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Description</th>
                                        <th>TransDate</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                               <?php
                                   include_once('../classes/Helper.php');
                                   include_once('../classes/Recruitment.php');
                                   include_once('../classes/Connection.php');
                                   $Conn = Connection::get_DefaultConnection();
                                   $Recruitments = Recruitment::LoadCollection($Conn);
                                   foreach($Recruitments as $Recruitment){
                               ?>
                                    <tr>
                                        <td><?php echo $Recruitment->get_Id(); ?></td>
                                        <td><?php echo $Recruitment->Description; ?></td>
                                        <td><?php echo date('Y-m-d',$Recruitment->TransDate); ?></td>
                                        <td><?php echo $Recruitment->getStatusText(); ?></td>
                                        <td>
                                            <a href="editrecruitment.php?Id=<?php echo $Recruitment->get_Id(); ?>">Edit</a>
                                            <a href="analysis.php?Id=<?php echo $Recruitment->get_Id(); ?>">Analysis</a>
                                            <a href="processdeleterecruitment.php?Id=<?php echo $Recruitment->get_Id(); ?>">Delete</a>
                                        </td>
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
            <!-- modal new recruitment -->
            <div class="modal fade" id="newrecruitment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">New Recruitment</h4>
                  </div>
                  <div class="modal-body">
                    <form name="frmNewRecruitment" id="frmNewRecruitment" method="POST" action="processnewrecruitment.php">
                        <div class="input-group">
                            <label class="control-label required">Description <span class="required">*</span></label>
                            <textarea name="Description" class="form-control" placeholder="Description" aria-describedby="basic-addon1"></textarea>
                        </div>

                        <div class="input-group">
                            <label class="control-label required">TransDate <span class="required">*</span></label>
                            <input type="text" name="TransDate" class="form-control" placeholder="TransDate" aria-describedby="basic-addon2" />
                        </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$(this).attr('onclick','');$('#frmNewRecruitment').submit();">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end of modal new recruitment -->
<?php include('footer.php'); ?>
            <script src="js/lib/datatables/js/jquery.dataTables.min.js"></script>
            <script src="js/lib/datatables/extras/ColReorder/media/js/ColReorder.min.js"></script>
            <script src="js/lib/datatables/extras/ColVis/media/js/ColVis.min.js"></script>
            <script src="js/lib/datatables/extras/TableTools/media/js/TableTools.min.js"></script>
            <script src="js/lib/datatables/extras/TableTools/media/js/ZeroClipboard.js"></script>
            <script src="js/lib/datatables/js/jquery.dataTables.bootstrap.min.js"></script>
            <script src="js/beoro_datatables.js"></script>