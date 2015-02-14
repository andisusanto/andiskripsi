<?php
    include("header.php");
?>
   
<div id="latest-job">
          <div class="heading-l">
            <h2> Log In </h2>
          </div>
          <div class="latest-job-wrapper">
                <div class="block-content box-1">
                    <section class="row-fluid">

                        <form name="frmEditRecruitment" method="POST" action="processlogin.php">
                        <input name="returnUrl" type="hidden" value="<?php echo isset($_GET['returnUrl']) ? $_GET['returnUrl'] : ''; ?>" />
                            <div class="input-group">
                                <label class="control-label required">Username</label>
                                <input type="text" name="txtUserName" class="form-control" placeholder="Username" aria-describedby="basic-addon1" />
                            </div>
                            
                            <div class="input-group">
                                <label class="control-label required">Password</label>
                                <input type="password" name="txtPassword" class="form-control" placeholder="Password" aria-describedby="basic-addon1" />
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Log in</button>
                        </form>
                    </section>
                </div>
          </div>
    </div>
          
<?php
    include("footer.php");
?>