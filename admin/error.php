<?php include_once('../classes/Exceptions.php');
  session_start();
 $ex = $_SESSION['Error']; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/core.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div class="logintop"></div>

<div class="errormsg">
    <?php echo get_class($ex).":<br />"; ?>
    <p><?php echo $ex->getMessage(); ?></p>
<p><span style="padding: 5px 15px; background-color: #FFa200; cursor: pointer; border-radius: 7px" onclick="history.back()">Back</span></p>
</div>
</body>
</html>