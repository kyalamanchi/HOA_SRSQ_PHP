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
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   
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

          <h1><strong>Reset Password</strong></h1>

        </section>

        <section class="content">
          
          <div class='row container-fluid'>

            <div class="row container-fluid" style="background-color: white;">

              <br>

                <?php

                  $reset_email = $_POST['forgot_password_email'];

                  $result = pg_query("SELECT * FROM usr WHERE email='$reset_email'");

                  if(pg_num_rows($result) == 0)
                  {

                    echo "<center><h3>User not found.<br><br>Please verify your email and try again.</h3><script>setTimeout(function(){window.location.href='https://hoaboardtime.com/'},1000);</script></center>";

                  }
                  else
                  {

                    $to = 'geethchadalawada@gmail';#$reset_email;

                    $otp = rand(100000,1000000);

                    $row = pg_fetch_assoc($result);

                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $community_id = $row['community_id'];

                    switch ($community_id) {
                      case 1:
                        $community = 'SRP';
                        $cnote = "Stoneridgeplace HOA";
                        $api_key = 'NRqC1Izl9L8aU-lgm_LS2A';
                        $from = 'info@stoneridgeplace.org';
                          break;

                      case 2:
                        $community = 'SRSQ';
                        $cnote = "Stoneridge Square HOA";
                        $api_key = 'MO3K0X3fhNe4qFMX6jOTOw';
                        $from = 'info@stoneridgesquare.org';
                          break;
                    }                     
                  
                    $content = 'Hello '.$first_name.' '.$last_name.',<br><br>Please use '.$otp.' as OTP for reseting your HOA account password.<br><br>Thank you<br>'.$cnote.'.';
                    $subject = 'Password Reset for HOA account '.$hoa_id;
                    $uri = 'https://mandrillapp.com/api/1.0/messages/send.json';
                    $content_text = strip_tags($content);

                    $params = array(
                      "key" => $api_key,
                      "message" => array(
                        "html" => $content,
                        "text" => $content_text,
                        "subject" => $subject,
                        "from_email" => $from,
                        "from_name" => $from,
                        "to" => array(
                          array("email" => $to, "name" => $to)
                        ),
                        "track_opens" => true,
                        "track_clicks" => true,
                        "auto_text" => true,
                        "url_strip_qs" => true,
                        "preserve_recipients" => true
                      ),
                      "async" => false
                    );

                    $ch = curl_init();
                    $postString = json_encode($params);
                    
                    curl_setopt($ch, CURLOPT_URL, $uri);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
                    
                    $result = curl_exec($ch);

                    $result = json_decode($result,TRUE);

                    print_r($result);


                    echo "Hello ".$first_name." ".$last_name.",<br><br><br>Your account has been temporarily blocked. An OTP has been mailed to your email (".$reset_email.").<br>Please enter the OTP below to reset your HOA account password and unblock your account.<br><br><br>";

                    echo "
                    <form action='https://hoaboardtime.com/forgotPassword2.php' method='POST'>

                      <div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>
                        
                        <input class='form-control' type='number' name='' id='' required placeholder='Enter OTP here'>

                        <input type='hidden' name='forgot_password_email' id='forgot_password_email' value='".$reset_email."' >

                      </div>

                      <div class='col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 text-left'>

                        <button type='submit' class='btn btn-sm btn-info'>Reset</button>

                      </div>

                    </form>";

                  }

                ?>

              <br><br><br><br>

            </div>

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