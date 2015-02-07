<?php
    include_once('../classes/Recruitment.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    $Recruitment = Recruitment::GetObjectByKey($Conn, $_POST['Id']);
    $ApplicantRecruitments = $Recruitment->get_ApplicantRecruitment();
    $RecruitmentCriterias = $Recruitment->get_RecruitmentCriteria();
    
    $criterias = array();
    foreach($RecruitmentCriterias as $RecruitmentCriteria)
    {
        foreach($ApplicantRecruitments as $ApplicantRecruitmentA)
        {
            $preferenceDegree = array();
            $ApplicantRecruitmentCriteriaA = ApplicantRecruitmentCriteria::LoadCollection($Conn,"Applicant = '{$ApplicantRecruitmentA->get_Id()}' AND RecruitmentCriteria = '{$RecruitmentCriteria->get_Id()}'")[0];
            $RecruitmentSubcriteriaA = RecruitmentSubcriteria::GetObjectByKey($Conn, $ApplicantRecruitmentCriteriaA->RecruitmentSubcriteria);
            foreach($ApplicantRecruitments as $ApplicantRecruitmentB)
            {
                if($ApplicantRecruitmentA==$ApplicantRecruitmentB) break;
                $ApplicantRecruitmentCriteriaB = ApplicantRecruitmentCriteria::LoadCollection($Conn,"Applicant = '{$ApplicantRecruitmentB->get_Id()}' AND RecruitmentCriteria = '{$RecruitmentCriteria->get_Id()}'")[0];
                $RecruitmentSubcriteriaB = RecruitmentSubcriteria::GetObjectByKey($Conn, $ApplicantRecruitmentCriteriaB->RecruitmentSubcriteria);
                $A_B = $RecruitmentSubcriteriaA - $RecruitmentSubcriteriaB;
                if ($A_B <= $RecruitmentCriteria->IndifferenceThreshold)
                {
                    $preferenceDegree[] = 0;
                }
                else
                {
                    if ($A_B >= $RecruitmentCriteria->PreferenceThreshold)
                    {
                        $preferenceDegree[] = 1;
                    }
                    else
                    {
                        $preferenceDegree[] = $A_B / ($RecruitmentCriteria->PreferenceThreshold - $RecruitmentCriteria->IndifferenceThreshold);
                    }
                }
            }
            $criterias[] = $preferenceDegree;
        }
    }
?>