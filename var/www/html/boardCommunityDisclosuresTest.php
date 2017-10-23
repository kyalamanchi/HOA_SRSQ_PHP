<?php

  ini_set("session.save_path","/var/www/html/session/");

  session_start();
        
?>

<!DOCTYPE html>
<html>
  <head>
    
    <?php

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

                <li class='active ytreeview'>

                  <a>

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

          <h1><strong>Community Disclosures</strong></h1>

        </section>

        <section class="content">
          
          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-sm-12">

              <div class="box">

                <div class="box-header">

                  <div class="row text-center container-fluid">

                    <h4>Fisal Year : 01-01-<?php echo $year; ?> to 12-31-<?php echo $year; ?></h4>

                  </div>

                </div>

                <div class="box-body table-responsive">
                  
                  <table id="example1" class="table table-bordered table-striped">
                    
                    <thead>
                      
                      <tr>
                        
                        <th>Legal Date From</th>
                        <th>Legal Date Until</th>
                        <th>Actual Date</th>
                        <th>Disclosure Type</th>
                        <th>Description</th>
                        <th>Delivery Type</th>
                        <th>Civil Code Section</th>
                        <th>Notes</th>

                      </tr>

                    </thead>

                    <tbody>

                      <?php 

                        $query = "SELECT * FROM community_disclosures WHERE community_id=".$community_id;

                        $result = pg_query($query);
                                                            
                        if($result)
                        {
                          
                          while ($row=pg_fetch_assoc($result)) 
                          {
                                            
                            $id = $row['id'];
                            $type_id = $row['type_id'];
                            $legal_date_from = $row['legal_date_from'];
                            $legal_date_until = $row['legal_date_until'];
                            $actual_date = $row['actual_date'];
                            $delivery_type = $row['delivery_type'];
                            $fiscal_year_start = $row['fiscal_year_start'];
                            $fiscal_year_end = $row['fiscal_year_end'];
                            $notes = $row['notes'];
                            if ( $row['document_id'] ){
                              $notes = "<a href=\"https://www.google.com\" target=\"_blank\">View Document</a>";
                            }

                            $result2 = pg_query("SELECT * FROM community_disclosure_type WHERE id=".$type_id);
                            $row2 = pg_fetch_assoc($result2);

                            if($actual_date != "")
                              $actual_date = date("m-d-Y", strtotime($actual_date));

                            $name = $row2['name'];
                            $desc = $row2['desc'];
                            $civilcode_section = $row2['civilcode_section'];

                            echo "

                            <div class='modal fade hmodal-success' id='editDisclosure_$id' role='dialog'  aria-hidden='true'>
                                  
                              <div class='modal-dialog'>
                                                        
                                <div class='modal-content'>
                                            
                                  <div class='modal-header'>
                                                                    
                                    <h4 class='modal-title'>Edit Disclosure - <strong>".$name."</strong></h4>

                                  </div>

                                  <div class='modal-body'>
                                                                    
                                    <div class='container-fluid'>

                                      <form class='row' method='post' action='https://hoaboardtime.com/boardEditDisclosure.php'>

                                        <div class='row container-fluid'>

                                          <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                            <label>Disclosure Type</label>
                                            <select class='form-control' name='edit_disclosure_type' id='edit_disclosure_type' required>

                                              <option value='' selected disabled>Select Disclosure Type</option>";

                                              $ree = pg_query("SELECT * FROM community_disclosure_type");

                                              while($roo = pg_fetch_assoc($ree))
                                              {

                                                $did = $roo['id'];
                                                $dname = $roo['name'];
                                                $ddesc = $roo['desc'];

                                                echo "<option ";

                                                if($dname == $name)
                                                  echo " selected ";

                                                echo "value='$did'>$dname</option>";
                                              }

                                            echo "</select>

                                          </div>

                                          <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                            <label>Actual Date</label>
                                            <input type='date' class='form-control' name='edit_actual_date' id='edit_actual_date' value='$actual_date'>

                                            <input type='hidden' name='disclosure_id' id='disclosure_id' value='$id'>

                                          </div>

                                        </div>

                                        <br>

                                        <div class='row container-fluid'>

                                          <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                            <label>Notes</label>
                                            <textarea id='edit_notes' name='edit_notes' class='form-control'>$notes</textarea>

                                          </div>

                                        </div>

                                        <br>

                                        <div class='row container-fluid text-center'>
                                                
                                          <button type='submit' name='submit' id='submit' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Update</button>
                                          <button type='button' class='btn btn-warning btn-xs' data-dismiss='modal'><i class='fa fa-close'></i> Cancel</button>

                                        </div>

                                      </form>
                                                                    
                                    </div>

                                  </div>

                                </div>
                                      
                              </div>

                            </div>

                            ";

                            echo "<tr><td><a title='Edit Disclosure' data-toggle='modal' data-target='#editDisclosure_$id'>".date("m-d-Y", strtotime($legal_date_from))."</a></td><td><a title='Edit Disclosure' data-toggle='modal' data-target='#editDisclosure_$id'>".date("m-d-Y", strtotime($legal_date_until))."</a></td><td><a title='Edit Disclosure' data-toggle='modal' data-target='#editDisclosure_$id'>".$actual_date."</a></td><td>".$name."</td><td>".$desc."</td><td>".$delivery_type."</td><td>".$civilcode_section."</td><td>".$notes."</td></tr>";

                          }

                        } 

                      ?>
                    
                    </tbody>

                    <tfoot>

                      <tr>

                        <th>Legal Date From</th>
                        <th>Legal Date Until</th>
                        <th>Actual Date</th>
                        <th>Disclosure Type</th>
                        <th>Description</th>
                        <th>Delivery Type</th>
                        <th>Civil Code Section</th>
                        <th>Notes</th>

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
    <script src="plugins/select2/select2.full.min.js"></script>

    <script>
      $(function () {
        $("#example1").DataTable({ "pageLength": 50, "order": [[ 0, "desc" ]] });

        $(".select2").select2();
      });
    </script>

  </body>

</html>