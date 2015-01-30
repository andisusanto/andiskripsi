<?php
include_once('../classes/Recruitment.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
    $Recruitment = Recruitment::GetObjectByKey($Conn, $_POST['Id']);
    $Recruitment->Description = $_POST['Description'];
    $Recruitment->TransDate = strtotime($_POST['TransDate']);
    $Recruitment->Status = $_POST['Status'];

    $Recruitment->Update();
    $Conn->Commit();
    header('location:recruitment.php');
} catch (Exception $e) {
    include('error_handler.php');
}
?>