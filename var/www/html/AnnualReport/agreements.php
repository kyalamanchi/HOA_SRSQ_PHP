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
            <section id='agreements_header' class='module-page-title'>
                                
                <div class='container'>
                                        
                    <div class='row-page-title'>
                                        
                        <div class='page-title-captions'>
                                            
                            <ol class="breadcrumb">
                                    
                                <li class="breadcrumb-item">User Details</li>
                                <li class="breadcrumb-item">Home Details</li>
                                <li class="breadcrumb-item">Persons</li>
                                <li class='breadcrumb-item'>Primary Email</li>
                                <li class='breadcrumb-item'>SMS Notifications</li>
                                <li class="breadcrumb-item"><strong style='color: black;'>Agreements</strong></li>
                                <li class='breadcrumb-item'>Documents</li>
                                <li class="breadcrumb-item">Payments</li>
                                <li class="breadcrumb-item">HOA Fact Sheet</li>
                                <li class="breadcrumb-item">Disclosures</li>

                            </ol>
                                        
                        </div>
                                    
                    </div>
                                    
                </div>
                            
            </section>

			<div class='wrapper'>

				<!-- Content -->
				<section class='module'>
						
					<div class='container'>

						<div id='agreements_div'>

							<div class='row'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<center><h3>Pending Agreements</h3></center>

								</div>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive'>

									<table id='pendingAgreements' class='table table-striped' style='color: black;'>

										<thead>
											
											<th>Agreement</th>
											<th>Email</th>
											<th>Sign Agreement</th>

										</thead>

										<tbody>

											<?php

												$result = pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='OUT_FOR_SIGNATURE' AND board_cancel_requested='f' AND document_to IN (SELECT email FROM person WHERE hoa_id=$hoa_id AND home_id=$home_id)");

												while($row = pg_fetch_assoc($result))
												{
													
													$id = $row['id'];
			                          				$document_to = $row['document_to'];
			                          				$agreement_name = $row['agreement_name'];
			                          				$esign_url = $row['esign_url'];
		                          				
		                          					echo "<tr><td><a title='Click to sign agreement' target='_blank' href='$esign_url'>$agreement_name</a></td><td>$document_to</td><td><a title='Click to sign agreement' target='_blank' href='$esign_url'>Click Here</a></td></tr>";
		                          				}

											?>
											
										</tbody>

									</table>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<center><h3>Signed Agreements</h3></center>

								</div>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<table id='signedAgreements' class='table table-striped' style='color: black;'>

										<thead>
											
											<th>Agreement</th>
											<th>Email</th>
											<th>Document Preview</th>

										</thead>

										<tbody>

											<?php

												$result = pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='SIGNED' AND board_cancel_requested='f' AND document_to IN (SELECT email FROM person WHERE hoa_id=$hoa_id AND home_id=$home_id)");

												while($row = pg_fetch_assoc($result))
												{
													
			                          				$agreement_id = $row['agreement_id'];
			                          				$document_to = $row['document_to'];
			                          				$agreement_name = $row['agreement_name'];
			                          				$esign_url = $row['esign_url'];
		                          				
		                          					echo "<tr><td><a target='_blank' href='esignPreview.php?id=$agreement_id'>$agreement_name</a></td><td>$document_to</td><td><a target='_blank' href='esignPreview.php?id=$agreement_id'><i class='fa fa-file-pdf-o'></i></a></td></tr>";

		                          				}

											?>
											
										</tbody>

									</table>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<hr class='small'>

									<div class='row'>
										
										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

											<button class='btn btn-warning btn-xs' type='button' id='agreements_back' name='agreements_back'><i class='fa fa-arrow-left'></i> Back</button>

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

											<button class='btn btn-xs btn-success' name='agreements_continue' id='agreements_continue'>Continue <i class='fa fa-arrow-right'></i></button>

										</div>

									</div>

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
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA0rANX07hh6ASNKdBr4mZH0KZSqbHYc3Q"></script>
		<script src="assets/js/plugins.min.js"></script>
		<script src="assets/js/charts.js"></script>
		<script src="assets/js/custom.min.js"></script>

		<script src='assets/js/agreements.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <!-- Datatable -->
        <script src='//code.jquery.com/jquery-1.12.4.js'></script>
        <script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>

        <script>
        
            $(function () {
                
                $("#pendingAgreements").DataTable({ "paging":   false, "pageLength": 500, "info": false, "order": [[0, 'desc']] });

            });

        </script>

        <script>
        
            $(function () {
                
                $("#signedAgreements").DataTable({ "paging":   false, "pageLength": 500, "info": false, "order": [[0, 'desc']] });

            });

        </script>

        <script>
        
            $(function () {
                
                $("#myDocuments").DataTable({ "pageLength": 50, "info": false, "order": [[0, 'desc']] });

            });

        </script>

        <!-- My Chart 1 -->
        <script type="text/javascript">
      
            var ctx = document.getElementById('myChart1').getContext('2d');
            var myBarChart = new Chart(ctx, {
        
                type: 'horizontalBar',
                data: {

                    datasets: [{

                        data: [ <?php echo $jan_members_paid; ?>, <?php echo $feb_members_paid; ?>, <?php echo $mar_members_paid; ?>, <?php echo $apr_members_paid; ?>, <?php echo $may_members_paid; ?>, <?php echo $jun_members_paid; ?>, <?php echo $jul_members_paid; ?>, <?php echo $aug_members_paid; ?>, <?php echo $sep_members_paid; ?>, <?php echo $oct_members_paid; ?>, <?php echo $nov_members_paid; ?>, <?php echo $dec_members_paid; ?> ],
                        backgroundColor: [ "rgba(153, 102, 255, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)" ],
                        borderColor: [ "rgb(153, 102, 255)", "rgb(54, 162, 235)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(153, 102, 255)", "rgb(54, 162, 235)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(153, 102, 255)", "rgb(54, 162, 235)", "rgb(255, 205, 86)", "rgb(75, 192, 192)" ],
                        borderWidth: 1

                    }],

                    labels: [ 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ]

                },

                options: {

                    scales: {
                
                        xAxes: [{
                  
                            ticks: {
                    
                                beginAtZero:true

                            }
                
                        }]
              
                    },

                    legend: {

                        display: false

                    },
              
                    title: {

                        display: true,
                        fontSize: 15,
                        fontStyle: 'bold',
                        text: 'Members Paid'

                    }

                }
          
            });

        </script>

        <!-- My Chart 2 -->
        <script type="text/javascript">
      
            var ctx = document.getElementById('myChart2').getContext('2d');
            var mixedChart = new Chart(ctx, {
        
                type: 'bar',
        
                data: {
          
                    datasets: [{
            
                        label: 'Amount Received',
                        backgroundColor: [ "rgba(153, 102, 255, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)" ],
                        borderColor: [ "rgb(153, 102, 255)", "rgb(54, 162, 235)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(153, 102, 255)", "rgb(54, 162, 235)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(153, 102, 255)", "rgb(54, 162, 235)", "rgb(255, 205, 86)", "rgb(75, 192, 192)" ],
                        borderWidth: 1,
                        data: [ <?php echo $jan_amount_received; ?>, <?php echo $feb_amount_received; ?>, <?php echo $mar_amount_received; ?>, <?php echo $apr_amount_received; ?>, <?php echo $may_amount_received; ?>, <?php echo $jun_amount_received; ?>, <?php echo $jul_amount_received; ?>, <?php echo $aug_amount_received; ?>, <?php echo $sep_amount_received; ?>, <?php echo $oct_amount_received; ?>, <?php echo $nov_amount_received; ?>, <?php echo $dec_amount_received; ?> ]

                    }, 
                    {
            
                        label: 'Amount Needed',
                        pointRadius: 3,
                        borderColor: "rgba(255,99,132,1)",
                        pointBackgroundColor: "rgba(255,99,132,1)",
                        pointBorderColor: "rgb(255, 99, 132)",
                        data: [ <?php echo $total_homes * $assessment_amount; ?>, <?php echo $total_homes * $assessment_amount; ?>, <?php echo $total_homes * $assessment_amount; ?>, <?php echo $total_homes * $assessment_amount; ?>, <?php echo $total_homes * $assessment_amount; ?>, <?php echo $total_homes * $assessment_amount; ?>, <?php echo $total_homes * $assessment_amount; ?>, <?php echo $total_homes * $assessment_amount; ?>, <?php echo $total_homes * $assessment_amount; ?>, <?php echo $total_homes * $assessment_amount; ?>, <?php echo $total_homes * $assessment_amount; ?>, <?php echo $total_homes * $assessment_amount; ?> ],

                        type: 'line'

                    }],

                    labels: [ 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ]

                },

                options: {

                    scales: {
            
                        yAxes: [{
              
                            ticks: {
                
                                beginAtZero:true

                            }
            
                        }]
          
                    },

                    legend: {

                        display: false

                    },
          
                    title: {

                        display: true,
                        fontSize: 15,
                        fontStyle: 'bold',
                        text: 'Amount Received ($)'

                    }

                }

            });

        </script>

        <!-- My Chart 3 -->
        <script type="text/javascript">
      
            var ctx = document.getElementById('myChart3').getContext('2d');
            var myBarChart = new Chart(ctx, {
        
                type: 'line',
                data: {

                    datasets: [{

                        data: [ <?php echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-01-16' AND process_date<='$year-01-31'")); ?>, <?php echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-02-16' AND process_date<='$year-02-$feb_days'")); ?>, <?php echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-03-16' AND process_date<='$year-03-31'")); ?>, <?php echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-04-16' AND process_date<='$year-04-30'")); ?>, <?php echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-05-16' AND process_date<='$year-05-31'")); ?>, <?php echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-06-16' AND process_date<='$year-06-30'")); ?>, <?php echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-07-16' AND process_date<='$year-07-31'")); ?>, <?php echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-08-16' AND process_date<='$year-08-31'")); ?>, <?php echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-09-16' AND process_date<='$year-09-30'")); ?>, <?php echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-10-16' AND process_date<='$year-10-31'")); ?>, <?php echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-11-16' AND process_date<='$year-11-30'")); ?>, <?php echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-12-16' AND process_date<='$year-12-31'")); ?> ],
                        pointBackgroundColor: "rgba(255,99,132,1)",
                        pointBorderColor: "rgb(255, 99, 132)",
                        borderWidth: 6,
                        pointStyle: "rectRot",
                        showLine: false

                    }],

                    labels: [ 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ]

                },

                options: {

                    scales: {
            
                        xAxes: [{
              
                            ticks: {
                
                                beginAtZero:true

                            }
            
                        }]
          
                    },

                    legend: {

                        display: false

                    },
          
                    title: {

                        display: true,
                        fontSize: 15,
                        fontStyle: 'bold',
                        text: 'Late Payments'

                    }

                }
      
            });

        </script>

	</body>

</html>