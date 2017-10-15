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

                  <a href="https://hoaboardtime.com/boardCommunityExpenses.php">

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
                
                <li class='active treeview'>

                  <a>

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

          <h1><strong>View Reminders</strong></h1>

        </section>

        <section class="content">
          
          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-sm-12">

              <div class="box">

                <div class="box-body table-responsive">
                  
                  <table id="example1" class="table table-bordered table-striped">
                    
                    <thead>
                      
                      <tr>
                        
                        <th>Open Date</th>
                        <th>Due Date</th>
                        <th>Date Updated</th>
                        <th>Assigned To</th>
                        <th>Address</th>
                        <th>Reminder Type</th>
                        <th>Comments</th>
                        <th>Vendor Assigned</th>
                        <th></th>
                        <th></th>

                      </tr>

                    </thead>

                    <tbody>

                      <?php 

                        $result = pg_query("SELECT * FROM reminders WHERE community_id=$community_id");
                                                            
                        if($result)
                        {
                          
                          while ($row = pg_fetch_assoc($result)) 
                          {
                                            
                            $rid = $row['id'];
                            $open_date = $row['open_date'];
                            $due_date = $row['due_date'];
                            $date_updated = $row['update_date'];
                            $hoa_id = $row['hoa_id'];
                            $home_id = $row['home_id'];
                            $reminder_type = $row['reminder_type_id'];
                            $comments = $row['comments'];
                            $vendor_assigned = $row['vendor_assigned'];
                            $reminder_status_id = $row['reminder_status_id'];

                            $row2 = pg_fetch_assoc(pg_query("SELECT address1 FROM homeid WHERE home_id=$home_id"));
                            $address = $row2['address1'];

                            $row2 = pg_fetch_assoc(pg_query("SELECT firstname, lastname FROM hoaid WHERE hoa_id=$hoa_id"));
                            $name = $row2['firstname'];
                            $name .= " ";
                            $name .= $row2['lastname'];

                            $row2 = pg_fetch_assoc(pg_query("SELECT * FROM reminder_type WHERE id=$reminder_type"));
                            $reminder_type = $row2['reminder_type'];

                            if($vendor_assigned != "")
                            {
                              $row2 = pg_fetch_assoc(pg_query("SELECT * FROM vendor_master WHERE vendor_id=$vendor_assigned"));
                              $vendor_assigned = $row2['vendor_name'];
                            }

                            echo "

                            <div class='modal fade hmodal-success' id='editReminder_$rid' role='dialog'  aria-hidden='true'>
                                  
                              <div class='modal-dialog'>
                                                        
                                <div class='modal-content'>
                                            
                                  <div class='modal-header'>
                                                                    
                                    <h4 class='modal-title'>Edit Reminder - <strong>".$name."</strong></h4>

                                  </div>

                                  <div class='modal-body'>
                                                                    
                                    <div class='container-fluid'>

                                      <form class='row' method='post' action='https://hoaboardtime.com/boardEditReminder.php'>

                                        <div class='row container-fluid'>

                                          <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                            <label>Open Date</label>
                                            <input class='form-control' type='date' name='edit_reminder_open_date' id='edit_reminder_open_date' value='$open_date' readonly>

                                          </div>

                                          <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                            <label>Due Date</label>
                                            <input class='form-control' type='date' name='edit_reminder_due_date' id='edit_reminder_due_date' value='$due_date' required>

                                          </div>

                                        </div>

                                        <br>

                                        <div class='row container-fluid'>

                                          <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                            <label>Reminder Type</label>
                                            <select class='form-control' type='date' name='edit_reminder_type' id='edit_reminder_type' required>

                                              <option value='' selected disabled>Select Reminder Type</option>";

                                              $ree = pg_query("SELECT * FROM reminder_type ORDER BY reminder_type");

                                              while($roo = pg_fetch_assoc($ree))
                                              {

                                                $r_id = $roo['id'];
                                                $r_type = $roo['reminder_type'];

                                                echo "<option ";

                                                if($r_type == $reminder_type)
                                                  echo " selected ";

                                                echo "value='$r_id'>$r_type</option>";
                                              }

                                            echo "</select>

                                          </div>

                                          <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                            <label>Vendor Assigned</label>
                                            <select class='form-control' type='date' name='edit_vendor' id='edit_vendor'>

                                              <option value='' selected>NONE</option>";

                                              $ree = pg_query("SELECT * FROM vendor_master WHERE community_id=$community_id");

                                              while($roo = pg_fetch_assoc($ree))
                                              {

                                                $vendor_id = $roo['vendor_id'];
                                                $vendor_name = $roo['vendor_name'];

                                                echo "<option ";

                                                if($vendor_name == $vendor_assigned)
                                                  echo " selected ";

                                                echo "value='$vendor_id'>$vendor_name</option>";
                                              }

                                            echo "</select>

                                            <input type='hidden' name='reminder_id' id='reminder_id' value='$rid'>

                                          </div>

                                        </div>

                                        <br>

                                        <div class='row container-fluid'>

                                          <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                            <label>Comment</label>
                                            <textarea id='edit_comment' name='edit_comment' class='form-control' required>$comments</textarea>

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

                            echo "
                          
                            <div class='modal fade hmodal-success' id='deleteReminder_$rid' role='dialog'  aria-hidden='true'>
                                
                              <div class='modal-dialog'>
                                              
                                <div class='modal-content'>
                                  
                                  <div class='modal-header'>
                                                          
                                    <h4 class='modal-title'>Delete Reminder - $name</h4>

                                  </div>

                                  <div class='modal-body'>
                                        
                                    <form method='POST' action='https://hoaboardtime.com/boardDeleteReminder.php'>

                                      <center>

                                        <input type='hidden' name='reminder_id' id='reminder_id' value='$rid'>

                                        <h4>You are about to delete reminder for <strong>$name</strong>.</h4><br><br><h3><b>Are you sure you want to continue?</b></h3><br><small>This action cannot be undone.</small><br><br>

                                        <button type='submit' class='btn btn-warning btn-sm'>Remove</button> <button type='button' class='btn btn-success btn-sm' data-dismiss='modal'>Cancel</button>

                                      </center>

                                    </form>

                                  </div>

                                </div>
                            
                              </div>

                            </div>

                            ";

                            if($reminder_status_id == 1)
                              echo "<tr><td>".date('m-d-Y', strtotime($open_date))."</td><td>".date('m-d-Y', strtotime($due_date))."</td><td>".date('m-d-Y', strtotime($date_updated))."</td><td><a title='User Dashboard' href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$hoa_id'>".$name."<br>(".$hoa_id.")</a></td><td>".$address."<br>(".$home_id.")</td><td>".$reminder_type."</td><td>".$comments."</td><td>".$vendor_assigned."</td><td><center><a title='Edit Reminder' data-toggle='modal' data-target='#editReminder_$rid'><i class='text-blue fa fa-edit'></i></a></center></td><td><center><a title='Delete Reminder' data-toggle='modal' data-target='#deleteReminder_$rid'><i class='text-red fa fa-close'></i></a></center></td></tr>";
                            else if($reminder_status_id == 2)
                              echo "<tr style='color: orange;'><td>".date('m-d-Y', strtotime($open_date))."</td><td>".date('m-d-Y', strtotime($due_date))."</td><td>".date('m-d-Y', strtotime($date_updated))."</td><td>".$name."<br>(".$hoa_id.")</td><td>".$address."<br>(".$home_id.")</td><td>".$reminder_type."</td><td>".$comments."</td><td>".$vendor_assigned."</td><td></td><td></td></tr>";

                          }

                        } 

                      ?>
                    
                    </tbody>

                    <tfoot>

                      <tr>

                        <th>Open Date</th>
                        <th>Due Date</th>
                        <th>Date Updated</th>
                        <th>Assigned To</th>
                        <th>Address</th>
                        <th>Reminder Type</th>
                        <th>Comments</th>
                        <th>Vendor Assigned</th>
                        <th></th>
                        <th></th>

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