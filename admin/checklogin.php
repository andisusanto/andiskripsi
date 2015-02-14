<?php
    session_start();
    if(!isset($_SESSION['CurrentAdminId'])){
        header('location:login.php');
    }
?>