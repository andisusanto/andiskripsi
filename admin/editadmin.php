<?php $title = 'Admin'; ?>
<?php include('header.php'); ?>
<?php
    include_once('../classes/Admin.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    $Admin = Admin::GetObjectByKey($Conn, $_GET['Id']);
?>
<div class="w-box-header">
    <h4>Edit Admin</h4>
</div>
<div class="w-box-content cnt_a">
    <div class="row-fluid">
        <div class="span6">
            <form name="frmEditAdmin" id="frmEditAdmin" method="POST" action="processeditadmin.php">
                <input type="hidden" name="Id" value="<?php echo $Admin->get_Id(); ?>" />
                <div class="input-group">
                    <label class="control-label required">UserName <span class="required">*</span></label>
                    <input type="text" name="UserName" class="form-control validate[required]" placeholder="UserName" value="<?php echo $Admin->UserName; ?>" aria-describedby="basic-addon1" />
                </div>

                <div class="input-group">
                    <label class="control-label">Is Active</label>
                    <input type="checkbox" name="IsActive" class="form-control" <?php if($Admin->IsActive){echo "Checked";}else{echo "";} ?> aria-describedby="basic-addon2" />
                </div>
                <a href="admin.php"><button type="button" class="btn btn-default">Cancel</button></a>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    $("#frmEditAdmin").validationEngine();
                });
            </script>