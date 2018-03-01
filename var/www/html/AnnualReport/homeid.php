<?php
	
	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

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
	$page = $result['homeid'];

	if($page == 'f')
		header("Location: persons.php");

	$result = pg_query("UPDATE community_annual_report_visited SET homeid_page_visited='t', last_visited_on='$today', last_visited_ip='$ip' WHERE hoa_id=$hoa_id AND home_id=$home_id");

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
                                    
                                        User Details

                                        <?php if($hoaid_page_visited == 't') echo "</a>"; ?>

                                    </li>

                                    <li class="breadcrumb-item">

                                        <?php if($homeid_page_visited == 't') echo "<a href='homeid.php'>"; ?>
                                    
                                        <strong style='color: black;'>Home Details</strong>

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

						<div id='home_details_div'>

							<div class='row'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<?php

										$row = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));

										$property_address = $row['address1'];
										$living_status = $row['living_status'];

										if($living_status == 't')
										{

											$mailing_address = $property_address;
											$mailing_country = $row['country_id'];
											$mailing_district = $row['district_id'];
											$mailing_city = $row['city_id'];
											$mailing_state = $row['state_id'];
											$mailing_zip = $row['zip_id'];

										}
										else
										{

											$row = pg_fetch_assoc(pg_query("SELECT * FROM home_mailing_address WHERE home_id=$home_id"));

											$mailing_address = $row['address1'];
											$mailing_country = $row['country_id'];
											$mailing_district = $row['district_id'];
											$mailing_city = $row['city_id'];
											$mailing_state = $row['state_id'];
											$mailing_zip = $row['zip_id'];

										}

										$mailing_country_id = $mailing_country;
										$mailing_state_id = $mailing_state;
										$mailing_district_id = $mailing_district;
										$mailing_city_id = $mailing_city;
										$mailing_zip_id = $mailing_zip;

										$row = pg_fetch_assoc(pg_query("SELECT * FROM country WHERE country_id=$mailing_country"));
										$mailing_country = $row['country_name'];

										$row = pg_fetch_assoc(pg_query("SELECT * FROM state WHERE state_id=$mailing_state"));
										$mailing_state = $row['state_name'];

										$row = pg_fetch_assoc(pg_query("SELECT * FROM district WHERE district_id=$mailing_district"));
										$mailing_district = $row['district_name'];

										$row = pg_fetch_assoc(pg_query("SELECT * FROM city WHERE city_id=$mailing_city"));
										$mailing_city = $row['city_name'];

										$row = pg_fetch_assoc(pg_query("SELECT * FROM zip WHERE zip_id=$mailing_zip"));
										$mailing_zip = $row['zip_code'];

									?>

									<div class='container module-gray' style="color: black;">

										<?php

											$row = pg_fetch_assoc(pg_query("SELECT * FROM community_disclosures WHERE community_id=$community_id AND type_id=14"));

											$notes = $row['notes'];
											$document_id = $row['document_id'];
											$changed_this_year = $row['changed_this_year'];

											$row = pg_fetch_assoc(pg_query("SELECT * FROM disclosure_type WHERE id=14"));
											$disclosure_name = $row['name'];
											$desc = $row['desc'];
											$civilcode_section = $row['civilcode_section'];
											$legal_url = $row['legal_url'];

											if($civilcode_section != "")
												$disclosure_name = $disclosure_name." (".$civilcode_section.")";

											if($legal_url != '')
												$disclosure_name = "<a target='_blank' href='$legal_url'>$disclosure_name</a>";

											if($desc == "")
												$desc = " - ";

											if($notes == "")
												$notes = " - ";

											if($changed_this_year == 't') 
												$changed_this_year = "Yes"; 
											else if($changed_this_year == 'f') 
												$changed_this_year = "No"; 
											else 
												$changed_this_year = " - ";

											if($document_id == "")
												$document = " - ";
											else
												$document = "<a target='_blank' href='$document_id'>$document_id</a>";

											echo "

                                            <div class='row'>

                                                <div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

                                                    <div class='container module-gray' style='color: black;'>

                                                        <br>

                                                        <div class='row'>

                                                            <div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

                                                                <strong>Disclosure Name :</strong> $disclosure_name

                                                            </div>

                                                        </div>

                                                        <br>";

                                                        if($changed_this_year != ' - ')
                                                            echo "

                                                            <div class='row'>

                                                                <div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

                                                                    <strong>Changed this year :</strong> $changed_this_year

                                                                </div>

                                                            </div>

                                                            <br>

                                                            ";

                                                        if($notes != ' - ')
                                                            echo "

                                                            <div class='row'>

                                                                <div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

                                                                    <strong>Board Comments </strong> $notes

                                                                </div>

                                                            </div>

                                                            <br>";

                                                        if($document != ' - ')
                                                            echo "

                                                            <div class='row'>

                                                                <div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

                                                                    <strong>Document :</strong> $document

                                                                </div>

                                                            </div>

                                                            <br>

                                                            ";

                                                    echo "

                                                    </div>

                                                    <br>

                                                </div>

                                            </div>

                                            ";

										?>

									</div>

									<br>

									<div class='row'>
										
										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

											<h3 class='h3'>Do you still live in <u id='user_mailing_address'><?php echo $mailing_address; ?></u>?</h3>

										</div>

									</div>

									<br>

									<div class='row'>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='home_information_radio' id='home_information_radio_yes' value='yes'> <strong style='color: black;'>Yes</strong>, I'm living in the above address.

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='home_information_radio' id='home_information_radio_no' value='no'> <strong style='color: black;'>No</strong>, I rented my home out.

										</div>

									</div>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

											<hr class='small'>

											<div class='row'>
										
												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

													<button id='home_details_back' name='home_details_back' class='btn btn-warning btn-xs'><i class='fa fa-arrow-left'></i> Back</button>

												</div>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

													<button id='home_details_continue' name='home_details_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button>

												</div>

											</div>

										</div>

									</div>

								</div>

							</div>

							<br>

						</div>

						<div id='edit_home_details_div'>

							<div class='row'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

										<h3>Update Mailing Address</h3>

									</div>

									<br>

									<form method='POST' action='updateHomeID.php' class='ajax2'>
																						
										<div class='row'>

											<div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>

												<label><strong>Mailing Address</strong></label>

												<br>

												<input class='form-control' type='text' name='edit_mailing_address' id='edit_mailing_address' value='<?php echo $mailing_address; ?>' required>

											</div>

											<div class='col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12'>

												<label><strong>Mailing CSZ</strong></label>

												<br>

												<input class='form-control' type='text' name='edit_mailing_csz' id='edit_mailing_csz' value='<?php echo $mailing_city." , ".$mailing_state." ".$mailing_zip; ?>'>

											</div>

										</div>

										<br>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

											<center>

												<button class='btn btn-warning btn-xs' type='button' name='home_edit_back' id='home_edit_back'><i class='fa fa-arrow-left'></i> Back</button> <button class='btn btn-success btn-xs' type='submit'><i class='fa fa-check'></i> Save</button>

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

		<script src='assets/js/homeid.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	</body>

</html>