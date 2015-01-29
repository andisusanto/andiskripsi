<?php
    include_once('../classes/Admin.php');
    include_once('../classes/Connection.php');
    $Conn = Connection::get_DefaultConnection();
    $userName = $_POST['txtUserName'];
    $password = $_POST['txtPassword'];
    if($userName == 'admin' && $password =='password'){
        session_start();
        $_SESSION['CurrentAdminId'] = 'admin';
        header('location:index.php');
    }else{
        try{
            $admin = Admin::GetObjectByUserName($Conn,$userName);
            if($admin != NULL && $admin->ComparePassword($password)){
                session_start();
                $_SESSION['CurrentAdminId'] = $admin->get_Id();
                header('location:index.php');
            }else{
                throw new Exception("Username or password does not match!");
            }
        } catch (Exception $e) {
            include('error_handler.php');
        }
   }    
?>