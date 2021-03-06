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
<link rel="stylesheet" href="css/custom.css">
<link rel="stylesheet" href="_js/jquery-ui.min.css">
<link rel="stylesheet" href="_js/jquery-ui.structure.min.css">
<link rel="stylesheet" href="_js/jquery-ui.theme.min.css">
<style>
    #accordion div
    {
        height: auto !important;
    }
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="_js/jquery-ui.min.js"></script>
<script type="text/javascript">
    function printSection (content, title, sectionname) {
        var OpenWindow = window.open("report.php", title, '');
        var reportheader = '<h1><?php echo $Recruitment->Name; ?></h1>';
        var reportsection = '<h2>' + sectionname + '</h2>';
        OpenWindow.dataFromParent = reportheader + reportsection + content;
    }
</script>
<div class="analysis">
<script>
  $(function() {
    $( "#accordion" ).accordion({
    active:3
    });
  });
  </script>
<h1><?php echo $Recruitment->Name; ?></h1>
<div id="accordion">
  <h1>Applicants</h1>
  <div><a href="#" onclick="printSection(document.getElementById('applicants').innerHTML, 'Applicants', 'Applicants')"> Print this section </a>
  <div id="applicants"><?php
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
                    $tmpPreferenceThreshold = $RecruitmentCriteria->PreferenceThreshold;
                    if ($tmpPreferenceThreshold == 0)
                        $tmpPreferenceThreshold = $RecruitmentCriteria->get_MaximumPreferenceThreshold();
                    if ($A_B >= $tmpPreferenceThreshold)
                    {
                        $preferenceDegree[] = 1;
                    }
                    else
                    {
                        $preferenceDegree[] = ($A_B - $RecruitmentCriteria->IndifferenceThreshold) / ($tmpPreferenceThreshold - $RecruitmentCriteria->IndifferenceThreshold);
                    }
                }
            }
            $applicantPreferenceDegree[] = $preferenceDegree;
        }
        $criterias[] = $applicantPreferenceDegree;
    }
    ?>
        <table>
            <thead>
                <tr>
                    <th rowspan="2" style="width:25%">Applicant Criteria Value</th>
                    <?php
                    $ApplicantRecruitmentCalculation = array();
                    foreach($RecruitmentCriterias as $RecruitmentCriteria)
                    {
                    ?>
                        <th colspan="2"><?php echo $RecruitmentCriteria->Name; ?>(w=<?php echo $RecruitmentCriteria->Weight; ?>)</th>
                    <?php
                    }
                    ?>
                </tr>
                    <?php
                    foreach($RecruitmentCriterias as $RecruitmentCriteria)
                    {
                    ?>
                        <th>Description</th>
                        <th>Value</th>
                    <?php
                    }
                    ?>
                <tr>
                </tr>
            </thead>
            <tbody>
                <?php
                for($i=0;$i<count($ApplicantRecruitments);$i++)
                {
                ?>
                    <tr>
                        <td><?php $Applicant = Applicant::GetObjectByKey($Conn, $ApplicantRecruitments[$i]->Applicant); echo $Applicant->Name; ?></td>
                        <?php
                            foreach($RecruitmentCriterias as $RecruitmentCriteria)
                            {
                                $ApplicantRecruitmentCriteria = ApplicantRecruitmentCriteria::GetObjectByCriteria($Conn,"ApplicantRecruitment = '{$ApplicantRecruitments[$i]->get_Id()}' AND RecruitmentCriteria = '{$RecruitmentCriteria->get_Id()}'");
                                $ApplicantRecruitmentSubcriteria = RecruitmentSubcriteria::GetObjectByKey($Conn,$ApplicantRecruitmentCriteria->RecruitmentSubcriteria);
                            ?>
                                <td><?php echo $ApplicantRecruitmentSubcriteria->Description; ?></td>
                                <td><?php echo $ApplicantRecruitmentSubcriteria->Value; ?></td>
                            <?php
                            }
                        ?>
                    </tr>
                <?php
                }
                 $RecruitmentCalculation[] = $ApplicantRecruitmentCalculation;
                ?>
            </tbody>
        </table>
  </div>
  </div>
  <h2>Calculation</h2>
  <div><a href="#" onclick="printSection(document.getElementById('calculation').innerHTML, 'Calculation', 'Calculation')"> Print this section </a>
  <div id="calculation">
