<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/Recruitment.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
    $Recruitment = Recruitment::GetObjectByKey($Conn, $_GET['Id']);
    $Recruitment->Status = Recruitment::STATUS_CLOSED;
    $Recruitment->Update();
    $Conn->Commit();
    header('location:recruitment.php');
} catch (Exception $e) {
    include('error_handler.php');
}
?>