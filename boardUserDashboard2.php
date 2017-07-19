<!DOCTYPE html>
<html>
  <head>
    
    <?php

      	session_start();

      	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

      	if(@!$_SESSION['hoa_username'])
      		header("Location: logout.php");

      	$community_id = $_SESSION['hoa_community_id'];
      	$user_id=$_SESSION['hoa_user_id'];

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

                <li class='active treeview'>

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

          $hoa_id = $_POST['hoa_id'];

          if(!$hoa_id)
            header("Location: https://hoaboardtime.com/boardUserDashboard.php");

          $row = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));

        ?>
        
        <section class="content-header">

          <h1><strong>User Dashboard</strong><small> - <?php echo $row['firstname']." ".$row['lastname']; ?></small></h1>

        </section>

        <section class="content">
          
          <div class="row">

          	<section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-xs-12">

              <div class="box box-success">

                <div class="box-header">

                  <center><h4><strong>User Details</strong></h4></center>

                </div>

                <div class="box-body table-responsive">
                  
                  <table class="table table-bordered">

                    <thead>
                      
                      <th>Name (HOA ID)</th>
                      <th>Resident Since</th>
                      <th>Role</th>
                      <th>Email</th>
                      <th>Phone</th>

                    </thead>

                    <tbody>

                      <?php

                        $firstname = $row['firstname'];
                        $lastname = $row['lastname'];
                        $valid_from = $row['valid_from'];
                        $email = $row['email'];
                        $cell_no = $row['cell_no'];
                        $role = $row['role_type_id'];
                        $home_id = $row['home_id'];

                        if($valid_from != "")
                          $valid_from = date('m-d-Y',strtotime($valid_from));

                        if($role != "")
                        {
                          $row = pg_fetch_assoc(pg_query("SELECT * FROM role_type WHERE role_type_id=$role"));

                          $role = $row['name'];
                        }

                        echo "<tr><td>$firstname $lastname ($hoa_id)</td><td>$valid_from</td><td>$role</td><td>$email</td><td>$cell_no</td></tr>";

                      ?>
                      
                    </tbody>
                    
                  </table>

                </div>

              </div>

            </section>

          </div>

          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-xs-12">

              <div class="box box-success">

                <div class="box-header">

                  <center><h4><strong>Home Details</strong></h4></center>

                </div>

                <div class="box-body table-responsive">
                  
                  <table class="table table-bordered">

                    <thead>
                      <?php

                        $row = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));


                        $living_status = $row['living_status'];

                      ?>
                      
                      <th>Home Address (Home ID)</th>
                      <th>Living Status</th>
                      <th>Lot</th>
                      <th>Pay Method</th>
                      <?php if($living_status == 'f') echo "<th>Mailing Address</th>"; ?>

                    </thead>

                    <tbody>

                      <?php

                        $address1 = $row['address1'];
                        $address2 = $row['address2'];
                        $home_id = $row['home_id'];
                        $lot = $row['lot'];

                        if($living_status == "t")
                          $living_status = "TRUE";
                        else
                          $living_status = "FALSE";

                        if($living_status)
                        {

                          $address = $row['address1'];
                          $address .= " ";
                          $address .= $row['address2'];
                          $city = $row['city_id'];
                          $state = $row['state_id'];
                          $zip = $row['zip'];

                        }
                        else
                        {
                          $row = pg_fetch_assoc(pg_query("SELECT * FROM home_mailing_address WHERE home_id=$home_id"));

                          $address = $row['address1'];
                          $address .= " ";
                          $address .= $row['address2'];
                          $city = $row['city_id'];
                          $state = $row['state_id'];
                          $zip = $row['zip'];
                        }

                        if($city != '')
                        {
                          $row = pg_fetch_assoc(pg_query("SELECT * FROM city WHERE city_id=$city"));
                          $city = $row['city_name'];
                        }

                        if($state != '')
                        {
                          $row = pg_fetch_assoc(pg_query("SELECT * FROM state WHERE state_id=$state"));
                          $state = $row['state_code'];
                        }

                        if($zip != '')
                        {
                          $row = pg_fetch_assoc(pg_query("SELECT * FROM zip WHERE zip_id=$zip"));
                          $zip = $row['zip_code'];
                        }

                        $row = pg_fetch_assoc(pg_query("SELECT * FROM home_pay_method WHERE home_id=$home_id"));
                        $pay_method = $row['payment_type_id'];

                        $row = pg_fetch_assoc(pg_query("SELECT * FROM payment_type WHERE payment_type_id=$pay_method"));
                        $pay_method = $row['payment_type_name'];

                        echo "<tr><td>$address1 $address2 ($home_id)</td><td>$living_status</td><td>$lot</td><td>$pay_method</td>";

                        if($living_status == 'FALSE')
                          echo "<td>$address, $city, $state $zip</td>";

                        echo "</tr>";

                      ?>
                      
                    </tbody>
                    
                  </table>

                </div>

              </div>

            </section>

          </div>

          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-xs-12">

              <div class="box box-info">

                <div class="box-header">

                  <center><h4><strong>Current Year Payments Processed</strong></h4></center>

                </div>

                <div class="box-body table-responsive">
                  
                  <table class="table table-bordered">

                    <thead>
                      
                      <th>Year</th>
                      <th>January</th>
                      <th>February</th>
                      <th>March</th>
                      <th>April</th>
                      <th>May</th>
                      <th>June</th>
                      <th>July</th>
                      <th>August</th>
                      <th>September</th>
                      <th>October</th>
                      <th>November</th>
                      <th>December</th>

                    </thead>

                    <tbody>

                      <?php

                        $row = pg_fetch_assoc(pg_query("SELECT * FROM current_year_payments_processed WHERE home_id=$home_id AND community_id=$community_id AND year=$year"));

                        $current_year = $row['year'];
                        $m[1] = $row['m1_pmt_processed'];
                        $m[2] = $row['m2_pmt_processed'];
                        $m[3] = $row['m3_pmt_processed'];
                        $m[4] = $row['m4_pmt_processed'];
                        $m[5] = $row['m5_pmt_processed'];
                        $m[6] = $row['m6_pmt_processed'];
                        $m[7] = $row['m7_pmt_processed'];
                        $m[8] = $row['m8_pmt_processed'];
                        $m[9] = $row['m9_pmt_processed'];
                        $m[10] = $row['m10_pmt_processed'];
                        $m[11] = $row['m11_pmt_processed'];
                        $m[12] = $row['m12_pmt_processed'];

                        for ($i = 1; $i <= 12; $i++)
                        {
                          if($m[$i] == 't')
                            $m[$i] = "<center><i class='fa fa-check-square text-success'></i></center>";
                          else
                            $m[$i] = "<center><i class='fa fa-square-o text-orange'></i></center>";
                        }

                        echo "<tr><td>$year</td><td>$m[1]</td><td>$m[2]</td><td>$m[3]</td><td>$m[4]</td><td>$m[5]</td><td>$m[6]</td><td>$m[7]</td><td>$m[8]</td><td>$m[9]</td><td>$m[10]</td><td>$m[11]</td><td>$m[12]</td></tr>";

                      ?>
                      
                    </tbody>
                    
                  </table>

                </div>

              </div>

            </section>

          </div>

          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-xs-12">

              <div class="box box-info">

                <div class="box-header">

                  <center><h4><strong>Accounts Statement</strong></h4></center>

                </div>

                <div class="box-body table-responsive">
                  
                  <table class="table table-striped">
            
                    <thead>
            
                      <tr>
                        
                        <th>Month</th>
                        <th>Document ID</th>
                        <th>Description</th>
                        <th>Charge</th>
                        <th>Payment</th>
                        <th>Balance</th>

                      </tr>
                    
                    </thead>

                    <tbody>
                      
                      <?php

                        for($m = 1; $m <= 12; $m++)
                        {

                          $last_date = date("Y-m-t", strtotime("$year-$m-1"));
                          
                          $charges_results = pg_query("SELECT * FROM current_charges WHERE home_id=$home_id AND hoa_id=$hoa_id AND assessment_date>='$year-$m-1' AND assessment_date<='$last_date' ORDER BY assessment_date");

                          $payments_results = pg_query("SELECT * FROM current_payments WHERE home_id=$home_id AND hoa_id=$hoa_id AND process_date>='$year-$m-1' AND process_date<='$last_date' ORDER BY process_date");

                          $month_charge = 0.0;

                          while($charges_row = pg_fetch_assoc($charges_results))
                          {

                            $month_charge += $charges_row['amount'];
                            $tdate = $charges_row['assessment_date'];
                            $desc = $charges_row['assessment_rule_type_id'];

                            $r = pg_fetch_assoc(pg_query("SELECT * FROM assessment_rule_type WHERE assessment_rule_type_id=$desc"));
                            $desc = $r['name'];

                            echo "<tr><td>".date('F', strtotime($tdate))."</td><td>".$charges_row['id']."-".$charges_row['assessment_rule_type_id']."</td><td>".date("m-d-y", strtotime($tdate))."|".$desc."</td><td>$ ".$charges_row['amount']."</td><td></td><td>$ ".$month_charge."</td></tr>";

                          }

                          $month_payment = 0.0;

                          while($payments_row = pg_fetch_assoc($payments_results))
                          {

                            $month_payment += $payments_row['amount'];
                            $tdate = $payments_row['process_date'];

                            echo "<tr><td>".date('F', strtotime($tdate))."</td><td>".$payments_row['id']."-".$payments_row['payment_type_id']."</td><td>".date("m-d-y", strtotime($tdate))."|"."Payment Received # ".$payments_row['document_num']."</td><td></td><td>$ ".$payments_row['amount']."</td><td>$ ".$month_payment."</td></tr>";

                          }

                        }

                      ?>

                      <tr><td></td><td></td><td><strong>Total</strong></td><td><?php $row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE home_id=$home_id AND hoa_id=$hoa_id")); $total_charges = $row['sum']; echo "<strong>$ ".$total_charges."</strong>"; ?></td><td><?php $row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE home_id=$home_id AND hoa_id=$hoa_id AND payment_status_id=1")); $total_payments = $row['sum']; if($total_payments == "") $total_payments = 0.0; echo "<strong>$ ".$total_payments."</strong>"; ?></td><td><?php $total = $total_charges - $total_payments; echo "<strong>$ ".$total."</strong>"; ?></td></tr>

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

                  <center><h4><strong>Forte Transactions</strong></h4></center>

                </div>

                <div class="box-body table-responsive">
                  
                  <table id='example1' class="table table-bordered">

                    <thead>
                      
                      <th>Date</th>
                      <th>Customer ID</th>
                      <th>Document Number</th>
                      <th>Status</th>
                      <th>Amount</th>

                    </thead>

                    <tbody>
                      
                    </tbody>
                    
                  </table>

                </div>

              </div>

            </section>

          </div>

          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-xs-12">

              <div class="box box-info">

                <div class="box-header">

                  <center><h4><strong>Statements Mailed</strong></h4></center>

                </div>

                <div class="box-body table-responsive">
                  
                  <table id='example3' class="table table-bordered">

                    <thead>
                      
                      <th>Date Sent</th>
                      <th>Total Due</th>
                      <th>Statement File</th>
                      <th>Statement Type</th>
                      <th>Notification Type</th>

                    </thead>

                    <tbody>

                      <?php 

                        $result = pg_query("SELECT * FROM community_statements_mailed WHERE home_id=$home_id AND hoa_id=$hoa_id");

                        while ($row = pg_fetch_assoc($result)) 
                        {
                          $date_sent = $row['date_sent'];
                          $total_due = $row['total_due'];
                          $statement_file = $row['statement_file'];
                          $statement_type = $row['statement_type'];
                          $notification_type = $row['notification_type'];

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM notification_mode WHERE notification_mode_id=$notification_type"));
                          $notification_type = $row1['notification_mode_type'];

                          echo "<tr><td>$date_sent</td><td>$ $total_due</td><td>$statement_file</td><td>$statement_type</td><td>$notification_type</td></tr>";
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

              <div class="box box-warning">

                <div class="box-header">

                  <center><h4><strong>Violation Citations</strong></h4></center>

                </div>

                <div class="box-body table-responsive">
                  
                  <table id='example2' class="table table-bordered">

                    <thead>
                      
                      <th>Inspection Date</th>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Description</th>
                      <th>Category</th>
                      <th>Sub Category</th>
                      <th>Sub Category Rule</th>
                      <th>Sub Category Rule Description</th>
                      <th>Sub Category Rule Explanation</th>
                      <th>Notice Type</th>
                      <th>Location</th>
                      <th>Document</th>
                      <th>Date of Upload</th>

                    </thead>

                    <tbody>

                      <?php 

                        $result = pg_query("SELECT * FROM violation_management WHERE home_id=$home_id AND hoa_id=$hoa_id");

                        while($row = pg_fetch_assoc($result))
                        {

                          $description = $row['description'];
                          $document = $row['document_id'];
                          $inspection_date = $row['inspection_date'];
                          $location = $row['location_id'];
                          $violation_category = $row['violation_category_id'];
                          $violation_sub_category = $row['violation_sub_category_id'];
                          $notice_type = $row['notice_type_id'];
                          $date_of_upload = $row['date_of_upload'];

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));

                          $hoa_id = $row1['hoa_id'];
                          $name = $row1['firstname'];
                          $name .= " ";
                          $name .= $row1['lastname'];

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));

                          $address = $row1['address1'];

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM violation_category WHERE violation_category_id=$violation_category"));

                          $violation_category = $row1['name'];

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM violation_sub_category WHERE violation_sub_category_id=$violation_sub_category"));

                          $violation_sub_category = $row1['name'];
                          $violation_sub_category_rule = $row1['rule'];
                          $violation_sub_category_rule_description = $row1['rule_description'];
                          $violation_sub_category_rule_explanation = $row1['explanation'];
                          
                          echo "<tr><td>".date('m-d-Y', strtotime($inspection_date))."</td><td>".$name."($hoa_id)</td><td>".$address."($home_id)</td><td>".$description."</td><td>".$violation_category."</td><td>".$violation_sub_category."</td><td>".$violation_sub_category_rule."</td><td>".$violation_sub_category_rule_description."</td><td>".$violation_sub_category_rule_explanation."</td><td>".$notice_type."</td><td>".$location."</td><td>".$document."</td><td>".date('m-d-Y', strtotime($date_of_upload))."</td></tr>";
                          
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
        $(".select2").select2();

        $("#example1").DataTable({ "pageLength": 50 });

        $("#example2").DataTable({ "pageLength": 50 });

        $("#example3").DataTable({ "pageLength": 50 });
      });
    </script>

  </body>

</html>