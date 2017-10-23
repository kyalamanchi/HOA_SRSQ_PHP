<?php

	ini_set("session.save_path","/var/www/html/session/");
	
	session_start();

?>

<!DOCTYPE html>

<html lang="en">
	<head>
		

		<?php

			if(!$_SESSION['hoa_username'])
				header("Location: logout.php");

			pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

			$user_id = $_SESSION['hoa_user_id'];
			$board = pg_num_rows(pg_query("SELECT * FROM board_committee_details WHERE user_id=$user_id"));

			if($board == 0)
				header("Location: residentDashboard.php");

			if($_SESSION['hoa_mode'] == 2)
				$_SESSION['hoa_mode'] = 1;

			$community_id = $_SESSION['hoa_community_id'];
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

	            $home_id = $row['home_id'];
	            $assessment_charges = $row['sum'];

	            $row2 = pg_fetch_assoc(pg_query("SELECT hoa_id, firstname, lastname, cell_no, email FROM hoaid WHERE home_id=".$home_id));
	            $hoa_id = $row2['hoa_id'];

	            $row2 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE hoa_id=".$hoa_id));
	            $charges = $row2['sum'];

	            $row2 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE payment_status_id=1 AND hoa_id=".$hoa_id));
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
          	$jan_amount_received = ( $jan_amount_received / $monthly_total ) * 100;
          	$jan_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-01-01' AND process_date<='$year-01-31'"));
          	$jan_members_paid = ( $jan_members_paid / $total_homes ) * 100;

          	if( (0 == $year % 4) and (0 != $year % 100) or (0 == $year % 400) )
          		$feb_days = 29;
          	else
          		$feb_days = 28;

          	$row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-02-01' AND process_date<='$year-02-$feb_days'"));
          	$feb_amount_received = $row['sum'];
          	$feb_amount_received = ( $feb_amount_received / $monthly_total ) * 100;
          	$feb_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-02-01' AND process_date<='$year-02-$feb_days'"));
          	$feb_members_paid = ( $feb_members_paid / $total_homes ) * 100;

          	$row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-03-01' AND process_date<='$year-03-31'"));
          	$mar_amount_received = $row['sum'];
          	$mar_amount_received = ( $mar_amount_received / $monthly_total ) * 100;
          	$mar_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-03-01' AND process_date<='$year-03-31'"));
          	$mar_members_paid = ( $mar_members_paid / $total_homes ) * 100;

          	$row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-04-01' AND process_date<='$year-04-30'"));
          	$apr_amount_received = $row['sum'];
          	$apr_amount_received = ( $apr_amount_received / $monthly_total ) * 100;
          	$apr_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-04-01' AND process_date<='$year-04-30'"));
          	$apr_members_paid = ( $apr_members_paid / $total_homes ) * 100;

          	$row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-05-01' AND process_date<='$year-05-31'"));
          	$may_amount_received = $row['sum'];
          	$may_amount_received = ( $may_amount_received / $monthly_total ) * 100;
          	$may_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-05-01' AND process_date<='$year-05-31'"));
          	$may_members_paid = ( $may_members_paid / $total_homes ) * 100;

          	$row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-06-01' AND process_date<='$year-06-30'"));
          	$jun_amount_received = $row['sum'];
          	$jun_amount_received = ( $jun_amount_received / $monthly_total ) * 100;
          	$jun_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-06-01' AND process_date<='$year-06-30'"));
          	$jun_members_paid = ( $jun_members_paid / $total_homes ) * 100;

          	$row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-07-01' AND process_date<='$year-07-31'"));
          	$jul_amount_received = $row['sum'];
          	$jul_amount_received = ( $jul_amount_received / $monthly_total ) * 100;
          	$jul_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-07-01' AND process_date<='$year-07-31'"));
          	$jul_members_paid = ( $jul_members_paid / $total_homes ) * 100;

          	$row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-08-01' AND process_date<='$year-08-31'"));
          	$aug_amount_received = $row['sum'];
          	$aug_amount_received = ( $aug_amount_received / $monthly_total ) * 100;
          	$aug_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-08-01' AND process_date<='$year-08-31'"));
          	$aug_members_paid = ( $aug_members_paid / $total_homes ) * 100;

          	$row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-09-01' AND process_date<='$year-09-30'"));
          	$sep_amount_received = $row['sum'];
          	$sep_amount_received = ( $sep_amount_received / $monthly_total ) * 100;
          	$sep_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-09-01' AND process_date<='$year-09-30'"));
          	$sep_members_paid = ( $sep_members_paid / $total_homes ) * 100;

          	$row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-10-01' AND process_date<='$year-10-31'"));
          	$oct_amount_received = $row['sum'];
          	$oct_amount_received = ( $oct_amount_received / $monthly_total ) * 100;
          	$oct_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-10-01' AND process_date<='$year-10-31'"));
          	$oct_members_paid = ( $oct_members_paid / $total_homes ) * 100;

          	$row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-11-01' AND process_date<='$year-11-30'"));
          	$nov_amount_received = $row['sum'];
          	$nov_amount_received = ( $nov_amount_received / $monthly_total ) * 100;
          	$nov_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-11-01' AND process_date<='$year-11-30'"));
          	$nov_members_paid = ( $nov_members_paid / $total_homes ) * 100;

          	$row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-12-01' AND process_date<='$year-12-31'"));
          	$dec_amount_received = $row['sum'];
          	$dec_amount_received = ( $dec_amount_received / $monthly_total ) * 100;
          	$dec_members_paid = pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-12-01' AND process_date<='$year-12-31'"));
          	$dec_members_paid = ( $dec_members_paid / $total_homes ) * 100;

		?>

		<?php

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

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title><?php echo $_SESSION['hoa_community_code']; ?> | Board Dashboard</title>
		
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
	</head>
	<body>

		<!-- Layout-->
		<div class="layout">

			<!-- Header-->
			<?php include "boardHeader.php"; ?>

			<!-- Wrapper-->
			<div class="wrapper">

				<!-- Page Header -->
				<section class="module-page-title">
					
					<div class="container">
							
						<div class="row-page-title">
							
							<div class="page-title-captions">
								
								<h1 class="h5">Home</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Tabs-->
				<section class="module">

					<div class="container">

						<div class="row">

							<div class="table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<!-- Tabs-->
								<ul class="nav nav-tabs">
									
									<li class="nav-item"><a class="nav-link active" href="#tab-1" data-toggle="tab">Board</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-2" data-toggle="tab">Comms</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-3" data-toggle="tab">Reserves</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-4" data-toggle="tab">Finance</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-5" data-toggle="tab">Yearly Reports - <?php echo date('Y'); ?></a></li>

								</ul>

								<div class="tab-content">
									
									<div class="tab-pane in active" id="tab-1">
										
										<div class="special-heading m-b-40">
									
											<h4><i class="fa fa-dashboard"></i> Board Dashboard</h4>
								
										</div>
								
										<div class='container'>

											<div class='row module-gray'>

												<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'><br><center><h3 class='h3'>PAYMENT INFORMATION</h3></center></div>

											</div>

											<div class='row module-gray'>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

													<div class='counter h3'>

														<div class='counter-number'>
															
															<a href='currentMonthPayments.php'>

																<?php echo round($amount_received, 1); ?>

															</a>
																
														</div>

														<div class='counter-title'>Amount Received</div>

													</div>

												</div>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

													<div class='counter h3'>

														<div class='counter-number'>

															<a href='currentMonthPayments.php'>

																<?php echo round($members_paid, 1); ?>

															</a>

														</div>

														<div class='counter-title'>Members Paid</div>

													</div>

												</div>

											</div>

											<br /><br />

											<div class='row'>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>
															
															<a href='communityDeposits.php'>

																<?php 
																	
																	echo pg_num_rows(pg_query("SELECT * FROM community_deposits WHERE community_id=$community_id")); 

																?>

															</a>
																
														</div>

														<div class='counter-title'>Community Deposits</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															<a href='communityDocuments.php'>

																<?php 
																
																	echo pg_num_rows(pg_query("SELECT * FROM document_management WHERE community_id=$community_id")); 

																?>

															</a>

														</div>

														<div class='counter-title'>Community Documents</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>
															
															<?php

																if($del_acc > 0)
																	echo "<a href='delinquentAccounts.php' style='color: orange;'>$del_acc</a>";
																else
																	echo "$del_acc";

															?>

														</div>

														<div class='counter-title'>Delinquent Accounts</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															<?php 
																
																$inspection_notices = pg_num_rows(pg_query("SELECT * FROM inspection_notices WHERE community_id=$community_id"));

																$closed = pg_num_rows(pg_query("SELECT * FROM inspection_notices WHERE community_id=$community_id AND (inspection_status_id=2 OR inspection_status_id=6 OR inspection_status_id=9 OR inspection_status_id=13 OR inspection_status_id=14)"));

																$inspection_notices = $inspection_notices - $closed;

																if ($inspection_notices == 0) 
																	echo $inspection_notices;
																else
																	echo "<a href='inspectionNotices.php' style='color: orange;'>$inspection_notices</a>";

															?>

														</div>

														<div class='counter-title'>Inspection Notices</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															<?php 
																
																$late_payments = pg_num_rows(pg_query("SELECT * FROM current_payments WHERE community_id=$community_id AND process_date>='$year-$month-16' AND process_date<='$year-$month-$last'"));

																if ($late_payments == 0) 
																	echo $late_payments;
																else
																	echo "<a href='latePayments.php' style='color: orange;'>$late_payments</a>";

															?>

														</div>

														<div class='counter-title'>Late Payments</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															<?php 
																
																$parking_tags = pg_num_rows(pg_query("SELECT * FROM home_tags WHERE community_id=$community_id AND type=1"));

																if ($parking_tags > 0) 
																	echo "<a href='parkingTags.php' style='color: green;'>$parking_tags</a>";
																else
																	echo $parking_tags;

															?>

														</div>

														<div class='counter-title'>Parking Tags</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															<?php 

																$pending_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='OUT_FOR_SIGNATURE'"));;

																if($pending_agreements == 0)
																	echo "$pending_agreements";
																else
																	echo "<a style='color: orange;' href='pendingAgreements.php'>$pending_agreements</a>";

															?>

														</div>

														<div class='counter-title'>Pending Agreements</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															<a href='signedAgreements.php'>
															
																<?php

																	echo pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='SIGNED'"));

																?>

															</a>

														</div>

														<div class='counter-title'>Signed Agreements</div>

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

																<div class='counter h3'>

																	<div class='counter-number'>
																		
																		<a href='communityIncome.php'>

																			$ ".$srp_savings_balance."

																		</a>
																			
																	</div>

																	<div class='counter-title'>Savings</div>

																</div>

															</div>

															<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

																<div class='counter h3'>

																	<div class='counter-number'>

																		<a href='communityIncome.php'>

																			$ ".$srp_current_balance."

																		</a>

																	</div>

																	<div class='counter-title'>Checkings</div>

																</div>

															</div>

														</div>

													";
												else if($community_id == 2)
													echo "

														<div class='row module-gray'>

															<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'><br><center><h3 class='h3'>BANK ACCOUNT BALANCE</h3></center></div>

														</div>

														<div class='row module-gray'>

															<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																<div class='counter h3'>

																	<div class='counter-number'>
																		
																		<a href='communityIncome.php'>

																			$ ".$srp_primary_Savings_CurrentBalance."

																		</a>
																			
																	</div>

																	<div class='counter-title'>Checkings</div>

																</div>

															</div>

															<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																<div class='counter h3'>

																	<div class='counter-number'>

																		<a href='communityIncome.php'>

																			$ ".$srp_savings."

																		</a>

																	</div>

																	<div class='counter-title'>Savings</div>

																</div>

															</div>

															<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																<div class='counter h3'>

																	<div class='counter-number'>

																		<a href='communityIncome.php'>

																			$ ".$srsq_third_Account_Balance."

																		</a>

																	</div>

																	<div class='counter-title'>Investments</div>

																</div>

															</div>

														</div>

													";

											?>

										</div>

									</div>

									<div class="tab-pane" id="tab-2">
										
										<div class="special-heading m-b-40">
									
											<h4><i class="fa fa-envelope"></i> Communications Dashboard</h4>
								
										</div>

										<div class='container'>

											<div class='row'>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>
															
															<a href='campaigns.php'>

																<i class='fa fa-envelope'></i>

															</a>
																
														</div>

														<div class='counter-title'>Campaigns</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>
															
															<?php if($community_id == 2) echo "<a href='adobeSendAgreement.php'>"; ?>

																<i class='fa fa-paper-plane'></i>

															<?php if($community_id == 2) echo "</a>"; ?>
																
														</div>

														<div class='counter-title'>Send Agreements</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>
															
															<?php 

																$statements_mailed = pg_num_rows(pg_query("SELECT * FROM community_statements_mailed WHERE community_id=$community_id"));

																if($statements_mailed == 0)
																	echo $statements_mailed;
																else
																	echo "<a style='color: green;' href='statementsMailed.php'>$statements_mailed</a>";

															?>
																
														</div>

														<div class='counter-title'>Statements Mailed</div>

													</div>

												</div>

											</div>

										</div>

									</div>

									<div class="tab-pane" id="tab-3">
										
										<div class="special-heading m-b-40">
									
											<h4><i class="fa fa-support"></i> Reserves Dashboard</h4>
								
										</div>

										<div class='container'>

											<div class='row'>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>
															
															<?php 

																$row = pg_fetch_assoc(pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id"));

																$reserves = $row['cur_bal_vs_ideal_bal'];

																if($reserves != '')
																	echo $reserves."%";
																else
																	echo "0%";

															?>
																
														</div>

														<div class='counter-title'>Reserves Funded</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>
															
															<?php 

																$assets = pg_num_rows(pg_query("SELECT * FROM community_assets WHERE community_id=$community_id"));

																if($assets != '')
																	echo "<a style='color: green;' href='communityAssets.php'>$assets</a>";
																else
																	echo $assets;

															?>
																
														</div>

														<div class='counter-title'>Total # of Assets</div>

													</div>

												</div>

											</div>

										</div>

									</div>

									<div class="tab-pane" id="tab-4">
										
										<div class="special-heading m-b-40">
									
											<h4><i class="fa fa-dollar"></i> Finance Dashboard</h4>
						
										</div>

									</div>

									<div class="tab-pane" id="tab-5">
										
										<div class="special-heading m-b-40">
									
											<h4><i class="fa fa-area-chart"></i> Yearly Reports - <?php echo date('Y'); ?></h4>
						
										</div>

										<div class='container'>

											<div class='row'>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
												
													<div class='row'>

														<div class='col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12'>

															<h5 class='h5'>January<br>01</h3>

														</div>

														<div class='col-xl-10 col-lg-10 col-md-9 col-sm-8 col-xs-12'>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Amount Received<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $jan_amount_received; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Members Paid<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $jan_members_paid; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND process_date>='$year-01-16' AND process_date<='$year-01-31' AND payment_status_id=1"));

																			?>

																		</div>

																		<div class='counter-title'>Late Payments</div>

																	</div>

																</div>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_charges WHERE community_id=$community_id AND assessment_date>='$year-01-01' AND assessment_date<='$year-01-31' AND assessment_rule_type_id=9"));

																			?>

																		</div>

																		<div class='counter-title'>Board Write Offs</div>

																	</div>

																</div>

															</div>

														</div>

													</div>
												
												</div>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
												
													<div class='row'>

														<div class='col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12'>

															<h5 class='h5'>February<br>02</h3>

														</div>

														<div class='col-xl-10 col-lg-10 col-md-9 col-sm-8 col-xs-12'>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Amount Received<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $feb_amount_received; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Members Paid<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $feb_members_paid; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND process_date>='$year-02-16' AND process_date<='$year-02-$feb_days' AND payment_status_id=1"));

																			?>

																		</div>

																		<div class='counter-title'>Late Payments</div>

																	</div>

																</div>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_charges WHERE community_id=$community_id AND assessment_date>='$year-02-01' AND assessment_date<='$year-02-$feb_days' AND assessment_rule_type_id=9"));

																			?>

																		</div>

																		<div class='counter-title'>Board Write Offs</div>

																	</div>

																</div>

															</div>

														</div>

													</div>
												
												</div>

											</div>

											<br>
											<hr>
											<br>

											<div class='row'>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
												
													<div class='row'>

														<div class='col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12'>

															<h5 class='h5'>March<br>03</h3>

														</div>

														<div class='col-xl-10 col-lg-10 col-md-9 col-sm-8 col-xs-12'>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Amount Received<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $mar_amount_received; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Members Paid<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $mar_members_paid; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND process_date>='$year-03-16' AND process_date<='$year-03-31' AND payment_status_id=1"));

																			?>

																		</div>

																		<div class='counter-title'>Late Payments</div>

																	</div>

																</div>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_charges WHERE community_id=$community_id AND assessment_date>='$year-03-01' AND assessment_date<='$year-03-31' AND assessment_rule_type_id=9"));

																			?>

																		</div>

																		<div class='counter-title'>Board Write Offs</div>

																	</div>

																</div>

															</div>

														</div>

													</div>
												
												</div>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
												
													<div class='row'>

														<div class='col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12'>

															<h5 class='h5'>April<br>04</h3>

														</div>

														<div class='col-xl-10 col-lg-10 col-md-9 col-sm-8 col-xs-12'>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Amount Received<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $apr_amount_received; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Members Paid<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $apr_members_paid; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND process_date>='$year-04-16' AND process_date<='$year-04-30' AND payment_status_id=1"));

																			?>

																		</div>

																		<div class='counter-title'>Late Payments</div>

																	</div>

																</div>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_charges WHERE community_id=$community_id AND assessment_date>='$year-04-01' AND assessment_date<='$year-04-30' AND assessment_rule_type_id=9"));

																			?>

																		</div>

																		<div class='counter-title'>Board Write Offs</div>

																	</div>

																</div>

															</div>

														</div>

													</div>
												
												</div>

											</div>

											<br>
											<hr>
											<br>

											<div class='row'>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
												
													<div class='row'>

														<div class='col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12'>

															<h5 class='h5'>May<br>05</h5>

														</div>

														<div class='col-xl-10 col-lg-10 col-md-9 col-sm-8 col-xs-12'>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Amount Received<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $may_amount_received; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Members Paid<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $may_members_paid; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND process_date>='$year-05-16' AND process_date<='$year-05-31' AND payment_status_id=1"));

																			?>

																		</div>

																		<div class='counter-title'>Late Payments</div>

																	</div>

																</div>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_charges WHERE community_id=$community_id AND assessment_date>='$year-05-01' AND assessment_date<='$year-05-31' AND assessment_rule_type_id=9"));

																			?>

																		</div>

																		<div class='counter-title'>Board Write Offs</div>

																	</div>

																</div>

															</div>

														</div>

													</div>
												
												</div>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
												
													<div class='row'>

														<div class='col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12'>

															<h5 class='h5'>June<br>06</h5>

														</div>

														<div class='col-xl-10 col-lg-10 col-md-9 col-sm-8 col-xs-12'>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Amount Received<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $jun_amount_received; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Members Paid<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $jun_members_paid; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND process_date>='$year-06-16' AND process_date<='$year-06-30' AND payment_status_id=1"));

																			?>

																		</div>

																		<div class='counter-title'>Late Payments</div>

																	</div>

																</div>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_charges WHERE community_id=$community_id AND assessment_date>='$year-06-01' AND assessment_date<='$year-06-30' AND assessment_rule_type_id=9"));

																			?>

																		</div>

																		<div class='counter-title'>Board Write Offs</div>

																	</div>

																</div>

															</div>

														</div>

													</div>
												
												</div>

											</div>

											<br>
											<hr>
											<br>

											<div class='row'>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
												
													<div class='row'>

														<div class='col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12'>

															<h5 class='h5'>July<br>07</h5>

														</div>

														<div class='col-xl-10 col-lg-10 col-md-9 col-sm-8 col-xs-12'>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Amount Received<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $jul_amount_received; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Members Paid<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $jul_members_paid; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND process_date>='$year-07-16' AND process_date<='$year-07-31' AND payment_status_id=1"));

																			?>

																		</div>

																		<div class='counter-title'>Late Payments</div>

																	</div>

																</div>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_charges WHERE community_id=$community_id AND assessment_date>='$year-07-01' AND assessment_date<='$year-07-31' AND assessment_rule_type_id=9"));

																			?>

																		</div>

																		<div class='counter-title'>Board Write Offs</div>

																	</div>

																</div>

															</div>

														</div>

													</div>
												
												</div>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
												
													<div class='row'>

														<div class='col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12'>

															<h5 class='h5'>August<br>08</h5>

														</div>

														<div class='col-xl-10 col-lg-10 col-md-9 col-sm-8 col-xs-12'>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Amount Received<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $aug_amount_received; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Members Paid<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $aug_members_paid; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND process_date>='$year-08-16' AND process_date<='$year-08-31' AND payment_status_id=1"));

																			?>

																		</div>

																		<div class='counter-title'>Late Payments</div>

																	</div>

																</div>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_charges WHERE community_id=$community_id AND assessment_date>='$year-08-01' AND assessment_date<='$year-08-31' AND assessment_rule_type_id=9"));

																			?>

																		</div>

																		<div class='counter-title'>Board Write Offs</div>

																	</div>

																</div>

															</div>

														</div>

													</div>
												
												</div>

											</div>

											<br>
											<hr>
											<br>

											<div class='row'>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
												
													<div class='row'>

														<div class='col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12'>

															<h5 class='h5'>September<br>09</h5>

														</div>

														<div class='col-xl-10 col-lg-10 col-md-9 col-sm-8 col-xs-12'>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Amount Received<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $sep_amount_received; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Members Paid<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $sep_members_paid; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND process_date>='$year-09-16' AND process_date<='$year-09-30' AND payment_status_id=1"));

																			?>

																		</div>

																		<div class='counter-title'>Late Payments</div>

																	</div>

																</div>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_charges WHERE community_id=$community_id AND assessment_date>='$year-09-01' AND assessment_date<='$year-09-30' AND assessment_rule_type_id=9"));

																			?>

																		</div>

																		<div class='counter-title'>Board Write Offs</div>

																	</div>

																</div>

															</div>

														</div>

													</div>
												
												</div>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
												
													<div class='row'>

														<div class='col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12'>

															<h5 class='h5'>October<br>10</h5>

														</div>

														<div class='col-xl-10 col-lg-10 col-md-9 col-sm-8 col-xs-12'>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Amount Received<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $oct_amount_received; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Members Paid<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $oct_members_paid; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND process_date>='$year-10-16' AND process_date<='$year-10-31' AND payment_status_id=1"));

																			?>

																		</div>

																		<div class='counter-title'>Late Payments</div>

																	</div>

																</div>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_charges WHERE community_id=$community_id AND assessment_date>='$year-10-01' AND assessment_date<='$year-10-31' AND assessment_rule_type_id=9"));

																			?>

																		</div>

																		<div class='counter-title'>Board Write Offs</div>

																	</div>

																</div>

															</div>

														</div>

													</div>
												
												</div>

											</div>

											<br>
											<hr>
											<br>

											<div class='row'>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
												
													<div class='row'>

														<div class='col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12'>

															<h5 class='h5'>November<br>11</h5>

														</div>

														<div class='col-xl-10 col-lg-10 col-md-9 col-sm-8 col-xs-12'>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Amount Received<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $nov_amount_received; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Members Paid<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $nov_members_paid; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND process_date>='$year-11-16' AND process_date<='$year-11-30' AND payment_status_id=1"));

																			?>

																		</div>

																		<div class='counter-title'>Late Payments</div>

																	</div>

																</div>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_charges WHERE community_id=$community_id AND assessment_date>='$year-11-01' AND assessment_date<='$year-11-30' AND assessment_rule_type_id=9"));

																			?>

																		</div>

																		<div class='counter-title'>Board Write Offs</div>

																	</div>

																</div>

															</div>

														</div>

													</div>
												
												</div>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>
												
													<div class='row'>

														<div class='col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12'>

															<h5 class='h5'>December<br>12</h5>

														</div>

														<div class='col-xl-10 col-lg-10 col-md-9 col-sm-8 col-xs-12'>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Amount Received<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $dec_amount_received; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='progress-item col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												
																	<div class='progress-title'>Members Paid<br><br><br></div>
																	
																	<div class='progress'>
																		
																		<div class='progress-bar progress-bar-brand progress-bar-striped progress-bar-animated' aria-valuenow='<?php echo $dec_members_paid; ?>' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
																	
																	</div>

																</div>

															</div>

															<hr>

															<div class='row'>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=$community_id AND process_date>='$year-12-16' AND process_date<='$year-12-31' AND payment_status_id=1"));

																			?>

																		</div>

																		<div class='counter-title'>Late Payments</div>

																	</div>

																</div>

																<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																	<div class='counter h6'>

																		<div class='counter-number'>

																			<?php

																				echo pg_num_rows(pg_query("SELECT DISTINCT home_id FROM current_charges WHERE community_id=$community_id AND assessment_date>='$year-12-01' AND assessment_date<='$year-12-31' AND assessment_rule_type_id=9"));

																			?>

																		</div>

																		<div class='counter-title'>Board Write Offs</div>

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

							</div>

						</div>

					</div>

				</section>

				<!-- Footer-->
				<?php include "footer.php"; ?>

				<a class="scroll-top" href="#top"><i class="fa fa-angle-up"></i></a>

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

		<!-- Color Switcher (Remove these lines)-->
		<!--script src="assets/js/style-switcher.min.js"></script-->

	</body>

</html>