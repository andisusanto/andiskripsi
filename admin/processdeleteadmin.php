<?php
include_once('../classes/Admin.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   Admin::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:admin.php');
} catch (Exception $e) {
   include('error_handler.php');
}
?>