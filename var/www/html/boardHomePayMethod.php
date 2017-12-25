<?php

  ini_set("session.save_path","/var/www/html/session/");

  session_start();

?>

<!DOCTYPE html>

<html>

  <head>
    
    <?php

      	if(@!$_SESSION['hoa_username'])
      		header("Location: https://hoaboardtime.com/logout.php");

      	$community_id = $_SESSION['hoa_community_id'];
      	$user_id=$_SESSION['hoa_user_id'];

        if($community_id == 1)
          pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");
        else if($community_id == 2)
          pg_connect("host=srsq-only.crsa3tdmtcll.ussrsq-only.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

      	$result = pg_query("SELECT * FROM board_committee_details WHERE user_id=$user_id AND community_id=$community_id");
    		$num_row = pg_num_rows($result);

    		if($num_row == 0)
    			header("Location: https://hoaboardtime.com/residentDashboard.php");

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
    <link rel="stylesheet" href="plugins/select2/select2.min.css">

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

                <li class='treeview'>
                  
                  <a href="https://hoaboardtime.com/boardPreviousMonthsPayments.php">

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

          $vendor_id = $_POST['select_vendor'];

          $row = pg_fetch_assoc(pg_query("SELECT * FROM vendor_master WHERE vendor_id=$vendor_id"));

        ?>
        
        <section class="content-header">

          <h1><strong>Home Payment Type</strong><small> - <?php echo $row['vendor_name']; ?></small></h1>

        </section>

        <section class="content">

          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-xs-12">

              <div class="box">

                <div class="box-header">

                  <center><h4><strong>ACH</strong></h4></center>

                </div>

                <div class="box-body table-responsive">
                  
                  <table id='example1' class="table table-bordered">

                    <thead>
                      
                      <th>Name</th>
                      <th>Living In</th>
                      <th>Recurring Pay</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Continous</th>
                      <th>Expires On</th>
                      <th>Next Schedule Date</th>
                      <th>Frequence</th>
                      <th>Balance</th>

                    </thead>

                    <tbody>

                      <?php

                        $res = pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=1");

                        if($res)
                        {

                          while($row = pg_fetch_assoc($res))
                          {
                            
                            $hoa_id = $row['hoa_id'];
                            $home_id = $row['home_id'];
                            $recurring_pay = $row['recurring_pay'];
                            $sch_start = $row['sch_start'];
                            $sch_end = $row['sch_end'];
                            $continous = $row['continous'];
                            $sch_expires = $row['sch_expires'];
                            $next_sch = $row['next_sch'];
                            $sch_frequency = $row['sch_frequency'];

                            if($recurring_pay == 't')
                              $recurring_pay = 'Enabled';
                            else
                              $recurring_pay = 'Not Set';

                            if($continous == 't')
                              $continous = 'TRUE';
                            else
                              $continous = 'FALSE';

                            if($sch_start != "")
                              $sch_start = date('m-d-Y', strtotime($sch_start));

                            if($sch_end != "")
                              $sch_end = date('m-d-Y', strtotime($sch_end));

                            if($sch_expires != "")
                              $sch_expires = date('m-d-Y', strtotime($sch_expires));

                            if($next_sch != "")
                              $next_sch = date('m-d-Y', strtotime($next_sch));

                            if($hoa_id == "")
                            {

                              $row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE home_id=$home_id"));

                              $hoa_id = $row1['hoa_id'];

                            }

                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));

                            $address = $row1['address1'];
                            $living_status = $row1['living_status'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));

                            $name = $row1['firstname'];
                            $name .= " ";
                            $name .= $row1['lastname'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE hoa_id=$hoa_id AND home_id=$home_id"));

                            $total_charges = $row1['sum'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE hoa_id=$hoa_id AND home_id=$home_id AND payment_status_id=1"));

                            $total_payments = $row1['sum'];

                            if($total_payments == '')
                              $total_payments = 0.0;

                            $balance = $total_charges - $total_payments;

                            echo "<tr";

                            if($living_status != 't')
                              echo " class='text-red' ";

                            echo "><td><a href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$hoa_id'>$name<br>($hoa_id)</a></td><td>$address<br>($home_id)</td><td>$recurring_pay</td><td>$sch_start</td><td>$sch_end</td><td>$continous</td><td>$sch_expires</td><td>$next_sch</td><td>$sch_frequency</td><td>$ $balance</td></tr>";

                          }

                        }

                      ?>
                      
                    </tbody>
                    
                  </table>

                </div>

              </div>

            </section>

          </div>

          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-xs-12">

              <div class="box">

                <div class="box-header">

                  <center><h4><strong>BillPay</strong></h4></center>

                </div>

                <div class="box-body table-responsive">
                  
                  <table id='example2' class="table table-bordered">

                    <thead>
                      
                      <th>Name</th>
                      <th>HOA ID</th>
                      <th>Living In</th>
                      <th>Home ID</th>
                      <th>Balance</th>

                    </thead>

                    <tbody>

                      <?php

                        $res = pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=2");

                        if($res)
                        {

                          while($row = pg_fetch_assoc($res))
                          {
                            
                            $hoa_id = $row['hoa_id'];
                            $home_id = $row['home_id'];

                            if($hoa_id == "")
                            {

                              $row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE home_id=$home_id"));

                              $hoa_id = $row1['hoa_id'];

                            }

                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));

                            $address = $row1['address1'];
                            $living_status = $row1['living_status'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));

                            $name = $row1['firstname'];
                            $name .= " ";
                            $name .= $row1['lastname'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE hoa_id=$hoa_id AND home_id=$home_id"));

                            $total_charges = $row1['sum'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE hoa_id=$hoa_id AND home_id=$home_id AND payment_status_id=1"));

                            $total_payments = $row1['sum'];

                            if($total_payments == '')
                              $total_payments = 0.0;

                            $balance = $total_charges - $total_payments;

                            echo "<tr";

                            if($living_status != 't')
                              echo " class='text-red' ";

                            echo "><td><a href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$hoa_id'>$name</a></td><td>$hoa_id</td><td>$address</td><td>$home_id</td><td>$ $balance</td></tr>";

                          }

                        }

                      ?>
                      
                    </tbody>
                    
                  </table>

                </div>

              </div>

            </section>

          </div>

          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-xs-12">

              <div class="box">

                <div class="box-header">

                  <center><h4><strong>Check</strong></h4></center>

                </div>

                <div class="box-body table-responsive">
                  
                  <table id='example3' class="table table-bordered">

                    <thead>
                      
                      <th>Name</th>
                      <th>HOA ID</th>
                      <th>Living In</th>
                      <th>Home ID</th>
                      <th>Balance</th>

                    </thead>

                    <tbody>

                      <?php

                        $res = pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=3");

                        if($res)
                        {

                          while($row = pg_fetch_assoc($res))
                          {
                            
                            $hoa_id = $row['hoa_id'];
                            $home_id = $row['home_id'];

                            if($hoa_id == "")
                            {

                              $row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE home_id=$home_id"));

                              $hoa_id = $row1['hoa_id'];

                            }

                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));

                            $address = $row1['address1'];
                            $living_status = $row1['living_status'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));

                            $name = $row1['firstname'];
                            $name .= " ";
                            $name .= $row1['lastname'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE hoa_id=$hoa_id AND home_id=$home_id"));

                            $total_charges = $row1['sum'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE hoa_id=$hoa_id AND home_id=$home_id AND payment_status_id=1"));

                            $total_payments = $row1['sum'];

                            if($total_payments == '')
                              $total_payments = 0.0;

                            $balance = $total_charges - $total_payments;

                            echo "<tr";

                            if($living_status != 't')
                              echo " class='text-red' ";

                            echo "><td><a href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$hoa_id'>$name</a></td><td>$hoa_id</td><td>$address</td><td>$home_id</td><td>$ $balance</td></tr>";

                          }

                        }

                      ?>
                      
                    </tbody>
                    
                  </table>

                </div>

              </div>

            </section>

          </div>

          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-xs-12">

              <div class="box">

                <div class="box-header">

                  <center><h4><strong>Others</strong></h4></center>

                </div>

                <div class="box-body table-responsive">
                  
                  <table id='example4' class="table table-bordered">

                    <thead>
                      
                      <th>Name</th>
                      <th>HOA ID</th>
                      <th>Living In</th>
                      <th>Home ID</th>
                      <th>Payment Method</th>
                      <th>Balance</th>

                    </thead>

                    <tbody>

                      <?php

                        $res = pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id>3");

                        if($res)
                        {

                          while($row = pg_fetch_assoc($res))
                          {
                            
                            $hoa_id = $row['hoa_id'];
                            $home_id = $row['home_id'];
                            $payment_type = $row['payment_type_id'];

                            if($hoa_id == "")
                            {

                              $row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE home_id=$home_id"));

                              $hoa_id = $row1['hoa_id'];

                            }

                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM payment_type WHERE payment_type_id=$payment_type"));

                            $payment_type = $row1['payment_type_name'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));

                            $address = $row1['address1'];
                            $living_status = $row1['living_status'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));

                            $name = $row1['firstname'];
                            $name .= " ";
                            $name .= $row1['lastname'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE hoa_id=$hoa_id AND home_id=$home_id"));

                            $total_charges = $row1['sum'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE hoa_id=$hoa_id AND home_id=$home_id AND payment_status_id=1"));

                            $total_payments = $row1['sum'];

                            if($total_payments == '')
                              $total_payments = 0.0;

                            $balance = $total_charges - $total_payments;

                            echo "<tr";

                            if($living_status != 't')
                              echo " class='text-red' ";

                            echo "><td><a href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$hoa_id'>$name</a></td><td>$hoa_id</td><td>$address</td><td>$home_id</td><td>$payment_type</td><td>$ $balance</td></tr>";

                          }

                        }

                      ?>
                      
                    </tbody>
                    
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
    <script src="plugins/select2/select2.full.min.js"></script>

    <script>
      $(function () {
        $("#example4").DataTable({ "pageLength": 25 });

        $("#example3").DataTable({ "pageLength": 25 });

        $("#example2").DataTable({ "pageLength": 25 });

        $("#example1").DataTable({ "pageLength": 25 });
      });
    </script>

  </body>

</html>