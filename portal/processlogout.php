<?php
    session_start();
    unset($_SESSION['CurrentApplicantId']);
    header('location:index.php');
?>