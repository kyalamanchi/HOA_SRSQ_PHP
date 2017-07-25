<!DOCTYPE html>
<html>
  <head>
    
    <?php

      session_start();

      pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

      if(@!$_SESSION['hoa_username'])
      	header("Location: https://hoaboardtime.com/logout.php");

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

                <li class='active treeview'>
                  
                  <a>

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

        <section class="content-header">

          <h1><strong>Statement Of Activity</strong><small> - <?php echo $_SESSION['hoa_community_name']; ?></small></h1>

        </section>

        <section class="content">

          <div class="row container-fluid">

            <?php
        
              $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/reports/ProfitAndLoss?minorversion=8');
              
              curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
              curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Content-Type:application/text','Content-Type:application/text','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="lvprdiCkEnJlsgkPzDkDsjOm2FUoYTc3zHCb41tu6wjN21AP",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="ip1c1vnwspYJ4SEyLwtReFzeIII%3D"'));
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

              $profitandloss = curl_exec($ch);
              $jsonprofitandloss = json_decode($profitandloss,TRUE);
              $data = $jsonprofitandloss['Rows']['Row'];

              foreach ($data as $key ) {

                foreach ($key['Summary'] as $Summary) {
                  
                  $count = 0;
                  
                  foreach ($Summary as $summary) {
    
                    if ($summary['value'] == 'Total Revenue') {
                      
                      $count = 1;
                      continue;

                    }
                    if ( $count == 1 ) {
                      
                      $income = $summary['value'];
                      continue;

                    } 

                    if ( $summary['value'] == 'Total Expenditures') {
                      
                      $count = 2;
                      continue;

                    }

                    if ( $count == 2) {
                      
                      $expenditure = $summary['value'];
                      continue;

                    }

                    if ( $summary['value'] == 'Net Revenue') {
                      
                      $count = 3;
                      continue;

                    }

                    if ( $count == 3) {
                      
                      $revenue = $summary['value'];
                      continue;

                    }

                    if ( $summary['value'] == 'Total Office Supplies & Software'){
                      
                      $count = 4;
                      continue;

                    }
                    if( $count == 4) {
                      
                      $officetotal = $summary['value'];
                      continue;

                    }

                  }

                }

                foreach ($key['Rows'] as $allRows) {
                  
                  foreach ($allRows as $individualRows) {
  
                    foreach ($individualRows as $colData) {
      
                      foreach ($colData as $keyColData) {
                        
                        $count = 0;
         
                        foreach ($keyColData as $keyColData2) {
           
                          if ( $keyColData2['value'] == 'Total 6410 Office/General Administrative Expenses') {
                            
                            $count = 1;
                            continue;

                          }
                          else if ( $keyColData2['value'] == 'Total 5420 Repairs & Maintenance') {
                            
                            $count = 2;
                            continue;

                          }

                          if ( $count == 2 ){
                            
                            $repair = $keyColData2['value'];
                            $count = 0;
                            continue;

                          }

                          if ( $count == 1) {
            
                            $officegeneral = $keyColData2['value'];
                            $count = 0;
                            continue;
                          
                          }
                        
                        }
                      
                      }  
      
                    }
                  
                  }

                }
              
              }
            
            ?>

            <section style="background-color: white;">

              <br>

              <?php

                $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/query?minorversion=8');
                
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Content-Type:application/text','Content-Type:application/text','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="lvprdiCkEnJlsgkPzDkDsjOm2FUoYTc3zHCb41tu6wjN21AP",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="SzEjFHI3judOvhE2H4nHT7XFQuk%3D"'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "Select * from CompanyInfo");
                
                $companyInfo = curl_exec($ch);
                
                curl_close($ch);
                
                $companyInfo = json_decode($companyInfo,TRUE);
                $companyInfo  = $companyInfo['QueryResponse'];
                $companyInfo = $companyInfo['CompanyInfo'];
                
                curl_close($ch);
              
                $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/reports/ProfitAndLossDetail?minorversion=8');
                
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Content-Type:application/text','Content-Type:application/text','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="lvprdiCkEnJlsgkPzDkDsjOm2FUoYTc3zHCb41tu6wjN21AP",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="dF10iisxl3QVmuZhGLd4pIA9GAQ%3D"'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                
                $result = curl_exec($ch);
                $json_Decode = json_decode($result,TRUE);
                $header = $json_Decode['Header'];
                $startDate  = $header['StartPeriod'];
                $endDate = $header['EndPeriod'];
                $startDate = strtotime($startDate);
                $endDate = strtotime($endDate);
                $startDate = date('F jS ',$startDate);
                $endDate = date('F jS, Y',$endDate);
                
                curl_close($ch);

              ?>

              <div class="row container-fluid">

                <?php

                  $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/reports/ProfitAndLoss?minorversion=8');
                  
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                  curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Content-Type:application/text','Content-Type:application/text','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="lvprdiCkEnJlsgkPzDkDsjOm2FUoYTc3zHCb41tu6wjN21AP",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="ip1c1vnwspYJ4SEyLwtReFzeIII%3D"'));
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                  
                  $profitandloss = curl_exec($ch);
                  $jsonprofitandloss = json_decode($profitandloss,TRUE);
                  $profitandlossrows = $jsonprofitandloss['Rows']['Row'];
                  
                  foreach ($profitandlossrows as $profitandlosstest) {
                    
                    foreach ($profitandlosstest['Header'] as $keyprofitandloss) {
                      
                      foreach ($keyprofitandloss as $keyprofitandloss) {
                        
                        $keyprofitandloss = $keyprofitandloss['value'];
                        
                        if ( $keyprofitandloss == "Expenditures") {
                          
                          foreach ($profitandlosstest['Rows'] as $keyprofitandlosstester) {
                            
                            foreach ($keyprofitandlosstester as $helloworld) {
                              
                              $helloworld2 = $helloworld['Header'];
                              $count = 0;
                              
                              foreach ($helloworld2['ColData'] as $keycoldata) {
                                
                                $count = $count + 1;
                                if ( $count == 2 ){
                                  
                                }

                              }

                            }

                          }

                        }

                      }

                    }

                  }

                ?>

                <div class="col-xl-offset-1 col-lg-offset-1 col-md-offset-1 col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12">
                  
                  <table class="table table-hover table-bordered container-fluid">
                    
                    <thead>
                        
                        <tr>
                            
                            <th></th>
                            <th>Total</th>

                        </tr>

                    </thead>
                    
                    <tbody>
                      
                      <tr>
                        
                        <?php
                          
                          echo '<td>Revenue</td>';
                          echo '<td>';
                          echo '<b>';
                          echo '$ ';
                          
                          $allRows = $json_Decode['Rows'];
                          
                          foreach ($allRows['Row'] as $singleRow) {
                            
                            $insideRows = $singleRow['Rows'];
                            $insideRow = $insideRows['Row'];
                  
                            foreach($insideRow as $key ) {
                    
                              $summary = $key['Summary'];
                    
                              foreach ($summary['ColData'] as $colval) {
                                
                                $value = floatval($colval['value']);
                                
                                if($value && intval($value) != $value)
                                {
                                  echo $value;
                                  break 3;

                                }

                              }
                            
                            }

                          }
                          
                          echo '</b>';

                        ?>

                      </tr>

                      <tr>

                        <td>
                          
                          <h5>4010 Assessments<span style="float:right;">$ <?php  echo $value; ?></span></h5>
                          
                          <ul>
                            
                            <hr>
                            <h4>Total Revenue<span style="float:right;">$ <?php  echo $value; ?></span></h4>
                        
                          </ul>
                        
                        </td>

                      </tr>
                      
                      <tr>
                      
                        <td>Gross Profit </td>
                        <td><b>$ <?php echo $value; ?></b></td>

                      </tr>

                      <tr>
                        
                        <td colspan="5"><ul><li>No data found.</li></ul></td>
                      
                      </tr>

                      <tr>
                        
                        <td>Expenditures</td>
                        
                        <?php

                          $cell = 0;

                          echo '<td>';
                          echo '<b>';
                          echo '$ ';

                          $allRows = $json_Decode['Rows'];
                          
                          foreach ($allRows['Row'] as $singleRow) {
                            
                            $insideRows = $singleRow['Rows'];
                            $insideRow = $insideRows['Row'];
                  
                            foreach($insideRow as $key ) {
                              
                              $summary = $key['Summary'];
                    
                              foreach ($summary['ColData'] as $colval) {
                      
                                foreach ($colval as $keycol) {
                                  
                                  if ( $keycol == "Total for Expenditures") {
                        
                                    $cell = 1;

                                  }

                                  if ( $cell == 1 ){
                                    
                                    $fval  = floatval($keycol);
                                    
                                    if($fval && intval($fval) != $fval)
                                    {
                                      echo $fval;
                                      $cell = 0;
                                      break 3;

                                    }

                                  }

                                }

                              }

                            }

                          }

                          echo '</b>';
                        
                        ?>

                      </tr>

                      <tr>

                        <td>
                          
                          <ul>
                  
                            <?php 
                  
                              foreach ($keyprofitandlosstester as $helloworld) {
                  
                                $helloworld2 = $helloworld['Header'];
                                $count = 0;
                  
                                foreach ($helloworld2['ColData'] as $keycoldata) {
                    
                                  $count = $count + 1;
                                  
                                  if ( $count == 1){

                                    $firstvalue = $keycoldata['value'];
                                  
                                  }
                                  
                                  if ( $count == 2 ){
                                    
                                    echo '<h5>'.$firstvalue.'<span style="float:right;">$ '.$keycoldata['value'].'</span></h5>';
                                    echo "<hr>";
                    
                                  }
                                
                                }
                              
                              }

                              echo '<h4>Total Expenditure<span style="float:right;">$ '.$fval.'</span></h4>';

                            ?>

                          </ul>

                        </td>

                      </tr>

                      <tr>

                        <td>Net Operating Revenue</td>
                        <td><b>$ 
                          <?php
                            
                            foreach ($allRows['Row'] as $singleRow) {
                              
                              $summary = $singleRow['Summary'];
                              $ColData  = $summary['ColData'];
                    
                              foreach ($ColData as $key) {
                      
                                $value   = $key['value'];
                      
                                if($value && intval($value) != $value)
                                {
                            
                                  echo $value;
                                  break 2;

                                }
                    
                              }
                            }
                          ?>
                          
                        </b></td>

                      </tr>

                      <tr>

                        <td colspan="5">
                
                          <ul><li>No data found.</li></ul>

                        </td>

                      </tr>

                      <tr>

                        <td>Net Revenue</td>
                        <td><b>$ <?php echo $value; ?></b></td>

                      </tr>
                    
                    </tbody>

                  </table>

                </div>

              </div>

              <br>

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