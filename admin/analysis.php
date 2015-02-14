<?php
    include_once('../classes/Recruitment.php');
    include_once('../classes/Applicant.php');
    include_once('../classes/ApplicantRecruitment.php');
    include_once('../classes/ApplicantRecruitmentCriteria.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    $Recruitment = Recruitment::GetObjectByKey($Conn, $_GET['Id']);
    $ApplicantRecruitments = $Recruitment->get_ApplicantRecruitment();
    $RecruitmentCriterias = $Recruitment->get_RecruitmentCriteria();
    ?>
    <h2><?php echo $Recruitment->Name; ?></h2>
    <?php
    $criterias = array();
    foreach($RecruitmentCriterias as $RecruitmentCriteria)
    {
        $applicantPreferenceDegree = array();
        foreach($ApplicantRecruitments as $ApplicantRecruitmentA)
        {
            $preferenceDegree = array();
            $ApplicantRecruitmentCriteriaA = ApplicantRecruitmentCriteria::GetObjectByCriteria($Conn,"ApplicantRecruitment = '{$ApplicantRecruitmentA->get_Id()}' AND RecruitmentCriteria = '{$RecruitmentCriteria->get_Id()}'");
            $RecruitmentSubcriteriaA = RecruitmentSubcriteria::GetObjectByKey($Conn, $ApplicantRecruitmentCriteriaA->RecruitmentSubcriteria);
            foreach($ApplicantRecruitments as $ApplicantRecruitmentB)
            {
                if($ApplicantRecruitmentA->get_Id()==$ApplicantRecruitmentB->get_Id()) 
                {
                    $preferenceDegree[] = 0;
                    continue;
                }
                $ApplicantRecruitmentCriteriaB = ApplicantRecruitmentCriteria::GetObjectByCriteria($Conn,"ApplicantRecruitment = '{$ApplicantRecruitmentB->get_Id()}' AND RecruitmentCriteria = '{$RecruitmentCriteria->get_Id()}'");
                $RecruitmentSubcriteriaB = RecruitmentSubcriteria::GetObjectByKey($Conn, $ApplicantRecruitmentCriteriaB->RecruitmentSubcriteria);
                $A_B = $RecruitmentSubcriteriaA->Value - $RecruitmentSubcriteriaB->Value;
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
            $applicantPreferenceDegree[] = $preferenceDegree;
        }
        $criterias[$RecruitmentCriteria->Name] = $applicantPreferenceDegree;
    }
    foreach($criterias as $key => $criteria)
    {
    ?>
        <table>
            <thead>
                <th><?php echo $key; ?></th>
                <?php
                foreach($ApplicantRecruitments as $ApplicantRecruitment)
                {
                ?>
                    <th><?php $Applicant = Applicant::GetObjectByKey($Conn, $ApplicantRecruitment->Applicant); echo $Applicant->Name; ?></th>
                <?php
                }
                ?>
            </thead>
            <tbody>
                <?php
                for($i=0;$i<count($ApplicantRecruitments);$i++)
                {
                ?>
                    <tr>
                        <td><?php $Applicant = Applicant::GetObjectByKey($Conn, $ApplicantRecruitments[$i]->Applicant); echo $Applicant->Name; ?></td>
                        <?php
                        for($j=0;$j<count($ApplicantRecruitments);$j++)
                        {
                        ?>
                            <td><?php echo $criteria[$i][$j]; ?></td>
                        <?php
                        }
                        ?>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
?>