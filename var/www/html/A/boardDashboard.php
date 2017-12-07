<?php

	session_start();

?>

<!DOCTYPE html>

<html lang="en">
	
	<head>
		
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-102881886-3"></script>
		<script>
			
			var dimensionValue = '<?php echo $_SESSION['hoa_hoa_id'] ?>';
			  	window.dataLayer = window.dataLayer || [];
			  	function gtag(){dataLayer.push(arguments);}
			  	gtag('js', new Date());
			  
			  	gtag('config', 'UA-102881886-3', {
			  	'custom_map': {'dimension1': 'hoaid'}
				});
		  
				// Sends an event that passes 'age' as a parameter.
				gtag('event', 'hoaid_dimension', {'hoaid': dimensionValue});
		</script>
		

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

						<div id='board_dashboard_div' class="row">

              <div class='col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12'>

                <div class='row'>

                  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

                    <a class="btn btn-block btn-round btn-lg btn-success disabled" style="color: white;">Dashboards</a>

                  </div>

                </div>

                <br>

                <div class='row'>

                  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                    <a class="btn btn-block btn-round btn-sm btn-gray">Board</a>

                  </div>

                </div>

                <br>

                <div class='row'>

                  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                    <a class="btn btn-block btn-round btn-shadow btn-sm btn-white" href="#">Finance</a>

                  </div>

                </div>

                <br>

                <div class='row'>

                  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                    <a class="btn btn-block btn-round btn-shadow btn-sm btn-white" href="#">Communications</a>

                  </div>

                </div>

                <br>

                <div class='row'>

                  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                    <a class="btn btn-block btn-round btn-shadow btn-sm btn-white" href="#">Reserves</a>

                  </div>

                </div>

              </div>

							<div class="table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12">
								
								<!-- Tabs-->
								<ul class="nav nav-tabs">
									
									<li class="nav-item"><a class="nav-link active" href="#tab-1" data-toggle="tab">Board</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-2" data-toggle="tab">Comms</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-3" data-toggle="tab">Reserves</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-4" data-toggle="tab">Finance</a></li>

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

												<div class='col-xl-2 col-lg-2 col-md-6 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>
															
															<a href='currentMonthPayments.php'>

																<?php echo round($amount_received, 0); ?>

															</a>
																
														</div>

														<div class='counter-title'>Amount Received (%)</div>

													</div>

												</div>

												<div class='col-xl-2 col-lg-2 col-md-6 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															<a href='currentMonthPayments.php'>

																<?php echo round($members_paid, 0); ?>

															</a>

														</div>

														<div class='counter-title'>Members Paid (%)</div>

													</div>

												</div>

												<div class='col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>
															
															<a href='homePayMethod.php'>

																<?php 
																	
																	$ach = pg_num_rows(pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=1")); 

																	echo $ach;

																?>

															</a>
																
														</div>

														<div class='counter-title'>ACH</div>

													</div>

												</div>

												<div class='col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															<a href='homePayMethod.php'>

																<?php 
																	
																	$bill_pay = pg_num_rows(pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=2")); 

																	echo $bill_pay;

																?>

															</a>

														</div>

														<div class='counter-title'>Bill Pay</div>

													</div>

												</div>

												<div class='col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>
															
															<a href='homePayMethod.php'>

																<?php 
																	
																	$check = pg_num_rows(pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=3")); 

																	echo $check;

																?>

															</a>

														</div>

														<div class='counter-title'>Check</div>

													</div>

												</div>

												<div class='col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															<a href='homePayMethod.php'>

																<?php 
																	
																	echo ($total_homes - ( $ach + $bill_pay + $check ) ); 

																?>

															</a>

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

                                if($board_documents > 0)
                                  echo "<a href='boardDocuments.php'>$board_documents</a>";
                                else
                                  echo $board_documents;

                              ?>

                            </div>

                            <div class='counter-title'>Board Documents</div>

                          </div>

                        </div>

                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                          <div class='counter h6'>

                            <div class='counter-number'>

                              <?php 

                                $pending_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='OUT_FOR_SIGNATURE' AND board_cancel_requested='f' AND is_board_document='t'"));

                                if($pending_agreements == 0)
                                  echo "$pending_agreements";
                                else
                                  echo "<a style='color: orange;' href='boardPendingAgreements.php'>$pending_agreements</a>";

                              ?>

                            </div>

                            <div class='counter-title'>Board Pending Agreements</div>

                          </div>

                        </div>

                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                          <div class='counter h6'>

                            <div class='counter-number'>

                              <?php

                                $signed_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='SIGNED' AND board_cancel_requested='f' AND is_board_document='t'"));

                                if($signed_agreements > 0)
                                  echo "<a href='boardSignedAgreements.php'>$signed_agreements</a>";
                                else
                                  echo $signed_agreements;

                              ?>

                            </div>

                            <div class='counter-title'>Board Signed Agreements</div>

                          </div>

                        </div>

                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

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

												<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															<a href='communityDocuments.php'>

																<?php 
																
																	echo pg_num_rows(pg_query("SELECT * FROM document_management WHERE community_id=$community_id AND active='t' AND is_board_document='f'")); 

																?>

															</a>

														</div>

														<div class='counter-title'>Community Documents</div>

													</div>

												</div>

                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                          <div class='counter h6'>

                            <div class='counter-number'>

                              <?php 

                                $pending_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='OUT_FOR_SIGNATURE' AND board_cancel_requested='f' AND is_board_document='f'"));

                                if($pending_agreements == 0)
                                  echo "$pending_agreements";
                                else
                                  echo "<a style='color: orange;' href='communityPendingAgreements.php'>$pending_agreements</a>";

                              ?>

                            </div>

                            <div class='counter-title'>Community Pending Agreements</div>

                          </div>

                        </div>

                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                          <div class='counter h6'>

                            <div class='counter-number'>

                              <?php

                                $signed_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='SIGNED' AND board_cancel_requested='f' AND is_board_document='f'"));

                                if($signed_agreements > 0)
                                  echo "<a href='communitySignedAgreements.php'>$signed_agreements</a>";
                                else
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

																if($del_acc > 0)
																	echo "<a href='delinquentAccounts.php' style='color: orange;'>$del_acc</a>";
																else
																	echo "$del_acc";

															?>

														</div>

														<div class='counter-title'>Delinquent Accounts</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

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

												<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

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

												<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

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
																		
																		<a href='communityIncome.php'>

																			".round($srp_savings_balance, 0)."

																		</a>
																			
																	</div>

																	<div class='counter-title'>Savings ($)</div>

																</div>

															</div>

															<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		<a href='communityIncome.php'>

																			".round($srp_current_balance, 0)."

																		</a>

																	</div>

																	<div class='counter-title'>Checkings ($)</div>

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

																<div class='counter h6'>

																	<div class='counter-number'>
																		
																		<a href='communityIncome.php'>

																			".round($srp_primary_Savings_CurrentBalance, 0)."

																		</a>
																			
																	</div>

																	<div class='counter-title'>Checkings ($)</div>

																</div>

															</div>

															<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		<a href='communityIncome.php'>

																			".round($srp_savings, 0)."

																		</a>

																	</div>

																	<div class='counter-title'>Savings ($)</div>

																</div>

															</div>

															<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		<a href='communityIncome.php'>

																			".round($srsq_third_Account_Balance, 0)."

																		</a>

																	</div>

																	<div class='counter-title'>Investments ($)</div>

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
															
															<a href='campaigns.php'>

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

															</a>
																
														</div>

														<div class='counter-title'>Community Notifications</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>
															
															<?php if($community_id == 2) echo "<a href='adobeSendAgreement.php'>"; ?>

																<!--i class='fa fa-file'></i-->
																<img src='send_agreements.png' alt='Send Agreements'>

															<?php if($community_id == 2) echo "</a>"; ?>
																
														</div>

														<div class='counter-title'>Send Agreements</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

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

												<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

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
                                echo "<div class='counter-number' style='color: green;'><a href='reserveRepairs.php'>".$repairs."</a></div>";
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

									<div class="tab-pane" id="tab-4">
										
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
																		
																		<a href='communityIncome.php'>

																			".round($srp_savings_balance, 0)."

																		</a>
																			
																	</div>

																	<div class='counter-title'>Savings ($)</div>

																</div>

															</div>

															<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		<a href='communityIncome.php'>

																			".round($srp_current_balance, 0)."

																		</a>

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
																		
																		<a href='communityIncome.php'>

																			".round($srp_primary_Savings_CurrentBalance, 0)."

																		</a>
																			
																	</div>

																	<div class='counter-title'>Checkings ($)</div>

																</div>

															</div>

															<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		<a href='communityIncome.php'>

																			".round($srp_savings, 0)."

																		</a>

																	</div>

																	<div class='counter-title'>Savings ($)</div>

																</div>

															</div>

															<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		<a href='communityIncome.php'>

																			".round($srsq_third_Account_Balance, 0)."

																		</a>

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
                              
                              <a href='trailBalanceReport.php'>

                                <!--i class='fa fa-file'></i-->
                                <img src='trail_balance.png' alt='Trail Balance'>

                              </a>
                                
                            </div>

                            <div class='counter-title'>Trail Balance Report</div>

                          </div>

                        </div>

                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                          <div class='counter h6'>

                            <div class='counter-number'>

                              <a href='expenditureByVendor.php'><img src='expenditures_by_vendors.png'></a>
                                
                            </div>

                            <div class='counter-title'>Expenditure By Vendors ($)</div>

                          </div>

                        </div>

                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                          <div class='counter h6'>

                            <div class='counter-number'>
                              
                              <a href='chartOfAccounts.php'>

                                <!--i class='fa fa-file'></i-->
                                <img src='chart_of_accounts.png' alt='Chart of Accounts'>

                              </a>
                                
                            </div>

                            <div class='counter-title'>Chart Of Accounts</div>

                          </div>

                        </div>

                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                          <div class='counter h6'>

                            <div class='counter-number'>
                              
                              <a href='generalLedger.php'>

                                <!--i class='fa fa-file'></i-->
                                <img src='general_ledger.png' alt='General Ledger'>

                              </a>
                                
                            </div>

                            <div class='counter-title'>General Ledger</div>

                          </div>

                        </div>

                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                          <div class='counter h6'>

                            <div class='counter-number'>
                              
                              <a href='purchaseSummary.php'>

                                <!--i class='fa fa-file'></i-->
                                <img src='purchase_summary.png' alt='Purchase Summary'>

                              </a>
                                
                            </div>

                            <div class='counter-title'>Purchase Summary</div>

                          </div>

                        </div>

                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                          <div class='counter h6'>

                            <div class='counter-number'>
                              
                              <a href='budget.php'>

                                <!--i class='fa fa-file'></i-->
                                <img src='purchase_summary.png' alt='Budget'>

                              </a>
                                
                            </div>

                            <div class='counter-title'>Budget</div>

                          </div>

                        </div>

                      </div>

                      <br><br>

                      <!--div class='row module-gray'>

                        <br>

                        <div class='col-xl-4 col-lg-6 col-md-6 col-sm-8 col-xs-10 offset-xl-4 offset-lg-3 offset-md-3 offset-sm-2 offset-xs-1'>
                          
                          <canvas id="myChart"></canvas>

                        </div>

                        <br>

                      </div-->

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
		<script src="assets/js/plugins.min.js"></script>
		<script src="assets/js/charts.js"></script>
		<script src="assets/js/custom.min.js"></script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src="assets/js/style-switcher.min.js"></script-->

    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    
    <!-- MyChart -->
    <script type="text/javascript">
      
      var ctx = document.getElementById('myChart').getContext('2d');
      var myDoughnutChart = new Chart(ctx, {
    
        type: 'doughnut',
        data: {
    
          datasets: [{
            
            data: [ 10, 20, 30 ],
            backgroundColor: [ '#ff6384', '#36a2eb', '#cc65fe' ]

          }],

          labels: [ 'Red', 'Yellow', 'Blue' ]

        },
        options: {

          cutoutPercentage: 75,

          title: {
            display: true,
            fontSize: 30,
            fontStyle: 'bold',
            text: 'Top spendings (Testing)'
          },

          legend: {
            display: true,
            position: 'right'
          }

        }
      
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

            // Changes this dataset to become a line
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