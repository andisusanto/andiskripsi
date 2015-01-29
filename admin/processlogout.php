<?php
    session_start();
    unset($_SESSION['CurrentAdminId']);
    header('location:login.php');
?>