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
                    <select name="Value" class="form-control" placeholder="Value" aria-describedby="basic-addon2">
                        <option value="0" <?php if($RecruitmentSubcriteria->Value == 0) echo "selected"; ?>>0</option>
                        <option value="1" <?php if($RecruitmentSubcriteria->Value == 1) echo "selected"; ?>>1</option>
                        <option value="2" <?php if($RecruitmentSubcriteria->Value == 2) echo "selected"; ?>>2</option>
                        <option value="3" <?php if($RecruitmentSubcriteria->Value == 3) echo "selected"; ?>>3</option>
                        <option value="4" <?php if($RecruitmentSubcriteria->Value == 4) echo "selected"; ?>>4</option>
                        <option value="5" <?php if($RecruitmentSubcriteria->Value == 5) echo "selected"; ?>>5</option>
                        <option value="6" <?php if($RecruitmentSubcriteria->Value == 6) echo "selected"; ?>>6</option>
                        <option value="7" <?php if($RecruitmentSubcriteria->Value == 7) echo "selected"; ?>>7</option>
                        <option value="8" <?php if($RecruitmentSubcriteria->Value == 8) echo "selected"; ?>>8</option>
                        <option value="9" <?php if($RecruitmentSubcriteria->Value == 9) echo "selected"; ?>>9</option>
                        <option value="10" <?php if($RecruitmentSubcriteria->Value == 10) echo "selected"; ?>>10</option>
                    </select>
                </div>
                <a href="editrecruitmentcriteria.php?Id=<?php echo $RecruitmentSubcriteria->RecruitmentCriteria; ?>"><button type="button" class="btn btn-default">Cancel</button></a>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>