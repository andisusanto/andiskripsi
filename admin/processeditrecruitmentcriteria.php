<?php
include_once('../classes/RecruitmentCriteria.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
    $RecruitmentCriteria = RecruitmentCriteria::GetObjectByKey($Conn, $_POST['Id']);
    $RecruitmentCriteria->Name = $_POST['Name'];
    $RecruitmentCriteria->Weight = $_POST['Weight'];
    $RecruitmentCriteria->IndifferenceThreshold = $_POST['IndifferenceThreshold'];
    $RecruitmentCriteria->PreferenceThreshold = $_POST['PreferenceThreshold'];

    $RecruitmentCriteria->Update();
    $Conn->Commit();
    header('location:editrecruitment.php?Id='.$RecruitmentCriteria->Recruitment);
} catch (Exception $e) {
    include('error_handler.php');
}
?>