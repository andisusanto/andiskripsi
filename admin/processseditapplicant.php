<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/Applicant.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
    $Applicant = Applicant::GetObjectByKey($Conn, $_POST['Id']);
    $Applicant->UserName = $_POST['UserName'];
    $Applicant->IsActive = ($_POST['IsActive'] == 'on') ? 1 : 0;

    $Applicant->Update();
    $Conn->Commit();
    header('location:admin.php');
} catch (Exception $e) {
    include('error_handler.php');
}
?>