<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HomFin - Monthly Savings</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <style>
        body {
            background-image: url('includes/dash2.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        .panel-body table {
            width: 100%;
            border-collapse: collapse;
        }
        .panel-body th, .panel-body td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    
    <?php include_once('includes/header.php');?>
    <?php include_once('includes/sidebar.php');?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><em class="fa fa-home"></em></a></li>
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
                <p><b>EXPENDITURES TO INCLUDE</b></p>
                
                <!-- Add link for monthly statements -->
                <button onclick="window.location.href = 'statement.php';">Account Statement</button>
            </div>
        </div>

        <?php
        session_start();
        error_reporting(0);
        include('includes/dbconnection.php');

        if (strlen($_SESSION['detsuid']) == 0) {
            header('location:logout.php');
        } else {
            // Fetch user ID
            $userid = $_SESSION['detsuid'];

            // Fetch data from log table
            $queryLog = mysqli_query($con, "SELECT * FROM log WHERE UserId='$userid' ORDER BY time ASC");

            // Initialize arrays to store data
            $monthlyData = [];

            // Process log data
            while ($row = mysqli_fetch_assoc($queryLog)) {
                $monthYear = date('F Y', strtotime($row['time']));
                $monthlyData[$monthYear][] = $row;
            }

            // Sort the months in descending order
            krsort($monthlyData);

            // Output monthly statements
            foreach ($monthlyData as $monthYear => $data) {
                // Initialize arrays to store data for each month
                $addedItems = [];
                $deletedItems = [];
                $totalIncome = 0;
                $totalExpense = 0;
                $totalBudget = 0;
                $totalLoan = 0;

                echo '<div class="row">';
                echo '<div class="col-xs-12 col-md-6">';
                echo '<div class="panel panel-default">';
                echo '<div class="panel-heading">Statement for ' . $monthYear . '</div>';
                echo '<div class="panel-body">';
                echo '<table>';
                
                foreach ($data as $item) {
                    if ($item['action'] == 'inserted') {
                        $addedItems[] = $item;
                        if ($item['type'] == 'income') {
                            $totalIncome += $item['cost'];
                        } elseif ($item['type'] == 'expense') {
                            $totalExpense += $item['cost'];
                        } elseif ($item['type'] == 'budget') {
                            $totalBudget += $item['cost'];
                        } elseif ($item['type'] == 'loan') {
                            $totalLoan += $item['cost'];
                        }
                    } elseif ($item['action'] == 'deleted') {
                        $deletedItems[] = $item;
                        if ($item['type'] == 'expense') {
                            $totalExpense -= $item['cost']; // Subtract the cost from total expense
                        }elseif ($item['type'] == 'income') {
                            $totalLoan += $item['cost'];
                        } elseif ($item['type'] == 'budget') {
                            $totalBudget -= $item['cost']; // Subtract the cost from total budget
                        } elseif ($item['type'] == 'loan') {
                            $totalLoan -= $item['cost']; // Subtract the cost from total loan
                        }
                    }
                }

                // Calculate total remaining amount
                $totalSavings = $totalIncome - $totalExpense - $totalLoan - $totalBudget;

                // Output added items
                echo "<h3>Items Added:</h3>";
                echo "<table>";
                echo "<tr><th>Type</th><th>Name</th><th>Cost (Rs.)</th><th>Date</th></tr>";
                foreach ($addedItems as $item) {
                    echo "<tr>";
                    echo "<td>" . $item['type'] . "</td>";
                    echo "<td>" . $item['name'] . "</td>";
                    echo "<td>" . $item['cost'] . "</td>";
                    echo "<td>" . $item['time'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";

                // Output deleted items
                echo "<h3>Items Deleted:</h3>";
                echo "<table>";
                echo "<tr><th>Type</th><th>Name</th><th>Cost (Rs.)</th><th>Date</th></tr>";
                foreach ($deletedItems as $item) {
                    echo "<tr>";
                    echo "<td>" . ($item['type'] == 'budget' ? 'Investment' : $item['type']) . "</td>"; // Displaying budget as investment
                    echo "<td>" . $item['name'] . "</td>";
                    echo "<td>" . $item['cost'] . "</td>";
                    echo "<td>" . $item['time'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";

                // Output total amounts
                echo "<h5>Total Income: Rs. " . $totalIncome . "</h5>";
                echo "<h5>Total Expense: Rs. " . $totalExpense . "</h5>";
                echo "<h5>Total Investment: Rs. " . $totalBudget . "</h5>"; // Displaying budget as investment
                echo "<h5>Total Loan: Rs. " . $totalLoan . "</h5>";
                echo "<h5>Total Remaining: Rs. " . $totalSavings . "</h5>";

                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>

    </div><!--/.main-->
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
