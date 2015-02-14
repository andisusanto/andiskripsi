<?php
    include('checklogin.php');
?>
<!DOCTYPE HTML>
<html lang="en-US">
    <head>

        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <link rel="icon" type="image/ico" href="favicon.ico">
        
    <!-- common stylesheets-->
        <!-- bootstrap framework css -->
            <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css">
        <!-- iconSweet2 icon pack (16x16) -->
            <link rel="stylesheet" href="img/icsw2_16/icsw2_16.css">
        <!-- splashy icon pack -->
            <link rel="stylesheet" href="img/splashy/splashy.css">
        <!-- flag icons -->
            <link rel="stylesheet" href="img/flags/flags.css">
        <!-- power tooltips -->
            <link rel="stylesheet" href="js/lib/powertip/jquery.powertip.css">
        <!-- google web fonts -->
            <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Abel">
            <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300">

    <!-- aditional stylesheets -->
        <!-- colorbox -->
            <link rel="stylesheet" href="js/lib/colorbox/colorbox.css">
        <!--fullcalendar -->
            <link rel="stylesheet" href="js/lib/fullcalendar/fullcalendar_beoro.css">


        <!-- main stylesheet -->
            <link rel="stylesheet" href="css/beoro.css">
            <link rel="stylesheet" href="css/main.css">

        <!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css"><![endif]-->
        <!--[if IE 9]><link rel="stylesheet" href="css/ie9.css"><![endif]-->
            
        <!--[if lt IE 9]>
            <script src="js/ie/html5shiv.min.js"></script>
            <script src="js/ie/respond.min.js"></script>
            <script src="js/lib/flot-charts/excanvas.min.js"></script>
        <![endif]-->

    </head>
    <body class="bg_d">
    <!-- main wrapper (without footer) -->    
        <div class="main-wrapper">


        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <div id="fade-menu" class="pull-left">
                        <ul class="clearfix" id="mobile-nav">
                            <li>
                                <a href="applicant.php">Applicant</a>
                            </li>
                            <li>
                                <a href="recruitment.php">Recruitment</a>
                            </li>
                            <li>
                                <a href="admin.php">Admin</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <header>
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <div class="main-logo"><a href="index.php"><img src="img/beoro.png" alt="Dashboard Area"></a></div>
                    </div>
                    <div class="span4" style="float: right">
                        <div class="user-box">
                            <div class="user-box-inner">
                                <div class="user-info">
                                    Welcome, <strong>
                                    <?php
                                        if ($_SESSION['CurrentAdminId'] == 'admin')
                                        {
                                            echo 'admin';
                                        }
                                        else
                                        {
                                            include_once('../classes/Admin.php');
                                            include_once('../classes/Connection.php');
                                            $Conn = Connection::get_DefaultConnection();
                                            $admin = Admin::GetObjectByKey($Conn,$_SESSION['CurrentAdminId']);
                                            echo $admin->UserName;
                                        }
                                    ?></strong>
                                    <ul class="unstyled">
                                        <li><a href="processlogout.php">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- main content -->
            <div class="container">