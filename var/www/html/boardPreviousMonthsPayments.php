<?php

  ini_set("session.save_path","/var/www/html/session/");

  session_start();

?>

<!DOCTYPE html>

<html>

  <head>
    
    <?php

      	if(@!$_SESSION['hoa_username'])
      		header("Location: logout.php");

      	$community_id = $_SESSION['hoa_community_id'];
      	$user_id=$_SESSION['hoa_user_id'];

        if($community_id == 1)
          pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");
        else if($community_id == 2)
          pg_connect("host=srsq-only.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

      	$result = pg_query("SELECT * FROM board_committee_details WHERE user_id=$user_id AND community_id=$community_id");
    		$num_row = pg_num_rows($result);

    		if($num_row == 0)
    			header("Location: residentDashboard.php");

    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <title><?php echo $_SESSION['hoa_community_name']; ?></title>
    
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    
    <div class="wrapper">

      	<header class="main-header">
        
        	<a class="logo">
          
          		<span class="logo-mini"><?php echo $_SESSION['hoa_community_code']; ?></span>
          
          		<span class="logo-lg"><?php echo $_SESSION['hoa_community_name']; ?></span>

        	</a>
        
        	<nav class="navbar navbar-static-top">
          
          		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            		
            		<span class="sr-only">Toggle navigation</span>

          		</a>

	          	<div class="navbar-custom-menu">
	            
	            	<ul class="nav navbar-nav">

		          		<li class="dropdown user user-menu">
	              
		            		<a href="https://hoaboardtime.com/residentDashboard.php">Resident Dashboard</a>

		          		</li>

		          		<li class="dropdown user user-menu">

		            		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		              
		              			<i class="fa fa-user"></i> <span class="hidden-xs"><?php echo $_SESSION['hoa_username']; ?></span>

		            		</a>

			            	<ul class="dropdown-menu">
			              
			              		<li class="user-header">
			                
			                		<i class="fa fa-user fa-5x"></i>

			                		<p>
			                  
					                  	<?php echo $_SESSION['hoa_username']; ?>

					                  	<br>

					                  	<small><?php echo $_SESSION['hoa_address']; ?></small>

					                  	<a href="https://hoaboardtime.com/logout.php" class="btn btn-warning">Log Out</a>

					                	<br>

					                </p>

			              		</li>

			            	</ul>

		          		</li>

	            	</ul>

	          	</div>

        	</nav>

      	</header>
      
      	<aside class="main-sidebar">
        
          <section class="sidebar">
          
              <ul class="sidebar-menu">
            
                <?php if($community_id == 2)
                echo "<li class='header text-center'>

                  <img src='srsq_logo.JPG'>

                </li>"; ?>
            
                <li class="header text-center"> Quick Links </li>

                <li class="treeview">
              
                  <a href='https://hoaboardtime.com/boardDashboard.php'>
                
                    <i class="fa fa-dashboard"></i> <span>Board Dashboard</span>

                  </a>

                </li>
            
                <li class="treeview">
              
                  <a href="#">

                    <i class="glyphicon glyphicon-hdd"></i> <span>Document Management</span>

                    <span class="pull-right-container">
                        
                      <i class="fa fa-angle-left pull-right"></i>

                    </span>

                  </a>

                  <ul class="treeview-menu">
                
                    <li><a><i class="fa fa-male text-green"></i> Member Documents</a></li>
                    <li><a><i class="fa fa-wrench text-red"></i> Vendor Documents</a></li>

                  </ul>

                </li>
             
                <li class="treeview">

                  <a href='https://hoaboardtime.com/boardProcessPayment.php'>

                    <i class='fa fa-dollar'></i> <span>Process Payments</span>
              
                  </a>

                </li>
            
                <li class="treeview">
              
                  <a href='https://hoaboardtime.com/boardSetReminder.php'>

                    <i class='fa fa-bell'></i> <span>Create Reminder</span>

                  </a>

                </li>

                <li class="header text-center"> Other Links </li>

                <!-- Board -->
                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardCharges.php">

                    <i class="fa fa-users text-blue"></i> <span>Late Fee / Write Off </span>

                  </a>

                </li>

                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardCommunityDisclosures.php">

                    <i class="fa fa-users text-blue"></i> <span>Community Disclosures</span>

                  </a>

                </li>

                <li class='treeview'>

                  <a>

                    <i class="fa fa-users text-blue"></i> <span>Digital Board Room</span>

                  </a>

                </li>

                <li class='active treeview'>
                  
                  <a>

                    <i class="fa fa-users text-blue"></i> <span>Previous Months Payments</span>

                  </a>

                </li>

                <li class="treeview">
                  
                  <a href="https://hoaboardtime.com/boardSurveyDetails.php">

                    <i class="fa fa-users text-blue"></i> <span>Survey Details</span>

                  </a>

                </li>

                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardCommunityExpenditureSummary.php">

                    <i class="fa fa-users text-blue"></i> <span>YTD Expenses</span>

                  </a>

                </li>

                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardCommunityDeposits.php">

                    <i class="fa fa-users text-blue"></i> <span>YTD Income</span>

                  </a>

                </li>

                <!-- Member -->
                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardMailingList.php">

                    <i class="fa fa-street-view text-green"></i> <span>Community Mailing List</span>

                  </a>

                </li>
                      
                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardCustomerBalance.php">

                    <i class="fa fa-street-view text-green"></i> <span>Customer Balance</span>

                  </a>

                </li>
                
                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardHOAHomeInfo.php">

                    <i class="fa fa-street-view text-green"></i> <span>HOA &amp; Home Info</span>

                  </a>

                </li>

                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardUserDashboard.php">

                    <i class="fa fa-street-view text-green"></i> <span>User Dashbord</span>

                  </a>

                </li>
                
                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardViewReminders.php">

                    <i class="fa fa-street-view text-green"></i> <span>View Reminders</span>

                  </a>

                </li>

                <!-- Vendor -->
                <li class='treeview'>

                  <a href="https://hoaboardtime.com/boardVendorDashboard.php">

                    <i class="fa fa-wrench text-red"></i> <span>Vendor Dashboard</span>

                  </a>

                </li>

              </ul>

          </section>

        </aside>

      <div class="content-wrapper">

        <?php

        	$year = date("Y");
        	$month = date("m");
        	$end_date = date("t");

        ?>
        
        <section class="content-header">

          <h1><strong>Previous Month Payments</strong></h1>

        </section>

        <section class="content">

          <div class="row">

            <center>
              
              <form method='POST' action='https://hoaboardtime.com/boardPreviousMonthsPayments.php'>
                  
                <?php

                  if(isset($_POST['submit']))
                  {    
                                    
                    echo "Showing payments of <select id='month' name='month' required><option "; if($_POST['month'] == 1) echo "selected"; echo " value='1'>January</option><option "; if($_POST['month'] == 2) echo "selected"; echo " value='2'>February</option><option "; if($_POST['month'] == 3) echo "selected"; echo " value='3'>March</option><option "; if($_POST['month'] == 4) echo "selected"; echo " value='4'>April</option><option "; if($_POST['month'] == 5) echo "selected"; echo " value='5'>May</option><option "; if($_POST['month'] == 6) echo "selected"; echo " value='6'>June</option><option "; if($_POST['month'] == 7) echo "selected"; echo " value='7'>July</option><option "; if($_POST['month'] == 8) echo "selected"; echo " value='8'>August</option><option "; if($_POST['month'] == 9) echo "selected"; echo " value='9'>September</option><option "; if($_POST['month'] == 10) echo "selected"; echo " value='10'>October</option><option "; if($_POST['month'] == 11) echo "selected"; echo " value='11'>November</option><option "; if($_POST['month'] == 12) echo "selected"; echo " value='12'>December</option></select><br><br><input type='submit' class='btn btn-warning btn-xs' name='submit' id='submit' value='Show Payments'>";

                  }
                  else
                  {
                    $m = (date("m") - 1); 

                    echo "Show payments of <select id='month' name='month' required><option ";

                    if($m == 1)
                      echo "selected ";

                    echo "value='1'>January</option><option ";

                    if($m == 2)
                      echo "selected ";

                    echo "value='2'>February</option><option ";

                    if($m == 3)
                      echo " selected ";

                    echo "value='3'>March</option><option ";

                    if($m == 4)
                      echo " selected ";

                    echo "value='4'>April</option><option ";

                    if($m == 5)
                      echo " selected ";

                    echo "value='5'>May</option><option ";

                    if($m == 6)
                      echo " selected ";

                    echo "value='6'>June</option><option ";

                    if($m == 7)
                      echo " selected ";

                    echo "value='7'>July</option><option ";

                    if($m == 8)
                      echo " selected ";

                    echo "value='8'>August</option><option ";

                    if($m == 9)
                      echo " selected ";

                    echo "value='9'>September</option><option ";

                    if($m == 10)
                      echo " selected ";

                    echo "value='10'>October</option><option ";

                    if($m == 11)
                      echo " selected ";

                    echo "value='11'>November</option><option ";

                    if($m == 12)
                      echo " selected ";

                    echo "value='12'>December</option></select><br><br><input type='submit' class='btn btn-warning btn-xs' name='submit' id='submit' value='Show Payments'>";

                  }

                ?>

              </form>

            </center>

          </div>

          <br><br>
          
          <div class="row">

          	<section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-sm-12">

              <div class="box">
                
                <div class="box-body table-responsive">
                  
                  <table id='example1' class="table table-striped table-bordered">

                    <thead>
                      
                      <th>Payment Date</th>
                      <th>Name</th>
                      <th>Living In</th>
                      <th>Confirmation Number</th>
                      <th>Pay Method</th>
                      <th>Amount</th>
                      <th>Current Balance</th>

                    </thead>

                    <tbody>

                      <?php
                        
                        if(isset($_POST['submit']))
                        {
                                    
                          $month = $_POST['month'];
                          $start_date = $year."-".$month."-1";
                          $end_date = $year."-".$month."-".date('t', strtotime($start_date));

                          $result = pg_query("SELECT * FROM hoaid WHERE community_id=$community_id");

                          while($row = pg_fetch_assoc($result))
                          {

                            $home_id = $row['home_id'];
                            $hoa_id = $row['hoa_id'];
                            $name = $row['firstname'];
                            $name .= " ";
                            $name .= $row['lastname'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));

                            $living_in = $row1['address1'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE hoa_id=$hoa_id AND home_id=$home_id"));
                            $payments = $row1['sum'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE hoa_id=$hoa_id AND home_id=$home_id"));
                            $charges = $row1['sum'];

                            $balance = $charges - $payments;

                            $result1 = pg_query("SELECT * FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$start_date' AND process_date<='$end_date' AND hoa_id=$hoa_id AND home_id=$home_id");

                            if(pg_num_rows($result1))
                            {

                              while($row1 = pg_fetch_assoc($result1))
                              {
                              
                                $process_date = $row1['process_date'];
                                $confirmation = $row1['document_num'];
                                $pay_method = $row1['payment_type_id'];
                                $amount = $row1['amount'];

                                $row2 = pg_fetch_assoc(pg_query("SELECT * FROM payment_type WHERE payment_type_id=$pay_method"));
                                $pay_method = $row2['payment_type_name'];

                                echo "<tr><td>".date('m-d-Y', strtotime($process_date))."</td><td>$name<br>($hoa_id)</td><td>$living_in<br>($home_id)</td><td>$confirmation</td><td>$pay_method</td><td>$amount</td><td>$ $balance</td></tr>";

                              }

                            }
                            else
                            {
                              
                              echo "<tr class='text-danger'><td></td><td>$name<br>($hoa_id)</td><td>$living_in<br>($home_id)</td><td></td><td></td><td></td><td>$ $balance</td></tr>";

                            }

                          }

                        }
                        else
                        {
                                    
                          $month = date('m') - 1;
                          $start_date = $year."-".$month."-1";
                          $end_date = $year."-".$month."-".date('t', strtotime($start_date));

                          $result = pg_query("SELECT * FROM hoaid WHERE community_id=$community_id");

                          while($row = pg_fetch_assoc($result))
                          {

                            $home_id = $row['home_id'];
                            $hoa_id = $row['hoa_id'];
                            $name = $row['firstname'];
                            $name .= " ";
                            $name .= $row['lastname'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));

                            $living_in = $row1['address1'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE hoa_id=$hoa_id AND home_id=$home_id"));
                            $payments = $row1['sum'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE hoa_id=$hoa_id AND home_id=$home_id"));
                            $charges = $row1['sum'];

                            $balance = $charges - $payments;

                            $result1 = pg_query("SELECT * FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$start_date' AND process_date<='$end_date' AND hoa_id=$hoa_id AND home_id=$home_id");

                            if(pg_num_rows($result1))
                            {

                              while($row1 = pg_fetch_assoc($result1))
                              {
                              
                                $process_date = $row1['process_date'];
                                $confirmation = $row1['document_num'];
                                $pay_method = $row1['payment_type_id'];
                                $amount = $row1['amount'];

                                $row2 = pg_fetch_assoc(pg_query("SELECT * FROM payment_type WHERE payment_type_id=$pay_method"));
                                $pay_method = $row2['payment_type_name'];

                                echo "<tr><td>".date('m-d-Y', strtotime($process_date))."</td><td><a title='User Dashboard' href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$hoa_id'>$name<br>($hoa_id)</a></td><td>$living_in<br>($home_id)</td><td>$confirmation</td><td>$pay_method</td><td>$amount</td><td>$ $balance</td></tr>";

                              }

                            }
                            else
                            {
                              
                              echo "<tr class='text-danger'><td></td><td><a title='User Dashboard' href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$hoa_id'>$name<br>($hoa_id)</a></td><td>$living_in<br>($home_id)</td><td></td><td></td><td></td><td>$ $balance</td></tr>";

                            }

                          }

                        } 
                      
                      ?>

                    </tbody>

                    <tfoot>
                      
                      <th>Payment Date</th>
                      <th>Name</th>
                      <th>Living In</th>
                      <th>Confirmation Number</th>
                      <th>Pay Method</th>
                      <th>Amount</th>
                      <th>Current Balance</th>

                    </tfoot>

                  </table>

                </div>

              </div>

            </section>

          </div>

        </section>

      </div>

      <footer class="main-footer">

        <div class="pull-right hidden-xs"></div>
        
        <strong>Copyright &copy; <?php echo date('Y'); ?> <a target='_blank' href="<?php echo $_SESSION['hoa_community_website_url']; ?>"><?php echo $_SESSION['hoa_community_name']; ?></a>.</strong> All rights reserved.

      </footer>

      <div class="control-sidebar-bg"></div>

    </div>

    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/fastclick/fastclick.js"></script>
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/demo.js"></script>

    <script>
      $(function () {
        $("#example1").DataTable({ "pageLength": 50 });
      });
    </script>

  </body>

</html>