<?php

  ini_set("session.save_path","/var/www/html/session/");

  session_start();

?>

<!DOCTYPE html>

<html>

  <head>
    
    <?php

      if(@!$_SESSION['hoa_username'])
      	header("Location: https://hoaboardtime.com/logout.php");

      $community_id = $_SESSION['hoa_community_id'];
      $user_id=$_SESSION['hoa_user_id'];

      if($community_id == 1)
        pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");
      else if($community_id == 2)
        pg_connect("host=srsq-only.crsa3tdmtcll.ussrsq-only.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

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
              
              		<a href="https://hoaboardtime.com/boardDashboard.php">
                
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

                <li class='treeview'>
                  
                  <a href="https://hoaboardtime.com/boardStatementOfActivity.php">

                    <i class="fa fa-users text-blue"></i> <span>Statement Of Activity</span>

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

          $others = 0;
          $num_docs = array();

          $num_type_docs = pg_num_rows(pg_query("SELECT * FROM document_category"));

          for($i = 1; $i <= $num_type_docs; $i++)
            $num_docs[$i] = 0;

          $result = pg_query("SELECT * FROM document_management WHERE community_id=$community_id");

          while ($row = pg_fetch_assoc($result)) 
          {
            
            $doc_cat = $row['document_category_id'];

            if($doc_cat != '')
              $num_docs[$doc_cat]++;
            else
              $others++;

          }

        ?>
        
        <section class="content-header">

          <h1><strong>Community Documents</strong><small> - <?php echo $_SESSION['hoa_community_name']; ?></small></h1>

        </section>

        <section class="content">

          <!--div class="row container-fluid">
            
            <section class="col-lg-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

              <?php
              
                #for($i = 1; $i <= $num_type_docs; $i++)
                {
                  
                  #if($num_docs[$i] > 0)
                  {

                    #$document_type = pg_fetch_assoc(pg_query("SELECT * FROM document_category WHERE document_category_id=$i"));

                    #$document_type = $document_type['document_category_name'];
                    
                    #echo "<div class='col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6'>
                    
                    #  <a href='https://hoaboardtime.com/boardShowDocuments.php?document_category=$i'>

                    #    <div style='background:#ffffff;'>
                      
                    #      <div class='box-header'>
                        
                    #        <div class='row container-fluid'><i class='fa fa-files-o fa-4x pull-left text-aqua'></i>
                        
                    #          <b class='pull-right'>
                                
                    #            <h4 class='text-info'><strong>".$num_docs[$i]."</strong></h4>

                    #          </b>

                    #        </div>
                            
                    #        <div class='row container-fluid text-center'><br>".$document_type."</div>
                      
                    #      </div>

                    #    </div>

                    #  </a>

                    #  <br>

                    #</div>";

                  }

                }

              ?>

              <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6">
                
                <?php #if($others > 0) echo "<a href='https://hoaboardtime.com/boardShowDocuments.php?document_category=0'>"; ?>

                  <div style="background:#ffffff;">
                
                    <div class="box-header">
                  
                      <div class='row container-fluid'><i class="fa fa-files-o fa-4x pull-left text-aqua"></i>
                  
                        <b class="pull-right">
                          
                          <?php 

                            #if($others == 0)
                            #  echo "<h4 class='text-success'><strong>0</strong></h4>";
                            #else
                            #  echo "<h4 class='text-info'><strong>".$others."</strong></h4>";

                          ?>

                        </b>

                      </div>
                      
                      <div class='row container-fluid text-center'><br>Others</div>
                
                    </div>

                  </div>

                <?php #if($others > 0) echo "</a>"; ?>

                <br>

              </div>

            </section>
            
          </div-->

          <div class="row container-fluid">

            <ul class="timeline">

              <?php

                $result = pg_query("SELECT year_of_upload FROM document_management WHERE community_id=$community_id GROUP BY year_of_upload ORDER BY year_of_upload DESC");

                $i = 0;

                while($row = pg_fetch_assoc($result))
                {

                  $i++;

                  $id = 'example';
                  $id .= $i;
                
                  $year_of_upload = $row['year_of_upload'];
                  
                  echo "<li class='time-label'>
                    
                      <span class='bg-red'>".$year_of_upload."</span>

                    </li> 

                  <li>
            
                    <div class='timeline-item'>

                      <div class='timeline-body container-fluid'>

                        <div class='row container-fluid table-responsive'>

                          <table id='".$id."' class='table table-bordered table-striped'>

                            <thead>

                              <th>Date of Upload</th>
                              <th>Description</th>

                            </thead>

                            <tbody>";
                      
                              $result1 = pg_query("SELECT * FROM document_management WHERE community_id=$community_id AND year_of_upload=$year_of_upload");

                              while($row1 = pg_fetch_assoc($result1))
                              {

                                $desc = $row1['description'];
                                $category = $row1['document_category_id'];
                                $document_url = $row1['url'];
                                $date_of_upload = $row1['uploaded_date'];

                                if($date_of_upload != '')
                                  $date_of_upload = date('m-d-Y', strtotime($date_of_upload));

                                if($category != '')
                                {

                                  $row11 = pg_fetch_assoc(pg_query("SELECT * FROM document_category WHERE document_category_id=$category"));

                                  $category = $row11['document_category_name'];

                                }
                                else
                                  $category = 'Others';

                                echo "<tr><td><a href='https://hoaboardtime.com/getDocumentPreviewTest.php?path=$document_url&desc=$desc&cid=$community_id' target='_blank'>$date_of_upload</a></td><td><a href='https://hoaboardtime.com/getDocumentPreviewTest.php?path=$document_url&desc=$desc&cid=$community_id' target='_blank'>$desc</a></td></tr>";

                              }

                            echo "</tbody>

                            <tfoot>

                              <th>Date of Upload</th>
                              <th>Description</th>

                            </tfoot>

                          </table>

                        </div>

                      </div>
                      
                    </div>
                    
                  </li>";

                }

              ?>

            </ul>

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
        
        $("#example1").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example2").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example3").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example4").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example5").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example6").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example7").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example8").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example9").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example10").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example11").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example12").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example13").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example14").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example15").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example16").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example17").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example18").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example19").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example20").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example21").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example22").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });

        $("#example23").DataTable({ "pageLength": 10, "order": [[0, 'desc']] });
        
      });
    </script>

  </body>

</html>