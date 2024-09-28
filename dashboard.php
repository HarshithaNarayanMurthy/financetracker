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
	<title>HomFin - Dashboard</title>
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
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		
		
		
		<div class="row">
			<div class="col-xs-6 col-md-3">
				
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
<?php
//Today Expense
$userid=$_SESSION['detsuid'];
$tdate=date('Y-m-d');
$query=mysqli_query($con,"select sum(ExpenseCost)  as todaysexpense from tblexpense where (ExpenseDate)='$tdate' && (UserId='$userid');");
$result=mysqli_fetch_array($query);
$sum_today_expense=$result['todaysexpense'];
 ?> 

						<h4>Today's Expense</h4>
						<div class="easypiechart" id="easypiechart" data-percent="<?php echo $sum_today_expense;?>" ><span class="percent"><?php if($sum_today_expense==""){
echo "0";
} else {
echo $sum_today_expense;
}

	?></span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<?php
//Monthly Expense
$userid=$_SESSION['detsuid'];
 $monthdate=  date("Y-m-d", strtotime("-1 month")); 
$crrntdte=date("Y-m-d");
$query3=mysqli_query($con,"select sum(ExpenseCost)  as monthlyexpense from tblexpense where ((ExpenseDate) between '$monthdate' and '$crrntdte') && (UserId='$userid');");
$result3=mysqli_fetch_array($query3);
$sum_monthly_expense=$result3['monthlyexpense'];
 ?>
					
						<h4>Last 30day's Expenses</h4>
						<div class="easypiechart" id="easypiechart" data-percent="<?php echo $sum_monthly_expense;?>" ><span class="percent"><?php if($sum_monthly_expense==""){
echo "0";
} else {
echo $sum_monthly_expense;
}

	?></span></div>
				
				</div>
			</div>
			
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<?php
//Yearly Expense
$userid=$_SESSION['detsuid'];
 $cyear= date("Y");
$query4=mysqli_query($con,"select sum(ExpenseCost)  as yearlyexpense from tblexpense where (year(ExpenseDate)='$cyear') && (UserId='$userid');");
$result4=mysqli_fetch_array($query4);
$sum_yearly_expense=$result4['yearlyexpense'];
 ?>
					
						<h4>Current Year Expenses</h4>
						<div class="easypiechart" id="easypiechart" data-percent="<?php echo $sum_yearly_expense;?>" ><span class="percent"><?php if($sum_yearly_expense==""){
echo "0";
} else {
echo $sum_yearly_expense;
}

	?></span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Yearly Expense
