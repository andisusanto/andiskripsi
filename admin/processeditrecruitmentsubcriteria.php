<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/RecruitmentSubcriteria.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
    $RecruitmentSubcriteria = RecruitmentSubcriteria::GetObjectByKey($Conn, $_POST['Id']);
    $RecruitmentSubcriteria->Description = $_POST['Description'];
    $RecruitmentSubcriteria->Value = $_POST['Value'];

    $RecruitmentSubcriteria->Update();
    $Conn->Commit();
    header('location:editrecruitmentcriteria.php?Id='.$RecruitmentSubcriteria->RecruitmentCriteria);
} catch (Exception $e) {
    include('error_handler.php');
}
?>