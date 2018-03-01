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
										
												<li class="nav-item"><a class="nav-link active" href="#tab-1" data-toggle="tab">Board</a></li>
												<li class="nav-item"><a class="nav-link disabled" href="#tab-2" data-toggle="tab">Comms</a></li>
												<li class="nav-item"><a class="nav-link disabled" href="#tab-3" data-toggle="tab">Reserves</a></li>
												<li class="nav-item"><a class="nav-link disabled" href="#tab-4" data-toggle="tab">Finance</a></li>

											</ul>

											<div class="tab-content">
										
												<div class="tab-pane in active" id="tab-1">
											
													<div class="special-heading m-b-40">
										
														<h4><i class="fa fa-dashboard"></i> Board Dashboard</h4>
									
													</div>
									
													<div class='container'>

														<div class='row module-gray'>

															<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

																<br><center><h3 class='h3'>PAYMENT INFORMATION</h3></center>

															</div>

														</div>
			
														<div class='row module-gray'>

															<div class='col-xl-2 col-lg-2 col-md-6 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>
																
																		<?php echo round($amount_received, 0); ?>
																	
																	</div>

																	<div class='counter-title'>Amount Received (%)</div>

																</div>

															</div>

															<div class='col-xl-2 col-lg-2 col-md-6 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		<?php echo round($members_paid, 0); ?>

																	</div>

																	<div class='counter-title'>Members Paid (%)</div>

																</div>

															</div>

															<div class='col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>
																
																		<?php 
																		
																			$ach = pg_num_rows(pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=1")); 

																			echo $ach;

																		?>
																	
																	</div>

																	<div class='counter-title'>ACH</div>

																</div>

															</div>

															<div class='col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		<?php 
																		
																			$bill_pay = pg_num_rows(pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=2")); 

																			echo $bill_pay;

																		?>

																	</div>

																	<div class='counter-title'>Bill Pay</div>

																</div>

															</div>

															<div class='col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>
																
																		<?php 
																		
																			$check = pg_num_rows(pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=3")); 

																			echo $check;

																		?>

																	</div>

																	<div class='counter-title'>Check</div>

																</div>

															</div>

															<div class='col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		<?php 
																			
																			echo ($total_homes - ( $ach + $bill_pay + $check ) ); 

																		?>

																	</div>

																	<div class='counter-title'>Others</div>

																</div>

															</div>

														</div>

														<br /><br />

														<div class='row'>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

	                         									<div class='counter h6'>

	                            									<div class='counter-number'>

	                              										<?php 
	                                
	                                										$board_documents = pg_num_rows(pg_query("SELECT * FROM document_management WHERE community_id=$community_id AND active='t' AND is_board_document='t'")); 

	                                										echo $board_documents;

	                              										?>

	                            									</div>

	                            									<div class='counter-title'>Board Documents</div>

	                          									</div>

	                        								</div>

	                        								<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

	                          									<div class='counter h6'>

	                            									<?php 

	                                									$pending_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='OUT_FOR_SIGNATURE' AND board_cancel_requested='f' AND is_board_document='t'"));

	                                									if($pending_agreements == 0)
	                                  										echo "<div class='counter-number' >$pending_agreements</div>";
	                                									else
	                                  										echo "<div class='counter-number' style='color: orange;' >$pending_agreements</div>";

	                              									?>

	                            

	                            									<div class='counter-title'>Board Pending Agreements</div>

	                          									</div>

	                        								</div>

	                        								<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

	                          									<div class='counter h6'>

	                            									<div class='counter-number'>

	                              										<?php

	                                										$signed_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='SIGNED' AND board_cancel_requested='f' AND is_board_document='t'"));

	                                										echo $signed_agreements;

	                              										?>

	                            									</div>

	                            									<div class='counter-title'>Board Signed Agreements</div>

	                          									</div>

	                        								</div>

	                        								<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>
																
																		<?php 
																		
																			echo pg_num_rows(pg_query("SELECT * FROM community_deposits WHERE community_id=$community_id")); 

																		?>
																	
																	</div>

																	<div class='counter-title'>Community Deposits</div>

																</div>

															</div>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		<?php 
																	
																			echo pg_num_rows(pg_query("SELECT * FROM document_management WHERE community_id=$community_id AND active='t' AND is_board_document='f'")); 

																		?>

																	</div>

																	<div class='counter-title'>Community Documents</div>

																</div>

															</div>

	                        								<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

		                          								<div class='counter h6'>

		                              								<?php 

		                                								$pending_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='OUT_FOR_SIGNATURE' AND board_cancel_requested='f' AND is_board_document='f'"));

		                                								if($pending_agreements == 0)
		                                  									echo "<div class='counter-number'>$pending_agreements</div>";
		                                								else
		                                  									echo "<div class='counter-number' style='color: orange;'>$pending_agreements</div>";

		                              								?>

		                            								<div class='counter-title'>Community Pending Agreements</div>

		                          								</div>

	                        								</div>

	                        								<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

	                          									<div class='counter h6'>

	                            									<div class='counter-number'>

	                              										<?php

	                                										$signed_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='SIGNED' AND board_cancel_requested='f' AND is_board_document='f'"));

	                                										echo $signed_agreements;

	                              										?>

	                            									</div>

	                            									<div class='counter-title'>Community Signed Agreements</div>

	                          									</div>

	                       									</div>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>
																
																		<?php

																			echo "$del_acc";

																		?>

																	</div>

																	<div class='counter-title'>Delinquent Accounts</div>

																</div>

															</div>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<?php 
																			
																		$inspection_notices = pg_num_rows(pg_query("SELECT * FROM inspection_notices WHERE community_id=$community_id"));

																		$closed = pg_num_rows(pg_query("SELECT * FROM inspection_notices WHERE community_id=$community_id AND (inspection_status_id=2 OR inspection_status_id=6 OR inspection_status_id=9 OR inspection_status_id=13 OR inspection_status_id=14)"));

																		$inspection_notices = $inspection_notices - $closed;

																		if ($inspection_notices == 0) 
																			echo "<div class='counter-number'>".$inspection_notices."</div>";
																		else
																			echo "<div class='counter-number' style='color: orange;'>$inspection_notices</div>";

																	?>

																	<div class='counter-title'>Inspection Notices</div>

																</div>

															</div>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<?php 
																	
																		$late_payments = pg_num_rows(pg_query("SELECT * FROM current_payments WHERE community_id=$community_id AND process_date>='$year-$month-16' AND process_date<='$year-$month-$last'"));

																		if ($late_payments == 0) 
																			echo "<div class='counter-number'>".$late_payments."</div>";
																		else
																			echo "<div class='counter-number' style='color: orange;'>$late_payments</div>";

																	?>

																	<div class='counter-title'>Late Payments</div>

																</div>

															</div>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<?php 
																	
																		$parking_tags = pg_num_rows(pg_query("SELECT * FROM home_tags WHERE community_id=$community_id AND type=1"));

																		if ($parking_tags > 0) 
																			echo "<div class='counter-number' style='color: green;'>$parking_tags</div>";
																		else
																			echo "<div class='counter-number'>".$parking_tags."</div>";

																	?>

																	<div class='counter-title'>Parking Tags</div>

																</div>

															</div>

														</div>

														<br /><br />

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

																";
															else if($community_id == 2)
																echo "

																	<div class='row module-gray'>

																		<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

																			<br><center><h3 class='h3'>BANK ACCOUNT BALANCE</h3></center>

																		</div>

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

																";

														?>

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

		<script src='assets/js/factSheet.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	</body>

</html>