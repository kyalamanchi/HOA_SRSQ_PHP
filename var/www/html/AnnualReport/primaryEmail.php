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

?>

<!DOCTYPE html>

<html lang='en'>

	<head>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='HOA Alchemy User Features'>
		<meta name='author' content='Geeth'>

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

            <!-- Page Header -->
            <section class='module-page-title'>
                                
                <div class='container'>
                                        
                    <div class='row-page-title'>
                                        
                        <div class='page-title-captions'>
                                            
                            <ol class="breadcrumb">
                                    
                                <li class="breadcrumb-item">User Details</li>
                                <li class="breadcrumb-item">Home Details</li>
                                <li class="breadcrumb-item">Persons</li>
                                <li class="breadcrumb-item"><strong style='color: black;'>Primary Email</strong></li>
                                <li class='breadcrumb-item'>SMS Notifications</li>
                                <li class="breadcrumb-item">Agreements</li>
                                <li class='breadcrumb-item'>Documents</li>
                                <li class="breadcrumb-item">Payments</li>
                                <li class="breadcrumb-item">HOA Fact Sheet</li>
                                <li class="breadcrumb-item">Disclosures</li>
                                <li class="breadcrumb-item">HOA Account</li>

                            </ol>
                                        
                        </div>
                                    
                    </div>
                                    
                </div>
                            
            </section>

			<div class='wrapper'>

				<!-- Content -->
				<section class='module'>
						
					<div class='container'>

                        <div id='edit_email_div'>

                            <div class='row'>

                                <div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

                                    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

                                        <h3>Choose your <u>primary email</u> to get HOA communication.</h3>

                                    </div>

                                    <br><br>

                                    <form method='POST' action='updatePrimaryEmail.php'>

                                        <div class='row'>

                                            <input type='hidden' name='hoa_id' id='hoa_id' value='<?php echo $hoa_id; ?>'>

                                            <?php

                                            	$result = pg_fetch_assoc(pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id AND is_active='t' AND is_primary_email='t'"));

                                            	$primary_email = $result['id'];

                                                $result = pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id AND is_active='t' ORDER BY email");

                                                while($row = pg_fetch_assoc($result))
                                                {

                                                    $pid = $row['id'];
                                                    $pemail = $row['email'];

                                                    echo "

                                                    <div class='col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12'>

                                                        <input type='radio' name='change_primary_email' value='".$pid."'";

                                                        if($pid == $primary_email)
                                                            echo " checked";

                                                        echo "> <label style='color: black;'><strong>".$pemail."</strong></label>

                                                    </div>

                                                    ";

                                                }

                                            ?>
                                                                                        
                                        </div>

                                        <br>

                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                            <center>

                                                <button class='btn btn-success btn-xs' type='submit'><i class='fa fa-save'></i> Save</button>

                                            </center>

                                        </div>

                                    </form>

                                </div>

                            </div>

                            <br>

                            <div class='row container-fluid'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<hr class='small'>

									<div class='row'>
										
										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

											<button id='email_back' name='email_back' class='btn btn-warning btn-xs'><i class='fa fa-arrow-left'></i> Back</button>

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

											<button id='email_continue' name='email_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button>

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

		<script src='assets/js/primaryEmail.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	</body>

</html>