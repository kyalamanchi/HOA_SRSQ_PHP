<?php
	
	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header('Location: logout.php');

	$username = $_SESSION['hoa_alchemy_username'];
	$hoa_id = $_SESSION['hoa_alchemy_hoa_id'];
    $home_id = $_SESSION['hoa_alchemy_home_id'];
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
    $page = $result['hoa_fact_sheet'];

    if($page == 'f')
        header("Location: communityContracts.php");

    $result = pg_query("UPDATE community_annual_report_visited SET hoa_fact_sheet_page_visited='t', last_visited_on='$today', last_visited_ip='$ip' WHERE hoa_id=$hoa_id AND home_id=$home_id");

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

	if($community_id == 1)
    { 
                      
        $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145854171542/account/77?minorversion=8');      
                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprd0JzDPeMNuATqXcic8hnusenW2",oauth_token="qyprdxuMeT1noFaS5g6aywjSOkFQo16WnvwigzPbxQ01LPYF",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="jzXGHD9VKI6fxwrXaWg90HQgFuI%3D"'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                            
        $result = curl_exec($ch);
        $json_decode = json_decode($result,TRUE);
        $srp_primarySavings = $json_decode['Account'];
        $srp_current_balance = $srp_primarySavings['CurrentBalance'];
                            
        curl_close($ch);

        $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145854171542/account/74?minorversion=8');      
                            
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprd0JzDPeMNuATqXcic8hnusenW2",oauth_token="qyprdxuMeT1noFaS5g6aywjSOkFQo16WnvwigzPbxQ01LPYF",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1508539532",oauth_nonce="2nX9kd69aNw",oauth_version="1.0",oauth_signature="5ZScoTRHF28D3YT0kHO27%2Br8Hvo%3D"'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                            
        $result2 = curl_exec($ch);
        $json_decode2 = json_decode($result2,TRUE);
        $srp = $json_decode2['Account'];
        $srp_savings_balance = $srp['CurrentBalance'];

    }
    else if($community_id == 2)
    {
                      
        $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/account/33?minorversion=8');      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1506682054",oauth_nonce="skPZikoZJCt",oauth_version="1.0",oauth_signature="aEBIdXcJdXSWiLp5k9gxlVuvsbs%3D"'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result = curl_exec($ch);
        $json_decode = json_decode($result,TRUE);
        $srp_primarySavings = $json_decode['Account'];
        $srp_primary_Savings_CurrentBalance = $srp_primarySavings['CurrentBalance'];

        curl_close($ch);

        $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/account/32?minorversion=8');      
                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="5IDpz%2F%2FItyjMYbh4Ke3JoBx3YGY%3D"'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result2 = curl_exec($ch);
        $json_decode2 = json_decode($result2,TRUE);
        $srp = $json_decode2['Account'];
        $srp_savings = $srp['CurrentBalance'];

        curl_close($ch);

        $ch  = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/account/31?minorversion=8');
                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1506681985",oauth_nonce="H7DXVHb2Qdp",oauth_version="1.0",oauth_signature="HDWt%2BfIz3NrAhJE9fO9G%2FI8Q%2Fcg%3D"'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result3 = curl_exec($ch);
        $json_decode3 = json_decode($result3,TRUE);
        $srsq_third_Account = $json_decode3['Account'];
        $srsq_third_Account_Balance = $srsq_third_Account['CurrentBalance'];
            
    }

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
                                        
                                        <strong style='color: black;'>HOA Fact Sheet</strong>

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
												<li class="nav-item"><a class="nav-link active" href="#tab-2" data-toggle="tab">Comms</a></li>
												<li class="nav-item"><a class="nav-link disabled" href="#tab-3" data-toggle="tab">Reserves</a></li>
												<li class="nav-item"><a class="nav-link disabled" href="#tab-4" data-toggle="tab">Finance</a></li>

											</ul>

											<div class="tab-content">
										
												<div class="tab-pane in active" id="tab-2">
												
													<div class="special-heading m-b-40">
											
														<h4><i class="fa fa-envelope"></i> Communications Dashboard</h4>
										
													</div>

													<div class='container'>

														<div class='row'>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<?php

																		$email_homes = pg_num_rows(pg_query("SELECT * FROM hoaid WHERE email!='' AND community_id=$community_id"));

																		if($email_homes > 0)
																			echo "<div class='counter-number' style='color: green;'>".$email_homes."</div>";
																		else
																			echo "<div class='counter-number'>".$email_homes."</div>";

																	?>

																	<div class='counter-title'>Email Signup</div>

																</div>

															</div>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>
																	
																		<?php

																			$campaigns = 0;

																			if($community_id == 1)
																			{

																				$ch = curl_init('https://us14.api.mailchimp.com/3.0/campaigns/');
																				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: apikey eecf4b5c299f0cc2124463fb10a6da2d-us14'));

																			}
																			else if($community_id == 2)
																			{

																				$ch = curl_init('https://us12.api.mailchimp.com/3.0/campaigns/');
																				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: apikey af5b50b9f714f9c2cb81b91281b84218-us12'));

																			}
												            				
												            				curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
												            				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
												            
												            				$result = curl_exec($ch);
												            				$json_decode = json_decode($result,TRUE);

												            				foreach ($json_decode['campaigns'] as $key ) 
												            					$campaigns++;

												            				echo $campaigns;

																		?>
																		
																	</div>

																	<div class='counter-title'>Community Notifications</div>

																</div>

															</div>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<?php 

																		$statements_mailed = pg_num_rows(pg_query("SELECT * FROM community_statements_mailed WHERE community_id=$community_id"));

																		if($statements_mailed == 0)
																			echo "<div class='counter-number'>".$statements_mailed."</div>";
																		else
																			echo "<div class='counter-number' style='color: green;'>$statements_mailed</div>";

																	?>

																	<div class='counter-title'>Statements Mailed</div>

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

		<script src='assets/js/factSheet2.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	</body>

</html>