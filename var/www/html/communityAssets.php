<!DOCTYPE html>
<html>
  <head>
    
    <?php

      session_start();

      pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

      $community_id = 2;

      if(@$_SESSION['hoa_username'])
        header("Location: logout.php");

      $year = date("Y");
      $month = date("m");
      $end_date = date("t");

    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <title>Stoneridge Square Association</title>
    
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
        
        <a href="https://hoaboardtime.com/srsq.php" class="logo">
          
          <span class="logo-mini">SRSQ</span>
          
          <span class="logo-lg">Stoneridge Square Association</span>

        </a>
        
        <nav class="navbar navbar-static-top">
          
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            
            <ul class="nav navbar-nav">
              
              <li class="dropdown user user-menu">
                
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  
                  <i class="fa fa-sign-in"></i> Log In

                </a>

                <ul class="dropdown-menu">
                  
                  <form class="container-fluid" method="POST" action="https://hoaboardtime.com/login.php">
                    
                    <li class="user-body">

                      <br>

                      <label for='login_email'>Email</label>
                      <input class='form-control' type='email' name='login_email' id='login_email' placeholder='example@email.com' required>

                      <br>

                      <label for='login_password'>Password</label>
                      <input class='form-control' type='password' name='login_password' id='login_password' placeholder='********' required>

                      <br>

                    </li>
                    
                    <li class="user-footer">

                      <div class="pull-left">

                        <a href="" class="btn btn-link btn-flat">Forgot Password?</a>

                        <br><br>

                      </div>

                      <div class="pull-right">

                        <button type="submit" class="btn btn-success btn-flat">Log In</button>

                        <br><br>

                      </div>

                    </li>

                  </form>

                </ul>

              </li>

            </ul>

          </div>

        </nav>

      </header>
      
      <aside class="main-sidebar">
        
        <section class="sidebar">
          
          <ul class="sidebar-menu">
            
            <li class="treeview">
              
              <a href="https://hoaboardtime.com/">
                
                <i class="fa fa-home"></i> <span>Home</span>

              </a>

            </li>

            <li class="treeview">
              
              <a href="https://hoaboardtime.com#getInvolved">
                
                <i class="fa fa-comment"></i> <span>Get Involved</span>

              </a>

            </li>

            <li class="treeview">
              
              <a target='_blank' href='http://stoneridgesquare.us12.list-manage.com/subscribe?u=12a11bf64aa26b44b5b667427&id=09692e90bd'>
               
                <i class='fa fa-envelope'></i> <span>Mailing List</span>

              </a>

            </li>
             
            <li class="treeview">

              <a href='https://hoaboardtime.com#pay'>

                <i class='fa fa-dollar'></i> <span>Make a payment</span>
              
              </a>

            </li>
            
            <li class="treeview">
              
              <a href='https://hoaboardtime.com#pool'>

                <i class='fa fa-pencil-square-o'></i> <span>Pool Signin</span>

              </a>

            </li>
            
            <li class="treeview">

              <a href='https://hoaboardtime.com#resale'>

                <i class='fa fa-sitemap'></i> <span>Resale Docs</span>

              </a>

            </li>
            
            <li class="treeview">

              <a href='https://hoaboardtime.com#contact'>
              
                <i class='fa fa-phone'></i> <span>Contact</span>

              </a>

            </li>

          </ul>

        </section>

      </aside>

      <div class="content-wrapper">
        
        <section class="content-header">

          <h1><strong>Community Assets</strong><small> - Stoneridge Square Association</small></h1>

        </section>

        <section class="content">
          
          <div class="row container-fluid table-responsive" style="background-color: white;">

            <br><br>

            <table id='example1' class="table table-bordered">

              <thead>

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
                
              </thead>

              <tbody>

                <?php

                  $result = pg_query("SELECT * FROM community_assets WHERE community_id=$community_id");

                  while ($row = pg_fetch_assoc($result)) 
                  {

                    $asset_category = $row['asset_category_id'];
                    $asset_sub_category = $row['asset_sub_category_id'];
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

                    echo "<tr><td>$asset_category</td><td>$asset_sub_category</td><td>$asset_component</td><td>$ul</td><td>$rul</td><td>$avg_unit_cost</td><td>$asset_placement_date</td><td>$ $ideal_balance</td><td>$ $current_balance</td><td>$monthly_contributions</td><td>$quantity</td><td>$community_repair_type</td><td>$community_uom</td></tr>";

                  }

                ?>

              </tbody>
              
            </table>

            <br><br>

          </div>

        </section>

      </div>

      <footer class="main-footer">

        <div class="pull-right hidden-xs"></div>
        
        <strong>Copyright &copy; <?php echo date('Y'); ?> <a target='_blank' href="https://www.stoneridgesquare.org">Stoneridge Square Association</a>.</strong> All rights
        reserved.

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