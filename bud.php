<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{

  

  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AINsoft - Savings</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<style>
	body {background-image: url('includes/dash2.jpg');
background-repeat: no-repeat;
background-attachment: fixed;
background-size: cover;}</style>
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Savings</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Savings</h1>
			</div>
		</div><!--/.row-->
		<div class="row">
	
		<div class="panel panel-default" align="center">
		<p><B>EXPENDITURES TO INCLUDE</B></p>
		<button onclick="window.location.href = 'exp.php';">Expense only</button>
		<button onclick="window.location.href = 'lon.php';">Loan only</button>
		<button onclick="window.location.href = 'bud.php';">Investment only</button>
		<button onclick="window.location.href = 'expnlon.php';">Expense and Loan</button>
		<button onclick="window.location.href = 'expnbud.php';">Expense and Investment</button>
		<button onclick="window.location.href = 'lonnbud.php';">Loan and Investment</button>
		<button onclick="window.location.href = 'explonnbud.php';">Expense, Loan and Investment</button>
		<button onclick="window.location.href = 'statement.php';">Account Statement</button>
		</div>
		</div>
	<div class="row">
		
		<div class="col-xs-6 col-md-3" >
				<div class="panel panel-default" ">
					<?php
//Yearly Income
$userid=$_SESSION['detsuid'];
$query5=mysqli_query($con,"select sum(IncomeCost)  as totalincome from tblincome where UserId='$userid';");
$result5=mysqli_fetch_array($query5);
$sum_total_income=$result5['totalincome'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Total Income</h4>
						<div class="easypiechart" id="easypiechart" data-percent="<?php echo $sum_total_income;?>" ><span class="percent"><?php if($sum_total_income==""){
echo "0";
} else {
echo $sum_total_income;
}

	?></span></div>


					</div>
				
				</div>

			</div>
			
			
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Yearly Budget
$userid=$_SESSION['detsuid'];
$query5=mysqli_query($con,"CALL `tbud`($userid);");
$result5=mysqli_fetch_array($query5);
$sum_total_budget=$result5['totalbudget'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Total Budgets</h4>
						<div class="easypiechart" id="easypiechart" data-percent="<?php echo $sum_total_budget;?>" ><span class="percent"><?php if($sum_total_budget==""){
echo "0";
} else {
echo $sum_total_budget;
}

	?></span></div>


					</div>
				
				</div>

			</div>
			
			
			
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Yearly savings

$sum_total_savings=$sum_total_income-$sum_total_budget
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Total Savings</h4>
						<div class="easypiechart" id="easypiechart" data-percent="<?php echo $sum_total_savings;?>" ><span class="percent"><?php if($sum_total_savings==""){
echo "0";
} else {
echo $sum_total_savings;
}

	?></span></div>


					</div>
				
				</div>

			</div>
		
		
		
		
		
		
		
		
		<!--/.row-->
	</div>	<!--/.main-->
	<?php include_once('includes/footer.php');?>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
		
</body>
</html>
<?php } ?>