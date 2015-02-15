<link rel="stylesheet" href="css/custom.css">
<div class="analysis">
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
    <h1><?php echo $Recruitment->Name; ?></h1>
    <?php
    $criterias = array();
    foreach($RecruitmentCriterias as $RecruitmentCriteria)
    {
        ?>
        <h3><?php echo $RecruitmentCriteria->Name; ?> (Weight: <?php echo $RecruitmentCriteria->Weight; ?>)</h3>
        <?php $RecruitmentSubcriterias = $RecruitmentCriteria->get_RecruitmentSubcriteria(0,0,'Value ASC'); ?>
        <table>
            <thead>
                <th style="width:70%">Description</th>
                <th style="width:30%">Value</th>
            </thead>
            <tbody>
                <?php
                foreach($RecruitmentSubcriterias as $RecruitmentSubcriteria)
                {
                ?>
                    <tr>
                        <td><?php echo $RecruitmentSubcriteria->Description; ?></td>
                        <td><?php echo $RecruitmentSubcriteria->Value; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
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
        $criterias[] = $applicantPreferenceDegree;
    }
    ?>
        <h2>CALCULATION</h2>
    <?php
    for($h=0;$h<count($RecruitmentCriterias);$h++)
    {
        $criteria = $criterias[$h];
    ?>
        <table>
            <thead>
                <th style="width:25%"><?php echo $RecruitmentCriterias[$h]->Name; ?> (weight = <?php echo $RecruitmentCriterias[$h]->Weight; ?>)</th>
                <?php
                foreach($ApplicantRecruitments as $ApplicantRecruitment)
                {
                ?>
                    <th><?php $Applicant = Applicant::GetObjectByKey($Conn, $ApplicantRecruitment->Applicant); echo $Applicant->Name; ?></th>
                <?php
                }
                ?>
                <th style="width:10%">Positive Flow</th>
                <th style="width:10%">Negative Flow</th>
                <th style="width:10%">Net Flow</th>
            </thead>
            <tbody>
                <?php
                for($i=0;$i<count($ApplicantRecruitments);$i++)
                {
                ?>
                    <tr>
                        <td><?php $Applicant = Applicant::GetObjectByKey($Conn, $ApplicantRecruitments[$i]->Applicant); echo $Applicant->Name; ?></td>
                        <?php
                        $positiveFlow = 0;
                        $negativeFlow = 0;
                        for($j=0;$j<count($ApplicantRecruitments);$j++)
                        {
                            $positiveFlow += $criteria[$i][$j];
                            $negativeFlow += $criteria[$j][$i];
                        ?>
                            <td><?php echo $criteria[$i][$j]; ?></td>
                        <?php
                        }
                        ?>
                        <td><?php echo $positiveFlow / (count($ApplicantRecruitments) - 1) ?></td>
                        <td><?php echo $negativeFlow / (count($ApplicantRecruitments) - 1) ?></td>
                        <td><?php echo ($positiveFlow - $negativeFlow) / (count($ApplicantRecruitments) - 1) ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
?>
</div>