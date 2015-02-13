<?php
    include_once('../classes/Applicant.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    $userName = $_POST['txtUserName'];
    $password = $_POST['txtPassword'];
    try{
        $applicant = Applicant::GetApplicantByUserName($Conn,$userName);
        if($applicant != NULL && $applicant->ComparePassword($password))
        {
            session_start();
            $_SESSION['CurrentApplicantId'] = $applicant->get_Id();
            header('location:index.php');
        }
        else
        {
            throw new Exception("Username or password does not match!");
        }
    } catch (Exception $e) {
        include('error_handler.php');
    }
?>