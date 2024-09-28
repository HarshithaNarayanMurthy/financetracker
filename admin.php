<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login']))
  {
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select ID from tbladmin where  Email='$email' && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['detsaid']=$ret['ID'];
     header('location:adminmanager.php');
    }
    else{
    $msg="Invalid Details.";
    }
  }
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HomFin - Admin Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Allura' rel='stylesheet'>
	<link rel="stylesheet" href="css/styler.css">
	
	
	<link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
	

	<style>
	body {background-image: url('includes/r4.jpg');
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-size: cover;}
	h1 {
		font-family: 'Allura';font-size: 62px; font-style: bold; color:white;
	}
	.panel-heading{
		font-family: 'Allura'; font-size: 32px; font-style: bold;
	}
	.login-panel panel panel-default{
		font-family: 'Allura';
	}
	h2 {
		font-family: 'Allura'; font-style: bold; color:white;
	}
	</style>
	
</head>
<body>
<p> <a href= "home.html" style = "background-image: url('includes/brick.jpg') ;font-family: 'Segoe Print';"> <b>go back home</b> </a></p>
	<div class="row">
		<h1 align="center" style="font-family: 'Segoe Script';" ><strong>HomFin</strong></h1>
		<h2 align="center" style="font-family: 'Segoe Print'"; >Admin Login</h2>
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading" style="font-family: 'Segoe Print'";>Admin Login</div>
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
								<input class="form-control" placeholder="Password" name="password" type="password" value="" required="true">
							</div>
							<div class="checkbox">
								<button type="submit" value="login" name="login" class="btn btn-primary">Login</button><span style="padding-left:250px">
								<a href="index.php" class="btn btn-primary">User login</a></span>
							</div>
							</fieldset>
					</form>
					
				</div>
				
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
</div>
	
</footer>
	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
