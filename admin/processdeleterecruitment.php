<?php
include_once('../classes/Recruitment.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   Recruitment::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:recruitment.php');
} catch (Exception $e) {
   include('error_handler.php');
}
?>