<?php
	
	session_start();

include 'includes/dbconn.php';
	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header('Location: logout.php');

	$email = $_SESSION['hoa_alchemy_email'];
	$hoa_id = $_SESSION['hoa_alchemy_hoa_id'];
	$home_id = $_SESSION['hoa_alchemy_home_id'];
	$user_id = $_SESSION['hoa_alchemy_user_id'];
	$username = $_SESSION['hoa_alchemy_username'];
	$community_id = $_SESSION['hoa_alchemy_community_id'];
	$community_code = $_SESSION['hoa_alchemy_community_code'];
	$community_name = $_SESSION['hoa_alchemy_community_name'];

	function get_client_ip() {

	    $ipaddress = '';

	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';

	    return $ipaddress;

	}

	$ip = get_client_ip();

	$today = date('Y-m-d G:i:s');

	$result = pg_fetch_assoc(pg_query("SELECT * FROM community_annual_report_pages WHERE community_id=$community_id"));
	$page = $result['hoaid'];

	if($page == 'f')
		header("Location: homeid.php");

	$result = pg_query("UPDATE community_annual_report_visited SET hoaid_page_visited='t', last_visited_on='$today', last_visited_ip='$ip' WHERE hoa_id=$hoa_id AND home_id=$home_id");

	$visited_pages = pg_query("SELECT * FROM community_annual_report_visited WHERE hoa_id=$hoa_id AND home_id=$home_id");
    $visited_pages = pg_fetch_assoc($visited_pages);
    $hoaid_page_visited = $visited_pages['hoaid_page_visited'];
    $homeid_page_visited = $visited_pages['homeid_page_visited'];
    $persons_page_visited = $visited_pages['persons_page_visited'];
    $primary_email_page_visited = $visited_pages['primary_email_page_visited'];
    $notifications_page_visited = $visited_pages['notifications_page_visited'];
    $agreements_page_visited = $visited_pages['agreements_page_visited'];
    $documents_page_visited = $visited_pages['documents_page_visited'];
    $payments_page_visited = $visited_pages['payments_page_visited'];
    $hoa_fact_sheet_page_visited = $visited_pages['hoa_fact_sheet_page_visited'];
    $disclosures_page_visited = $visited_pages['disclosures_page_visited'];
    $contracts_page_visited = $visited_pages['contracts_page_visited'];
    $financial_summary_page_visited = $visited_pages['financial_summary_page_visited'];
    $volunteers_page_visited = $visited_pages['volunteers_page_visited'];
    $inspection_notices_page_visited = $visited_pages['inspection_notices_page_visited'];

?>

<!DOCTYPE html>

