<?php $title = 'Recruitment'; ?>
<?php include('header.php'); ?>
<?php
    include_once('../classes/Recruitment.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    $Recruitment = Recruitment::GetObjectByKey($Conn, $_GET['Id']);
?>
<h3>Edit Recruitment</h3>
<form name="frmEditRecruitment" method="POST" action="processeditrecruitment.php">
    <input type="hidden" name="Id" value="<?php echo $Recruitment->get_Id(); ?>" />
    <div class="input-group">
        <label class="control-label required">Description <span class="required">*</span></label>
        <textarea name="Description" class="form-control" placeholder="Description" aria-describedby="basic-addon1"><?php echo $Recruitment->Description; ?></textarea>
    </div>

    <div class="input-group">
        <label class="control-label">TransDate</label>
        <input type="text" name="TransDate" class="form-control" aria-describedby="basic-addon2" value="<?php echo date('Y-m-d',$Recruitment->TransDate); ?>"/>
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
<?php include('footer.php'); ?>