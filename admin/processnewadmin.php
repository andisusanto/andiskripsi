<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/Admin.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
    if($_POST['Password'] == $_POST['ConfirmPassword'])
    {
        $Admin = new Admin($Conn);
        $Admin->UserName = $_POST['UserName'];
        $Admin->setPassword($_POST['Password']);
        $Admin->IsActive = ($_POST['IsActive'] == 'on') ? 1 : 0;
        $Admin->Save();
        $Conn->Commit();
        header('location:admin.php');
    }
    else
    {
        throw new Exception("password confirmation failed");
    }
} catch (Exception $e) {
    include('error_handler.php');
}
?>