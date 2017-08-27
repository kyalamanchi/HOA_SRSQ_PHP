<!DOCTYPE html>
<html>
  <head>
    
    <?php

        session_start();

        pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

        if(@!$_SESSION['hoa_username'])
          header("Location: logout.php");

        $community_id = $_SESSION['hoa_community_id'];

        $query = "SELECT * FROM board_committee_details WHERE user_id=".$_SESSION['hoa_user_id'];
        $result = pg_query($query);
        $board = pg_num_rows($result);

        $hoa_id = $_SESSION['hoa_hoa_id'];
        $home_id = $_SESSION['hoa_home_id'];

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
    <script scr='plugins/ckeditor/adapters/jquery.js'></script>

    <script>
      $(document).ready(function(){
        $('#make').change(function(){
          var make_id = $(this).val();
          $.ajax({
            url:"get_model.php",
            type:"POST",
            data:{make_id:make_id},
            success:function(html)
            {
              $('#model').html(html);
            }
          });
        });
      });
    </script>

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

                  <?php

                    if($board)
                    echo "<li class='dropdown user user-menu'>
                  
                      <a href='boardDashboard.php'>Board Dashboard</a>

                    </li>";

                  ?>

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

                              <a href="logout.php" class="btn btn-warning">Log Out</a>

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
            
                <li class="header text-center"> Quick Links </li>

                <li class="treeview">
              
                    <a href='https://hoaboardtime.com/residentDashboard.php'>
                
                      <i class="fa fa-dashboard"></i> <span><?php if($board) echo "Resident "; ?>Dashboard</span>

                    </a>

                </li>
            
                <li class="treeview">
              
                    <a>

                      <i class="glyphicon glyphicon-hdd"></i> <span>Document Management</span>

                    </a>

                </li>
             
                <li class="treeview">

                    <a href="https://hoaboardtime.com/residentViewMeetingMinutes.php">

                      <i class='fa fa-folder'></i> <span>Meeting Minutes</span>
              
                    </a>

                </li>
            
                <li class="treeview">
              
                    <a href='https://hoaboardtime.com/residentQuickPay.php'>

                      <i class='fa fa-dollar'></i> <span>Quick Pay</span>

                    </a>

                </li>

                <li class="treeview">

                    <a href='https://hoaboardtime.com/residentRecurringPay.php'>

                      <i class='fa fa-repeat'></i> <span>Recurring Pay</span>
              
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

          $result = pg_query("SELECT * FROM home_tags WHERE community_id=$community_id AND hoa_id=$hoa_id AND type=1");

        ?>
        
        <section class="content-header">

          <h1><strong>My Parking Tags</strong></h1>

        </section>

        <section class="content">
          
          <div class="row">

          	<section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-sm-12">

              <div class="box">

                <div class="box-body table-responsive">
                  
                  <table id="example1" class="table table-bordered table-striped">
                    
                    <thead>
                      
                      <tr>
                        
                        <th></th>
                        <th>Date Issued</th>
                        <th>Valid From</th>
                        <th>Valid Until</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Color</th>
                        <th>Year</th>
                        <th>Plate</th>
                        <th></th>

                      </tr>

                    </thead>

                    <tbody>

                      <?php 

                        function decrypt_string($input)
                        {
                          
                          $input_count = strlen($input);
                                                                                             
                          $dec = explode(".", $input);// splits up the string to any array
                          $x = count($dec);
                          $y = $x-1;// To get the key of the last bit in the array 
                                                                                             
                          $calc = $dec[$y]-50;
                          $randkey = chr($calc);// works out the randkey number
                                                                                             
                          $i = 0;
                                                                                             
                          while ($i < $y)
                          {
                                                                                             
                            $array[$i] = $dec[$i]+$randkey; // Works out the ascii characters actual numbers
                            @$real .= chr($array[$i]); //The actual decryption
                                                                                             
                            $i++;

                          };
                                                                                             
                          @$input = $real;
                          return $input;

                        }

                        while($row = pg_fetch_assoc($result))
                        {

                          $issued_on = $row['issued_on'];
                          $valid_from = $row['valid_from'];
                          $valid_until = $row['valid_until'];
                          $detail = $row['detail'];

                          if($issued_on != "")
                            $issued_on = date('m-d-Y', strtotime($issued_on));

                          if($valid_from != "")
                            $valid_from = date('m-d-Y', strtotime($valid_from));

                          if($valid_until != "")
                            $valid_until = date('m-d-Y', strtotime($valid_until));

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM car_detail WHERE id=$detail"));

                          $make = $row1['car_make_id'];
                          $model = $row1['car_model_id'];
                          $color = $row1['car_color_id'];
                          $year = $row1['year'];
                          $plate = $row1['notes'];

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM car_make WHERE id=$make"));

                          $make = $row1['name'];

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM car_model WHERE id=$model"));

                          $model = $row1['name'];

                          $row1 = pg_fetch_assoc(pg_query("SELECT * FROM car_color WHERE id=$color"));

                          $color = $row1['name'];

                          if($plate != "")
                          {

                            $plate = base64_decode($plate);

                            $plate = decrypt_string($plate);

                          }

                          echo "
                          
                          <div class='modal fade hmodal-success' id='editTag_".$plate."' role='dialog'  aria-hidden='true'>
                                
                            <div class='modal-dialog'>
                                              
                              <div class='modal-content'>
                                                  
                                <div class='color-line'></div>
                                  
                                  <div class='modal-header'>
                                                          
                                    <h4 class='modal-title'>Edit Tag - ".$plate."</h4>

                                  </div>

                                  <form class='row' method='post' action='https://hoaboardtime.com/boardEditParkingTag.php'>
                                                      
                                    <div class='modal-body'>
                                        
                                      Edit Tag

                                    </div>

                                  </form>

                                </div>
                            
                              </div>

                            </div>

                            ";

                          echo "
                          
                          <div class='modal fade hmodal-success' id='removeTag_".$plate."' role='dialog'  aria-hidden='true'>
                                
                            <div class='modal-dialog'>
                                              
                              <div class='modal-content'>
                                                  
                                <div class='color-line'></div>
                                  
                                  <div class='modal-header'>
                                                          
                                    <h4 class='modal-title'>Remove Tag - ".$plate."</h4>

                                  </div>

                                  <div class='modal-body'>
                                        
                                    <form method='POST' action='https://hoaboardtime.com/residentRemoveParkingTag.php'>

                                      <center>

                                      <input type='hidden' name='plate' id='plate' value='".$plate."'>

                                        <h4>You are about to remove tag for <strong>$plate</strong>.</h4><br><br><h3><b>Are you sure you want to continue?</b></h3><br><small>This action cannot be undone.</small><br><br>

                                        <button type='submit' class='btn btn-warning btn-sm'>Remove</button> <button type='button' class='btn btn-success btn-sm' data-dismiss='modal'>Cancel</button>

                                      </center>

                                    </form>

                                  </div>

                                </div>
                            
                              </div>

                            </div>

                            ";

                          echo "<tr><td><a data-toggle='modal' data-target='#editTag_".$plate."' class='btn btn-link'>Edit</a></td><td>".$issued_on."</td><td>".$valid_from."</td><td>".$valid_until."</td><td>".$make."</td><td>".$model."</td><td>".$color."</td><td>".$year."</td><td>".$plate."</td><td><a data-toggle='modal' data-target='#removeTag_".$plate."' class='btn btn-link'>Remove</a></td></tr>";
                          
                        }

                      ?>
                    
                    </tbody>

                  </table>

                </div>

              </div>

            </section>

          </div>

        </section>

        <!--section class="content-header">

          <h1><strong>Add New Parking Tags</strong></h1>

        </section>

        <section class="content">
          
          <div class="row">

            <section class="col-lg-12 col-xl-12 col-md-12 col-xs-12 col-sm-12">

              <div class="box">

                <div class="box-body table-responsive">
                  
                  <table class="table table-bordered table-striped">
                    
                    <thead>
                      
                      <tr>
                        
                        <th>Make</th>
                        <th>Model</th>
                        <th>Color</th>
                        <th>Year</th>
                        <th>Plate</th>
                        <th></th>

                      </tr>

                    </thead>

                    <tbody>

                      <tr>

                        <form rolw='form' method='POST' action=''>
                        
                          <td>
                            
                            <select id='make' name='make' required>

                              <?php

                                $result1 = pg_query("SELECT * FROM car_make");

                                while($row1 = pg_fetch_assoc($result1))
                                {

                                  $id = $row1['id'];
                                  $name = $row1['name'];

                                  echo "<option value='$id'>$name - $id</option>";

                                }

                              ?>

                            </select>

                          </td>

                          <td>
                            
                            <select id='model' name='model' required></select>

                          </td>

                          <td>
                            
                            <select id='color' name='color' class='form-control' required>

                              <?php

                                $result1 = pg_query("SELECT * FROM car_color");

                                while($row1 = pg_fetch_assoc($result1))
                                {

                                  $id = $row1['id'];
                                  $name = $row1['name'];

                                  echo "<option value='$id'>$name</option>";

                                }

                              ?>

                            </select>

                          </td>

                          <td>
                            
                            <input class='form-control' type='number' id='year' name='year' required>

                          </td>

                          <td>
                            
                            <input class='form-control' type='text' name='plate' id='plate' required>

                          </td>

                          <td>
                            
                            <button type='submit' class='btn-xs btn-info'>Add Tag</button>

                          </td>

                        </form>

                      </tr>
                    
                    </tbody>

                  </table>

                </div>

              </div>

            </section>

          </div>

        </section-->

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