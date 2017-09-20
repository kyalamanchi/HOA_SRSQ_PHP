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

          <h1><strong>Community Assets</strong><small> - <?php echo $_SESSION['hoa_community_name']; ?></small></h1>

        </section>

        <section class="content">
          
          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-sm-12">

              <div class="box">

                <div class="box-body table-responsive">
                  
                  <table id="example1" class="table table-bordered table-striped">
                    
                    <thead>
                      
                      <tr>
                        
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Component</th>
                        <th>UL</th>
                        <th>RUL</th>
                        <th>Average Unit Cost</th>
                        <th>Asset Placement Date</th>
                        <th>Ideal Balance</th>
                        <th>Current Balance</th>
                        <th>Monthly Contribution</th>
                        <th>Quantity</th>
                        <th>Repair Type</th>
                        <th>UOM</th>

                      </tr>

                    </thead>

                    <tbody>

                      <?php

                        $result = pg_query("SELECT * FROM community_assets WHERE community_id=$community_id");

                        while ($row = pg_fetch_assoc($result)) 
                        {

                          $asset_category = $row['asset_category_id'];
                          $asset_sub_category = $row['asset_subcategory_id'];
                          $asset_component = $row['asset_component_id'];
                          $ul = $row['ul'];
                          $rul = $row['rul'];
                          $avg_unit_cost = $row['avg_unit_cost'];
                          $asset_placement_date = $row['asset_placement_date'];
                          $ideal_balance = $row['ideal_balance'];
                          $current_balance = $row['current_balance'];
                          $monthly_contributions = $row['monthly_contributions'];
                          $quantity = $row['quantity'];
                          $community_repair_type = $row['community_repair_type_id'];
                          $community_uom = $row['community_uom_id'];

                          if($asset_category != "")
                          {

                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM asset_category WHERE id=$asset_category"));
                            $asset_category = $row1['name'];
                            
                          }

                          if($asset_sub_category != "")
                          {

                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM asset_subcategory WHERE id=$asset_sub_category"));
                            $asset_sub_category = $row1['name'];
                            
                          }

                          if($community_repair_type != "")
                          {

                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM community_repair_type WHERE id=$community_repair_type"));
                            $community_repair_type = $row1['name'];
                            
                          }

                          if($community_uom != "")
                          {

                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM community_uom WHERE id=$community_uom"));
                            $community_uom = $row1['name'];
                            
                          }

                          if($asset_placement_date != "")
                            $asset_placement_date = date('m-d-Y', strtotime($asset_placement_date));

                          echo "<tr><td>$asset_category</td><td>$asset_sub_category</td><td>$asset_component</td><td>$ul</td><td>$rul</td><td>$ $avg_unit_cost</td><td>$asset_placement_date</td><td>$ $ideal_balance</td><td>$ $current_balance</td><td>$ $monthly_contributions</td><td>$quantity</td><td>$community_repair_type</td><td>$community_uom</td></tr>";

                        }

                      ?>
                    
                    </tbody>

                    <tfoot>

                      <tr>

                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Component</th>
                        <th>UL</th>
                        <th>RUL</th>
                        <th>Average Unit Cost</th>
                        <th>Asset Placement Date</th>
                        <th>Ideal Balance</th>
                        <th>Current Balance</th>
                        <th>Monthly Contribution</th>
                        <th>Quantity</th>
                        <th>Repair Type</th>
                        <th>UOM</th>

                      </tr>

                    </tfoot>

                  </table>

                  <br><br><br>

                  <div class="box box-solid">

                    <div class="box-body">

                      <div class="box-group" id="accordion">

                        <?php

                          $res = pg_query("SELECT asset_category_id, count(*) FROM community_assets WHERE community_id=$community_id GROUP BY asset_category_id");

                          while($row = pg_fetch_assoc($res))
                          {

                            echo $row['asset_category_id']." - - - ".$row['count']."<br>";

                          }

                        ?>

                        <div class="panel">

                          <div class="box-header with-border">

                            <h4 class="box-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                Collapsible Group Item #1
                              </a>
                            </h4>

                          </div>

                          <div id="collapseOne" class="panel-collapse collapse">

                            <div class="box-body">

                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                              wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                              eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                              assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                              nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                              farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                              labore sustainable VHS.

                            </div>

                          </div>

                        </div>

                        <div class="panel">

                          <div class="box-header with-border">

                            <h4 class="box-title">

                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                Collapsible Group Danger
                              </a>

                            </h4>

                          </div>

                          <div id="collapseTwo" class="panel-collapse collapse">

                            <div class="box-body">

                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                              wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                              eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                              assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                              nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                              farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                              labore sustainable VHS.

                            </div>

                          </div>

                        </div>

                        <div class="panel">

                          <div class="box-header with-border">

                            <h4 class="box-title">

                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                Collapsible Group Success
                              </a>

                            </h4>

                          </div>

                          <div id="collapseThree" class="panel-collapse collapse">

                            <div class="box-body">

                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                              wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                              eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                              assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                              nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                              farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                              labore sustainable VHS.

                            </div>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

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
        $("#example1").DataTable({ "pageLength": 50 });
      });
    </script>

  </body>

</html>