<?php
include_once('../classes/RecruitmentSubcriteria.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
    $RecruitmentSubcriteria = new RecruitmentSubcriteria($Conn);
    $RecruitmentSubcriteria->RecruitmentCriteria = $_POST['RecruitmentCriteria'];
    $RecruitmentSubcriteria->Description = $_POST['Description'];
    $RecruitmentSubcriteria->Value = $_POST['Value'];

    $RecruitmentSubcriteria->Save();
    $Conn->Commit();
    header('location:editrecruitmentcriteria.php?Id='.$RecruitmentSubcriteria->RecruitmentCriteria);
} catch (Exception $e) {
    include('error_handler.php');
}
?>