<?php
    $RecruitmentCalculation = array();
    for($h=0;$h<count($RecruitmentCriterias);$h++)
    {
        $criteria = $criterias[$h];
    ?>
        <table>
            <thead>
                <th style="width:25%"><?php echo $RecruitmentCriterias[$h]->Name; ?> (weight = <?php echo $RecruitmentCriterias[$h]->Weight; ?>)</th>
                <?php
                $ApplicantRecruitmentCalculation = array();
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
                            <td><?php echo round($criteria[$i][$j],3); ?></td>
                        <?php
                        }
                        ?>
                        <td><?php $positiveFlow = $positiveFlow / (count($ApplicantRecruitments) - 1); echo round($positiveFlow,3); ?></td>
                        <td><?php $negativeFlow = $negativeFlow / (count($ApplicantRecruitments) - 1); echo round($negativeFlow,3); ?></td>
                        <td><?php $netFlow = ($positiveFlow - $negativeFlow); echo round($netFlow,3); ?></td>
                        <?php $Flows = array(); $Flows['positiveFlow'] = $positiveFlow;  $Flows['negativeFlow'] = $negativeFlow;  $Flows['netFlow'] = $netFlow; $ApplicantRecruitmentCalculation[] = $Flows; ?>
                    </tr>
                <?php
                }
                 $RecruitmentCalculation[] = $ApplicantRecruitmentCalculation;
                ?>
            </tbody>
        </table>
    <?php
    }
?>
  </div>
  </div>
  <h3>Global Flows</h3>
  <div><a href="#" onclick="printSection(document.getElementById('globalflows').innerHTML, 'Global Flows', 'Global Flows')"> Print this section </a>
  <div id="globalflows">
<table>
    <thead>
        <tr>
            <th rowspan="3">Applicant</th>
            <th colspan="<?php echo count($RecruitmentCriterias) * 2; ?>">Criterias</th>
            <th rowspan="3">Global Netflow</th>
        </tr>
        <tr>
        <?php
            for($i=0;$i<count($RecruitmentCriterias);$i++)
            {
            ?>
                <th colspan="2"><?php echo $RecruitmentCriterias[$i]->Name ?> (w= <?php echo $RecruitmentCriterias[$i]->Weight; ?>)</th>
            <?php
            }
        ?>
        </tr>
        <tr>
            <?php
                for($i=0;$i<count($RecruitmentCriterias);$i++)
                {
                ?>
                    <th>Netflow</th>
                    <th>Netflow * Weight</th>
                <?php
                }
            ?>
        </tr>
    </thead>
    <tbody>
    <?php
        $ApplicantRecruitmentGlobalFlows = array();
        for($i=0;$i<count($ApplicantRecruitments);$i++)
        {
        ?>
        <tr>
            <td><?php $Applicant = Applicant::GetObjectByKey($Conn, $ApplicantRecruitments[$i]->Applicant); echo $Applicant->Name; ?></td>
        <?php
            $globalFlow = 0;
            for($j=0;$j<count($RecruitmentCriterias);$j++)
            {
            ?>
                <td><?php echo round($RecruitmentCalculation[$j][$i]['netFlow'],3) ?></td>
                <td><?php $tmpGlobalFlow = $RecruitmentCalculation[$j][$i]['netFlow'] * $RecruitmentCriterias[$j]->Weight;  echo round($tmpGlobalFlow,3); $globalFlow+=$tmpGlobalFlow; ?></td>
            <?php
            }
            ?>
            <td><?php echo round($globalFlow,3); ?></td>
        </tr>
        <?
        $ApplicantRecruitmentGlobalFlows[] = array('GlobalFlow'=>$globalFlow,'ApplicantName'=>$Applicant->Name);
        }
    ?>
    </tbody>
</table>
  </div>
  </div>
  <h3 id="hranking">Ranking</h3>
  <div><a href="#" onclick="printSection(document.getElementById('ranking').innerHTML, 'Ranking', 'Ranking')"> Print this section </a>
  <div id="ranking">
<?php
    $sorted = array();
    $sorted[0] = $ApplicantRecruitmentGlobalFlows[0];
    for($i=1;$i<count($ApplicantRecruitmentGlobalFlows);$i++)
    {
        for($j=$i-1;$j>=0;$j--)
        {
            if($sorted[$j]['GlobalFlow'] >= $ApplicantRecruitmentGlobalFlows[$i]['GlobalFlow'])
            {
                $sorted[$j+1] = $ApplicantRecruitmentGlobalFlows[$i];
                break;
            }
            else
            {
                $sorted[$j+1] = $sorted[$j];
            }
            if($j==0)
                $sorted[0] = $ApplicantRecruitmentGlobalFlows[$i];
        }
    }
?>
<table>
    <thead>
        <th>Applicant</th>
        <th>Global Netflow</th>
        <th>Ranking</th>
    </thead>
    <tbody>
        <?php
            for($i=0;$i<count($sorted);$i++)
            {
            ?>
                <tr>
                    <td><?php echo $sorted[$i]['ApplicantName'] ?></td>
                    <td><?php echo round($sorted[$i]['GlobalFlow'],3) ?></td>
                    <td><?php echo $i+1 ?></td>
                </tr>
            <?php
            }
        ?>
    </tbody>
</table>
  </div>
  </div>
</div>
  <div><a href="#" onclick="printSection(document.getElementById('applicants').innerHTML+document.getElementById('calculation').innerHTML+document.getElementById('globalflows').innerHTML+document.getElementById('ranking').innerHTML, 'All', '')"> Print </a>