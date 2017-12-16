<?php

  ini_set("session.save_path","/var/www/html/session/");

  session_start();

?>

<!DOCTYPE html>

<html>

  <head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-102881886-2"></script>
	<script>
		
		var dimensionValue = '<?php echo $_SESSION['hoa_hoa_id'] ?>';
		  	window.dataLayer = window.dataLayer || [];
		  	function gtag(){dataLayer.push(arguments);}
		  	gtag('js', new Date());
		  
		  	gtag('config', 'UA-102881886-2', {
		  	'custom_map': {'dimension1': 'hoaid'}
			
			// Sends an event that passes 'age' as a parameter.
			gtag('event', 'hoaid_dimension', {'hoaid': dimensionValue});
		});
	  
	</script>
    <?php

      	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

      	if(@!$_SESSION['hoa_username'])
      		header("Location: logout.php");

        if($_SESSION['hoa_mode'] == 1)
          $_SESSION['hoa_mode'] = 2;

      	$community_id = $_SESSION['hoa_community_id'];
        $hoa_id = $_SESSION['hoa_hoa_id'];
        $home_id = $_SESSION['hoa_home_id'];
        $user_id = $_SESSION['hoa_user_id'];

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

    <script>/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(e){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var e=this.createElement("script");n&&(this.domain=n),e.id="js-iframe-async",e.src="https://assets.zendesk.com/embeddable_framework/main.js",this.t=+new Date,this.zendeskHost="stoneridgesquare.zendesk.com",this.zEQueue=a,this.body.appendChild(e)},o.write('<body onload="document._l();">'),o.close()}();
