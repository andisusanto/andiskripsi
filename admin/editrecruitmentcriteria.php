<?php $title = 'Recruitment Criteria'; ?>
<?php include('header.php'); ?>
            <link rel="stylesheet" href="js/lib/datatables/css/datatables_beoro.css">
            <link rel="stylesheet" href="js/lib/datatables/extras/TableTools/media/css/TableTools.css">
<?php
    include_once('../classes/RecruitmentSubcriteria.php');
    include_once('../classes/RecruitmentCriteria.php');
    include_once('../classes/Recruitment.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    $RecruitmentCriteria = RecruitmentCriteria::GetObjectByKey($Conn, $_GET['Id']);
    $Recruitment = Recruitment::GetObjectByKey($Conn, $RecruitmentCriteria->Recruitment);
?>
<h3>Edit Recruitment Criteria</h3>
<form name="frmEditRecruitmentCriteria" method="POST" action="processeditrecruitmentcriteria.php">
    <input type="hidden" name="Id" value="<?php echo $RecruitmentCriteria->get_Id(); ?>" />
    <div class="input-group">
        <label class="control-label required">Recruitment</label><?php echo $Recruitment->Description; ?>
    </div>
    
    <div class="input-group">
        <label class="control-label required">Name</label>
        <textarea name="Name" class="form-control" placeholder="Name" aria-describedby="basic-addon1"><?php echo $RecruitmentCriteria->Name; ?></textarea>
    </div>

    <div class="input-group">
        <label class="control-label">Weight</label>
        <input type="text" name="Weight" class="form-control" aria-describedby="basic-addon2" value="<?php echo $RecruitmentCriteria->Weight; ?>"/>
    </div>

    <div class="input-group">
        <label class="control-label">Indifference Threshold</label>
        <input type="text" name="IndifferenceThreshold" class="form-control" aria-describedby="basic-addon2" value="<?php echo $RecruitmentCriteria->IndifferenceThreshold; ?>"/>
    </div>

    <div class="input-group">
        <label class="control-label">Preference Threshold</label>
        <input type="text" name="PreferenceThreshold" class="form-control" aria-describedby="basic-addon2" value="<?php echo $RecruitmentCriteria->PreferenceThreshold; ?>"/>
    </div>
    <a href="editrecruitment.php?Id=<?php echo $RecruitmentCriteria->Recruitment; ?>"><button type="button" class="btn btn-default">Cancel</button></a>
    <button type="submit" class="btn btn-primary">Save changes</button>
</form>

            <h5>Subcriterias</h5>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="w-box w-box-orange">
                            <div class="w-box-header">
                                <a href="javascript.void(0)" class="btn btn-inverse btn-mini" data-toggle="modal" data-target="#newrecruitmentsubcriteria">New</a>
                            </div>
                            <div class="w-box-content">
                                <table class="table table-striped table-condensed dt_colVis_Reorder">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Description</th>
                                        <th>Value</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                               <?php
                                   $RecruitmentSubcriterias = $RecruitmentCriteria->get_RecruitmentSubcriteria();
                                   foreach($RecruitmentSubcriterias as $RecruitmentSubcriteria){
                               ?>
                                    <tr>
                                    <td><?php echo $RecruitmentSubcriteria->get_Id(); ?></td>
                                    <td><?php echo $RecruitmentSubcriteria->Description; ?></td>
                                    <td><?php echo $RecruitmentSubcriteria->Value; ?></td>
                                    <td><a href="editrecruitmentsubcriteria.php?Id=<?php echo $RecruitmentSubcriteria->get_Id(); ?>">Edit</a> <a href="processdeleterecruitmentsubcriteria.php?Id=<?php echo $RecruitmentSubcriteria->get_Id(); ?>">Delete</a></td></tr>
                                    <?php
                                    }
                                ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
            <!-- modal new recruitmentsubcriteria -->
            <div class="modal fade" id="newrecruitmentsubcriteria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">New RecruitmentCriteria</h4>
                  </div>
                  <div class="modal-body">
                    <form name="frmNewRecruitmentCriteria" id="frmNewRecruitmentCriteria" method="POST" action="processnewrecruitmentsubcriteria.php">
                        <input type="hidden" name="RecruitmentCriteria" value="<?php echo $RecruitmentCriteria->get_Id(); ?>" />
                        <div class="input-group">
                            <label class="control-label required">Description <span class="required">*</span></label>
                            <textarea name="Description" class="form-control" placeholder="Description" aria-describedby="basic-addon1"></textarea>
                        </div>

                        <div class="input-group">
                            <label class="control-label required">Value <span class="required">*</span></label>
                            <input type="text" name="Value" class="form-control" placeholder="Value" aria-describedby="basic-addon2" />
                        </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$(this).attr('onclick','');$('#frmNewRecruitmentCriteria').submit();">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end of modal new recruitmentsubcriteria -->
<?php include('footer.php'); ?>
            <script src="js/lib/datatables/js/jquery.dataTables.min.js"></script>
            <script src="js/lib/datatables/extras/ColReorder/media/js/ColReorder.min.js"></script>
            <script src="js/lib/datatables/extras/ColVis/media/js/ColVis.min.js"></script>
            <script src="js/lib/datatables/extras/TableTools/media/js/TableTools.min.js"></script>
            <script src="js/lib/datatables/extras/TableTools/media/js/ZeroClipboard.js"></script>
            <script src="js/lib/datatables/js/jquery.dataTables.bootstrap.min.js"></script>
            <script src="js/beoro_datatables.js"></script>