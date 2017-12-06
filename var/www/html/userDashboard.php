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
      	header("Location: https://hoaboardtime.com/logout.php");

      $community_id = $_SESSION['hoa_community_id'];
      $user_id=$_SESSION['hoa_user_id'];

      if($_SESSION['hoa_mode'] == 2)
        header("Location: https://hoaboardtime.com/residentDashboard.php");

    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <title><?php echo $_SESSION['hoa_community_name']; ?></title>
    
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="dist/js/googleanalytics.js"></script>

    <script type="text/javascript">
      var dimensionValue1 = '<?php echo $_SESSION['hoa_hoa_id'] ?>';
      var dimensionValue2 = "${communityInfo.communityCode}";
      if(<?php echo $community_id; ?> == 1)
        ga('create', 'UA-102881886-3', 'auto');
      else if(<?php echo $community_id; ?> == 2)
        ga('create', 'UA-102881886-2', 'auto');
      ga('set', 'dimension1', dimensionValue1);
      ga('set', 'dimension2', dimensionValue2);
      ga('send', 'pageview');
    </script>

  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    
    <div class="wrapper">

      <?php include 'boardHeader.php'; ?>
      
      <?php include 'boardNavigationMenu.php'; ?>

      <?php include 'zenDeskScript.php'; ?>

      <div class="content-wrapper">
        
        <section class="content-header">

          <h1><strong>User Dashboard</strong></h1>

          <ol class="breadcrumb">
            
            <li>User Dashboard</li>
          
          </ol>

        </section>

        <section class="content">

          <div class="row">

            <section class="col-xl-offset-2 col-lg-offset-2 col-md-offset-1 col-lg-8 col-xl-8 col-md-10 col-xs-12">

              <div class="box">

                <div class="box-body table-responsive">
                  
                  <center>

                    <div class="box-header with-border">
              
                      <h3 class="box-title"><?php echo $_SESSION['hoa_community_name']; ?> Users</h3>
            
                    </div>

                    <div class="box-body table-responsive">
                      
                      <table id='example1' class="table table-bordered">

                        <thead>

                          <th>Name</th>
                          <th>HOA ID</th>
                          <th>Address</th>
                          <th>Home ID</th>

                        </thead>

                        <tbody>

                          <?php

                            $i = 1;

                            $result = pg_query("SELECT * FROM homeid WHERE community_id=$community_id");

                            while($row = pg_fetch_assoc($result))
                            {
                              
                              $home_id = $row['home_id'];
                              $address = $row['address1'];

                              $row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE home_id=$home_id"));

                              $hoa_id = $row1['hoa_id'];
                              $firstname = $row1['firstname'];
                              $lastname = $row1['lastname'];

                              $ehoa_id = base64_encode($hoa_id);

                              echo "<tr><td><a class='btn btn-link' href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$ehoa_id'>".$firstname." ".$lastname."</a></td><td><a class='btn btn-link' href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$ehoa_id'>".$hoa_id."</a></td><td><a class='btn btn-link' href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$ehoa_id'>".$address."</a></td><td><a class='btn btn-link' href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$ehoa_id'>".$home_id."</a></td></tr>";

                            }

                          ?>
                        
                        </tbody>

                        <tfoot>

                          <th>Name</th>
                          <th>HOA ID</th>

                        </tfoot>
                        
                      </table>
                    
                    </div>

                  </center>

                </div>

              </div>

            </section>

          </div>

        </section>

      </div>

      <?php include "footer.php"; ?>

      <div class="control-sidebar-bg"></div>

    </div>

    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="plugins/knob/jquery.knob.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/fastclick/fastclick.js"></script>
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/pages/dashboard.js"></script>
    <script src="dist/js/demo.js"></script>

  </body>

</html>