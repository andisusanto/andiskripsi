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
<div class="w-box-header">
    <h4>Edit Recruitment Criteria</h4>
</div>
<div class="w-box-content cnt_a">
    <div class="row-fluid">
        <div class="span6">
            <form name="frmEditRecruitmentCriteria" id="frmEditRecruitmentCriteria" method="POST" action="processeditrecruitmentcriteria.php">
                <input type="hidden" name="Id" value="<?php echo $RecruitmentCriteria->get_Id(); ?>" />
                <div class="input-group">
                    <label class="control-label required">Recruitment</label><?php echo $Recruitment->Name; ?>
                </div>
    
                <div class="input-group">
                    <label class="control-label required">Name</label>
                    <textarea name="Name" class="form-control validate[required]" placeholder="Name" aria-describedby="basic-addon1"><?php echo $RecruitmentCriteria->Name; ?></textarea>
                </div>

                <div class="input-group">
                    <label class="control-label">Weight</label>
                    <select name="Weight" class="form-control" placeholder="Weight" aria-describedby="basic-addon2">
                        <option value="1" <?php if($RecruitmentCriteria->Weight == 1) echo "selected"; ?>>1</option>
                        <option value="2" <?php if($RecruitmentCriteria->Weight == 2) echo "selected"; ?>>2</option>
                        <option value="3" <?php if($RecruitmentCriteria->Weight == 3) echo "selected"; ?>>3</option>
                        <option value="4" <?php if($RecruitmentCriteria->Weight == 4) echo "selected"; ?>>4</option>
                        <option value="5" <?php if($RecruitmentCriteria->Weight == 5) echo "selected"; ?>>5</option>
                        <option value="6" <?php if($RecruitmentCriteria->Weight == 6) echo "selected"; ?>>6</option>
                        <option value="7" <?php if($RecruitmentCriteria->Weight == 7) echo "selected"; ?>>7</option>
                        <option value="8" <?php if($RecruitmentCriteria->Weight == 8) echo "selected"; ?>>8</option>
                        <option value="9" <?php if($RecruitmentCriteria->Weight == 9) echo "selected"; ?>>9</option>
                        <option value="10" <?php if($RecruitmentCriteria->Weight == 10) echo "selected"; ?>>10</option>
                    </select>
                    <span class="glyphicon icon-question-sign" title="The importance of this criteria, higher weight means more important."></span>
                </div>

                <div class="input-group">
                    <label class="control-label">Indifference Threshold</label>
                    <select name="IndifferenceThreshold" class="form-control" placeholder="IndifferenceThreshold" aria-describedby="basic-addon2">
                        <option value="0" <?php if($RecruitmentCriteria->IndifferenceThreshold == 0) echo "selected"; ?>>0</option>
                        <option value="1" <?php if($RecruitmentCriteria->IndifferenceThreshold == 1) echo "selected"; ?>>1</option>
                        <option value="2" <?php if($RecruitmentCriteria->IndifferenceThreshold == 2) echo "selected"; ?>>2</option>
                        <option value="3" <?php if($RecruitmentCriteria->IndifferenceThreshold == 3) echo "selected"; ?>>3</option>
                        <option value="4" <?php if($RecruitmentCriteria->IndifferenceThreshold == 4) echo "selected"; ?>>4</option>
                        <option value="5" <?php if($RecruitmentCriteria->IndifferenceThreshold == 5) echo "selected"; ?>>5</option>
                        <option value="6" <?php if($RecruitmentCriteria->IndifferenceThreshold == 6) echo "selected"; ?>>6</option>
                        <option value="7" <?php if($RecruitmentCriteria->IndifferenceThreshold == 7) echo "selected"; ?>>7</option>
                        <option value="8" <?php if($RecruitmentCriteria->IndifferenceThreshold == 8) echo "selected"; ?>>8</option>
                        <option value="9" <?php if($RecruitmentCriteria->IndifferenceThreshold == 9) echo "selected"; ?>>9</option>
                        <option value="10" <?php if($RecruitmentCriteria->IndifferenceThreshold == 10) echo "selected"; ?>>10</option>
                    </select>
                    <span class="glyphicon icon-question-sign" title="When the difference is smaller than the indifference threshold it is considered as negligible by the decision maker."></span>
                </div>

                <div class="input-group">
                    <label class="control-label">Preference Threshold</label>
                    <select name="PreferenceThreshold" class="form-control" placeholder="PreferenceThreshold" aria-describedby="basic-addon2">
                        <option value="0" <?php if($RecruitmentCriteria->PreferenceThreshold == 0) echo "selected"; ?>>Max</option>
                        <option value="1" <?php if($RecruitmentCriteria->PreferenceThreshold == 1) echo "selected"; ?>>1</option>
                        <option value="2" <?php if($RecruitmentCriteria->PreferenceThreshold == 2) echo "selected"; ?>>2</option>
                        <option value="3" <?php if($RecruitmentCriteria->PreferenceThreshold == 3) echo "selected"; ?>>3</option>
                        <option value="4" <?php if($RecruitmentCriteria->PreferenceThreshold == 4) echo "selected"; ?>>4</option>
                        <option value="5" <?php if($RecruitmentCriteria->PreferenceThreshold == 5) echo "selected"; ?>>5</option>
                        <option value="6" <?php if($RecruitmentCriteria->PreferenceThreshold == 6) echo "selected"; ?>>6</option>
                        <option value="7" <?php if($RecruitmentCriteria->PreferenceThreshold == 7) echo "selected"; ?>>7</option>
                        <option value="8" <?php if($RecruitmentCriteria->PreferenceThreshold == 8) echo "selected"; ?>>8</option>
                        <option value="9" <?php if($RecruitmentCriteria->PreferenceThreshold == 9) echo "selected"; ?>>9</option>
                        <option value="10" <?php if($RecruitmentCriteria->PreferenceThreshold == 10) echo "selected"; ?>>10</option>
                    </select>
                    <span class="glyphicon icon-question-sign" title="If the difference exceeds the preference threshold it is considered to be significant(The preference degree will be 1)."></span>
                </div>
                <a href="editrecruitment.php?Id=<?php echo $RecruitmentCriteria->Recruitment; ?>"><button type="button" class="btn btn-default">Cancel</button></a>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
    </div>
</div>

<div class="w-box-header">
    <h5>Subcriterias</h5>
</div>
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
                    <h4 class="modal-title" id="myModalLabel">New Recruitment Subcriteria</h4>
                  </div>
                  <div class="modal-body">
                    <form name="frmNewRecruitmentSubcriteria" id="frmNewRecruitmentSubcriteria" method="POST" action="processnewrecruitmentsubcriteria.php">
                        <input type="hidden" name="RecruitmentCriteria" value="<?php echo $RecruitmentCriteria->get_Id(); ?>" />
                        <div class="input-group">
                            <label class="control-label required">Description <span class="required">*</span></label>
                            <textarea name="Description" class="form-control validate[required]" placeholder="Description" aria-describedby="basic-addon1"></textarea>
                        </div>

                        <div class="input-group">
                            <label class="control-label required">Value <span class="required">*</span></label>
                            <select name="Value" class="form-control" placeholder="Value" aria-describedby="basic-addon2">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$(this).attr('onclick','');$('#frmNewRecruitmentSubcriteria').submit();">Save changes</button>
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
            <script type="text/javascript">
                $(document).ready(function () {
                    $("#frmEditRecruitmentCriteria").validationEngine();
                    $("#frmNewRecruitmentSubcriteria").validationEngine();
                });
            </script>