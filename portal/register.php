<?php
    include("header.php");
    //if (isset($_GET['returnUrl'])) $_SESSION['returnUrl'] = $_GET['returnUrl'];
?>
   
<div id="latest-job">
          <div class="heading-l">
            <h2> Register </h2>
          </div>
          <div class="latest-job-wrapper">
                <div class="block-content box-1">
                    <section class="row-fluid">

                        <form name="frmEditRecruitment" method="POST" action="processregister.php">
                            <div class="input-group">
                                <label class="control-label required">Name</label>
                                <input type="text" name="Name" class="form-control" placeholder="Name" aria-describedby="basic-addon1" />
                            </div>
                            
                            <div class="input-group">
                                <label class="control-label required">UserName</label>
                                <input type="text" name="UserName" class="form-control" placeholder="UserName" aria-describedby="basic-addon1" />
                            </div>

                            <div class="input-group">
                                <label class="control-label">Date of Birth</label>
                                <input type="text" name="DateOfBirth" class="form-control" placeholder="DateOfBirth" aria-describedby="basic-addon2" />
                            </div>
                
                            <div class="input-group">
                                <label class="control-label required">Place of Birth</label>
                                <input type="text" name="PlaceOfBirth" class="form-control" placeholder="PlaceOfBirth" aria-describedby="basic-addon1" />
                            </div>
                
                            <div class="input-group">
                                <label class="control-label required">Address</label>
                                <textarea name="Address" class="form-control" placeholder="Address" aria-describedby="basic-addon1"></textarea>
                            </div>
                            
                            <div class="input-group">
                                <label class="control-label required">Phone Number</label>
                                <input type="text" name="PhoneNumber" class="form-control" placeholder="PhoneNumber" aria-describedby="basic-addon1" />
                            </div>
                            
                            <div class="input-group">
                                <label class="control-label required">Password</label>
                                <input type="password" name="Password" class="form-control" placeholder="Password" aria-describedby="basic-addon1" />
                            </div>
                            
                            <div class="input-group">
                                <label class="control-label required">Confirm Password</label>
                                <input type="password" name="ConfirmPassword" class="form-control" placeholder="ConfirmPassword" aria-describedby="basic-addon1" />
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </section>
                </div>
          </div>
    </div>
          
<?php
    include("footer.php");
?>