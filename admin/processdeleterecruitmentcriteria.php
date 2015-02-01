<?php
include_once('../classes/RecruitmentCriteria.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
    $RecruitmentCriteria = RecruitmentCriteria::GetObjectByKey($Conn, $_GET['Id']);
    RecruitmentCriteria::Delete($Conn, $_GET['Id']);
    $Conn->Commit();
    header('location:editrecruitment.php?Id='.$RecruitmentCriteria->Recruitment);
} catch (Exception $e) {
    //include('error_handler.php');
}
?>