<?php
    include('checklogin.php');
?>
<?php
include_once('../classes/Applicant.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   Applicant::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:applicant.php');
} catch (Exception $e) {
   include('error_handler.php');
}
?>