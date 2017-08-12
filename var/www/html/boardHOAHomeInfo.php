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
                
                <li class='active treeview'>

                  <a>

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

          $result = pg_query("SELECT * FROM hoaid WHERE community_id=$community_id");

        ?>
        
        <section class="content-header">

          <h1><strong>HOA &amp; Home Info</strong><small> - <?php echo $_SESSION['hoa_community_name']; ?></small></h1>

        </section>

        <section class="content">
          
          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-sm-12">

              <div class="box">
                
                <div class="box-header">
                  <i class="fa fa-"></i>

                  <div class="box-tools pull-right">

                    <a type="button" href="HOAHomeInfoCSV.php" class="btn bg-teal btn-sm">Export as .csv</a>

                  </div>

                </div>

                <div class="box-body table-responsive">
                  
                  <table id="example1" class="table table-bordered table-striped">
                    
                    <thead>
                      
                      <tr>
                        
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Living In</th>
                        <th>Balance</th>
                        <th>Mailing Address</th>
                        <th>Pay Method</th>
                        <th>Active Reminder</th>
                        <th>Recurring Pay</th>

                      </tr>

                    </thead>

                    <tbody>

                      <?php 

                        while($row = pg_fetch_assoc($result))
                        {

                          $hoa_id = $row['hoa_id'];
                          $firstname = $row['firstname'];
                          $lastname = $row['lastname'];
                          $valid_from = $row['valid_from'];
                          $valid_until = $row['valid_until'];
                          $email = $row['email'];
                          $cell_no = $row['cell_no'];
                          $home_id = $row['home_id'];

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));

                          $address = $row1['address1'];
                          $living_status = $row1['living_status'];

                          if($living_status)
                          {
                            $mailing_address = $row1['address1'];
                            $mailing_city = $row1['city_id'];
                            $mailing_state = $row1['state_id'];
                            $mailing_zip = $row1['zip_id'];
                          }
                          else
                          {
                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM home_mailing_address WHERE home_id=$home_id"));

                            $mailing_address = $row1['address1'];
                            $mailing_city = $row1['city_id'];
                            $mailing_state = $row1['state_id'];
                            $mailing_zip = $row1['zip_id'];
                          }

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM city WHERE city_id=$mailing_city"));
                          $mailing_city = $row1['city_name'];

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM state WHERE state_id=$mailing_state"));
                          $mailing_state = $row1['state_code'];

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM zip WHERE zip_id=$mailing_zip"));
                          $mailing_zip = $row1['zip_code'];

                          $row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE home_id=$home_id AND hoa_id=$hoa_id"));
                          $charges = $row1['sum'];

                          $row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE payment_status_id=1 AND home_id=$home_id AND hoa_id=$hoa_id"));
                          $payments = $row1['sum'];

                          $balance = $charges - $payments;

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM home_pay_method WHERE home_id=$home_id"));
                          $home_pay_method = $row1['payment_type_id'];
                          $recurring_pay = $row1['recurring_pay'];

                          if($recurring_pay == 't')
                            $recurring_pay = "TRUE";
                          else
                            $recurring_pay = "FALSE";

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM payment_type WHERE payment_type_id=$home_pay_method"));
                          $home_pay_method = $row1['payment_type_name'];

                          $reminders = pg_num_rows(pg_query("SELECT * FROM reminders WHERE home_id=$home_id AND hoa_id=$hoa_id"));
                          
                          if($reminders == 0)
                            $reminders = "FALSE";
                          else
                            $reminders = "TRUE";

                          echo "<div class='modal fade hmodal-success' id='HOAInfo_".$hoa_id."' role='dialog'  aria-hidden='true'>
                                
                            <div class='modal-dialog'>
                                              
                              <div class='modal-content'>
                                                  
                                <div class='color-line'></div>
                                  
                                  <div class='modal-header'>
                                                          
                                    <h4 class='modal-title'>HOA Info - ".$firstname." ".$lastname." - ".$hoa_id."</h4>

                                  </div>

                                  <form class='row' method='post' action='https://hoaboardtime.com/boardUpdateHOAID.php'>
                                                      
                                    <div class='modal-body'>
                                                          
                                      <center>
                                        
                                        <div class='row'>
                                          
                                          <div class='row container-fluid'>
                                
                                            <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                                              <label>First Name</label>
                                              <input type='text' class='form-control' name='edit_firstname' id='edit_firstname' value='$firstname' required>
                                            </div>
                                                
                                            <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                                              <label>Last Name</label>
                                              <input type='text' class='form-control' name='edit_lastname' id='edit_lastname' value='$lastname' required>
                                            </div>

                                          </div>

                                        </div>

                                        <br>

                                        <div class='row container-fluid'>
                                          
                                          <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                                            <label>Phone</label>
                                            <input type='number' class='form-control' name='edit_cell_no' id='edit_cell_no' value='$cell_no' required>
                                          </div>
                                              
                                          <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                                            <label>Email</label>
                                            <input type='email' class='form-control' name='edit_email' id='edit_email' value='$email' required>
                                          </div>

                                        </div>

                                        <br>

                                        <div class='row container-fluid'>
                                          
                                          <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                                            <label>Resident Since</label>
                                            <input type='date' class='form-control' name='edit_valid_from' id='edit_valid_from' value='$valid_from' required>
                                          </div>
                                              
                                          <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                                            <label>Resident Until</label>
                                            <input type='date' class='form-control' name='edit_valid_until' id='edit_valid_until' value='$valid_until' >

                                            <input type='hidden' name='hoa_id' id='hoa_id' value='$hoa_id'>
                                          </div>

                                        </div>

                                        <br><br>

                                        <button type='submit' name='submit' id='submit' class='btn btn-success btn-sm'>Update</button>
                                        <button type='button' class='btn btn-warning btn-sm' data-dismiss='modal'>Cancel</button>
                                                          
                                      </center>

                                    </div>

                                  </form>

                                </div>
                            
                              </div>

                            </div>";

                          echo "<div class='modal fade hmodal-success' id='paymentInfo_".$hoa_id."' role='dialog'  aria-hidden='true'>
                                
                            <div class='modal-dialog'>
                                              
                              <div class='modal-content'>
                                                  
                                <div class='color-line'></div>
                                  
                                  <div class='modal-header'>
                                                          
                                    <h4 class='modal-title'>Payment Info - ".$firstname." ".$lastname."</h4>

                                  </div>

                                  <div class='modal-body'>
                                                          
                                    <center>
                                        
                                      <div class='row container-fluid'>
                                          
                                        <div class='col-xl-3 col-lg-3 col-md-3 col-md-3 col-xs-3'><strong>Date</strong></div>
                                        <div class='col-xl-3 col-lg-3 col-md-3 col-md-3 col-xs-3'><strong>Confirmation</strong></div>
                                        <div class='col-xl-3 col-lg-3 col-md-3 col-md-3 col-xs-3'><strong>Payment Method</strong></div>
                                        <div class='col-xl-3 col-lg-3 col-md-3 col-md-3 col-xs-3'><strong>Amount</strong></div>

                                      </div>

                                      <br>";

                                      $result1 = pg_query("SELECT * FROM current_payments WHERE payment_status_id=1 AND home_id=$home_id AND hoa_id=$hoa_id");

                                      while($row1 = pg_fetch_assoc($result1))
                                      {

                                        $process_date = $row1['process_date'];
                                        $confirmation = $row1['document_num'];
                                        $pay_method = $row1['payment_type_id'];
                                        $amount = $row1['amount'];

                                        echo "<div class='row container-fluid'>
                                          
                                        <div class='col-xl-3 col-lg-3 col-md-3 col-md-3 col-xs-3'>".$process_date."</div>
                                        <div class='col-xl-3 col-lg-3 col-md-3 col-md-3 col-xs-3'>".$confirmation."</div>
                                        <div class='col-xl-3 col-lg-3 col-md-3 col-md-3 col-xs-3'>".$pay_method."</div>
                                        <div class='col-xl-3 col-lg-3 col-md-3 col-md-3 col-xs-3'>$ ".$amount."</div>

                                        </div>";

                                      }

                                      echo "<br>

                                      <div class='row container-fluid'>
                                          
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>M1</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>M2</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>M3</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>M4</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>M5</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>M6</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>M7</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>M8</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>M9</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>M10</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>M11</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>M12</strong></div>

                                      </div>";

                                      $row1 = pg_fetch_assoc(pg_query("SELECT * FROM current_year_payments_processed WHERE hoa_id=$hoa_id AND home_id=$home_id AND year=$year"));

                                      $m1 = $row1['m1_pmt_processed'];
                                      $m2 = $row1['m2_pmt_processed'];
                                      $m3 = $row1['m3_pmt_processed'];
                                      $m4 = $row1['m4_pmt_processed'];
                                      $m5 = $row1['m5_pmt_processed'];
                                      $m6 = $row1['m6_pmt_processed'];
                                      $m7 = $row1['m7_pmt_processed'];
                                      $m8 = $row1['m8_pmt_processed'];
                                      $m9 = $row1['m9_pmt_processed'];
                                      $m10 = $row1['m10_pmt_processed'];
                                      $m11 = $row1['m11_pmt_processed'];
                                      $m12 = $row1['m12_pmt_processed'];

                                      if($m1 == 't')
                                        $m1 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                      else
                                        $m1 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                      if($m2 == 't')
                                        $m2 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                      else
                                        $m2 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                      if($m3 == 't')
                                        $m3 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                      else
                                        $m3 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                      if($m4 == 't')
                                        $m4 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                      else
                                        $m4 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                      if($m5 == 't')
                                        $m5 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                      else
                                        $m5 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                      if($m6 == 't')
                                        $m6 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                      else
                                        $m6 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                      if($m7 == 't')
                                        $m7 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                      else
                                        $m7 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                      if($m8 == 't')
                                        $m8 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                      else
                                        $m8 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                      if($m9 == 't')
                                        $m9 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                      else
                                        $m9 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                      if($m10 == 't')
                                        $m10 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                      else
                                        $m10 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                      if($m11 == 't')
                                        $m11 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                      else
                                        $m11 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                      if($m12 == 't')
                                        $m12 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                      else
                                        $m12 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                      echo "<div class='row container-fluid'>

                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>".$m1."</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>".$m2."</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>".$m3."</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>".$m4."</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>".$m5."</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>".$m6."</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>".$m7."</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>".$m8."</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>".$m9."</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>".$m10."</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>".$m11."</strong></div>
                                        <div class='col-xl-1 col-lg-1 col-md-1 col-md-1 col-xs-1'><strong>".$m12."</strong></div>

                                      </div>";

                                      echo "<br><br>

                                      <a target='_blank' href='https://hoaboardtime.com/boardViewFortePayments.php?hoa_id=".$hoa_id."' class='btn btn-info btn-sm'>View Forte Payments</a>
                                      <button type='button' class='btn btn-warning btn-sm' data-dismiss='modal'>Cancel</button>
                                                          
                                  </center>

                                </div>

                              </div>
                            
                            </div>

                          </div>";


                          echo "<tr><td><a data-toggle='modal' data-target='#HOAInfo_".$hoa_id."'>".$firstname." ".$lastname."<br>(".$hoa_id.")</a></td><td>".$email."</td><td>".$cell_no."</td><td>".$address."<br>(".$home_id.")</td><td><a data-toggle='modal' data-target='#paymentInfo_".$hoa_id."'>$ ".$balance."</a></td><td>".$mailing_address."<br>".$mailing_city."<br>".$mailing_state." ".$mailing_zip."</td><td>".$home_pay_method."</td><td>".$reminders."</td><td>".$recurring_pay."</td></tr>";

                        }

                      ?>
                    
                    </tbody>

                    <tfoot>

                      <tr>

                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Living In</th>
                        <th>Balance</th>
                        <th>Mailing Address</th>
                        <th>Pay Method</th>
                        <th>Active Reminder</th>
                        <th>Recurring Pay</th>

                      </tr>

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