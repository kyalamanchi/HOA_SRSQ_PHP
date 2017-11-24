<?php
	
	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header('Location: logout.php');

	$username = $_SESSION['hoa_alchemy_username'];
	$community_id = $_SESSION['hoa_alchemy_community_id'];
	$community_code = $_SESSION['hoa_alchemy_community_code'];
	$community_name = $_SESSION['hoa_alchemy_community_name'];

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

	$days90 = date('Y-m-d', strtotime("-90 days"));
	$del_acc = 0;
    $del = 3;

    $year = date('Y');
    $month = date('m');
    $last = date('t');

	$row = pg_fetch_assoc(pg_query("SELECT amount FROM assessment_amounts WHERE community_id=$community_id"));

    $assessment_amount = $row['amount'];
    $del_amount = $assessment_amount * $del;

	$res_dir = pg_num_rows(pg_query("SELECT * FROM member_info WHERE community_id=$community_id"));
	$email_homes = pg_num_rows(pg_query("SELECT * FROM hoaid WHERE email!='' AND community_id=$community_id"));
	$total_homes = pg_num_rows(pg_query("SELECT * FROM homeid WHERE community_id=$community_id"));
	$tenants = pg_num_rows(pg_query("SELECT * FROM home_mailing_address WHERE community_id=$community_id"));
	$newly_moved_in = pg_num_rows(pg_query("SELECT * FROM hoaid WHERE community_id=$community_id AND valid_from>='".$days90."' AND valid_from<='".date('Y-m-d')."'"));

    $result = pg_query("SELECT home_id, sum(amount) FROM current_charges WHERE assessment_rule_type_id=1 AND community_id=$community_id GROUP BY home_id ORDER BY home_id");

    while($row = pg_fetch_assoc($result))
    {

        $temp_home_id = $row['home_id'];
        $assessment_charges = $row['sum'];

        $row2 = pg_fetch_assoc(pg_query("SELECT hoa_id, firstname, lastname, cell_no, email FROM hoaid WHERE home_id=".$temp_home_id));
        $temp_hoa_id = $row2['hoa_id'];

        $row2 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE hoa_id=".$temp_hoa_id));
        $charges = $row2['sum'];

        $row2 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE payment_status_id=1 AND hoa_id=".$temp_hoa_id));
        $payments = $row2['sum'];

        $balance = $charges - $payments;

        if($del_amount <= ($assessment_charges - $payments) && $balance >= $del_amount)
          $del_acc++;

    }

    $monthly_total = $assessment_amount * $total_homes;

    $monthly_amount = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND process_date>='$year-$month-1' AND process_date<='$year-$month-$last' AND payment_status_id=1"));

    $monthly_amount = $monthly_amount['sum'];

    $amount_received = ($monthly_amount / $monthly_total) * 100;

    $members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND process_date>='$year-$month-1' AND process_date<='$year-$month-$last' AND payment_status_id=1"));

    $members_paid = ($members_paid / $total_homes) * 100;

    $row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-01-01' AND process_date<='$year-01-31'"));
    $jan_amount_received = $row['sum'];
    #$jan_amount_received = ( $jan_amount_received / $monthly_total ) * 100;
    $jan_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-01-01' AND process_date<='$year-01-31'"));
    #$jan_members_paid = ( $jan_members_paid / $total_homes ) * 100;

    if( (0 == $year % 4) and (0 != $year % 100) or (0 == $year % 400) )
        $feb_days = 29;
    else
        $feb_days = 28;

    $row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-02-01' AND process_date<='$year-02-$feb_days'"));
    $feb_amount_received = $row['sum'];
    #$feb_amount_received = ( $feb_amount_received / $monthly_total ) * 100;
    $feb_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-02-01' AND process_date<='$year-02-$feb_days'"));
    #$feb_members_paid = ( $feb_members_paid / $total_homes ) * 100;

    $row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-03-01' AND process_date<='$year-03-31'"));
    $mar_amount_received = $row['sum'];
    #$mar_amount_received = ( $mar_amount_received / $monthly_total ) * 100;
    $mar_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-03-01' AND process_date<='$year-03-31'"));
    #$mar_members_paid = ( $mar_members_paid / $total_homes ) * 100;

    $row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-04-01' AND process_date<='$year-04-30'"));
    $apr_amount_received = $row['sum'];
    #$apr_amount_received = ( $apr_amount_received / $monthly_total ) * 100;
    $apr_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-04-01' AND process_date<='$year-04-30'"));
    #$apr_members_paid = ( $apr_members_paid / $total_homes ) * 100;

    $row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-05-01' AND process_date<='$year-05-31'"));
    $may_amount_received = $row['sum'];
    #$may_amount_received = ( $may_amount_received / $monthly_total ) * 100;
    $may_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-05-01' AND process_date<='$year-05-31'"));
    #$may_members_paid = ( $may_members_paid / $total_homes ) * 100;

    $row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-06-01' AND process_date<='$year-06-30'"));
    $jun_amount_received = $row['sum'];
    #$jun_amount_received = ( $jun_amount_received / $monthly_total ) * 100;
    $jun_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-06-01' AND process_date<='$year-06-30'"));
    #$jun_members_paid = ( $jun_members_paid / $total_homes ) * 100;

    $row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-07-01' AND process_date<='$year-07-31'"));
    $jul_amount_received = $row['sum'];
    #$jul_amount_received = ( $jul_amount_received / $monthly_total ) * 100;
    $jul_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-07-01' AND process_date<='$year-07-31'"));
    #$jul_members_paid = ( $jul_members_paid / $total_homes ) * 100;

    $row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-08-01' AND process_date<='$year-08-31'"));
    $aug_amount_received = $row['sum'];
    #$aug_amount_received = ( $aug_amount_received / $monthly_total ) * 100;
    $aug_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-08-01' AND process_date<='$year-08-31'"));
    #$aug_members_paid = ( $aug_members_paid / $total_homes ) * 100;

    $row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-09-01' AND process_date<='$year-09-30'"));
    $sep_amount_received = $row['sum'];
    #$sep_amount_received = ( $sep_amount_received / $monthly_total ) * 100;
    $sep_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-09-01' AND process_date<='$year-09-30'"));
    #$sep_members_paid = ( $sep_members_paid / $total_homes ) * 100;

    $row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-10-01' AND process_date<='$year-10-31'"));
    $oct_amount_received = $row['sum'];
    #$oct_amount_received = ( $oct_amount_received / $monthly_total ) * 100;
    $oct_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-10-01' AND process_date<='$year-10-31'"));
    #$oct_members_paid = ( $oct_members_paid / $total_homes ) * 100;

    $row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-11-01' AND process_date<='$year-11-30'"));
    $nov_amount_received = $row['sum'];
    #$nov_amount_received = ( $nov_amount_received / $monthly_total ) * 100;
    $nov_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-11-01' AND process_date<='$year-11-30'"));
    #$nov_members_paid = ( $nov_members_paid / $total_homes ) * 100;

    $row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-12-01' AND process_date<='$year-12-31'"));
    $dec_amount_received = $row['sum'];
    #$dec_amount_received = ( $dec_amount_received / $monthly_total ) * 100;
    $dec_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-12-01' AND process_date<='$year-12-31'"));
    #$dec_members_paid = ( $dec_members_paid / $total_homes ) * 100;

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
                                    <li class="breadcrumb-item">Disclosures</li>

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
												<li class="nav-item"><a class="nav-link disabled" href="#tab-3" data-toggle="tab">Reserves</a></li>
												<li class="nav-item"><a class="nav-link active" href="#tab-4" data-toggle="tab">Finance</a></li>

											</ul>

											<div class="tab-content">

												<div class="tab-pane in active" id="tab-4">
											
													<div class="special-heading m-b-40">
												
														<h4><i class="fa fa-dollar"></i> Finance Dashboard</h4>
									
													</div>

													<div class='container'>

														<?php

															if($community_id == 1)
																echo "

																	<div class='row module-gray'>

																		<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'><br><center><h3 class='h3'>BANK ACCOUNT BALANCE</h3></center></div>

																	</div>

																	<div class='row module-gray'>

																		<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

																			<div class='counter h6'>

																				<div class='counter-number'>
																					
																					".round($srp_savings_balance, 0)."
																						
																				</div>

																				<div class='counter-title'>Savings ($)</div>

																			</div>

																		</div>

																		<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

																			<div class='counter h6'>

																				<div class='counter-number'>

																					".round($srp_current_balance, 0)."

																				</div>

																				<div class='counter-title'>Checkings ($)</div>

																			</div>

																		</div>

																	</div>

			                            							<br><br>

																";
															else if($community_id == 2)
																echo "

																	<div class='row module-gray'>

																		<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'><br><center><h3 class='h3'>BANK ACCOUNT BALANCE</h3></center></div>

																	</div>

																	<div class='row module-gray'>

																		<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																			<div class='counter h6'>

																				<div class='counter-number'>
																					
																					".round($srp_primary_Savings_CurrentBalance, 0)."
																						
																				</div>

																				<div class='counter-title'>Checkings ($)</div>

																			</div>

																		</div>

																		<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																			<div class='counter h6'>

																				<div class='counter-number'>

																					".round($srp_savings, 0)."

																				</div>

																				<div class='counter-title'>Savings ($)</div>

																			</div>

																		</div>

																		<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																			<div class='counter h6'>

																				<div class='counter-number'>

																					".round($srsq_third_Account_Balance, 0)."

																				</div>

																				<div class='counter-title'>Investments ($)</div>

																			</div>

																		</div>

																	</div>

			                            							<br><br>

																";

														?>

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

	                      								<br><br>

													</div>

								                    <div class="special-heading m-b-40">
								                  
								                      	<h4><i class="fa fa-area-chart"></i> Yearly Report - <?php echo $year; ?></h4>
								            
								                    </div>

								                    <div class='container'>

								                      	<div class='row'>

									                        <div class='col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12'>
									                          
									                          	<canvas id="myChart1"></canvas>

									                        </div>

									                        <div class='col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12'>
									                          
									                         	<canvas id="myChart2"></canvas>

									                        </div>

								                      	</div>

								                    </div>

	                    							<br>

	                    							<div class='container'>

	                      								<div class='row'>

	                        								<div class='col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12'>
	                          
	                          									<canvas id="myChart3"></canvas>

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

		<script src='assets/js/factSheet4.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

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