<?php
    if($returnUrl) $returnUrl = "?returnUrl=".$returnUrl;
    if(!isset($_SESSION['CurrentApplicantId']))
    {
        header('location:login.php'.$returnUrl);
    }
?>