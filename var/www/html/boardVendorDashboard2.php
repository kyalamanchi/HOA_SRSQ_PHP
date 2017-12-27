<?php

  ini_set("session.save_path","/var/www/html/session/");

  session_start();

?>

<!DOCTYPE html>

<html>

  <head>
    
    <?php

        pg_connect("host=srsq-only.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

        if(@!$_SESSION['hoa_username'])
          header("Location: https://hoaboardtime.com/logout.php");

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
                <li class='active treeview'>

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

          $vendor_id = $_REQUEST['select_vendor'];

          $row = pg_fetch_assoc(pg_query("SELECT * FROM vendor_master WHERE vendor_id=$vendor_id"));

        ?>
        
        <section class="content-header">

          <h1><strong>Vendor Dashboard</strong><small> - <?php echo $row['vendor_name']; ?></small></h1>

        </section>

        <section class="content">
          
          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-xs-12">

              <div class="box">

                <div class="box-header">

                  <center><h4><strong>Vendor Details</strong></h4></center>

                </div>

                <div class="box-body table-responsive">
                  
                  <table class="table table-bordered">

                    <thead>
                      
                      <th>Vendor Name</th>
                      <th>Active From</th>
                      <th>Approved</th>
                      <th>Vendor Type</th>
                      <th>Payment Method</th>
                      <th>Tax ID</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>

                    </thead>

                    <tbody>

                      <?php

                        $vendor_name = $row['vendor_name'];
                        $active_from = $row['active_from'];
                        $approved = $row['approved'];
                        $vendor_type = $row['vendor_type_id'];
                        $payment_type = $row['payment_type_id'];
                        $tax_id = $row['tax_id'];
                        $email = $row['email'];
                        $phone = $row['phone_no'];
                        $address = $row['address'];

                        if($active_from != "")
                          $active_from = date('m-d-Y', strtotime($active_from));

                        if($approved == 't')
                          $approved = 'TRUE';
                        else
                          $approved = 'FALSE';

                        if($vendor_type != "")
                        {
                          $row = pg_fetch_assoc(pg_query("SELECT * FROM vendor_type WHERE vendor_type_id=$vendor_type"));

                          $vendor_type = $row['vendor_type_name'];
                        }

                        if($payment_type != "")
                        {
                          $row = pg_fetch_assoc(pg_query("SELECT * FROM payment_type WHERE payment_type_id=$payment_type"));

                          $payment_type = $row['payment_type_name'];
                        }

                        echo "<tr><td>$vendor_name</td><td>$active_from</td><td>$approved</td><td>$vendor_type</td><td>$payment_type</td><td>$tax_id</td><td>$email</td><td>$phone</td><td>$address</td></tr>";

                      ?>
                      
                    </tbody>
                    
                  </table>

                </div>

                <div class="box-body table-responsive">
                  
                  <table class="table table-bordered">

                    <thead>
                      
                      <th>Service Address</th>
                      <th>Recurrnig Pay</th>
                      <th>Account ID</th>
                      <th>Recurring Pay Day</th>
                      <th>Bill Recurs every</th>
                      <th>Quickbooks Vendor Payments</th>

                    </thead>

                    <tbody>

                      <?php

                        $row = pg_fetch_assoc(pg_query("SELECT * FROM vendor_pay_method WHERE vendor_id=$vendor_id"));

                        $service_address = $row['service_address'];
                        $recurring_pay = $row['recurring_pay'];
                        $account_id = $row['account_id'];
                        $recurring_pay_day = $row['recurring_pay_day_of_month'];
                        $bill_recurs_every = $row['recurs_every_in_days'];

                        if($recurring_pay == 't')
                          $recurring_pay = "TRUE";
                        else
                          $recurring_pay = "FALSE";

                        echo "<tr><td>".$service_address."</td><td>".$recurring_pay."</td><td>".$account_id."</td><td>".$recurring_pay_day."</td><td>".$bill_recurs_every."</td><td></td></tr>";

                      ?>
                      
                    </tbody>
                    
                  </table>

                </div>

              </div>

            </section>

          </div>
          <!-- Vendor Payments -->
          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-xs-12">

              <div class="box">

                <div class="box-header">

                  <center><h4><strong>Vendor Payments</strong></h4></center>

                </div>

                <div class="box-body table-responsive">
                  
                  <table class="table table-bordered">

                    <thead>
                      
                      <th>Date</th>
                      <th>Payment Type</th>
                      <th>Reference Number</th>
                      <th>Payee</th>
                      <th>Category</th>
                      <th>Total</th>
                    </thead>

                    <tbody>

                        <?php
            setlocale(LC_MONETARY, 'en_US');
            date_default_timezone_set('America/Los_Angeles');
            $connection = pg_pconnect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
            $vendorID = $_GET['select_vendor'];
            if ( $vendorID ){
            $query = "SELECT quickbooks_id from vendor_master where vendor_id = $vendorID";
            $res  = pg_query($query);
            $return  = pg_fetch_assoc($res);
            $qbID = $return['quickbooks_id'];
            if ( $qbID ){
            $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/query');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'POST');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json','Content-Type:application/text','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1509541160",oauth_nonce="4u2GbsqN86U",oauth_version="1.0",oauth_signature="OOpV7UMNAkRACPJjJ2SU%2FzidANE%3D"'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, "select * from purchase MAXRESULTS 1000");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $result = curl_exec($ch);
            $result =  json_decode($result);
            foreach ($result->QueryResponse->Purchase as $purchase) {
                if ( $purchase->EntityRef->value == $qbID ){
                    
                $name = "";
                foreach ($purchase->Line as $accountData) {
                    if ( $name != "" )
                    $name = $name."<br>".$accountData->AccountBasedExpenseLineDetail->AccountRef->name;
                    else 
                    {
                        $name = $accountData->AccountBasedExpenseLineDetail->AccountRef->name;
                    }
                }

                echo '<tr>';
                     echo '<td>';
                        echo date('Y-m-d',strtotime($purchase->MetaData->CreateTime));
                    echo '</td>';
                    echo '<td>';
                        echo $Purchase->PaymentType;
                    echo '</td>';
                    echo '<td>';
                        echo $purchase->DocNumber;
                    echo '</td>';
                    echo '<td>';
                        echo $purchase->EntityRef->name;
                    echo '</td>';
                     echo '<td>';
                        echo $name;
                    echo '</td>';
                     echo '<td>';
                     $purchaseid = $purchase->Id;
                        echo '<a href="https://hoaboardtime.com/qbPurchaseDetails.php?id='.$purchaseid.'">'.money_format('%#10n',  $purchase->TotalAmt).'</a>';
                    echo '</td>';
                  echo '</tr>';
                      }
                    }
                    }
                    }
                    ?>
                      
                    </tbody>
                    
                  </table>

                </div>

            </section>

          </div>

          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-xs-12">

              <div class="box">

                <div class="box-header">

                  <center><h4><strong>Current Year Vendor Payment Processed</strong></h4></center>
                  
                  <i class="fa fa-"></i>

                  <div class="box-tools pull-right">

                    <a data-toggle="modal" data-target="#editVendorCurrentYearPaymentsProcessed" class='btn-xs'><i class='fa fa-edit'></i> Edit</a>

                  </div>

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

                        $result = pg_query("SELECT * FROM current_year_vendors_pmt_processed WHERE vendor_id=$vendor_id AND community_id=$community_id ORDER BY year DESC");

                        while($row = pg_fetch_assoc($result))
                        {
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
                            $m1[$i] = $m[$i];

                          for ($i = 1; $i <= 12; $i++)
                          {
                            if($m[$i] == 't')
                              $m[$i] = "<center><i class='fa fa-check-square text-success'></i></center>";
                            else
                              $m[$i] = "<center><i class='fa fa-square-o text-orange'></i></center>";
                          }

                          echo "<tr><td>$current_year</td><td>$m[1]</td><td>$m[2]</td><td>$m[3]</td><td>$m[4]</td><td>$m[5]</td><td>$m[6]</td><td>$m[7]</td><td>$m[8]</td><td>$m[9]</td><td>$m[10]</td><td>$m[11]</td><td>$m[12]</td></tr>";
                        }

                      ?>
                      
                    </tbody>
                    
                  </table>

                </div>

              </div>

              <div class="modal fade hmodal-success" id="editVendorCurrentYearPaymentsProcessed" role="dialog"  aria-hidden="true">
                                
                <div class="modal-dialog">
                                    
                  <div class="modal-content">
                                        
                    <div class="color-line"></div>
                        
                    <div class="modal-header">
                                                
                      <h4 class="modal-title"><strong>Current Year Vendor Payments Processed</strong></h4>

                    </div>

                    <form class='row' method='post' action='https://hoaboardtime.com/boardEditCurrentYearPaymentsProcessed.php'>
                                            
                      <div class='modal-body'>
                                                
                        <div class='container-fluid'>
                              
                          <div class='row container-fluid'>
                                
                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><label>January</label></div>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><input type='checkbox' value='January' name='month[]' id='month' <?php if($m1[1] == 't') echo "checked"; ?>></div>
                            </div>
                                
                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><label>February</label></div>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><input type='checkbox' value='February' name='month[]' id='month' <?php if($m1[2] == 't') echo "checked"; ?> ></div>
                            </div>

                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><label>March</label></div>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><input type='checkbox' value='March' name='month[]' id='month' <?php if($m1[3] == 't') echo "checked"; ?> ></div>
                            </div>

                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><label>April</label></div>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><input type='checkbox' value='April' name='month[]' id='month' <?php if($m1[4] == 't') echo "checked"; ?> ></div>
                            </div>

                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><label>May</label></div>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><input type='checkbox' value='May' name='month[]' id='month' <?php if($m1[5] == 't') echo "checked"; ?> ></div>
                            </div>

                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><label>June</label></div>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><input type='checkbox' value='June' name='month[]' id='month' <?php if($m1[6] == 't') echo "checked"; ?> ></div>
                            </div>

                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><label>July</label></div>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><input type='checkbox' value='July' name='month[]' id='month' <?php if($m1[7] == 't') echo "checked"; ?> ></div>
                            </div>

                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><label>August</label></div>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><input type='checkbox' value='August' name='month[]' id='month' <?php if($m1[8] == 't') echo "checked"; ?> ></div>
                            </div>

                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><label>September</label></div>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><input type='checkbox' value='September' name='month[]' id='month' <?php if($m1[9] == 't') echo "checked"; ?> ></div>
                            </div>

                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><label>October</label></div>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><input type='checkbox' value='October' name='month[]' id='month' <?php if($m1[10] == 't') echo "checked"; ?> ></div>
                            </div>

                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><label>November</label></div>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><input type='checkbox' value='November' name='month[]' id='month' <?php if($m1[11] == 't') echo "checked"; ?> ></div>
                            </div>

                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><label>December</label></div>
                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><input type='checkbox' value='December' name='month[]' id='month' <?php if($m1[12] == 't') echo "checked"; ?> ></div>

                              <input type="hidden" name="home_id" id='home_id' value="<?php echo $home_id; ?>">
                              <input type="hidden" name="hoa_id" id='hoa_id' value="<?php echo $hoa_id; ?>">
                            </div>

                          </div>

                          <br>

                          <div class='row text-center'>
                            <button type='submit' name='submit' id='submit' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Save Changes</button>
                            <button type='button' class='btn btn-warning btn-xs' data-dismiss='modal'><i class='fa fa-close'></i> Cancel</button>
                          </div>
                                                
                        </div>

                      </div>

                    </form>

                  </div>
                  
                </div>

              </div>

            </section>

          </div>

          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-xs-12">

              <div class="box">

                <div class="box-header">

                  <center><h4><strong>Accounts Payable</strong></h4></center>

                </div>

                <div class="box-body table-responsive">
                  
                  <table id='example1' class="table table-bordered">

                    <thead>
                      
                      <th>Pay Date</th>
                      <th>Payment Type</th>
                      <th>Amount</th>
                      <th>Bank Account</th>
                      <th>Payment Cleared</th>
                      <th>Date Payment Cleared</th>
                      <th>Closing Year</th>
                      <th>Closing Month</th>
                      <th>Document</th>

                    </thead>

                    <tbody>

                      <?php

                        $res = pg_query("SELECT * FROM accounts_payable WHERE vendor_id=$vendor_id AND community_id=$community_id ORDER BY pay_date DESC");

                        if($res)
                        {

                          while($row = pg_fetch_assoc($res))
                          {
                            
                            $pay_date = $row['pay_date'];
                            $payment_type = $row['payment_type_id'];
                            $amount = $row['amount'];
                            $bank_account = $row['bank_account_id'];
                            $payment_cleared = $row['payment_cleared'];
                            $date_payment_cleared = $row['date_payment_cleared'];
                            $closing_year = $row['closing_year'];
                            $closing_month = $row['closing_month'];
                            $id = $row['id'];

                            if($payment_cleared == 't')
                              $payment_cleared = 'TRUE';
                            else
                              $payment_cleared = 'FALSE';

                            if($payment_type != "")
                            {
                              $row1 = pg_fetch_assoc(pg_query("SELECT * FROM payment_type WHERE payment_type_id=$payment_type"));

                              $payment_type = $row1['payment_type_name'];
                            }

                            if($bank_account != "")
                            {
                              $row1 = pg_fetch_assoc(pg_query("SELECT * FROM bank_account WHERE community_id=$community_id AND id=$bank_account"));

                              $bank_account = $row1['bank_name'];
                              $bank_account .= " ";
                              $bank_account .= $row1['last4_account_no'];
                            }

                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM accounts_payable_documents WHERE accounts_payable_id=$id"));

                            $document = $row1['document_id'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM document_management WHERE document_id=$document"));

                            $document_url = $row1['url'];
                            $desc = $row1['description'];

                            if($document_url == "")
                              $document_url = "N/A";
                            else
                              $document_url = "<a href='https://hoaboardtime.com/getDocumentPreview.php?path=$document_url&desc=$desc' target='_blank'><i class='fa fa-file-pdf-o'></i></a>";

                            echo "<tr><td>".date('m-d-Y', strtotime($pay_date))."</td><td>$payment_type</td><td>$ $amount</td><td>$bank_account</td><td>$payment_cleared</td><td>$date_payment_cleared</td><td>$closing_year</td><td>$closing_month</td><td>$document_url</td></tr>";

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

                  <center><h4><strong>Vendor Documents</strong></h4></center>

                </div>

                <div class="box-body table-responsive">
                  
                  <table id='example' class="table table-bordered">

                    <thead>
                      
                      <th>Uploaded Date</th>
                      <th>Description</th>
                      <th>Month &amp; Year of Upload</th>

                    </thead>

                    <tbody>

                      <?php

                        $res = pg_query("SELECT * FROM document_management WHERE vendor_master_vendor_id=$vendor_id AND community_id=$community_id");

                        if($res)
                        {

                          while($row = pg_fetch_assoc($res))
                          {
                            
                            $description = $row['description'];
                            $month_of_upload = $row['month_of_upload'];
                            $uploaded_date = $row['uploaded_date'];
                            $year_of_upload = $row['year_of_upload'];
                            $document_category = $row['document_category_id'];
                            $document_type = $row['document_type_id'];
                            $document_upload_type = $row['document_upload_type_id'];
                            $document_url = $row['url'];

                            if($uploaded_date != '')
                              $uploaded_date = date('m-d-Y', strtotime($uploaded_date));

                            echo "<tr><td><a href='https://hoaboardtime.com/getDocumentPreview.php?path=$document_url&desc=$description' target='_blank'>$uploaded_date</a></td><td><a href='https://hoaboardtime.com/getDocumentPreview.php?path=$document_url&desc=$description' target='_blank'>$description</a></td><td>$month_of_upload, $year_of_upload</td></tr>";

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

                  <center><h4><strong>Vendor Contracts</strong></h4></center>

                </div>

                <div class="box-body table-responsive">
                  
                  <table id='example2' class="table table-bordered">

                    <thead>
                      
                      <th>Active From</th>
                      <th>Active Until</th>
                      <th>Yearly Amount</th>
                      <th>Description</th>

                    </thead>

                    <tbody>

                      <?php

                        $res = pg_query("SELECT * FROM community_vendor_contracts WHERE vendor_id=$vendor_id AND community_id=$community_id ORDER BY active_from DESC");

                        if($res)
                        {

                          while($row = pg_fetch_assoc($res))
                          {
                            
                            $active_from = $row['active_from'];
                            $active_until = $row['active_until'];
                            $document = $row['document'];
                            $yearly_amount = $row['yearly_amount'];
                            $desc = $row['desc'];

                            if($yearly_amount == "")
                              $yearly_amount = 'N/A';
                            else
                              $yearly_amount = '$ '.$yearly_amount;

                            if($document != "")
                            {

                              $row1 = pg_fetch_assoc(pg_query("SELECT * FROM document_management WHERE document_id=$document"));

                              $document_url = $row1['url'];

                            }
                            else
                              $document_url = "N/A";

                            echo "<tr><td>".date('m-d-Y', strtotime($active_from))."</td><td>".date('m-d-Y', strtotime($active_until))."</td><td>$yearly_amount</td><td><a href='https://hoaboardtime.com/getDocumentPreview.php?path=$document_url&desc=$desc' target='_blank'>$desc</a></td></tr>";

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
        $("#example").DataTable({ "pageLength": 50 });

        $("#example1").DataTable({ "pageLength": 50 });

        $("#example2").DataTable({ "pageLength": 50 });
      });
    </script>

  </body>

</html>
