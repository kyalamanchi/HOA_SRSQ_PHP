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
              
                    <a href="https://hoaboardtime.com/residentDashboard.php">
                
                      <i class="fa fa-dashboard"></i> <span><?php if($board) echo "Resident "; ?>Dashboard</span>

                    </a>

                </li>
            
                <li class="treeview">
              
                    <a href="https://hoaboardtime.com/residentDocumentManagement.php">

                      <i class="glyphicon glyphicon-hdd"></i> <span>Document Management</span>

                    </a>

                </li>
             
                <li class="treeview">

                    <a href='https://hoaboardtime.com/residentMeetingMinutes.php'>

                      <i class='fa fa-folder'></i> <span>Meeting Minutes</span>
              
                    </a>

                </li>
            
                <li class="treeview">
              
                    <a href='https://hoaboardtime.com/residentQuickPay.php'>

                      <i class='fa fa-dollar'></i> <span>Quick Pay</span>

                    </a>

                </li>

                <li class="treeview">

                    <a href="">
                
                      <i class="glyphicon glyphicon-option-horizontal"></i>
                
                      <span>Other Links</span>
                
                      <span class="pull-right-container">
                  
                          <i class="fa fa-angle-left pull-right"></i>

                      </span>

                    </a>

                    <ul class="treeview-menu">
                
                      <li><a href="https://hoaboardtime.com/residentRecurringPay.php"><i class="fa fa-circle-o text-orange"></i> Recurring Pay</a></li>
                      <li><a href="https://hoaboardtime.com/residentReportViolation.php"><i class="fa fa-circle-o text-success"></i> Report Violation</a></li>

                    </ul>

                </li>

              </ul>

          </section>

        </aside>

      <div class="content-wrapper">

        <?php

        	$year = date("Y");
        	$month = date("m");
        	$end_date = date("t");

          $row = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));

          $email = $row['email'];
          $cell_no = $row['cell_no'];
          $firstname = $row['firstname'];
          $lastname = $row['lastname'];

        ?>

        <section class="content-header">

          <h1><strong>My Profile</strong></h1>

        </section>

        <section class="content">
          
          <div class="row">

            <section class="col-xl-offset-4 col-lg-offset-4 col-md-offset-3 col-xs-offset-1 col-xl-4 col-lg-4 col-md-6 col-xs-10">

              <div class="nav-tabs-custom">
                
                <form method="POST" class="box container-fluid" action="residentUpdateProfile.php">

                  <br>

                  <div class="row container-fluid 
                  form-group">

                    <label>First Name</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" required readonly value="<?php echo $firstname; ?>">

                    <label>Last Name</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" required readonly value="<?php echo $lastname; ?>">

                    <label>Email</label>
                    <input type="email" class="form-control" name="email" id="email" required <?php if($email != "") echo "readonly"; ?> value="<?php echo $email; ?>">

                    <label>Cell Number</label>
                    <input type="number" class="form-control" name="cell_no" id="cell_no" required value="<?php echo $cell_no; ?>">

                  </div>

                  <div class="row form-group">

                    <center><button class="btn btn-info btn-sm" type="submit">Update</button></center>

                  </div>

                  <br>

                </form>

                <center><a data-toggle="modal" data-target="#changePassword">Change Password</a></center>

                <br>

                <div class="modal fade hmodal-success" id="changePassword" role="dialog"  aria-hidden="true">
                                
                  <div class="modal-dialog">
                                    
                    <div class="modal-content">
                                        
                      <div class="color-line"></div>
                        
                        <div class="modal-header">
                                                
                          <h4 class="modal-title">Change Password</h4>

                        </div>

                        <form class="row" method="post" action="https://hoaboardtime.com/residentChangePassword.php">
                                            
                          <div class="modal-body">
                                                
                            <center>
                              
                              <div class="row">
                                
                                Current Password : <input type='password' name='old_password' id='old_password' size='20' required>

                              </div>

                              <br>

                              <div class="row">
                                
                                New Password : <input type='password' name='new_password' id='new_password' size='20' required>

                              </div>

                              <br>

                              <div class="row">
                                
                                Re-type Password : <input type='password' name='confirm_password' id='confirm_password' size='20' required>

                              </div>

                              <br><br>

                              <button type="submit" name='submit' id='submit' class="btn btn-success btn-sm">Change Password</button>
                              <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Cancel</button>
                                                
                          </center>

                        </div>

                      </form>

                    </div>
                  
                  </div>

                </div>

              </div>

            </section>

            <div class="clearfix"></div>

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
