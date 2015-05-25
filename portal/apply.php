<?php
    $returnUrl = 'apply.php?Id='.$_GET['Id'];
    include("header.php");
    include("checklogin.php");
    include_once('../classes/Recruitment.php');
    include_once('../classes/ApplicantRecruitment.php');
    include_once('../classes/ApplicantRecruitmentCriteria.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    $Recruitment = Recruitment::GetObjectByKey($Conn,$_GET['Id']);
    $ApplicantRecruitment = ApplicantRecruitment::GetObjectByCriteria($Conn, "Applicant = '{$_SESSION['CurrentApplicantId']}' AND Recruitment = '{$Recruitment->get_Id()}'");
?>
    <div id="latest-job">
          <div class="heading-l">
            <h2> Apply - <?php echo $Recruitment->Name; ?></h2>
          </div>
          <div class="latest-job-wrapper">
                <div class="block-content box-1">
                    <section class="row-fluid">

                        <form name="frmApply" method="POST" action="processapply.php">
                            <input type="hidden" value="<?php echo $_GET['Id']; ?>" name="Recruitment" />
                                <?php $RecruitmentCriterias = $Recruitment->get_RecruitmentCriteria(); ?>
                                <?php
                                    foreach($RecruitmentCriterias as $RecruitmentCriteria)
                                    {
                                        $Subcriterias = $RecruitmentCriteria->get_RecruitmentSubcriteria();
                                    ?>
                                        <div class="input-group">
                                            <label class="control-label required"><?php echo $RecruitmentCriteria->Name; ?></label>
                                            <select name="RecruitmentCriteria[<?php echo $RecruitmentCriteria->get_Id(); ?>]" class="form-control" aria-describedby="basic-addon1">
                                            <?php
                                                foreach($Subcriterias as $Subcriteria)
                                                {
                                                    if(!$ApplicantRecruitment)
                                                    {
                                                    ?>
                                                        <option value="<?php echo $Subcriteria->get_Id(); ?>"><?php echo $Subcriteria->Description; ?></option>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                        $ApplicantRecruitmentCriteria = ApplicantRecruitmentCriteria::GetObjectByCriteria($Conn, "ApplicantRecruitment = '{$ApplicantRecruitment->get_Id()}' AND RecruitmentCriteria = '{$RecruitmentCriteria->get_Id()}'");
                                                        if($ApplicantRecruitmentCriteria)
                                                        {
                                                            $isSelected = $ApplicantRecruitmentCriteria->RecruitmentSubcriteria == $Subcriteria->get_Id() ? "Selected" : "";
                                                        ?>
                                                            <option <?php echo $isSelected; ?> value="<?php echo $Subcriteria->get_Id(); ?>"><?php echo $Subcriteria->Description; ?></option>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                            <option value="<?php echo $Subcriteria->get_Id(); ?>"><?php echo $Subcriteria->Description; ?></option>
                                                        <?php
                                                        }
                                                    }
                                                }
                                            ?>
                                            </select>
                                            <span class="glyphicon icon-question-sign" title="bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla "></span>
                                        </div>
                                    <?php
                                    }
                                ?>
                            
                            <button type="submit" class="btn btn-primary">Apply</button>
                        </form>
                    </section>
                </div>
          </div>
    </div>
<?php
    include("footer.php");
?>