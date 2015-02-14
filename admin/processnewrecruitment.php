<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/Recruitment.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
    $Recruitment = new Recruitment($Conn);
    $Recruitment->Name = $_POST['Name'];
    $Recruitment->TransDate = strtotime($_POST['TransDate']);
    $Recruitment->Description = $_POST['Description'];
    $Recruitment->EstimationCloseDate = strtotime($_POST['EstimationCloseDate']);
    $Recruitment->Status = 0;

    $Recruitment->Save();
    $Conn->Commit();
    header('location:recruitment.php');
} catch (Exception $e) {
    include('error_handler.php');
}
?>