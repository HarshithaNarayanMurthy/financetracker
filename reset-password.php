<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);

if(isset($_POST['submit']))
  {
    $contactno=$_SESSION['contactno'];
    $email=$_SESSION['email'];
    $password=md5($_POST['newpassword']);

        $query=mysqli_query($con,"update tbluser set Password='$password'  where  Email='$email' && MobileNumber='$contactno' ");
   if($query)
   {
echo "<script>alert('Password successfully changed');</script>";
session_destroy();
   }
  
  }
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HomFin - Forgot/Reset Password</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Allura' rel='stylesheet'>
	<link rel="stylesheet" href="css/styler.css">
	<style>
	body {background-image: url('includes/dash2.jpg');
background-repeat: no-repeat;
background-attachment: fixed;
background-size: cover;}</style>
	<script type="text/javascript">
	
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
} 

</script>
</head>
<body>
<p> <a href= "home.html" style = "background-image: url('includes/brick.jpg') ;font-family: 'Segoe Print';"> <b>go back home</b> </a></p>
	<div class="row">
			<h1 align="center" style="font-family: 'Segoe Script'; font-size: 62px; color: white;"><strong>HomFin</strong></h1>
			<h2 align="center" style="font-family: 'Segoe Print'; color: white; font-size: 32px;" >Reset Password</h2>
	<br>
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading" style = "font-family: 'Segoe Print'">Reset Password</div>
				<div class="panel-body">
					<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
					<form role="form" action="" method="post" name="changepassword" onsubmit="return checkpass()">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="newpassword" type="password" value="" required="true">
							</div>
							
							<div class="form-group">
								<input class="form-control" placeholder="Confirm Password" name="confirmpassword" type="password" value="" required="true">
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
