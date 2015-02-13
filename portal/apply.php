<?php
    include("header.php");
    include_once('../classes/Recruitment.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    $Recruitment = Recruitment::GetObjectByKey($Conn,$_GET['Id']);
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
                                                ?>
                                                    <option value="<?php echo $Subcriteria->get_Id(); ?>"><?php echo $Subcriteria->Description; ?></option>
                                                <?php
                                                }
                                            ?>
                                            </select>
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