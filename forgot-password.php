<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
  {
    $contactno=$_POST['contactno'];
    $email=$_POST['email'];

        $query=mysqli_query($con,"select ID from tbluser where  Email='$email' and MobileNumber='$contactno' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['contactno']=$contactno;
      $_SESSION['email']=$email;
     header('location:reset-password.php');
    }
    else{
      $msg="Invalid Details. Please try again.";
    }
  }
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AINsoft - Forgot Password</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link rel="stylesheet" href="css/styler.css">
	<style>
	body {background-image: url('includes/forg.jpg');
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-size: cover;}
	h1 {
		font-family: 'Allura';font-size: 62px; font-style: bold; color:white;
	}
	h2 {
		font-family: 'Allura'; font-style: bold; color:white;
	}
	.panel-heading{
		font-family: 'Allura'; font-size: 32px; font-style: bold;
	}
	.login-panel panel panel-default{
		font-family: 'Allura';
	}
	</style>
	
</head>
<body>
<p> <a href= "home.html" style = "background-image: url('includes/brick.jpg') ;font-family: 'Segoe Print';"> <b>go back home</b> </a></p>
	<div class="row">
			<h1 align="center" style="font-family: 'Segoe Script'"; ><strong>AINsoft</strong></h1>
			<h2 align="center" style="font-family: 'Segoe Print'"; >Forgot Password </h2>
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading" style="font-family: 'Segoe Print'";>Log in</div>
				<div class="panel-body">
					<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
					<form role="form" action="" method="post" id="" name="login">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" required="true">
							</div>
							
							<div class="form-group">
								<input class="form-control" placeholder="Mobile Number" name="contactno" type="contactno" value="" required="true">
							</div>
							<div class="checkbox">
								<button type="submit" value="" name="submit" class="btn btn-primary">Reset</button><span style="padding-left:250px"><a href="index.php" class="btn btn-primary">Login</a></span>

							</div>
							</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
<footer style="background-image:url('includes/blackbr.png');height:40px;padding-top:10px; bottom:0; position:fixed; width:100%; text-align:center;">
  <p style="color:white">Developed by RechRitu | @Copyright 2020 | All Rights Reserved.</p>
</footer>	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
