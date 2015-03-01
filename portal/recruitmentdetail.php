<?php
    include("header.php");
    include_once('../classes/Helper.php');
    include_once('../classes/Recruitment.php');
    include_once('../classes/ApplicantRecruitment.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    $Recruitment = Recruitment::GetObjectByKey($Conn,$_GET['Id']);
?>
    <div id="latest-job">
          <div class="heading-l">
            <h2> <?php echo $Recruitment->Name; ?> </h2>
          </div>
          <div class="latest-job-wrapper">
                <div class="block-content box-1">
                    <section class="row-fluid">
                            <div class="company-text">
                                <h4>Information</h4>
                                <div class="description">Posted Date : <?php echo date('d-M-Y',$Recruitment->TransDate); ?></div>
                                <div class="description">Estimation Close Date : <?php echo date('d-M-Y',$Recruitment->EstimationCloseDate); ?></div>
                            </div>
                            
                            <div class="company-text">
                                <h4>Job Description</h4>
                                <div class="description"><?php echo $Recruitment->Description; ?></div>
                            </div>
                            
                            <div class="company-text">
                                <h4>Required Criteria to be filled</h4>
                                <div class="description">
                                <ul>
                                <?php $RecruitmentCriterias = $Recruitment->get_RecruitmentCriteria(); ?>
                                <?php
                                    foreach($RecruitmentCriterias as $RecruitmentCriteria)
                                    {
                                    ?>
                                        <li>
                                        - <?php echo $RecruitmentCriteria->Name; ?>
                                        </li>
                                    <?php
                                    }
                                ?>
                                </ul>
                                </div>
                            </div>
                            
                    </section>
                </div>
                <div class="block-content box-1">
                    <?php
                        if(isset($_SESSION['CurrentApplicantId']))
                        {
                            $ApplicantRecruitment = ApplicantRecruitment::GetObjectByCriteria($Conn, "Applicant = '{$_SESSION['CurrentApplicantId']}' AND Recruitment = '{$_GET['Id']}'");
                            if(!$ApplicantRecruitment)
                            {
                                ?>
                                    <a href="apply.php?Id=<?php echo $_GET['Id']; ?>"><button class="btn btn-primary">Apply</button></a>
                                <?php
                            }
                            else
                            {
                                ?>
                                    <a href="apply.php?Id=<?php echo $_GET['Id']; ?>"><button class="btn btn-primary">Update my information</button></a>
                                <?php
                            }
    
                        }
                        else
                        {
                            ?>
                                <a href="login.php?returnUrl=recruitmentdetail.php?Id=<?php echo $_GET['Id']; ?>"><button class="btn btn-primary">Log in to apply</button></a>
                            <?php
                        }
                    ?>
                </div>
          </div>
    </div>
<?php
    include("footer.php");
?>