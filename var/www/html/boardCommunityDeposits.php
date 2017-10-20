<!DOCTYPE html>
<html>
  <head>
    
    <?php

        ini_set("session.save_path","/var/www/html/session/");

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

                <li class='active treeview'>

                  <a>

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

          <h1><strong>YTD Income</strong> <small>- <?php echo $_SESSION['hoa_community_name']; ?></small></h1>

        </section>

        <section class="content">
          
          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-sm-12">

              <div class="box">

                <div class="box-body table-responsive">
                  
                  <table id="example1" class="table table-bordered table-striped">
                    
                    <thead>
                      
                      <tr>
                        
                        <th>Date</th>
                        <th>Deposit Type</th>
                        <th>Amount</th>
                        <th>Confirmation</th>

                      </tr>

                    </thead>

                    <tbody>

                      <?php 

                        if($community_id == 1)
                        {
                          
                          $ch  = curl_init('https://quickbooks.api.intuit.com/v3/company/123145854171542/query?minorversion=8');
                          
                          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                          curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Content-Type:application/text','Content-Type:application/text','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprd0JzDPeMNuATqXcic8hnusenW2",oauth_token="qyprdtnlpBxOlv0BmjUwWTfj29gEC0KrzOcJQHaiaUDajyIO",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="AdhLMYh%2FePI5JVFAvaTKZ2sjeG0%3D"'));
                          curl_setopt($ch, CURLOPT_POSTFIELDS, "SELECT * from Deposit startposition 1 maxresults 1000");
                          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

                          $result = curl_exec($ch);
                          $json_Decode = json_decode($result,TRUE);
                          $srp_Deposits = $json_Decode['QueryResponse'];

                          foreach ($srp_Deposits['Deposit'] as $Deposit) {
                              
                            echo "<tr><td>".date('m-d-Y', strtotime(nl2br($Deposit['TxnDate'])))."</td><td>".nl2br($Deposit['DepositToAccountRef']['name'])."</td><td>$ ".nl2br($Deposit['TotalAmt'])."</td><td>".nl2br($Deposit['PrivateNote'])."</td></tr>";

                          }

                        }
                        else if($community_id == 2)
                        {
                          
                          $ch  = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/query?minorversion=8');

                          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                          curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Content-Type:application/text','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1506452058",oauth_nonce="cEzWCgQy0l5",oauth_version="1.0",oauth_signature="KXtBMOAC0UjBuczxlE7tPlDyPN0%3D"'));
                          curl_setopt($ch, CURLOPT_POSTFIELDS, "SELECT * from Deposit startposition 1 maxresults 1000");
                          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

                          $result = curl_exec($ch);

                          $json_Decode = json_decode($result,TRUE);
                          $srp_Deposits = $json_Decode['QueryResponse'];

                          foreach ($srp_Deposits['Deposit'] as $Deposit) {
                              
                            echo "<tr><td>".date('m-d-Y', strtotime(nl2br($Deposit['TxnDate'])))."</td><td>".nl2br($Deposit['DepositToAccountRef']['name'])."</td><td>$ ".nl2br($Deposit['TotalAmt'])."</td><td>".nl2br($Deposit['PrivateNote'])."</td></tr>";

                          }

                        }

                      ?>
                    
                    </tbody>

                    <tfoot>

                      <tr>

                        <th>Date</th>
                        <th>Deposit Type</th>
                        <th>Amount</th>
                        <th>Confirmation</th>

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
        $("#example1").DataTable({ "pageLength": 50, "order": [[ 0, "desc" ]] });
      });
    </script>

  </body>

</html>