$userid=$_SESSION['detsuid'];
$query5=mysqli_query($con,"select sum(ExpenseCost)  as totalexpense from tblexpense where UserId='$userid';");
$result5=mysqli_fetch_array($query5);
$sum_total_expense=$result5['totalexpense'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Total Expenses</h4>
						<div class="easypiechart" id="easypiechart" data-percent="<?php echo $sum_total_expense;?>" ><span class="percent"><?php if($sum_total_expense==""){
echo "0";
} else {
echo $sum_total_expense;
}

	?></span></div>
					</div>
				</div>
			</div>
		
		</div>
		
		
		
		<div class="row">
			<div class="col-xs-6 col-md-3">
				
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel"
		
		<?php
//Today Income
$userid=$_SESSION['detsuid'];
$tdate=date('Y-m-d');
$query=mysqli_query($con,"select sum(IncomeCost)  as todaysincome from tblincome where (IncomeDate)='$t1date' && (UserId='$userid');");
$result=mysqli_fetch_array($query);
$sum_today_expense=$result['todaysincome'];
 ?> 
         <div class="panel-body easypiechart-panel">
						<h4>Today's Income</h4>
						<div class="easypiechart" id="easypiechart" data-percent="<?php echo $sum_today_expense;?>" ><span class="percent"><?php if($sum_today_income==""){
echo "0";
} else {
echo $sum_today_income;
}

	?></span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Monthly Income
$userid=$_SESSION['detsuid'];
 $monthdate=  date("Y-m-d", strtotime("-1 month")); 
$crrntdte=date("Y-m-d");
$query3=mysqli_query($con,"select sum(IncomeCost)  as monthlyincome from tblincome where ((IncomeDate) between '$monthdate' and '$crrntdte') && (UserId='$userid');");
$result3=mysqli_fetch_array($query3);
$sum_monthly_income=$result3['monthlyincome'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Last 30day's Income</h4>
						<div class="easypiechart" id="easypiechart" data-percent="<?php echo $sum_monthly_income;?>" ><span class="percent"><?php if($sum_monthly_income==""){
echo "0";
} else {
echo $sum_monthly_income;
}

	?></span></div>
					</div>
				</div>
			</div>
		
		
			<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Yearly Income
$userid=$_SESSION['detsuid'];
 $cyear= date("Y");
$query4=mysqli_query($con,"select sum(IncomeCost)  as yearlyincome from tblincome where (year(IncomeDate)='$cyear') && (UserId='$userid');");
$result4=mysqli_fetch_array($query4);
$sum_yearly_income=$result4['yearlyincome'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Current Year Income</h4>
						<div class="easypiechart" id="easypiechart" data-percent="<?php echo $sum_yearly_income;?>" ><span class="percent"><?php if($sum_yearly_income==""){
echo "0";
} else {
echo $sum_yearly_income;
}

	?></span></div>



					</div>
				
				</div>

			</div>
			

		<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
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


		</div>
			
		
		
			<div class="col-xs-6 col-md-3">
				
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
<?php
//Today Budget
$userid=$_SESSION['detsuid'];
$tdate=date('Y-m-d');
$query=mysqli_query($con,"select sum(BudgetCost)  as todaysbudget from tblbudget where (BudgetDate)='$tdate' && (UserId='$userid');");
$result=mysqli_fetch_array($query);
$sum_today_budget=$result['todaysbudget'];
 ?> 

						<h4>Today's Budget</h4>
						<div class="easypiechart" id="easypiechart" data-percent="<?php echo $sum_today_budget;?>" ><span class="percent"><?php if($sum_today_budget==""){
echo "0";
} else {
echo $sum_today_budget;
}

	?></span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Monthly Budget
$userid=$_SESSION['detsuid'];
 $monthdate=  date("Y-m-d", strtotime("-1 month")); 
$crrntdte=date("Y-m-d");
$query3=mysqli_query($con,"select sum(BudgetCost)  as monthlybudget from tblbudget where ((BudgetDate) between '$monthdate' and '$crrntdte') && (UserId='$userid');");
$result3=mysqli_fetch_array($query3);
$sum_monthly_budget=$result3['monthlybudget'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Last 30day's Budgets</h4>
						<div class="easypiechart" id="easypiechart" data-percent="<?php echo $sum_monthly_budget;?>" ><span class="percent"><?php if($sum_monthly_budget==""){
echo "0";
} else {
echo $sum_monthly_budget;
}

	?></span></div>
					</div>
				</div>
			</div>
		
		
			<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Yearly Budget
$userid=$_SESSION['detsuid'];
 $cyear= date("Y");
$query4=mysqli_query($con,"select sum(BudgetCost)  as yearlybudget from tblbudget where (year(BudgetDate)='$cyear') && (UserId='$userid');");
$result4=mysqli_fetch_array($query4);
$sum_yearly_budget=$result4['yearlybudget'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Current Year Budgets</h4>
						<div class="easypiechart" id="easypiechart" data-percent="<?php echo $sum_yearly_budget;?>" ><span class="percent"><?php if($sum_yearly_budget==""){
echo "0";
} else {
echo $sum_yearly_budget;
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
$query5=mysqli_query($con,"select sum(BudgetCost)  as totalbudget from tblbudget where UserId='$userid';");
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


		</div>
			
		
		
		
	
			<div class="col-xs-6 col-md-3">
				
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
<?php
//Today Loan
$userid=$_SESSION['detsuid'];
$tdate=date('Y-m-d');
$query=mysqli_query($con,"select sum(LoanCost)  as todaysloan from tblloan where (LoanDate)='$tdate' && (UserId='$userid');");
$result=mysqli_fetch_array($query);
$sum_today_loan=$result['todaysloan'];
 ?> 

						<h4>Today's Loan</h4>
						<div class="easypiechart" id="easypiechart" data-percent="<?php echo $sum_today_loan;?>" ><span class="percent"><?php if($sum_today_loan==""){
echo "0";
} else {
echo $sum_today_loan;
}

	?></span></div>
					</div>
				</div>
			</div>
			
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Monthly Loan
$userid=$_SESSION['detsuid'];
 $monthdate=  date("Y-m-d", strtotime("-1 month")); 
$crrntdte=date("Y-m-d");
$query3=mysqli_query($con,"select sum(LoanCost)  as monthlyloan from tblloan where ((LoanDate) between '$monthdate' and '$crrntdte') && (UserId='$userid');");
$result3=mysqli_fetch_array($query3);
$sum_monthly_loan=$result3['monthlyloan'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Last 30day's Loans</h4>
						<div class="easypiechart" id="easypiechart" data-percent="<?php echo $sum_monthly_loan;?>" ><span class="percent"><?php if($sum_monthly_loan==""){
echo "0";
} else {
echo $sum_monthly_loan;
}

	?></span></div>
					</div>
				</div>
			</div>
		
		
			<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Yearly Loan
$userid=$_SESSION['detsuid'];
 $cyear= date("Y");
$query4=mysqli_query($con,"select sum(LoanCost)  as yearlyloan from tblloan where (year(LoanDate)='$cyear') && (UserId='$userid');");
$result4=mysqli_fetch_array($query4);
$sum_yearly_loan=$result4['yearlyloan'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Current Year Loans</h4>
						<div class="easypiechart" id="easypiechart" data-percent="<?php echo $sum_yearly_loan;?>" ><span class="percent"><?php if($sum_yearly_loan==""){
echo "0";
} else {
echo $sum_yearly_loan;
}

	?></span></div>


					</div>
				
				</div>

			</div>

		<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Yearly Loan
$userid=$_SESSION['detsuid'];
$query5=mysqli_query($con,"select sum(LoanCost)  as totalloan from tblloan where UserId='$userid';");
$result5=mysqli_fetch_array($query5);
$sum_total_loan=$result5['totalloan'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Total Loans</h4>
						<div class="easypiechart" id="easypiechart" data-percent="<?php echo $sum_total_loan;?>" ><span class="percent"><?php if($sum_total_loan==""){
echo "0";
} else {
echo $sum_total_loan;
}

	?></span></div>


					</div>
				
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