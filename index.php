<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoload.php
require 'vendor\phpmailer\phpmailer\src\Exception.php';
require 'vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'vendor\phpmailer\phpmailer\src\SMTP.php';

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = mysqli_query($con, "SELECT ID, FullName, Email FROM tbluser WHERE Email='$email' && Password='$password'");
    $ret = mysqli_fetch_array($query);
    
    if($ret) {
        $_SESSION['detsuid'] = $ret['ID'];
        header('location:dashboard.php');

        // Send email to the user upon successful login
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Specify SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'harshithanarayanmurthy25@gmail.com'; // SMTP username
            $mail->Password = 'lkwz litb qyqe wpji'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom('your@example.com', 'HomFin team');
            $mail->addAddress($ret['Email'], $ret['FullName']); // Add a recipient
            
            // Content
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Login Successful';
            $mail->Body    = 'Hello ' . $ret['FullName'] . ',<br><br>You have successfully logged in to your account, if not you please report.<br><br>Regards,<br>HomFin Team';

            $mail->send();
        } catch (Exception $e) {
            // Handle error
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    } else {
        $msg = "Invalid Details.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HomFin - User Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link rel="stylesheet" href="css/styler.css">
	<link href='https://fonts.googleapis.com/css?family=Allura' rel='stylesheet'>
	<style>
	body {background-image: url('includes/chess.jpg');
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-size: 100%;}
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
			<h1 align="center" style="font-family: 'Segoe Script'"; ><strong>HomFin</strong></h1>
			<h2 align="center" style="font-family: 'Segoe Print'"; >User Login</h2>
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
							<a href="forgot-password.php">Forgot Password?</a>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="" required="true">
							</div>
							<div class="checkbox">
								<button type="submit" value="login" name="login" class="btn btn-primary">Login</button><span style="padding-left:250px">
								<a href="register.php" class="btn btn-primary">Register</a></span>
							</div>
							</fieldset>
					</form>
					<a href="admin.php" class="btn btn-primary">Admin login</a></span>
				</div>
				
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

	
	
</footer>
	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script  src="js/index.js"></script>
	<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script src='https://cdn.jsdelivr.net/scrollreveal.js/3.3.1/scrollreveal.min.js'></script>
</body>
</html>
