<?php
	
	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header('Location: logout.php');

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
				
				</div>

			</header>

			<div class='wrapper'>

                <!-- Page Header -->
                <section class='module-page-title'>
                                    
                    <div class='container'>
                                            
                        <div class='row-page-title'>
                                            
                            <div class='page-title-captions'>
                                                
                                <ol class="breadcrumb">
                                        
                                    <li class="breadcrumb-item">User Details</li>
                                    <li class="breadcrumb-item">Home Details</li>
                                    <li class="breadcrumb-item">Persons</li>
                                    <li class='breadcrumb-item'>Primary Email</li>
                                    <li class='breadcrumb-item'>SMS Notifications</li>
                                    <li class="breadcrumb-item">Agreements</li>
                                    <li class='breadcrumb-item'>Documents</li>
                                    <li class='breadcrumb-item'>CCR Inspection Notices</li>
                                    <li class="breadcrumb-item">Payments</li>
                                    <li class="breadcrumb-item"><strong style='color: black;'>HOA Fact Sheet</strong></li>
                                    <li class='breadcrumb-item'>Contracts</li>
                                    <li class='breadcrumb-item'>QB Reports</li>
                                    <li class="breadcrumb-item">Disclosures</li>
                                    <li class='breadcrumb-item'>Volunteers</li>

                                </ol>
                                            
                            </div>
                                        
                        </div>
                                        
                    </div>
                                
                </section>

				<!-- Content -->
				<section class='module'>
						
					<div class='container'>

						<div id='hoa_fact_sheet_div'>

							<div class='row'>

								<div class='col=xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<center><h3 class='h3'>HOA Fact Sheet</h3></center>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class="container">

									<div class="row">

										<div class="table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
											<!-- Tabs-->
											<ul class="nav nav-tabs" id='tab'>
										
												<li class="nav-item"><a class="nav-link disabled" href="#tab-1" data-toggle="tab">Board</a></li>
												<li class="nav-item"><a class="nav-link disabled" href="#tab-2" data-toggle="tab">Comms</a></li>
												<li class="nav-item"><a class="nav-link active" href="#tab-3" data-toggle="tab">Reserves</a></li>
												<li class="nav-item"><a class="nav-link disabled" href="#tab-4" data-toggle="tab">Finance</a></li>

											</ul>

											<div class="tab-content">

												<div class="tab-pane in active" id="tab-3">
												
													<div class="special-heading m-b-40">
											
														<h4><i class="fa fa-support"></i> Reserves Dashboard</h4>
										
													</div>

													<div class='container'>

														<div class='row'>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

		                          								<div class='counter h6'>
		                              
		                              								<?php 

		                                								$assets = pg_num_rows(pg_query("SELECT * FROM community_assets WHERE community_id=$community_id"));

		                                								if($assets != '')
		                                  									echo "<div class='counter-number' style='color: green;'>$assets</div>";
		                                								else
		                                  									echo "<div class='counter-number'>$assets</div>";

		                              								?>

		                            								<div class='counter-title'>Assets</div>

		                          								</div>

		                        							</div>

		                        							<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

		                          								<div class='counter h6'>

		                            								<?php 

		                              									$row = pg_fetch_assoc(pg_query("SELECT sum(invoice_amount) FROM community_invoices WHERE reserve_expense='t' AND community_id=$community_id"));

		                              									$repairs = $row['sum'];

		                              									$repairs = round($repairs, 0);
											
		                              									if($repairs > 0)
		                                									echo "<div class='counter-number' style='color: green;'>".$repairs."</div>";
		                              									else
		                                									echo "<div class='counter-number'>".$repairs."</div>";

		                            								?>

		                            								<div class='counter-title'>Completed Repairs ($)</div>

		                          								</div>

		                        							</div>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>
																		
																		<?php 

																			$row = pg_fetch_assoc(pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id"));

																			$reserves = $row['cur_bal_vs_ideal_bal'];

																			echo $reserves;

																		?>
																			
																	</div>

																	<div class='counter-title'>Reserves Funded (%)</div>

																</div>

															</div>

		                        							<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

		                          								<div class='counter h6'>

		                            								<?php 

		                              									$row = pg_fetch_assoc(pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id AND fisc_yr_end<='$year-12-31'"));

		                              									$recommended_monthly_allocation_units = $row['rec_mthly_alloc_unit'];
		                              									$cur_bal_vs_ideal_bal = $row['cur_bal_vs_ideal_bal'];

		                              									$reserve_allocation = $recommended_monthly_allocation_units * $month;

		                              									$reserve_allocation = round($reserve_allocation, 0);

		                              									if($cur_bal_vs_ideal_bal >= 70)
		                                									echo "<div class='counter-number' style='color: green;'>".$reserve_allocation."</div>";
		                              									else
		                                									echo "<div class='counter-number' style='color: orange;'>".$reserve_allocation."</div>";

		                            								?>

		                            								<div class='counter-title'>YTD Allocation ($)</div>

		                          								</div>

		                       								</div>

														</div>

													</div>

												</div>

											</div>

										</div>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1'>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

											<div class='row'>
										
												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

													<button id='hoa_fact_sheet_back' name='hoa_fact_sheet_back' class='btn btn-warning btn-xs'><i class='fa fa-arrow-left'></i> Back</button>

												</div>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

													<button id='hoa_fact_sheet_continue' name='hoa_fact_sheet_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button>

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
		<script src="assets/js/plugins.min.js"></script>
		<script src="assets/js/charts.js"></script>
		<script src="assets/js/custom.min.js"></script>

		<script src='assets/js/factSheet3.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	</body>

</html>