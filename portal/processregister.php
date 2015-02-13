<?php
session_start();
include_once('../classes/Applicant.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
    if ($_POST['Password'] == $_POST['ConfirmPassword']){
        if(!Applicant::GetApplicantByUserName($Conn, $_POST['UserName']))
        {
            $Applicant = new Applicant($Conn);
            $Applicant->SetPassword($_POST['Password']);
            $Applicant->IsActive = 1;
            $Applicant->Name = $_POST['Name'];
            $Applicant->UserName = $_POST['UserName'];
            $Applicant->DateOfBirth = strtotime($_POST['DateOfBirth']);
            $Applicant->PlaceOfBirth = $_POST['PlaceOfBirth'];
            $Applicant->Address = $_POST['Address'];
            $Applicant->PhoneNumber = $_POST['PhoneNumber'];

            $Applicant->Save();
            $Conn->Commit();
        }
        else
        {
            throw new Exception('Username already exists');
        }
    }
    else
    {
        throw new Exception('Password confirmation failed');
    }
    $returnUrl = isset($_SESSION['returnUrl']) ? $_SESSION['returnUrl'] : "index.php";
    header("location:{$returnUrl}");
} catch (Exception $e) {
   include('error_handler.php');
}
?>