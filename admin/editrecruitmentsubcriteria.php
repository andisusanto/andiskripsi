<?php $title = 'Recruitment Criteria'; ?>
<?php include('header.php'); ?>
<?php
    include_once('../classes/RecruitmentSubcriteria.php');
    include_once('../classes/Recruitment.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    $RecruitmentSubcriteria = RecruitmentSubcriteria::GetObjectByKey($Conn, $_GET['Id']);
    $RecruitmentCriteria = RecruitmentCriteria::GetObjectByKey($Conn, $RecruitmentSubcriteria->RecruitmentCriteria);
?>
<div class="w-box-header">
    <h4>Edit Recruitment Subcriteria</h4>
</div>
<div class="w-box-content cnt_a">
    <div class="row-fluid">
        <div class="span6">
            <form name="frmEditRecruitmentSubcriteria" method="POST" action="processeditrecruitmentsubcriteria.php">
                <input type="hidden" name="Id" value="<?php echo $RecruitmentSubcriteria->get_Id(); ?>" />
                <div class="input-group">
                    <label class="control-label required">Recruitment Criteria</label><?php echo $RecruitmentCriteria->Name; ?>
                </div>
    
                <div class="input-group">
                    <label class="control-label required">Description</label>
                    <textarea name="Description" class="form-control" placeholder="Description" aria-describedby="basic-addon1"><?php echo $RecruitmentSubcriteria->Description; ?></textarea>
                </div>

                <div class="input-group">
                    <label class="control-label">Value</label>
                    <input type="text" name="Value" class="form-control" placeholder="Value" aria-describedby="basic-addon2" value="<?php echo $RecruitmentSubcriteria->Value; ?>"/>
                </div>
                <a href="editrecruitmentcriteria.php?Id=<?php echo $RecruitmentSubcriteria->RecruitmentCriteria; ?>"><button type="button" class="btn btn-default">Cancel</button></a>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>