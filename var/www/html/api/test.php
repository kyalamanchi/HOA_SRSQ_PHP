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

?>

<!DOCTYPE html>

<html lang='en'>

	<head>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>

		<title><?php echo $community_code; ?> - User Page</title>

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

		<div class='layout'>

			<!-- Header-->
			<header class='header header-right undefined'>
	
				<div class='container-fluid'>
								
					<!-- Logos-->
					<div class='inner-header text-center'>

						<a class='inner-brand'><h3 style='color: green;'><?php echo $community_code; ?></h3></a>

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
				
				</div>

			</header>

			<div class='wrapper'>

				<!-- Content -->
				<section class='module'>
						
					<div class='container'>

						<div id='disclosures_div'>

							<br>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item">User Details</li>
											<li class="breadcrumb-item">Home Details</li>
											<li class="breadcrumb-item">Email &amp; Persons</li>
                                            <li class='breadcrumb-item'>SMS Notifications</li>
                                            <li class="breadcrumb-item">Agreements</li>
											<li class='breadcrumb-item'>Documents</li>
                                            <li class="breadcrumb-item">HOA Fact Sheet</li>
											<li class="breadcrumb-item"><strong style='color: black;'>Disclosures</strong></li>

										</ol>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<?php

                                        $result = pg_query("SELECT * FROM community_disclosures WHERE community_id=$community_id");

                                        while($row = pg_fetch_assoc($result))
                                        {

                                            $notes = $row['notes'];
                                            $document_id = $row['document_id'];
                                            $changed_this_year = $row['changed_this_year'];
                                            $type_id = $row['type_id'];

                                            $row = pg_fetch_assoc(pg_query("SELECT * FROM community_disclosure_type WHERE id=$type_id"));
                                            $disclosure_name = $row['name'];
                                            $desc = $row['desc'];
                                            $civilcode_section = $row['civilcode_section'];
                                            $legal_url = $row['legal_url'];

                                            $dname = $disclosure_name;

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
                                                $document = "<a target='_blank' href='getDocumentPreview.php?cid=$community_id&path=$document_id&desc=$dname'><i class='fa fa-file-pdf-o'></i> Click Here</a>";

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

                                                        <br>

                                                        <div class='row'>

                                                            <div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

                                                                <strong>Changed this year :</strong> $changed_this_year

                                                            </div>

                                                        </div>

                                                        <br>

                                                        <div class='row'>

                                                            <div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

                                                                <strong>Board Comments </strong> $notes

                                                            </div>

                                                        </div>

                                                        <br>

                                                        <div class='row'>

                                                            <div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

                                                                <strong>Document :</strong> $document

                                                            </div>

                                                        </div>

                                                        <br>

                                                    </div>

                                                    <br><br>

                                                </div>

                                            </div>

                                            ";

                                        }

                                    ?>

									<br>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

											<hr class='small'>

											<div class='row'>
										
												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

													<button id='disclosure1_back' name='disclosure1_back' class='btn btn-warning btn-xs'><i class='fa fa-arrow-left'></i> Back</button>

												</div>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

													<!--button id='disclosure1_continue' name='disclosure1_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button-->

												</div>

											</div>

										</div>

									</div>

								</div>

							</div>

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
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA0rANX07hh6ASNKdBr4mZH0KZSqbHYc3Q"></script>
		<script src="assets/js/plugins.min.js"></script>
		<script src="assets/js/charts.js"></script>
		<script src="assets/js/custom.min.js"></script>

		<script src='assets/js/userPage.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

		<!-- Datatable -->
		<script src='//code.jquery.com/jquery-1.12.4.js'></script>
		<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>