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
                <section id='documents_header' class='module-page-title'>
                                    
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
                                    <li class="breadcrumb-item">HOA Fact Sheet</li>
                                    <li class='breadcrumb-item'><strong style='color: black;'>Contracts</strong></li>
                                    <li class='breadcrumb-item'>Financial Summary</li>
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

						<div id='documents_div'>

                            <div class='row'>

                                <div class='row container'>

	                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

	                                    <center><h3>Financial Summary</h3></center>

	                                </div>

	                            </div>

	                            <br>

	                            <div class='row container'>

	                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive'>

	                                    <div class='row'>

	                        				<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

	                          					<div class='counter h6'>

	                            					<div class='counter-number'>
	                              
	                              						<?php 

	                                						if($community_id == 1)
	                                						{

	                                  							$ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145854171542/reports/VendorExpenses?minorversion=8');
	                                  							// curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'POST');
	                                  							curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
	                                  							curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprd0JzDPeMNuATqXcic8hnusenW2",oauth_token="qyprdxuMeT1noFaS5g6aywjSOkFQo16WnvwigzPbxQ01LPYF",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="doJ2s3%2F2B6LEarru2JKFfy9%2B8V0%3D"'));
	                                  							// curl_setopt($ch, CURLOPT_POSTFIELDS, "select * from vendor");
	                                  							curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	                                  
	                                  							$result = curl_exec($ch);
	                                  							$result  = json_decode($result);
	                                  							$vendorsArray = array();

	                                  							foreach ($result->Rows->Row as $ColumnData) 
	                                  							{
	                                      
	                                    							$values = array();
	                                    							$id = -10;
	                                    							$vendors = array();
	                                    							$amounts = array();
	                                      
	                                    							foreach ($ColumnData as $row) 
	                                    							{
	                                        
	                                      								$name = "";
	                                      								$id = "";
	                                      								$amount = "";
	                                          
	                                      								if ( $row->ColData )
	                                        								$finalAmount = $row->ColData[1]->value;

	                                    							}

	                                  							}

	                                  							echo round($finalAmount, 0);

	                                						}
	                                						else if($community_id == 2)
	                                						{

	                                  							$ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/reports/VendorExpenses?minorversion=8');
	                                  							// curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'POST');
	                                  							curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
	                                  							curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="0pBXJJqrgWzGbU51XadGu%2FuKtyc%3D"'));
	                                  							// curl_setopt($ch, CURLOPT_POSTFIELDS, "select * from vendor");
	                                  							curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	                                  
	                                  							$result = curl_exec($ch);
	                                  							$result  = json_decode($result);
	                                  							$vendorsArray = array();

	                                  							foreach ($result->Rows->Row as $ColumnData) 
	                                  							{
	                                      
	                                    							$values = array();
	                                   									$id = -10;
	                                    							$vendors = array();
	                                    							$amounts = array();
	                                      
	                                    							foreach ($ColumnData as $row) 
	                                    							{
	                                        
	                                      								$name = "";
	                                      								$id = "";
	                                      								$amount = "";
	                                          
	                                      								if ( $row->ColData )
	                                        								$finalAmount = $row->ColData[1]->value;

	                                    							}

	                                  							}

	                                 							echo round($finalAmount, 0);

	                                						}

	                              						?>
	                                
	                            					</div>

	                            					<div class='counter-title'>Expenditure By Vendors ($)</div>

	                          					</div>

	                        				</div>

	                      				</div>

	                                </div>

	                            </div>

                            </div>

                            <br>

                            <div class='row'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <hr class='small'>

                                    <div class='row'>
                                        
                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

                                            <button class='btn btn-warning btn-xs' type='button' id='financial_summary_back' name='financial_summary_back'><i class='fa fa-arrow-left'></i> Back</button>

                                        </div>

                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

                                            <button class='btn btn-xs btn-success' name='financial_summary_continue' id='financial_summary_continue'>Continue <i class='fa fa-arrow-right'></i></button>

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
		<script src="assets/js/plugins.min.js"></script>
		<script src="assets/js/charts.js"></script>
		<script src="assets/js/custom.min.js"></script>

		<script src='assets/js/financialSummary.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <!-- Datatable -->
        <script src='//code.jquery.com/jquery-1.12.4.js'></script>
        <script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>

        <script>
        
            $(function () {
                
                $("#contracts").DataTable({ "pageLength": 50, "order": [[0, 'desc']] });

            });

        </script>

	</body>

</html>