<?php session_start(); ?>
<!DOCTYPE html>
<html class="no-js pattern_1">
<head>
<title>Careers - Job Board Templete</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato:300,400,700&amp;subset=latin,latin-ext"/>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome-ie7.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link id="color_css" rel="stylesheet" type="text/css" href="css/color_scheme_1.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.combosex.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.flexslider.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.scrollbar.css"/>

<!--[if (lte IE 9)]>
    <link rel="stylesheet" type="text/css" href="css/iefix.css"/>
    <![endif]-->
<script type="text/javascript" src="js/jquery.1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.1.7.2.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/jquery.combosex.min.js"></script>
<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="js/jquery.easytabs.min.js"></script>
<script type="text/javascript" src="js/jquery.gmap.min.js"></script>
<script type="text/javascript" src="js/jquery.scrollbar.min.js"></script>
<script type="text/javascript" src="js/jQuery.menutron.js"></script>
<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
</head>
<body>

<!-- Bar -->
<div id="bar">
  <div class="inner"> 
    
    <!-- User Menu -->
    <ul id="user-menu">
      <?php
        if (isset($_SESSION['CurrentApplicantId']))
        {
        ?>
            <li id="logout" class="first"><a href="processlogout.php">Log out</a></li>
        <?php
        }
        else
        {
        ?>
            <li id="login" class="first"><a href="login.php">Login</a></li>
        <?php
        }
      ?>
      <li id="register"><a href="register.php">Register</a></li>
    </ul>
    <!-- /User Menu --> 
    
  </div>
</div>
<!-- /Bar --> 

<!-- Header -->
<div id="header">
  <div class="inner"> 
    
    <!-- Logo -->
    <div id="logo"> <a href="index.php"><img src="images/Logo.png" width="205" height="50"  alt="logo"/></a><a class="menu-hider"></a></div>
    <!-- /Logo -->
    
    <div class="reponsive-nav">
   <select  class="select" name="menu1" id="menu1"> 
       <option value="index.html">Home</option>
      <option value="jobs.html">Job listing</option>
      <option value="job.html">Job Details</option>
      <option value="candidates-listing.html">Candidate Listing (with sidebar)</option>
      <option value="candidates-listing-no-sidebar.html">Candidate listing (without sidebar)</option>
      <option value="candidate.html">Candidate Details</option>
      <option value="partners.html">Partners</option>
      <option value="about-us.html">About Us</option>
      <option value="contacts.html">Contact</option>
    </select>
    </div>
  </div>
</div>
<!-- /Header --> 
<!-- Content -->
<div id="content"> 