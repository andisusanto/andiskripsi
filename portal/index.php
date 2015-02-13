<?php
    include("header.php");
    include_once('../classes/Helper.php');
    include_once('../classes/Recruitment.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    $Recruitments = Recruitment::LoadCollection($Conn, 'Status = 1');
?>
    <div id="latest-job">
          <div class="heading-l">
            <h2> Available Jobs </h2>
          </div>
          <div class="latest-job-wrapper">
                <div class="block-content box-1">
                    <section class="row-fluid">
                    <?php
                        foreach($Recruitments as $Recruitment)
                        {
                            ?>
                              <div class="company-text">
                                <div class="title"><a href="recruitmentdetail.php?Id=<?php echo $Recruitment->get_Id(); ?>"><?php echo $Recruitment->Name; ?></a>
                                  <div class="location">At <?php echo date('Y-m-d', $Recruitment->TransDate); ?></div>
                                </div>
                                <div class="description"><?php echo strlen($Recruitment->Description) > 100 ? substr($Recruitment->Description,0,100)."<a href='recruitmentdetail.php?Id=".$Recruitment->get_Id()."'> ...Read More</a>" : $Recruitment->Description; ?></div>
                              </div>
                            <?php
                        }
                    ?>
                    </section>
                </div>
          </div>
    </div>
<?php
    include("footer.php");
?>