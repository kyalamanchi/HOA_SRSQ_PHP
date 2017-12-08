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
      $user_id = $_SESSION['hoa_user_id'];
      $mode = $_SESSION['hoa_mode'];

      if($mode == 2)
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

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    
    <div class="wrapper">

      <?php if($mode == 1) include "boardHeader.php"; ?>
      
      <?php if($mode == 1) include 'boardNavigationMenu.php'; ?>

      <?php include 'zenDeskScript.php'; ?>

      <div class="content-wrapper">

        <?php

          $year = date("Y");
          $month = date("m");
          $end_date = date("t");

          $result = pg_query("SELECT * FROM community_invoices WHERE community_id=$community_id AND reserve_expense='t'");

          $today = date('Y-m-d');

        ?>
        
        <section class="content-header">

          <h1><strong>Mailing List</strong></h1>

          <ol class="breadcrumb">
            
            <?php if($mode == 1) echo "<li><i class='fa fa-institution'></i> Community</li>"; ?>

            <li>Mailing List</li>
          
          </ol>

        </section>

        <section class="content">
          
          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-sm-12">

              <div class="box">
                
                <div class="box-header">
                  <i class="fa fa-"></i>

                  <div class="box-tools pull-right">

                    <a type="button" href="mailingListCSV.php" class="btn bg-teal btn-sm">Export as .csv</a>

                  </div>

                </div>

                <div class="box-body table-responsive">
                  
                  <table id="example1" class="table table-bordered table-striped">
                    
                    <thead>
                      
                      <tr>
                        
                        <th>HOA ID</th>
                        <th>Name</th>
                        <th>Home ID</th>
                        <th>Mailing Address</th>
                        <th>Email</th>
                        <th>Phone</th>

                      </tr>

                    </thead>

                    <tbody>

                      <?php 

                        $result = pg_query("SELECT * FROM homeid WHERE community_id=$community_id");

                        while($row = pg_fetch_assoc($result))
                        {

                          $home_id = $row['home_id'];
                          $living_status = $row['living_status'];

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE home_id=$home_id"));

                          $hoa_id = $row1['hoa_id'];
                          $name = $row1['firstname'];
                          $name .= " ";
                          $name .= $row1['lastname'];
                          $email = $row1['email'];
                          $phone = $row1['cell_no'];

                          if($living_status == 't')
                          {
                            $address = $row['address1'];
                            $city = $row['city_id'];
                            $state = $row['state_id'];
                            $zip = $row['zip_id'];
                          }
                          else
                          {
                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM home_mailing_address WHERE home_id=$home_id"));

                            $address = $row1['address1'];
                            $city = $row1['city_id'];
                            $state = $row1['state_id'];
                            $zip = $row1['zip_id'];
                          }

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM city WHERE city_id=$city"));
                          $city = $row1['city_name'];

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM state WHERE state_id=$state"));
                          $state = $row1['state_code'];

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM zip WHERE zip_id=$zip"));
                          $zip = $row1['zip_code'];

                          if($email != '')
                          {
                                    
                            $arr = array();
                            $arr = explode('@', $email);
                            $email = $arr[0];
                            $i = strlen($email);

                            for($j = 3; $j < $i; $j++)
                              $email[$j] = '*';

                            $email = $email.'@'.$arr[1];

                            echo "<div class='modal fade hmodal-success' id='send_email_".$hoa_id."' role='dialog'  aria-hidden='true'>
                                
                            <div class='modal-dialog'>
                                              
                              <div class='modal-content'>
                                                  
                                <div class='color-line'></div>
                                  
                                  <div class='modal-header'>
                                                          
                                    <h4 class='modal-title'>Send Email to ".$name." - ".$email."</h4>

                                  </div>

                                  <form class='row' method='post' action='https://hoaboardtime.com/boardEditHOAID2.php'>
                                                      
                                    <div class='modal-body'>
                                        
                                        <div class='row container-fluid'>
                                
                                          <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                                            <label>First Name</label>
                                            <input type='text' class='form-control' name='edit_firstname' id='edit_firstname' value='$firstname' readonly>
                                          </div>
                                                
                                          <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                                            <label>Last Name</label>
                                            <input type='text' class='form-control' name='edit_lastname' id='edit_lastname' value='$lastname' readonly>
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

                                        <center>
                                        <button type='submit' name='submit' id='submit' class='btn btn-success btn-xs'><i class='fa fa-check'></i>Update</button>
                                        <button type='button' class='btn btn-warning btn-xs' data-dismiss='modal'><i class='fa fa-close'></i>Cancel</button>
                                        </center>

                                    </div>

                                  </form>

                                </div>
                            
                              </div>

                            </div>";

                            $email = "<a data-toggle='modal' data-target='#send_email_".$hoa_id."'>".$email."</a>";

                          }

                          echo "<tr><td>".$hoa_id."</td><td><a title='User Dashboard' href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$hoa_id'>".$name."</a></td><td>".$home_id."</td><td>".$address.", ".$city." ".$state." ".$zip."</td><td>".$email."</td><td>".$phone."</td></tr>";

                        }

                      ?>
                    
                    </tbody>

                    <tfoot>

                      <tr>

                        <th>HOA ID</th>
                        <th>Name</th>
                        <th>Home ID</th>
                        <th>Mailing Address</th>
                        <th>Email</th>
                        <th>Phone</th>

                      </tr>

                    </tfoot>

                  </table>

                </div>

              </div>

            </section>

          </div>

        </section>

      </div>

      <?php include 'footer.php'; ?>

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