/*]]>*/</script>

  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    
    <div class="wrapper">

      	<!--header class="main-header">
        
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
  	              
  		            		<a href='https://hoaboardtime.com/boardDashboard.php'>Board Dashboard</a>

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
            
            		<li class="header text-center"> Quick Links </li>

            		<li class="treeview active">
              
              			<a>
                
                			<i class="fa fa-dashboard"></i> <span><?php if($board) echo "Resident "; ?>Dashboard</span>

              			</a>

            		</li>
            
            		<li class="treeview">
              
              			<a href='https://hoaboardtime.com/residentDocumentManagement.php'>

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

      	</aside-->

        <?php include 'residentHeader.php'; ?>

        <?php include 'residentNavigationMenu.php'; ?>

        <?php  include 'zenDeskScript.php'; ?>

      <div class="content-wrapper">

        <?php

        	$year = date("Y");
        	$month = date("m");
        	$end_date = date("t");

        	$row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND hoa_id=$hoa_id AND home_id=$home_id"));

        	$total_payments = $row['sum'];

        	$row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE community_id=$community_id AND hoa_id=$hoa_id AND home_id=$home_id"));

        	$total_charges = $row['sum'];

        	$balance = ( $total_charges - $total_payments );

          $row = pg_fetch_assoc(pg_query("SELECT amount FROM assessment_amounts WHERE community_id=$community_id"));

          $monthly_assessment = $row['amount'];

          $row = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));

          $email = $row['email'];
          $cell = $row['cell_no'];

          if($email == "")
            $email = "<i class='fa fa-remove text-red'></i>";
          else
            $email = "<i class='fa fa-check text-green'></i>";

          if($cell == "")
            $cell = "<i class='fa fa-remove text-red'></i>";
          else
            $cell = "<i class='fa fa-check text-green'></i>";

          $row = pg_fetch_assoc(pg_query("SELECT count(*) FROM inspection_notices WHERE hoa_id=$hoa_id AND home_id=$home_id"));

          $violations = $row['count'];

          $row = pg_fetch_assoc(pg_query("SELECT count(*) FROM reminders WHERE hoa_id=$hoa_id AND home_id=$home_id AND reminder_status_id=1"));

          $reminders = $row['count'];

          $row = pg_fetch_assoc(pg_query("SELECT count(*) FROM vendor_master WHERE community_id=$community_id"));

          $vendors = $row['count'];

          $row = pg_fetch_assoc(pg_query("SELECT count(hoa_id) FROM hoaid WHERE community_id=$community_id"));

          $total_customers = $row['count'];

          $bods = pg_num_rows(pg_query("SELECT * FROM board_committee_details WHERE community_id=$community_id AND is_active=TRUE"));

          $deposits = pg_num_rows(pg_query("SELECT * FROM community_deposits WHERE community_id=$community_id"));

          $row = pg_fetch_assoc(pg_query("SELECT * FROM member_info WHERE hoa_id=$hoa_id"));

          $account_id = $row['account_id'];

          $row = pg_fetch_assoc(pg_query("SELECT * FROM account_info WHERE account_id=$account_id"));

          $email_visibility = $row['email_visibility'];
          $cell_visibility = $row['cell_visibility'];
          $mailing_visibility = $row['mailing_address_visibility'];

          if($email_visibility == 'NO')
            $email_visibility = "<i class='fa fa-eye-slash text-red'></i>";
          else
            $email_visibility = "<i class='fa fa-eye text-green'></i>";

          if($cell_visibility == 'NO')
            $cell_visibility = "<i class='fa fa-eye-slash text-red'></i>";
          else
            $cell_visibility = "<i class='fa fa-eye text-green'></i>";

          if($mailing_visibility == 'NO')
            $mailing_visibility = "<i class='fa fa-eye-slash text-red'></i>";
          else
            $mailing_visibility = "<i class='fa fa-eye text-green'></i>";

        ?>
        
        <section class="content-header">

          <h1><strong>Resident Dashboard</strong></h1>

        </section>

        <section class="content">

          <div class='row container-fluid' style="background-color: #ffffff;">

            <br>

            <div class="modal fade hmodal-success" id="editContactVisibility" role="dialog"  aria-hidden="true">
                                
              <div class="modal-dialog">
                                    
                <div class="modal-content">
                                        
                  <div class="modal-header">
                                                
                    <h4 class="modal-title"><strong>Change Visibility</strong></h4>

                  </div>

                  <div class="modal-body">
                                                
                    <form class="row" method="post" action="https://hoaboardtime.com/residentEditVisibility.php">
                                            
                      <div class="container-fluid">

                        <div class='row container-fluid'>

                          <div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>

                            <label>Mailing Address</label>

                          </div>

                          <div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>

                            <input type="radio" name="change_mailing_address_visibility" value='YES' id="change_mailing_address_visibility" <?php if($mailing_visibility == "<i class='fa fa-eye text-green'></i>") echo "checked "; ?>> YES

                          </div>

                          <div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>

                            <input type="radio" name="change_mailing_address_visibility" value='NO' id="change_mailing_address_visibility" <?php if($mailing_visibility == "<i class='fa fa-eye-slash text-red'></i>") echo "checked "; ?>> NO

                          </div>

                        </div>

                        <br>

                        <div class='row container-fluid'>

                          <div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>

                            <label>Phone</label>

                          </div>

                          <div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>

                            <input type="radio" name="change_cell_visibility" value='YES' id="change_cell_visibility" <?php if($cell_visibility == "<i class='fa fa-eye text-green'></i>") echo "checked "; ?>> YES

                          </div>

                          <div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>

                            <input type="radio" name="change_cell_visibility" value='NO' id="change_cell_visibility" <?php if($cell_visibility == "<i class='fa fa-eye-slash text-red'></i>") echo "checked "; ?>> NO

                          </div>

                        </div>

                        <br>

                        <div class='row container-fluid'>

                          <div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>

                            <label>Email</label>

                          </div>

                          <div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>

                            <input type="radio" name="change_email_visibility" value='YES' id="change_email_visibility" <?php if($email_visibility == "<i class='fa fa-eye text-green'></i>") echo "checked "; ?>> YES

                          </div>

                          <div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>

                            <input type="radio" name="change_email_visibility" value='NO' id="change_email_visibility" <?php if($email_visibility == "<i class='fa fa-eye-slash text-red'></i>") echo "checked "; ?>> NO

                            <input type="hidden" name="account_id" id='account_id' value="<?php echo $account_id; ?>">

                          </div>

                        </div>

                        <br>

                        <div class="row text-center">
                          
                          <button type="submit" name='submit' id='submit' class="btn btn-success btn-xs"><i class='fa fa-check'></i>Save Changes</button>
                          <button type="button" class="btn btn-warning btn-xs" data-dismiss="modal"><i class='fa fa-close'></i>Cancel</button>
                        
                        </div>
                                                
                      </div>

                    </form>

                  </div>

                </div>
                  
              </div>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">

              <div class="row container-fluid text-left">

                <br>

                <div class="row container-fluid">

                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                    <img src="account_balance.png" height=75 width=75 alt='Account Balance'>

                  </div>

                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                    <?php

                      if($balance <= 0)
                        echo "<h3 class='text-green'><strong>$ ".$balance."</strong></h3>";
                      else if($balance > 0 && $balance <= $monthly_assessment)
                        echo "<h3 class='text-orange'><strong>$ ".$balance."</strong></h3>";
                      else if($balance > $monthly_assessment)
                        echo "<h3 class='text-red'><strong>$ ".$balance."</strong></h3>";

                    ?>

                  </div>

                </div>

                <div class="row container-fluid text-left">

                  <h4><strong>Account Balance</strong></h4>

                </div>

                <br>

              </div>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">

              <?php echo "<a target='_blank' href='viewBillingStatement.php?hoa_id=".$hoa_id."'>"; ?>

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <img src="account_statement.png" height=75 width=75 alt='Account Statement'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <h3 class="text-info"><strong><?php echo $year; ?></strong></h3>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <h4><strong>Account Statement / Invoice</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">

              <a href='https://hoaboardtime.com/residentViewBoardOfDirectors.php'>

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <img src="board_of_directors.png" height=75 width=75 alt='Board Of Directors'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <?php

                        $result = pg_query("SELECT * FROM board_committee_details WHERE community_id=");

                        echo "<h3 class='text-info'><strong>".$bods."</strong></h3>";

                      ?>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <h4><strong>Board Of Directors</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">

              <a href='https://hoaboardtime.com/communityDeposits.php'>

                <div class="row container-fluid">

                  <br>

                  <div class="row container-fluid text-left">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <img src="deposits.png" height=75 width=75 alt='Community Deposits'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <h3 class="text-info"><strong><?php echo $deposits; ?></strong></h3>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <h4><strong>Community Deposits</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">

              <a href='https://hoaboardtime.com/residentVendorDashboard.php'>

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <img src="vendors.png" height=75 width=75 alt='Community Vendors'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <?php

                        echo "<h3 class='text-info'><strong>".$vendors."</strong></h3>";

                      ?>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <h4><strong>Community Vendors</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">

              <a  data-toggle='modal' data-target='#editContactVisibility'>

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <img src="pending_payments.png" height=70 width=70 alt='Contact Visibility'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <?php 

                        echo "<h5 class='text-info'><strong><i class='fa fa-home'></i> : $mailing_visibility</strong><br><strong><i class='fa fa-phone'></i> : $cell_visibility</strong><br><strong><i class='fa fa-at'></i> : $email_visibility</strong></h5>";

                      ?>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <h4><strong>Contact Visibility</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">

              <a href='https://hoaboardtime.com/residentViolationCitation.php'>

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <img src="inspections.png" height=75 width=75 alt='Inspection Notices'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <?php

                        if($violations > 0) 
                          echo "<h3 class='text-orange'><strong>$violations</strong></h3>"; 
                        else 
                          echo "<h3 class='text-info'><strong>$violations</strong></h3>";

                      ?>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <h4><strong>Inspection Notices</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">

              <a href='https://hoaboardtime.com/residentDocumentManagement.php'>

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <img src="documents.png" height=75 width=75 alt='My Documents'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <?php

                        $my_documents = pg_num_rows(pg_query("SELECT * FROM document_visibility WHERE user_id=$user_id"));

                        echo "<h3 class='text-info'><strong>$my_documents</strong></h3>";

                      ?>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <h4><strong>My Documents</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">

              <a href='https://hoaboardtime.com/residentParkingTags.php'>

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <img src="parking_tags.png" height=75 width=75 alt='Parking Tags'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <?php

                        $parking_tags = pg_num_rows(pg_query("SELECT * FROM home_tags WHERE hoa_id=$hoa_id AND community_id=$community_id AND type=1"));

                        if($parking_tags > 0) 
                          echo "<h3 class='text-green'><strong>$parking_tags</strong></h3>"; 
                        else 
                          echo "<h3 class='text-info'><strong>$parking_tags</strong></h3>";

                      ?>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <h4><strong>My Parking Tags</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">

              <a href='https://hoaboardtime.com/residentPendingAgreements.php'>

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <img src="pending_agreements.png" height=75 width=75 alt='Pending Agreements'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <?php 

                        $result = pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND document_to LIKE '".$_SESSION['hoa_email']."' AND agreement_status='OUT_FOR_SIGNATURE'");
                        $pending_agreements = pg_num_rows($result);

                        if($pending_agreements == 0)
                          echo "<h3 class='text-green'><strong>".$pending_agreements."</strong></h3>"; 
                        else
                          echo "<h3 class='text-red'><strong>".$pending_agreements."</strong></h3>";

                      ?>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <h4><strong>My Pending Agreements</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">

              <a href='https://hoaboardtime.com/residentProfile.php'>

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <img src="my_profile.png" height=75 width=75 alt='My Profile'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <?php 

                        echo "<h4 class='text-info'><strong><i class='fa fa-phone'></i> : $cell</strong><br><strong><i class='fa fa-at'></i> : $email</strong></h4>";

                      ?>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <h4><strong>My Profile</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">

              <a href='https://hoaboardtime.com/residentSignedAgreements.php'>

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <img src="signed_agreements.png" height=75 width=75 alt='Signed Agreements'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <?php 

                        $result = pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND document_to LIKE '".$_SESSION['hoa_email']."' AND agreement_status='SIGNED'");
                        $signed_agreements = pg_num_rows($result);

                        if($signed_agreements == 0)
                          echo "<h3 class='text-green'><strong>".$signed_agreements."</strong></h3>"; 
                        else
                          echo "<h3 class='text-red'><strong>".$signed_agreements."</strong></h3>";

                      ?>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <h4><strong>My Signed Agreements</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">

              <a href='https://hoaboardtime.com/viewReminders.php'>

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <img src="reminders.png" height=75 width=75 alt='Reminders'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <?php

                        echo "<h3 class='text-green'><strong>".$reminders."</strong></h3>";
                                      
                      ?>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <h4><strong>Reminders</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">

              <a href='https://hoaboardtime.com/residentDirectory.php'>

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <img src="resident_directory.png" height=75 width=75 alt='Pending Agreements'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <?php
                          
                        $query = "SELECT count(*) FROM member_info WHERE community_id=".$community_id;

                        $result = pg_query($query);
                        $row = pg_fetch_assoc($result);
                        $num = $row['count'];

                        echo "<h3 class='text-green'><strong>".$num."</strong></h3>";
                                      
                      ?>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <h4><strong>Resident Directory</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <br>

          </div>

          <br><br>

          <div class='row container-fluid'>

            <div class="col-xl-6 col-lg-6 col-md-12 col-xs-12">
          
                <div class="info-box">
                  
                  <span class="info-box-icon bg-green"><i class="fa fa-check-square-o"></i></span>

                  <div class="info-box-content">
              
                    <span class="info-box-text text-green">Payments Processed - <?php echo date("F").", ".date('Y'); ?></span>
                    
                    <?php

                      $ach = 0;
                      $billpay = 0;
                      $cheque = 0;

                      $result = pg_query("SELECT * FROM current_payments WHERE community_id=$community_id AND process_date>='".date("Y")."-".date("m")."-1' AND process_date<='".date("Y")."-".date('m')."-".date('t')."'");
                        
                      while($row = pg_fetch_assoc($result))
                      {
                        if($row['payment_type_id'] == 1)
                          $ach++;
                        else if($row['payment_type_id'] == 2)
                          $billpay++;
                        else if($row['payment_type_id'] == 3)
                          $cheque++;
                      }

                      echo "ACH : ".$ach."<br>BillPay : ".$billpay."<br>Check : ".$cheque;

                    ?>
            
                  </div>

                </div>
              
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12 col-xs-12">
          
              <div class="info-box">
                  
                <span class="info-box-icon bg-yellow"><i class="fa fa-dollar"></i></span>

                <div class="info-box-content">
              
                  <span class="info-box-text text-yellow">Bank Account Balance</span>
                    
                  <?php

                    if($community_id == 1)
                    { 
                      
                      $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145854171542/account/77?minorversion=8');      
                      
                      curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
                      curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprd0JzDPeMNuATqXcic8hnusenW2",oauth_token="qyprdtnlpBxOlv0BmjUwWTfj29gEC0KrzOcJQHaiaUDajyIO",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="voGBPJafHfxz8bOURbG7VntK8sI%3D"'));
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                            
                      $result = curl_exec($ch);
                      $json_decode = json_decode($result,TRUE);
                      $srp_primarySavings = $json_decode['Account'];
                      $srp_current_balance = $srp_primarySavings['CurrentBalance'];
                            
                      curl_close($ch);

                      $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145854171542/account/74?minorversion=8');      
                            
                      curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
                      curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprd0JzDPeMNuATqXcic8hnusenW2",oauth_token="qyprdtnlpBxOlv0BmjUwWTfj29gEC0KrzOcJQHaiaUDajyIO",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1506683164",oauth_nonce="UFK2HGiv0KT",oauth_version="1.0",oauth_signature="SmDroRQxwOUYd33MIj7EA0jRVUc%3D"'));
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                            
                      $result2 = curl_exec($ch);
                      $json_decode2 = json_decode($result2,TRUE);
                      $srp = $json_decode2['Account'];
                      $srp_savings_balance = $srp['CurrentBalance'];

                      echo "Savings : <strong>$ ".$srp_savings_balance."</strong><br>Checkings : <strong>$ ".$srp_current_balance."</strong>";
                    }
                    else if($community_id == 2)
                    {
                      
                      $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/account/33?minorversion=8');      
                      curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
                      curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1506683248",oauth_nonce="r8sLA2HRZIP",oauth_version="1.0",oauth_signature="vTWfSwEd%2FQafodJh19X19Th2MMw%3D"'));
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

                      $result = curl_exec($ch);
                      $json_decode = json_decode($result,TRUE);
                      $srp_primarySavings = $json_decode['Account'];
                      $srp_primary_Savings_CurrentBalance = $srp_primarySavings['CurrentBalance'];

                      curl_close($ch);

                      $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/account/32?minorversion=8');      
                      
                      curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
                      curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1506683227",oauth_nonce="uD0onU1Xoea",oauth_version="1.0",oauth_signature="Y6RFDcxbAsAsyyRy4gMp7%2F2WEhg%3D"'));
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

                      $result2 = curl_exec($ch);
                      $json_decode2 = json_decode($result2,TRUE);
                      $srp = $json_decode2['Account'];
                      $srp_savings = $srp['CurrentBalance'];

                      curl_close($ch);

                      $ch  = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/account/31?minorversion=8');
                      
                      curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
                      curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1506683271",oauth_nonce="uiCpAV7TloJ",oauth_version="1.0",oauth_signature="6OALo%2BYbnzr4GU8Yuk9NQ9bYZ7c%3D"'));
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

                      $result3 = curl_exec($ch);
                      $json_decode3 = json_decode($result3,TRUE);
                      $srsq_third_Account = $json_decode3['Account'];
                      $srsq_third_Account_Balance = $srsq_third_Account['CurrentBalance'];

                      echo "Savings : <strong>$ ".$srp_primary_Savings_CurrentBalance."</strong><br>Checkings : <strong>$ ".$srp_savings."</strong><br>Investments : <strong>$ ".$srsq_third_Account_Balance."</strong>";
                    }

                  ?>
            
                </div>

              </div>
              
            </div>

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