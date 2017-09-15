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

        ?>
        
        <section class="content-header">

          <h1><strong>Community Deposits</strong><small> - <?php echo $_SESSION['hoa_community_name']; ?></small></h1>

        </section>

        <section class="content">
          
          <div class="row container-fluid">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-xs-12">

              <div class="row container-fluid"  style="background-color: white;">

                <div class="box-body table-responsive">
                  
                  <table id='example1' class="table table-striped table-bordered">

                    <thead>
                      
                      <th>Fund Received On</th>
                      <th>ID</th>
                      <th>Net Amount</th>
                      <th>Number of Transactions</th>
                      <th>Status</th>
                      <th>Fund Sent On</th>

                    </thead>

                    <tbody>

                      <?php

                        $result = pg_query("SELECT * FROM community_deposits WHERE community_id=$community_id");

                        while($row = pg_fetch_assoc($result))
                        {

                          $funding_id = $row['funding_id'];
                          $id1 = $row['id'];
                          $status = $row['status'];
                          $net_amount = $row['net_amount'];
                          $number_of_transactions = $row['number_of_transactions'];
                          $effective_date = $row['effective_date'];
                          $origination_date = $row['origination_date'];
                          $routing_number = $row['routing_number'];
                          $account_number = $row['account_number_last_four_digits'];
                          $entry_description = $row['entry_description'];

                          if($effective_date != '')
                            $effective_date = date('m-d-Y', strtotime($effective_date));

                          if($origination_date != '')
                            $origination_date = date('m-d-Y', strtotime($origination_date));

                          echo "<div class='modal fade hmodal-success' id='funding_id_".$funding_id."' role='dialog'  aria-hidden='true'>
                                
                            <div class='modal-dialog'>
                                              
                              <div class='modal-content'>
                                                  
                                <div class='color-line'></div>

                                  <div class='modal-body table-responsive'>";

                                    $result1 = pg_query("SELECT * FROM community_funding_transactions WHERE funding_id='$funding_id' ORDER BY id");

                                    echo "<div class='row container-fluid'>

                                      <div class='row text-center'>

                                        <strong>

                                          <div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'>Name<br>(HOA ID)</div>
                                          <div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'>Address<br>(Home ID)</div>
                                          <div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'>ID</div>
                                          <div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'>Status</div>
                                          <div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'>Amount</div>
                                          <div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'>Received Date</div>

                                        </strong>

                                      </div>

                                      <br>

                                      <div class='row container-fluid'>";

                                        while($row1 = pg_fetch_assoc($result1))
                                        {

                                          $id = $row1['id'];
                                          $transaction_id = $row1['transaction_id'];
                                          $funding_status = $row1['status'];
                                          $amount = $row1['amount'];
                                          $received_date = $row1['received_date'];
                                          $funding_hoa_id = $row1['hoa_id'];

                                          if($received_date != '')
                                            $received_date = date('m-d-Y', strtotime($received_date));

                                          $row11 = pg_fetch_assoc(pg_query("SELECT * FROM current_payments WHERE bank_transaction_id='$transaction_id'"));

                                          $t_hoa_id = $row11['hoa_id'];
                                          $t_home_id = $row11['home_id'];

                                          $row11 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$t_hoa_id"));

                                          $name = $row11['firstname'];
                                          $name .= " ";
                                          $name .= $row11['lastname'];

                                          $row11 = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$t_home_id"));

                                          $address = $row11['address1'];
                                          $living_status = $row11['living_status'];

                                          if($name != " " && $address != "")
                                          {
                                            
                                            $name = "$name<br>($t_hoa_id)";
                                            $address = "$address<br>($t_home_id)";

                                          }
                                          else
                                          {

                                            echo "

                                            <div class='modal fade hmodal-success' id='addHOAID_$id1_$id' role='dialog'  aria-hidden='true'>
                                
                                              <div class='modal-dialog'>
                                                                
                                                <div class='modal-content'>

                                                  <div class='modal-header table-responsive'>

                                                    <h4>Add Hoa ID - <strong>$id</strong></h4>

                                                  </div>

                                                  <div class='modal-body table-responsive'>

                                                    <center>

                                                      <select class='form-contril select2' name='select_hoa' id='select_hoa' required>

                                                        <option value='' disabled selected>Select User</option>";

                                                        $result000 = pg_query("SELECT * FROM homeid WHERE community_id=$community_id");

                                                        while($row000 = pg_fetch_assoc($result000))
                                                        {

                                                          $add_home_id = $row000['home_id'];
                                                          $add_address1 = $row000['address1'];
                                                          
                                                          $row111 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE home_id=$add_home_id"));

                                                          $add_name = $row111['firstname'];
                                                          $add_name .= " ";
                                                          $add_name .= $row111['lastname'];

                                                          echo "<option value='".$add_hoa_id."'>".$add_name." - ".$add_address1."</option>";

                                                        }

                                                      echo "</select>

                                                      <br><br>

                                                      <button class='btn btn-xs btn-info' type='submit'>Update</button>

                                                    </center>

                                                  </div>

                                                  <br>

                                                </div>
                                              
                                              </div>

                                            </div>";//End

                                            $name = "<a data-toggle='modal' data-target='#addHOAID_$id1_$id' title='Add HOA ID'>N/A</a>";
                                            $address = "<a data-toggle='modal' data-target='#addHOAID_$id1_$id' title='Add HOA ID'>N/A</a>";

                                          }

                                          echo "<div class='row text-center";

                                          if($living_status != 't')
                                            echo " text-red";

                                          echo "'><div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'><a href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$t_hoa_id' title='User Dashboard'>$name</a></div><div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'>$address</div><div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'>$id</div><div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'>$funding_status</div><div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'>$amount</div><div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'>$received_date</div></div><br>";

                                        }

                                      echo "</div>

                                    </div>";

                                  echo "</div>

                                  <br>

                                </div>
                            
                              </div>

                            </div>";

                          echo "<tr><td>".$effective_date."</td><td><a data-toggle='modal' data-target='#funding_id_".$funding_id."'>".$id1."</td><td><a data-toggle='modal' data-target='#funding_id_".$funding_id."'>$ ".$net_amount."</a></td><td><a data-toggle='modal' data-target='#funding_id_".$funding_id."'>".$number_of_transactions."</a></td><td>".$status."</td><td>".$origination_date."</td></tr>";

                        }

                      ?>

                    </tbody>

                    <tfoot>
                      
                      <th>Fund Received On</th>
                      <th>Funding Id</th>
                      <th>Net Amount</th>
                      <th>Number of Transactions</th>
                      <th>Status</th>
                      <th>Fund Sent On</th>

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
    <script src="plugins/select2/select2.full.min.js"></script>
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/demo.js"></script>

    <script>
      $(function () {
        $("#example1").DataTable({ "pageLength": 50, "order": [[0, 'desc']] });

        $("#example2").DataTable({ "pageLength": 50 });

        $(".select2").select2();
      });
    </script>

  </body>

</html>