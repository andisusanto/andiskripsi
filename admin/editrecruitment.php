<?php $title = 'Recruitment'; ?>
<?php include('header.php'); ?>
            <link rel="stylesheet" href="js/lib/datatables/css/datatables_beoro.css">
            <link rel="stylesheet" href="js/lib/datatables/extras/TableTools/media/css/TableTools.css">
<?php
    include_once('../classes/Recruitment.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    $Recruitment = Recruitment::GetObjectByKey($Conn, $_GET['Id']);
?>
<div class="w-box-header">
    <h4>Edit Recruitment</h4>
</div>
<div class="w-box-content cnt_a">
    <div class="row-fluid">
        <div class="span6">
            <form name="frmEditRecruitment" id="frmEditRecruitment" method="POST" action="processeditrecruitment.php">
                <input type="hidden" name="Id" value="<?php echo $Recruitment->get_Id(); ?>" />
                <div class="input-group">
                    <label class="control-label required">Name <span class="required">*</span></label>
                    <textarea name="Name" class="form-control validate[required]" placeholder="Name" aria-describedby="basic-addon1"><?php echo $Recruitment->Name; ?></textarea>
                </div>

                <div class="input-group">
                    <label class="control-label">TransDate</label>
                    <input type="text" name="TransDate" class="form-control validate[required]" aria-describedby="basic-addon2" value="<?php echo date('Y-m-d',$Recruitment->TransDate); ?>"/>
                </div>
                
                <div class="input-group">
                    <label class="control-label required">Description <span class="required">*</span></label>
                    <textarea name="Description" id="wysiwg_editor" class="form-control validate[required]" placeholder="Description" aria-describedby="basic-addon1"><?php echo $Recruitment->Description; ?></textarea>
                </div>

                <div class="input-group">
                    <label class="control-label">Estimation Close Date</label>
                    <input type="text" name="EstimationCloseDate" class="form-control validate[required]" aria-describedby="basic-addon2" value="<?php echo date('Y-m-d',$Recruitment->EstimationCloseDate); ?>"/>
                </div>

                <div class="input-group">
                    <label class="control-label">Status</label>
                    <select name="Status" class="form-control" aria-describedby="basic-addon2">
                    <?php
                        foreach (Recruitment::getStatusOptions() as $StatusKey => $StatusText)
                        {
                            echo "<option value='".$StatusKey."'".(($StatusKey == $Recruitment->Status) ? "selected" : "").">".$StatusText."</option>";
                        }
                    ?>
                    </select>
                </div>
                <a href="recruitment.php"><button type="button" class="btn btn-default">Cancel</button></a>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
    </div>
</div>

<div class="w-box-header">
    <h5>Criterias</h5>
</div>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="w-box w-box-orange">
                            <div class="w-box-header">
                                <a href="javascript.void(0)" class="btn btn-inverse btn-mini" data-toggle="modal" data-target="#newrecruitmentcriteria">New</a>
                            </div>
                            <div class="w-box-content">
                                <table class="table table-striped table-condensed dt_colVis_Reorder">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Weight</th>
                                        <th>Indifference Threshold</th>
                                        <th>Preference Threshold</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                               <?php
                                   $RecruitmentCriterias = $Recruitment->get_RecruitmentCriteria();
                                   foreach($RecruitmentCriterias as $RecruitmentCriteria){
                               ?>
                                    <tr>
                                    <td><?php echo $RecruitmentCriteria->get_Id(); ?></td>
                                    <td><?php echo $RecruitmentCriteria->Name; ?></td>
                                    <td><?php echo $RecruitmentCriteria->Weight; ?></td>
                                    <td><?php echo $RecruitmentCriteria->IndifferenceThreshold; ?></td>
                                    <td><?php echo $RecruitmentCriteria->PreferenceThreshold; ?></td>
                                    <td><a href="editrecruitmentcriteria.php?Id=<?php echo $RecruitmentCriteria->get_Id(); ?>">Edit</a> <a href="processdeleterecruitmentcriteria.php?Id=<?php echo $RecruitmentCriteria->get_Id(); ?>">Delete</a></td></tr>
                                    <?php
                                    }
                                ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
            <!-- modal new recruitmentcriteria -->
            <div class="modal fade" id="newrecruitmentcriteria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">New Recruitment Criteria</h4>
                  </div>
                  <div class="modal-body">
                    <form name="frmNewRecruitmentCriteria" id="frmNewRecruitmentCriteria" method="POST" action="processnewrecruitmentcriteria.php">
                        <input type="hidden" name="Recruitment" value="<?php echo $Recruitment->get_Id(); ?>" />
                        <div class="input-group">
                            <label class="control-label required">Description <span class="required">*</span></label>
                            <textarea name="Name" class="form-control validate[required]" placeholder="Name" aria-describedby="basic-addon1"></textarea>
                        </div>

                        <div class="input-group">
                            <label class="control-label required">Weight <span class="required">*</span></label>
                            <select name="Weight" class="form-control" placeholder="Weight" aria-describedby="basic-addon2">
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
                            <span class="glyphicon icon-question-sign" title="The importance of this criteria, higher weight means more important."></span>
                        </div>

                        <div class="input-group">
                            <label class="control-label required">Indifference Threshold <span class="required">*</span></label>
                            <select name="IndifferenceThreshold" class="form-control" placeholder="IndifferenceThreshold" aria-describedby="basic-addon2">
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
                        <span class="glyphicon icon-question-sign" title="When the difference is smaller than the indifference threshold it is considered as negligible by the decision maker."></span>
                        </div>

                        <div class="input-group">
                            <label class="control-label required">Preference Threshold <span class="required">*</span></label>
                            <select name="PreferenceThreshold" class="form-control" placeholder="PreferenceThreshold" aria-describedby="basic-addon2">
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
                        <span class="glyphicon icon-question-sign" title="If the difference exceeds the preference threshold it is considered to be significant(The preference degree will be 1)."></span>
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
            <!-- end of modal new recruitmentcriteria -->
<?php include('footer.php'); ?>
            <script src="js/lib/datatables/js/jquery.dataTables.min.js"></script>
            <script src="js/lib/datatables/extras/ColReorder/media/js/ColReorder.min.js"></script>
            <script src="js/lib/datatables/extras/ColVis/media/js/ColVis.min.js"></script>
            <script src="js/lib/datatables/extras/TableTools/media/js/TableTools.min.js"></script>
            <script src="js/lib/datatables/extras/TableTools/media/js/ZeroClipboard.js"></script>
            <script src="js/lib/datatables/js/jquery.dataTables.bootstrap.min.js"></script>
            <script src="js/beoro_datatables.js"></script>
            <script src="js/lib/ckeditor/ckeditor.js"></script>
            <script src="js/wysiwg.js"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $("#frmNewRecruitmentCriteria").validationEngine();
                    $("#frmEditRecruitment").validationEngine();
                });
            </script>