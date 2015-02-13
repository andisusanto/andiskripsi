<?php
    session_start();
    include_once('../classes/Applicant.php');
    include_once('../classes/Connection.php');
    include_once('../classes/Recruitment.php');
    include_once('../classes/ApplicantRecruitment.php');
    include_once('../classes/ApplicantRecruitmentCriteria.php');
    
    if (!isset($_SESSION['CurrentApplicantId'])) throw new Exception('Authentication failed');
    $Conn = Connection::get_DefaultConnection();
    $RecruitmentId = $_POST['Recruitment'];
    $Recruitment = Recruitment::GetObjectByKey($Conn, $RecruitmentId);
    $RecruitmentCriterias = $Recruitment->get_RecruitmentCriteria();
    
    $ApplicantRecruitment = ApplicantRecruitment::GetObjectByCriteria($Conn, "Applicant = '{$_SESSION['CurrentApplicantId']}' AND Recruitment = '{$RecruitmentId}'");
    if(!$ApplicantRecruitment)
    {
        $ApplicantRecruitment = new ApplicantRecruitment($Conn);
        $ApplicantRecruitment->Applicant = $_SESSION['CurrentApplicantId'];
        $ApplicantRecruitment->Recruitment = $RecruitmentId;
        $ApplicantRecruitment->Save();
    }
    foreach($RecruitmentCriterias as $RecruitmentCriteria)
    {
        if(!isset($_POST['RecruitmentCriteria'][$RecruitmentCriteria->get_Id()])) throw new Exception("{$RecruitmentCriteria->Name} is not set");
        $ApplicantRecruitmentCriteria = ApplicantRecruitmentCriteria::GetObjectByCriteria($Conn, "ApplicantRecruitment = '{$ApplicantRecruitment->get_Id()}' AND RecruitmentCriteria = '{$RecruitmentCriteria->get_Id()}'");
        if(!$ApplicantRecruitmentCriteria)
        {
            $ApplicantRecruitmentCriteria = new ApplicantRecruitmentCriteria($Conn);
            $ApplicantRecruitmentCriteria->ApplicantRecruitment = $ApplicantRecruitment->get_Id();
            $ApplicantRecruitmentCriteria->RecruitmentCriteria = $RecruitmentCriteria->get_Id();
            $ApplicantRecruitmentCriteria->RecruitmentSubcriteria = $_POST['RecruitmentCriteria'][$RecruitmentCriteria->get_Id()];
            $ApplicantRecruitmentCriteria->Save();
        }
        else
        {
            $ApplicantRecruitmentCriteria->RecruitmentSubcriteria = $_POST['RecruitmentCriteria'][$RecruitmentCriteria->get_Id()];
            $ApplicantRecruitmentCriteria->Update();
        }
    }
    $Conn->Commit();
    header('location:recruitmentdetail.php?Id='.$RecruitmentId);
?>