<?php
session_start();
include_once('../classes/Applicant.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
            $Applicant = Applicant::GetObjectByKey($Conn,$_SESSION['CurrentApplicantId']);
            $Applicant->Name = $_POST['Name'];
            $Applicant->DateOfBirth = strtotime($_POST['DateOfBirth']);
            $Applicant->PlaceOfBirth = $_POST['PlaceOfBirth'];
            $Applicant->Address = $_POST['Address'];
            $Applicant->PhoneNumber = $_POST['PhoneNumber'];

            $Applicant->Update();
            $Conn->Commit();
    $returnUrl = isset($_SESSION['returnUrl']) ? $_SESSION['returnUrl'] : "index.php";
    header("location:{$returnUrl}");
} catch (Exception $e) {
   include('error_handler.php');
}
?>