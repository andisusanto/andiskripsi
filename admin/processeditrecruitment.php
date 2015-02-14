<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/Recruitment.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
    $Recruitment = Recruitment::GetObjectByKey($Conn, $_POST['Id']);
    $RecruitmentCriterias = $Recruitment->get_RecruitmentCriteria();
    if (count($RecruitmentCriterias) == 0 && ($_POST['Status'] == 1 || $_POST['Status'] == 2)) throw new Exception("Recruitment without criteria can be allowed in entry status");
    $Recruitment->Name = $_POST['Name'];
    $Recruitment->TransDate = strtotime($_POST['TransDate']);
    $Recruitment->Description = $_POST['Description'];
    $Recruitment->EstimationCloseDate = strtotime($_POST['EstimationCloseDate']);
    $Recruitment->Status = $_POST['Status'];

    $Recruitment->Update();
    $Conn->Commit();
    header('location:recruitment.php');
} catch (Exception $e) {
    include('error_handler.php');
}
?>