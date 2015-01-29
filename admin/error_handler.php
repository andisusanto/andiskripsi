<?php
    session_start();
    $_SESSION['Error'] = $e;
    header('location:error.php');
?>