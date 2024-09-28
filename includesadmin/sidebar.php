<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>


<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            
            <div class="profile-usertitle">
                <?php
$aid=$_SESSION['detsaid'];
$ret=mysqli_query($con,"select FullName from tbladmin where ID='$aid'");
$row=mysqli_fetch_array($ret);
$name=$row['FullName'];

?>
                <div class="profile-usertitle-name"><?php echo $name; ?></div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>
        
        <ul class="nav menu">
            <li class="active"><a href="adminmanager.php"><em class="fa fa-user">&nbsp;</em>Users</a></li>
            
            
           
			
			<li class="parent "><a data-toggle="collapse" href="#sub-item-5">
                <em class="fa fa-navicon">&nbsp;</em>Logs <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-5">
                    <li><a class="" href="insertedlog.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Inserted
                    </a></li>
                    <li><a class="" href="deletedlog.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Deleted
                    </a></li>
                    
                </ul>

            </li>
           
  <li class="parent "><a data-toggle="collapse" href="#sub-item-6">
                <em class="fa fa-navicon">&nbsp;</em>Type Wise Log <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-6">
                    <li><a class="" href="incomelog.php">
                        <span class="fa fa-arrow-right">&nbsp;</span>Income Wise
                    </a></li>
                    <li><a class="" href="expenselog.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Expense Wise
                    </a></li>
                    <li><a class="" href="loanlog.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Loan Wise
                    </a></li>
                     <li><a class="" href="budgetlog.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Budget Wise
                    </a></li>
					
                </ul>
            </li>
			
			
			
	 
			

            <li><a href="admin-profile.php"><em class="fa fa-user">&nbsp;</em> Profile</a></li>
             <li><a href="admin-password.php"><em class="fa fa-clone">&nbsp;</em> Change Password</a></li>
<li><a href="adminlogout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>

        </ul>
    </div>