<html lang='en'>

	<head>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<title><?php echo $community_code; ?> - Annual Report</title>

		<!-- Web Fonts-->
		<link href="https://fonts.googleapis.com/css?family=Poppins:500,600,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Hind:400,600,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lora:400i" rel="stylesheet">
		<!-- Bootstrap core CSS-->
		<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Icon Fonts-->
		<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link href="assets/css/linea-arrows.css" rel="stylesheet">
		<link href="assets/css/linea-icons.css" rel="stylesheet">
		<!-- Plugins-->
		<link href="assets/css/owl.carousel.css" rel="stylesheet">
		<link href="assets/css/flexslider.css" rel="stylesheet">
		<link href="assets/css/magnific-popup.css" rel="stylesheet">
		<link href="assets/css/vertical.min.css" rel="stylesheet">
		<link href="assets/css/pace-theme-minimal.css" rel="stylesheet">
		<link href="assets/css/animate.css" rel="stylesheet">
		<!-- Template core CSS-->
		<link href="assets/css/template.min.css" rel="stylesheet">
		<!-- Datatable -->
		<link rel='stylesheet' href='https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css'>

	</head>

	<body>

		<style type="text/css">
			
			body {
  				background: #ecf0f1;
			}

			.loader {
  				width: 50px;
  				height: 30px;
  				position: absolute;
  				left: 50%;
  				top: 50%;
  				transform: translate(-50%, -50%);
			}
			.loader:after {
  				position: absolute;
  				content: "Loading";
  				bottom: -40px;
  				left: -2px;
  				text-transform: uppercase;
  				font-family: "Arial";
  				font-weight: bold;
  				font-size: 12px;
			}

			.loader > .line {
  				background-color: #333;
  				width: 6px;
  				height: 100%;
  				text-align: center;
  				display: inline-block;
  
  				animation: stretch 1.2s infinite ease-in-out;
			}

			.line.one {
			  	background-color: #2ecc71; 
			}

			.line.two {
			  	animation-delay:  -1.1s;
			  	background-color:#3498db;
			}
			.line.three {
			  	animation-delay:  -1.0s;
			  	background-color:#9b59b6;
			}
			.line.four {
			  	animation-delay:  -0.9s;
			   	background-color: #e67e22;
			}
			.line.five {
			  	animation-delay:  -0.8s;
			  	background-color: #e74c3c;
			}

			@keyframes stretch {
			  	0%, 40%, 100% { transform: scaleY(0.4); }
			  	20% {transform: scaleY(1.0);}
			}

		</style>

		<div class="loader">
  			
  			<div class="line one"></div>
  			<div class="line two"></div>
  			<div class="line three"></div>
  			<div class="line four"></div>
  			<div class="line five"></div>
		
		</div>

		<div class='layout'>

			<!-- Header-->
			<header class='header header-right undefined'>
	
				<div class='container-fluid'>
								
					<!-- Logos-->
					<div class='inner-header text-left'>

						<a><h5 style='color: green;'><?php echo $community_name; ?></h5></a>

					</div>

					<!-- Navigation-->
					<div class='inner-navigation collapse'>

						<div class='inner-navigation-inline'>
				
							<div class='inner-nav'>
						
								<ul>

									<li><a style="color: green;"><span>Hello <?php echo $username; ?></span></a></li>

									<li><a style="color: orange;" href='logout.php'><span><i class='fa fa-sign-out'></i> Log Out</span></a></li>

								</ul>

							</div>

						</div>

					</div>

					<!-- Mobile menu-->
					<div class='nav-toggle'>
						
						<a href='#' data-toggle='collapse' data-target='.inner-navigation'>
							
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>

						</a>

					</div>
				
				</div>

			</header>

			<div class='wrapper'>

				<!-- Page Header -->
	            <section class='module-page-title'>
	                                
	                <div class='container'>
	                                        
	                    <div class='row-page-title'>
	                                        
	                        <div class='page-title-captions'>

	                        	<ol class="breadcrumb">
                                        
                                    <li class="breadcrumb-item">

                                        <?php if($hoaid_page_visited == 't') echo "<a href='hoaid.php'>"; ?>
                                    
                                        <strong style='color: black;'>User Details</strong>

                                        <?php if($hoaid_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class="breadcrumb-item">

                                        <?php if($homeid_page_visited == 't') echo "<a href='homeid.php'>"; ?>
                                    
                                        Home Details

                                        <?php if($homeid_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class="breadcrumb-item">

                                        <?php if($persons_page_visited == 't') echo "<a href='persons.php'>"; ?>
                                        
                                        Persons

                                        <?php if($persons_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class='breadcrumb-item'>

                                        <?php if($primary_email_page_visited == 't') echo "<a href='primaryEmail.php'>"; ?>
                                    
                                        Primary Email

                                        <?php if($primary_email_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class='breadcrumb-item'>

                                        <?php if($notifications_page_visited == 't') echo "<a href='notifications.php'>"; ?>
                                    
                                        SMS Notifications

                                        <?php if($notifications_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class="breadcrumb-item">

                                        <?php if($agreements_page_visited == 't') echo "<a href='agreements.php'>"; ?>
                                    
                                        Agreements

                                        <?php if($agreements_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class='breadcrumb-item'>

                                        <?php if($documents_page_visited == 't') echo "<a href='documents.php'>"; ?>
                                    
                                        Documents

                                        <?php if($documents_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class='breadcrumb-item'>

                                        <?php if($inspection_notices_page_visited == 't') echo "<a href='inspectionNotices.php'>"; ?>
                                    
                                        CCR Inspection Notices

                                        <?php if($inspection_notices_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class="breadcrumb-item">

                                        <?php if($payments_page_visited == 't') echo "<a href='payments.php'>"; ?>
                                    
                                        Payments

                                        <?php if($payments_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class="breadcrumb-item">

                                        <?php if($hoa_fact_sheet_page_visited == 't') echo "<a href='factSheet.php'>"; ?>
                                        
                                        HOA Fact Sheet

                                        <?php if($hoa_fact_sheet_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class='breadcrumb-item'>

                                        <?php if($contracts_page_visited == 't') echo "<a href='communityContracts.php'>"; ?>
                                        
                                        Contracts

                                        <?php if($contracts_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class='breadcrumb-item'>

                                        <?php if($financial_summary_page_visited == 't') echo "<a href='financialSummary.php'>"; ?>
                                        
                                        Financial Summary

                                        <?php if($financial_summary_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class="breadcrumb-item">

                                        <?php if($disclosures_page_visited == 't') echo "<a href='disclosures.php'>"; ?>
                                    
                                        Disclosures

                                        <?php if($disclosures_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class='breadcrumb-item'>

                                        <?php if($volunteers_page_visited == 't') echo "<a href='volunteers.php'>"; ?>
                                        
                                        Volunteers

                                        <?php if($volunteers_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                </ol>
	                                        
	                        </div>
	                                    
	                    </div>
	                                    
	                </div>
	                            
	            </section>

				<!-- Content -->
				<section class='module'>
						
					<div class='container'>

						<div id='user_details_div'>

							<div class='row container-fluid'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<?php

										$row = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));

										$user_firstname = $row['firstname'];
										$user_lastname = $row['lastname'];
										$user_email = $row['email'];
										$user_cell_no = $row['cell_no'];

										$user_cell_no = base64_decode($user_cell_no);

                                        $_SESSION['hoa_alchemy_cell_no'] = $user_cell_no;

									?>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

											<h3 class='h3'>Is this information correct?</h3>

										</div>

									</div>

									<br>

									<div class='row'>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='user_information_radio' id='user_information_radio_yes' value='yes'> <strong style='color: black;'>Yes</strong>, this information is correct.

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='user_information_radio' id='user_information_radio_no' value='no'> <strong style='color: black;'>No</strong>, this information is incorrect.

										</div>

									</div>

									<br>

									<div class='row'>
										
										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

											<label><strong><u>Name</u></strong></label>

											<br>

											<h3 class='h3' style='color: black;'><?php echo $user_firstname; ?></h3>

										</div>

									</div>

									<br>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

											<label><strong><u>Email</u></strong></label>

											<br>

											<h3 class='h3' id='user_email' style='color: black;'><?php echo $user_email; ?></h3>

										</div>

									</div>

									<br>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

											<label><strong><u>Cell Number</u></strong></label>

											<br>

											<h3 class='h3' id='user_cell_no' style='color: black;'><?php echo $user_cell_no; ?></h3>

										</div>

									</div>

                                    <hr class='small'>

                                    <div class='row'>

                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

                                            <button id='user_details_continue' name='user_details_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button>

                                        </div>

                                    </div>

								</div>

							</div>

						</div>

						<div id='edit_user_details_div'>

							<div class='row'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

										<h3 class='h3'>Update User Details</h3>

									</div>

									<br>

									<form method='POST' action='updateHOAID.php' class='ajax1'>
																						
										<div class='row'>

											<div class='col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12'>

												<label><strong>Name</strong></label>

												<br>

												<input class='form-control' type='text' name='edit_name' id='edit_name' value='<?php echo $user_firstname; ?>' readonly>

											</div>


											<div class='col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12'>

												<label><strong>Email</strong></label><br>
												<input class='form-control' type='email' name='edit_email' id='edit_email' value='<?php echo $user_email; ?>' required>

											</div>

											<div class='col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12'>

												<label><strong>Phone</strong></label><br>
												<input class='form-control' type='number' name='edit_cell_no' id='edit_cell_no' value='<?php echo $user_cell_no; ?>' required>

											</div>

										</div>

										<br>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

											<center>

												<button class='btn btn-warning btn-xs' name='user_edit_back' type='button' id='user_edit_back'><i class='fa fa-arrow-left'></i> Back</button> <button class='btn btn-success btn-xs' type='submit'><i class='fa fa-check'></i> Save</button>

											</center>

										</div>

									</form>

								</div>

							</div>

							<br>

						</div>

					</div>

				</section>

				<a class='scroll-top' href='#top'><i class='fa fa-angle-up'></i></a>

			</div>

		</div>

		<!-- Scripts-->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js"></script>
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
		<script src="assets/js/plugins.min.js"></script>
		<script src="assets/js/charts.js"></script>
		<script src="assets/js/custom.min.js"></script>

		<script src='assets/js/hoaid.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	</body>

</html>