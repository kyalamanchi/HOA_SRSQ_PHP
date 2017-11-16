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

						<div id='user_details_div'>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item"><strong style='color: black;'>User Details</strong></li>
											<li class="breadcrumb-item">Home Details</li>
											<li class="breadcrumb-item">Email &amp; Persons</li>
                                            <li class='breadcrumb-item'>SMS Notifications</li>
                                            <li class="breadcrumb-item">Agreements</li>
											<li class='breadcrumb-item'>Documents</li>
                                            <li class="breadcrumb-item">HOA Fact Sheet</li>
											<li class="breadcrumb-item">Disclosures</li>

										</ol>

									</div>

								</div>

							</div>

							<br>

							<div class='row container-fluid'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<?php

										$row = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));

										$user_firstname = $row['firstname'];
										$user_lastname = $row['lastname'];
										$user_email = $row['email'];
										$user_cell_no = $row['cell_no'];

                                        $_SESSION['hoa_alchemy_cell_no'] = $user_cell_no;

									?>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

											<h3 class='h3'>Is this information correct?</h3>

										</div>

									</div>

									<br>

									<div class='row'>
										
										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<label><strong><u>First Name</u></strong></label>

											<br>

											<h3 class='h3' style='color: black;'><?php echo $user_firstname; ?></h3>

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<label><strong><u>Last Name</u></strong></label>

											<br>

											<h3 class='h3' style='color: black;'><?php echo $user_lastname; ?></h3>

										</div>

									</div>

									<br>

									<div class='row'>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<label><strong><u>Email</u></strong></label>

											<br>

											<h3 class='h3' id='user_email' style='color: black;'><?php echo $user_email; ?></h3>

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<label><strong><u>Cell Number</u></strong></label>

											<br>

											<h3 class='h3' id='user_cell_no' style='color: black;'><?php echo $user_cell_no; ?></h3>

										</div>

									</div>

									<br><br>

									<div class='row'>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='user_information_radio' id='user_information_radio_yes' value='yes'> <strong style='color: black;'>Yes</strong>, this information is correct.

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='user_information_radio' id='user_information_radio_no' value='no'> <strong style='color: black;'>No</strong>, this information is incorrect.

										</div>

									</div>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

											<hr class='small'>

											<button id='user_details_continue' name='user_details_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button>

										</div>

									</div>

								</div>

							</div>

							<br>

						</div>

						<div id='edit_user_details_div'>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item"><strong style='color: black;'>User Details</strong></li>
											<li class="breadcrumb-item">Home Details</li>
											<li class="breadcrumb-item">Email &amp; Persons</li>
                                            <li class='breadcrumb-item'>SMS Notifications</li>
                                            <li class='breadcrumb-item'>Documents</li>
                                            <li class="breadcrumb-item">Agreements</li>
											<li class="breadcrumb-item">HOA Fact Sheet</li>
											<li class="breadcrumb-item">Disclosures</li>

										</ol>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

										<h3 class='h3'>Update User Details</h3>

									</div>

									<br><br>

									<form method='POST' action='updateHOAID.php' class='ajax1'>
																						
										<div class='row'>

											<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

												<label><strong>First Name</strong></label>

												<br>

												<input class='form-control' type='text' name='edit_firstname' id='edit_firstname' value='<?php echo $user_firstname; ?>' readonly>

											</div>

											<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

												<label><strong>Last Name</strong></label>

												<br>

												<input class='form-control' type='text' name='edit_lastname' id='edit_lastname' value='<?php echo $user_lastname; ?>' readonly>

											</div>

										</div>

										<br>

										<div class='row'>

											<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

												<label><strong>Email</strong></label><br>
												<input class='form-control' type='email' name='edit_email' id='edit_email' value='<?php echo $user_email; ?>' required>

											</div>

											<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

												<label><strong>Phone</strong></label><br>
												<input class='form-control' type='number' name='edit_cell_no' id='edit_cell_no' value='<?php echo $user_cell_no; ?>' required>

											</div>

										</div>

										<br>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

											<center>

												<button class='btn btn-warning btn-xs' name='user_edit_back' type='button' id='user_edit_back'><i class='fa fa-arrow-left'></i> Back</button> <button class='btn btn-success btn-xs' type='submit'><i class='fa fa-check'></i> Save</button>

											</center>

										</div>

									</form>

								</div>

							</div>

							<br>

						</div>

						<div id='home_details_div'>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item">User Details</li>
											<li class="breadcrumb-item"><strong style='color: black;'>Home Details</strong></li>
											<li class="breadcrumb-item">Email &amp; Persons</li>
                                            <li class='breadcrumb-item'>SMS Notifications</li>
                                            <li class='breadcrumb-item'>Documents</li>
                                            <li class="breadcrumb-item">Agreements</li>
											<li class="breadcrumb-item">HOA Fact Sheet</li>
											<li class="breadcrumb-item">Disclosures</li>

										</ol>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<?php

										$row = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));

										$property_address = $row['address1'];
										$living_status = $row['living_status'];

										if($living_status == 't')
										{

											$mailing_address = $property_address;
											$mailing_country = $row['country_id'];
											$mailing_district = $row['district_id'];
											$mailing_city = $row['city_id'];
											$mailing_state = $row['state_id'];
											$mailing_zip = $row['zip_id'];

										}
										else
										{

											$row = pg_fetch_assoc(pg_query("SELECT * FROM home_mailing_address WHERE home_id=$home_id"));

											$mailing_address = $row['address1'];
											$mailing_country = $row['country_id'];
											$mailing_district = $row['district_id'];
											$mailing_city = $row['city_id'];
											$mailing_state = $row['state_id'];
											$mailing_zip = $row['zip_id'];

										}

										$mailing_country_id = $mailing_country;
										$mailing_state_id = $mailing_state;
										$mailing_district_id = $mailing_district;
										$mailing_city_id = $mailing_city;
										$mailing_zip_id = $mailing_zip;

										$row = pg_fetch_assoc(pg_query("SELECT * FROM country WHERE country_id=$mailing_country"));
										$mailing_country = $row['country_name'];

										$row = pg_fetch_assoc(pg_query("SELECT * FROM state WHERE state_id=$mailing_state"));
										$mailing_state = $row['state_name'];

										$row = pg_fetch_assoc(pg_query("SELECT * FROM district WHERE district_id=$mailing_district"));
										$mailing_district = $row['district_name'];

										$row = pg_fetch_assoc(pg_query("SELECT * FROM city WHERE city_id=$mailing_city"));
										$mailing_city = $row['city_name'];

										$row = pg_fetch_assoc(pg_query("SELECT * FROM zip WHERE zip_id=$mailing_zip"));
										$mailing_zip = $row['zip_code'];

										$_SESSION['mailing_address'] = $mailing_address;
										$_SESSION['mailing_country'] = $mailing_country_id;
										$_SESSION['mailing_state'] = $mailing_state_id;
										$_SESSION['mailing_district'] = $mailing_district_id;
										$_SESSION['mailing_city'] = $mailing_city_id;
										$_SESSION['mailing_zip'] = $mailing_zip_id;

									?>

									<div class='container module-gray' style="color: black;">

										<?php

											$row = pg_fetch_assoc(pg_query("SELECT * FROM community_disclosures WHERE community_id=$community_id AND type_id=14"));

											$notes = $row['notes'];
											$document_id = $row['document_id'];
											$changed_this_year = $row['changed_this_year'];

											$row = pg_fetch_assoc(pg_query("SELECT * FROM community_disclosure_type WHERE id=14"));
											$disclosure_name = $row['name'];
											$desc = $row['desc'];
											$civilcode_section = $row['civilcode_section'];
											$legal_url = $row['legal_url'];

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
												$document = "<a target='_blank' href='$document_id'>$document_id</a>";

										?>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Disclosure Name :</strong> <?php echo $disclosure_name; ?>

											</div>

										</div>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Changed this year :</strong> <?php echo $changed_this_year; ?>

											</div>

										</div>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Board Comments </strong> <?php echo $notes; ?>

											</div>

										</div>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Document :</strong> <?php echo $document; ?>

											</div>

										</div>

										<br>

									</div>

									<br>

									<div class='row'>
										
										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

											<h3 class='h3'>Do you still live in <u id='user_mailing_address'><?php echo $mailing_address; ?></u>?</h3>

										</div>

									</div>

									<br>

									<div class='row'>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='home_information_radio' id='home_information_radio_yes' value='yes'> <strong style='color: black;'>Yes</strong>, I'm living in the above address.

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='home_information_radio' id='home_information_radio_no' value='no'> <strong style='color: black;'>No</strong>, I rented my home out.

										</div>

									</div>

									<br>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

											<center>

												<script>(function(t,e,s,n){var o,a,c;t.SMCX=t.SMCX||[],e.getElementById(n)||(o=e.getElementsByTagName(s),a=o[o.length-1],c=e.createElement(s),c.type="text/javascript",c.async=!0,c.id=n,c.src=["https:"===location.protocol?"https://":"http://","widget.surveymonkey.com/collect/website/js/tRaiETqnLgj758hTBazgd_2BfaWOjaemomJA_2FAfa23Vy49wNbXrrSPU8mJda5XW6x7.js"].join(""),a.parentNode.insertBefore(c,a))})(window,document,"script","smcx-sdk");</script>

											</center>

										</div>

									</div>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

											<hr class='small'>

											<div class='row'>
										
												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

													<button id='home_details_back' name='home_details_back' class='btn btn-warning btn-xs'><i class='fa fa-arrow-left'></i> Back</button>

												</div>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

													<button id='home_details_continue' name='home_details_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button>

												</div>

											</div>

										</div>

									</div>

								</div>

							</div>

							<br>

						</div>

						<div id='edit_home_details_div'>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item">User Details</li>
											<li class="breadcrumb-item"><strong style='color: black;'>Home Details</strong></li>
											<li class="breadcrumb-item">Email &amp; Persons</li>
                                            <li class='breadcrumb-item'>SMS Notifications</li>
                                            <li class="breadcrumb-item">Agreements</li>
											<li class='breadcrumb-item'>Documents</li>
                                            <li class="breadcrumb-item">HOA Fact Sheet</li>
											<li class="breadcrumb-item">Disclosures</li>

										</ol>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

										<h3>Update Home Details</h3>

									</div>

									<br><br>

									<form method='POST' action='updateHomeID.php' class='ajax2'>
																						
										<div class='row'>

											<div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>

												<label><strong>Address</strong></label>

												<br>

												<input class='form-control' type='text' name='edit_mailing_address' id='edit_mailing_address' value='<?php echo $mailing_address; ?>' required>

											</div>

											<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

												<label><strong>Country</strong></label>

												<br>

												<select class='form-control' name='edit_mailing_country' id='edit_mailing_country' required>

													<option value='' selected disabled>Select Country</option>

													<?php

														$result = pg_query("SELECT * FROM country");

														while($row = pg_fetch_assoc($result))
														{

															$country_id = $row['country_id'];
															$country_name = $row['country_name'];

															echo "<option value='$country_id'";

															if($country_id == $mailing_country_id)
																echo " selected";

															echo ">$country_name</option>";

														}

													?>
													
												</select>

											</div>

											<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

												<label><strong>State</strong></label>

												<br>

												<select class='form-control' name='edit_mailing_state' id='edit_mailing_state' required>

													<option value='' selected disabled>Select State</option>

													<?php

														$result = pg_query("SELECT * FROM state WHERE country_id=$mailing_country_id");

														while($row = pg_fetch_assoc($result))
														{

															$state_id = $row['state_id'];
															$state_name = $row['state_name'];

															echo "<option value='$state_id'";

															if($state_id == $mailing_state_id)
																echo " selected";

															echo ">$state_name</option>";

														}

													?>
													
												</select>

											</div>

										</div>

										<br>

										<div class='row'>

											<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

												<label><strong>District</strong></label>

												<br>

												<select class='form-control' name='edit_mailing_district' id='edit_mailing_district' required>

													<option value='' selected disabled>Select District</option>

													<?php

														$result = pg_query("SELECT * FROM district WHERE state_id=$mailing_state_id");

														while($row = pg_fetch_assoc($result))
														{

															$district_id = $row['district_id'];
															$district_name = $row['district_name'];

															echo "<option value='$district_id'";

															if($district_id == $mailing_district_id)
																echo " selected";

															echo ">$district_name</option>";

														}

													?>
													
												</select>

											</div>

											<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

												<label><strong>City</strong></label>

												<br>

												<select class='form-control' name='edit_mailing_city' id='edit_mailing_city' required>

													<option value='' selected disabled>Select City</option>

													<?php

														$result = pg_query("SELECT * FROM city WHERE district_id=$mailing_district_id");

														while($row = pg_fetch_assoc($result))
														{

															$city_id = $row['city_id'];
															$city_name = $row['city_name'];

															echo "<option value='$city_id'";

															if($city_id == $mailing_city_id)
																echo " selected";

															echo ">$city_name</option>";

														}

													?>
													
												</select>

											</div>

											<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

												<label><strong>Zip</strong></label>

												<br>

												<select class='form-control' name='edit_mailing_zip' id='edit_mailing_zip' required>

													<option value='' selected disabled>Select Zip</option>

													<?php

														$result = pg_query("SELECT * FROM zip WHERE city_id=$mailing_city_id");

														while($row = pg_fetch_assoc($result))
														{

															$zip_id = $row['zip_id'];
															$zip_code = $row['zip_code'];

															echo "<option value='$zip_id'";

															if($zip_id == $mailing_zip_id)
																echo " selected";

															echo ">$zip_code</option>";

														}

													?>
													
												</select>

											</div>

										</div>

										<br>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

											<center>

												<button class='btn btn-warning btn-xs' type='button' name='home_edit_back' id='home_edit_back'><i class='fa fa-arrow-left'></i> Back</button> <button class='btn btn-success btn-xs' type='submit'><i class='fa fa-check'></i> Save</button>

											</center>

										</div>

									</form>

								</div>

							</div>

							<br>

						</div>

						<div id='email_div'>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item">User Details</li>
											<li class="breadcrumb-item">Home Details</li>
											<li class="breadcrumb-item"><strong style='color: black;'>Email &amp; Persons</strong></li>
                                            <li class='breadcrumb-item'>SMS Notifications</li>
                                            <li class="breadcrumb-item">Agreements</li>
											<li class='breadcrumb-item'>Documents</li>
                                            <li class="breadcrumb-item">HOA Fact Sheet</li>
											<li class="breadcrumb-item">Disclosures</li>

										</ol>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<?php

										$row = pg_fetch_assoc(pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id AND role_type_id=1 AND is_active='t' AND relationship_id=1"));

										$primary_email = $row['email'];
                                        $pid = $row['id'];

									?>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

											<center><h3 class='h3'>Is <u><?php echo $primary_email; ?></u> your primary email?</h3></center>

										</div>

									</div>

									<br>

									<div class='row'>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='email_radio' id='email_radio_yes' value='yes'> <strong style='color: black;'>Yes</strong>, this is my primary email.

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='email_radio' id='email_radio_no' value='no'> <strong style='color: black;'>No</strong>, this is not my primary email.

										</div>

									</div>

								</div>

							</div>

							<br><br>

                            <div class='row'>

                                <div class='col=xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <center><h3 class='h3'>Persons</h3></center>

                                </div>

                            </div>

                            <br>

                            <div class='row container-fluid'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive'>

                                    <table id='person_table' class='table table-striped' style='color: black;'>

                                        <thead>

                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Role</th>
                                            <th>Relationship</th>
                                            <th></th>
                                            <th></th>

                                        </thead>

                                        <tbody>

                                            <?php

                                                $result = pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id AND is_active='t' ORDER BY fname");

                                                while($row = pg_fetch_assoc($result))
                                                {

                                                    $person_id = $row['id'];
                                                    $person_firstname = $row['fname'];
                                                    $person_lastname = $row['lname'];
                                                    $person_email = $row['email'];
                                                    $person_cell_no = $row['cell_no'];
                                                    $person_relationship = $row['relationship_id'];
                                                    $person_role = $row['role_type_id'];

                                                    $_SESSION['person_$person_id_firstname'] = $person_firstname;
                                                    $_SESSION['person_$person_id_lastname'] = $person_lastname;
                                                    $_SESSION['person_$person_id_email'] = $person_email;
                                                    $_SESSION['person_$person_id_cell_no'] = $person_cell_no;
                                                    $_SESSION['person_$person_id_relationship'] = $person_relationship;
                                                    $_SESSION['person_$person_id_role'] = $person_role;

                                                    $row1 = pg_fetch_assoc(pg_query("SELECT * FROM relationship WHERE id=$person_relationship"));
                                                    $person_relationship = $row1['name'];

                                                    $row1 = pg_fetch_assoc(pg_query("SELECT * FROM role_type WHERE role_type_id=$person_role"));
                                                    $person_role = $row1['name'];

                                                    echo "
                                            
                                                        <div class='modal fade' id='edit_$person_id'>

                                                            <div class='modal-dialog modal-lg'>

                                                                <div class='modal-content'>

                                                                    <div class='modal-header'>

                                                                        <h4 class='h4'>Edit - $person_firstname $person_lastname</h4>
                                                                        <button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>

                                                                    </div>

                                                                    <div class='modal-body'>

                                                                        <div class='row'>

                                                                            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                                                <form id='$person_id' method='POST' class='ajax4' action='updatePerson.php'>

                                                                                    <div class='row container'>

                                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                                            <label><strong>Firstname</strong></label>

                                                                                            <br>

                                                                                            <input type='hidden' name='edit_person_id' id='edit_person_id' value='".$person_id."'>

                                                                                            <input class='form-control' type='text' name='edit_person_firstname_".$person_id."' id='edit_person_firstname_".$person_id."' value='".$person_firstname."' required>

                                                                                        </div>

                                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                                            <label><strong>Lastname</strong></label>

                                                                                            <br>

                                                                                            <input class='form-control' type='text' name='edit_person_lastname_".$person_id."' id='edit_person_lastname_".$person_id."' value='".$person_lastname."' required>

                                                                                        </div>

                                                                                    </div>

                                                                                    <br>

                                                                                    <div class='row container'>

                                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                                            <label><strong>Email</strong></label>

                                                                                            <br>

                                                                                            <input class='form-control' type='email' name='edit_person_email_".$person_id."' id='edit_person_email_".$person_id."' value='".$person_email."' required>

                                                                                        </div>

                                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                                            <label><strong>Phone</strong></label>

                                                                                            <br>

                                                                                            <input class='form-control' type='number' name='edit_person_cell_no_".$person_id."' id='edit_person_cell_no_".$person_id."' value='".$person_cell_no."' required>

                                                                                        </div>

                                                                                    </div>

                                                                                    <br>

                                                                                    <div class='row container'>

                                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                                            <label><strong>Role</strong></label>

                                                                                            <br>

                                                                                            <select class='form-control' name='edit_person_role_".$person_id."' id='edit_person_role_".$person_id."' required>

                                                                                                <option value='' disabled selected>Select Role</option>

                                                                                                ";

                                                                                                $res = pg_query("SELECT * FROM role_type");

                                                                                                while($r = pg_fetch_assoc($res))
                                                                                                {

                                                                                                    $role_id = $r['role_type_id'];
                                                                                                    $role_name = $r['name'];

                                                                                                    echo "<option value='$role_id'";

                                                                                                    if($person_role == $role_name)
                                                                                                        echo " selected";

                                                                                                    echo ">$role_name</option>";

                                                                                                }

                                                                                                echo "

                                                                                            </select>

                                                                                        </div>

                                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                                            <label><strong>Relationship</strong></label>

                                                                                            <br>

                                                                                            <select class='form-control' name='edit_person_relationship_".$person_id."' id='edit_person_relationship_".$person_id."' required>

                                                                                                <option value='' disabled selected>Select Relationship</option>

                                                                                                ";

                                                                                                $res = pg_query("SELECT * FROM relationship");

                                                                                                while($r = pg_fetch_assoc($res))
                                                                                                {

                                                                                                    $relationship_id = $r['id'];
                                                                                                    $relationship_name = $r['name'];

                                                                                                    echo "<option value='$relationship_id'";

                                                                                                    if($person_relationship == $relationship_name)
                                                                                                        echo " selected";

                                                                                                    echo ">$relationship_name</option>";

                                                                                                }

                                                                                                echo "

                                                                                            </select>

                                                                                        </div>

                                                                                    </div>

                                                                                    <br>

                                                                                    <div class='row'>

                                                                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

                                                                                            <button type='submit' class='btn btn-success btn-xs'><i class='fa fa-save'></i> Save</button>

                                                                                            <!--button type='button' name='person_edit_save' id='person_edit_save' value='$person_id' class='btn btn-success btn-xs'><i class='fa fa-save'></i> Save</button-->

                                                                                            <button type='button' data-dismiss='modal' class='btn btn-warning btn-xs closing'><i class='fa fa-close'></i> Close</button>

                                                                                        </div>

                                                                                    </div>

                                                                                </form>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    ";

                                                    echo "

                                                    <tr>

                                                        <td name='person_".$person_id."_firstname' id='person_".$person_id."_firstname'>$person_firstname</td>
                                                        <td name='person_".$person_id."_lastname' id='person_".$person_id."_lastname'>$person_lastname</td>
                                                        <td name='person_".$person_id."_email' id='person_".$person_id."_email'>$person_email</td>
                                                        <td name='person_".$person_id."_cell_no' id='person_".$person_id."_cell_no'>$person_cell_no</td>
                                                        <td name='person_".$person_id."_role' id='person_".$person_id."_role'>$person_role</td>
                                                        <td name='person_".$person_id."_relationship' id='person_".$person_id."_relationship'>$person_relationship</td>
                                                        <td><button class='btn btn-link' type='button' data-toggle='modal' data-target='#edit_$person_id'><i class='fa fa-edit'></i> Edit</button></td>
                                                        <td><button class='btn btn-link text-warning' type='button' data-toggle='modal' data-target='#remove_$person_id'><i class='fa fa-close'></i> Remove</button></td>

                                                    </tr>

                                                    ";

                                                }

                                            ?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            <br>

                            <div class='row'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <div class='modal fade' id='add_person'>

                                        <div class='modal-dialog modal-lg'>

                                            <div class='modal-content'>

                                                <div class='modal-header'>

                                                    <h4 class='h4'>Add Person</h4>
                                                    <button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>

                                                </div>

                                                <div class='modal-body'>

                                                    <div class='row'>

                                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                            <form method='POST' class='ajax5' action='addPerson.php'>

                                                                <div class='row container'>

                                                                    <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                        <label><strong>Firstname</strong></label>

                                                                        <br>

                                                                        <input type='hidden' name='hoa_id' id='hoa_id' value='<?php echo $hoa_id; ?>'>

                                                                        <input type='hidden' name='home_id' id='home_id' value='<?php echo $home_id; ?>'>

                                                                        <input class='form-control' type='text' name='add_person_firstname' id='add_person_firstname' required>

                                                                    </div>

                                                                    <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                        <label><strong>Lastname</strong></label>

                                                                        <br>

                                                                        <input class='form-control' type='text' name='add_person_lastname' id='add_person_lastname' required>

                                                                    </div>

                                                                </div>

                                                                <br>

                                                                <div class='row container'>

                                                                    <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                        <label><strong>Email</strong></label>

                                                                        <br>

                                                                        <input class='form-control' type='email' name='add_person_email' id='add_person_email' required>

                                                                    </div>

                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                            <label><strong>Phone</strong></label>

                                                                            <br>

                                                                            <input class='form-control' type='number' name='add_person_cell_no' id='add_person_cell_no' required>

                                                                        </div>

                                                                    </div>

                                                                    <br>

                                                                    <div class='row container'>

                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                            <label><strong>Role</strong></label>

                                                                            <br>

                                                                            <select class='form-control' name='add_person_role' id='add_person_role' required>

                                                                                <option value='' disabled selected>Select Role</option>

                                                                                <?php

                                                                                    $res = pg_query("SELECT * FROM role_type");

                                                                                    while($r = pg_fetch_assoc($res))
                                                                                    {

                                                                                        $role_id = $r['role_type_id'];
                                                                                        $role_name = $r['name'];

                                                                                        echo "<option value='$role_id'>$role_name</option>";

                                                                                    }

                                                                                ?>

                                                                            </select>

                                                                        </div>

                                                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                                                                            <label><strong>Relationship</strong></label>

                                                                            <br>

                                                                            <select class='form-control' name='add_person_relationship' id='add_person_relationship' required>

                                                                                <option value='' disabled selected>Select Relationship</option>

                                                                                <?php

                                                                                    $res = pg_query("SELECT * FROM relationship");

                                                                                    while($r = pg_fetch_assoc($res))
                                                                                    {

                                                                                        $relationship_id = $r['id'];
                                                                                        $relationship_name = $r['name'];

                                                                                        echo "<option value='$relationship_id'>$relationship_name</option>";

                                                                                    }

                                                                                ?>

                                                                            </select>

                                                                        </div>

                                                                    </div>

                                                                    <br>

                                                                    <div class='row'>

                                                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

                                                                            <button type='submit' class='btn btn-success btn-xs'><i class='fa fa-save'></i> Save</button>

                                                                            <button type='button' data-dismiss='modal' class='btn btn-warning btn-xs closing'><i class='fa fa-close'></i> Close</button>

                                                                        </div>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <center>

                                        <button class='btn btn-info btn-xs' type='button' data-toggle='modal' data-target='#add_person'><i class='fa fa-plus'></i> Add Person</button>

                                    </center>

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

							<br>

						</div>

                        <div id='edit_email_div'>

                            <div class='row container'>
                                
                                <div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

                                    <div class='alert alert-warning'>

                                        <ol class="breadcrumb">
                                    
                                            <li class="breadcrumb-item">User Details</li>
                                            <li class="breadcrumb-item">Home Details</li>
                                            <li class="breadcrumb-item"><strong style='color: black;'>Email &amp; Persons</strong></li>
                                            <li class='breadcrumb-item'>SMS Notifications</li>
                                            <li class="breadcrumb-item">Agreements</li>
                                            <li class='breadcrumb-item'>Documents</li>
                                            <li class="breadcrumb-item">HOA Fact Sheet</li>
                                            <li class="breadcrumb-item">Disclosures</li>

                                        </ol>

                                    </div>

                                </div>

                            </div>

                            <br>

                            <div class='row'>

                                <div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

                                    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

                                        <h3>Edit Primary Email</h3>

                                    </div>

                                    <br><br>

                                    <form method='POST' action='updatePrimaryEmail.php' class='ajax3'>
                                                                                        
                                        <div class='row'>

                                            <div class='col-xl-6 col-lg-6 col-md-8 col-sm-10 col-xs-12 offset-xl-3 offset-lg-3 offset-md-2 offset-sm-1'>

                                                <label><strong>Email</strong></label>

                                                <br>

                                                <input class='form-control' type='email' name='edit_primary_email' id='edit_primary_email' value='<?php echo $primary_email; ?>' required>

                                                <input type='hidden' name='pid' id='pid' value='<?php echo $pid; ?>'>

                                            </div>

                                        </div>

                                        <br>

                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                            <center>

                                                <button class='btn btn-warning btn-xs' type='button' name='edit_email_back' id='edit_email_back'><i class='fa fa-arrow-left'></i> Back</button> <button class='btn btn-success btn-xs' type='submit'><i class='fa fa-save'></i> Save</button>

                                            </center>

                                        </div>

                                    </form>

                                </div>

                            </div>

                            <br>

                        </div>

                        <div id='notifications_div'>

                            <div class='row container'>
                                
                                <div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

                                    <div class='alert alert-warning'>

                                        <ol class="breadcrumb">
                                    
                                            <li class="breadcrumb-item">User Details</li>
                                            <li class="breadcrumb-item">Home Details</li>
                                            <li class="breadcrumb-item">Email &amp; Persons</li>
                                            <li class='breadcrumb-item'><strong style='color: black;'>SMS Notifications</strong></li>
                                            <li class="breadcrumb-item">Agreements</li>
                                            <li class='breadcrumb-item'>Documents</li>
                                            <li class="breadcrumb-item">HOA Fact Sheet</li>
                                            <li class="breadcrumb-item">Disclosures</li>

                                        </ol>

                                    </div>

                                </div>

                            </div>

                            <br>

                            <div class='row'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <center><h3>SMS Notifications</h3></center>

                                </div>

                            </div>

                            <br>

                            <div class='row container-fluid'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive'>

                                    <table class='table table-striped' style="color: black;">

                                        <thead>
                                            
                                            <th>Person Name</th>
                                            <th>Event</th>
                                            <th>Phone Notification</th>
                                            <th>Email Notification</th>
                                            <th>Create Date</th>

                                        </thead>

                                        <tbody>
                                            
                                            <?php

                                                $result = pg_query("SELECT * FROM community_comms WHERE hoa_id=$hoa_id");

                                                while ($row = pg_fetch_assoc($result)) 
                                                {

                                                    $person_id = $row['person_id'];
                                                    $event_type_id = $row['event_type_id'];
                                                    $create_date = $row['create_date'];
                                                    $phone = $row['phone'];
                                                    $email = $row['email'];


                                                    $row1 = pg_fetch_assoc(pg_query("SELECT * FROM person WHERE id=$person_id"));
                                                    $pname = $row1['fname'];
                                                    $pname .= " ";
                                                    $pname .= $row1['lname'];

                                                    $row1 = pg_fetch_assoc(pg_query("SELECT * FROM event_type WHERE event_type_id=$event_type_id"));
                                                    $event_type_name = $row1['event_type_name'];
                                                    $event_header = $row1['header'];

                                                    if($phone == 't')
                                                        $phone = 'Enabled';
                                                    else
                                                        $phone = 'Disabled';

                                                    if($email == 't')
                                                        $email = 'Enabled';
                                                    else
                                                        $email = 'Disabled';

                                                    if($create_date != '')
                                                        $create_date = date('m-d-Y', strtotime($create_date));

                                                    echo "<tr><td>$pname</td><td>$event_header - $event_type_name</td><td>$phone</td><td>$email</td><td>$create_date</td></tr>";

                                                }

                                            ?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            <br>

                            <div class='row container'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <?php

                                        $result = pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id AND is_active='t'");

                                        while($row = pg_fetch_assoc($result))
                                        {

                                            $cc_firstname = $row['fname'];
                                            $cc_lastname = $row['lname'];
                                            $cc_person_id = $row['id'];

                                            echo "

                                                <form id='$cc_person_id' method='POST'>

                                                    <div class='row'>

                                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                            Person : <strong style='color: black;'>$cc_firstname $cc_lastname</strong>

                                                        </div>

                                                    </div>

                                                    <br>

                                                    <div class='row'>

                                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                            Notification Type : 

                                                        </div>

                                                    </div>

                                                    <div class='row'>

                                                        <div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='notification_type' id='notification_type_email' value='Email'> <strong style='color: black;'>Email Only</strong>

                                                        </div>

                                                        <div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='notification_type' id='notification_type_phone' value='Phone'> <strong style='color: black;'>Phone Only</strong>

                                                        </div>

                                                        <div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12'>

                                                            <input type='radio' name='notification_type' id='notification_type_both' value='Both'> <strong style='color: black;'>Both</strong>

                                                        </div>

                                                    </div>

                                                    <br>

                                                    <div class='row'>

                                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                            For Events : 

                                                        </div>

                                                    </div>

                                                    <div class='row'>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12'>

                                                            <input type='checkbox' name='notification_event' value='1'> <strong style='color: black;'>Board Meeting</strong>

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12'>

                                                            <input type='checkbox' name='notification_event' value='4'> <strong style='color: black;'>Payment Received</strong>

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12'>

                                                            <input type='checkbox' name='notification_event' value='8'> <strong style='color: black;'>Landscape Repair</strong>

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12'>

                                                            <input type='checkbox' name='notification_event' value='9'> <strong style='color: black;'>Landscape Maintenance</strong>

                                                        </div>

                                                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12'>

                                                            <input type='checkbox' name='notification_event' value='14'> <strong style='color: black;'>Late Payment Posted</strong>

                                                        </div>

                                                    </div>

                                                    <br>

                                                    <div class='row'>

                                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                            <center>

                                                                <button type='submit' class='btn btn-xs btn-success'><i class='fa fa-tick'></i> Update</button>

                                                            </center>

                                                        </div>

                                                    </div>

                                                    <br><br>

                                                </form>

                                            ";

                                        }

                                    ?>

                                    <form method='POST' class='ajax6'>

                                        <div class='row'>

                                            <label><strong>Select notification type</strong></label>

                                        </div>

                                        <div class='row' style='color: black;'>

                                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12'>

                                                <input type='radio' name='notification_type' id='notification_type_email' value='Email'> <strong>Email Only</strong>

                                            </div>

                                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12'>

                                                <input type='radio' name='notification_type' id='notification_type_phone' value='Phone'> <strong>Phone Only</strong>

                                            </div>

                                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12'>

                                                <input type='radio' name='notification_type' id='notification_type_both' value='both' selected> <strong>Both Email &amp; Phone</strong>

                                            </div>

                                        </div>

                                        <br>

                                        <div class='row'>

                                            <label><strong>Send notification to</strong></label>

                                        </div>

                                        <div class='row' style='color: black;'>
                                            
                                            <?php

                                                $result = pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id");

                                                while($row = pg_fetch_assoc($result))
                                                {

                                                    $person_name = $row['fname'];
                                                    $person_name .= " ";
                                                    $person_name .= $row['lname'];

                                                    echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12'><input type='checkbox' name='notification_person' value='$person_name'> <strong>$person_name</strong></div>";

                                                }

                                            ?>

                                        </div>
                                        
                                    </form>

                                </div>

                            </div>

                            <br>

                            <div class='row'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <hr class='small'>

                                    <div class='row'>
                                        
                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

                                            <button class='btn btn-warning btn-xs' type='button' id='notifications_back' name='notifications_back'><i class='fa fa-arrow-left'></i> Back</button>

                                        </div>

                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

                                            <button class='btn btn-xs btn-success' name='notifications_continue' id='notifications_continue'>Continue <i class='fa fa-arrow-right'></i></button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <br>

                        </div>

						<div id='agreements_div'>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item">User Details</li>
											<li class="breadcrumb-item">Home Details</li>
											<li class="breadcrumb-item">Email &amp; Persons</li>
                                            <li class='breadcrumb-item'>SMS Notifications</li>
                                            <li class="breadcrumb-item"><strong style='color: black;'>Agreements</strong></li>
											<li class='breadcrumb-item'>Documents</li>
                                            <li class="breadcrumb-item">HOA Fact Sheet</li>
											<li class="breadcrumb-item">Disclosures</li>

										</ol>

									</div>

								</div>

							</div>

							<br>

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

                        <div id='documents_div'>

                            <div class='row container'>
                                
                                <div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

                                    <div class='alert alert-warning'>

                                        <ol class="breadcrumb">
                                    
                                            <li class="breadcrumb-item">User Details</li>
                                            <li class="breadcrumb-item">Home Details</li>
                                            <li class="breadcrumb-item">Email &amp; Persons</li>
                                            <li class='breadcrumb-item'>SMS Notifications</li>
                                            <li class="breadcrumb-item">Agreements</li>
                                            <li class="breadcrumb-item"><strong style='color: black;'>Documents</strong></li>
                                            <li class="breadcrumb-item">HOA Fact Sheet</li>
                                            <li class="breadcrumb-item">Disclosures</li>

                                        </ol>

                                    </div>

                                </div>

                            </div>

                            <br>

                            <div class='row'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <center><h3>Documents</h3></center>

                                </div>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive'>

                                    <table id='myDocuments' class='table table-striped' style='color: black;'>

                                        <thead>
                                            
                                            <th>Name</th>
                                            <th>Date of Upload</th>
                                            <th>Year</th>

                                        </thead>

                                        <tbody>

                                            <?php 

                                                $result = pg_query("SELECT * FROM document_management WHERE community_id=$community_id AND active='t' AND is_board_document='f'");

                                                while($row = pg_fetch_assoc($result))
                                                {

                                                    $document_id = $row['document_id'];
                                                    $year = $row['year_of_upload'];
                                                    $upload_date = $row['uploaded_date'];
                                                    $description = $row['description'];
                                                    $document_url = $row['url'];

                                                    if($upload_date != "")
                                                        $upload_date = date('m-d-Y', strtotime($upload_date));

                                                    $is_visible = pg_num_rows(pg_query("SELECT * FROM document_visibility WHERE document_id=$document_id AND (user_id=$user_id OR hoa_id=$hoa_id)"));

                                                    if($is_visible)
                                                        echo "<tr><td><a href='getDocumentPreview.php?path=$document_url&desc=$description&cid=$community_id&doc_id=$document_id' target='_blank'>$description</a></td><td><a href='getDocumentPreview.php?path=$document_url&desc=$description&cid=$community_id&doc_id=$document_id' target='_blank'>$upload_date</a></td><td>$year</td></tr>";

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

                                            <button class='btn btn-warning btn-xs' type='button' id='documents_back' name='documents_back'><i class='fa fa-arrow-left'></i> Back</button>

                                        </div>

                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

                                            <button class='btn btn-xs btn-success' name='documents_continue' id='documents_continue'>Continue <i class='fa fa-arrow-right'></i></button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <br>

                        </div>

						<div id='hoa_fact_sheet_div'>

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
                                            <li class="breadcrumb-item"><strong style='color: black;'>HOA Fact Sheet</strong></li>
											<li class="breadcrumb-item">Disclosures</li>

										</ol>

									</div>

								</div>

							</div>

							<br>

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

												<div class="tab-pane" id="tab-3">
												
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

						<div id='disclosure1_div'>

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

                                                        <br>";

                                                        if($changed_this_year != ' - ')
                                                            echo "

                                                            <div class='row'>

                                                                <div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

                                                                    <strong>Changed this year :</strong> $changed_this_year

                                                                </div>

                                                            </div>

                                                            <br>

                                                            ";

                                                        if($notes != ' - ')
                                                            echo "

                                                            <div class='row'>

                                                                <div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

                                                                    <strong>Board Comments </strong> $notes

                                                                </div>

                                                            </div>

                                                            <br>";

                                                        if($document != ' - ')
                                                            echo "

                                                            <div class='row'>

                                                                <div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

                                                                    <strong>Document :</strong> $document

                                                                </div>

                                                            </div>

                                                            <br>

                                                            ";

                                                    echo "

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

						<div id='disclosure8_div'>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item">User Details</li>
											<li class="breadcrumb-item">Home Details</li>
											<li class="breadcrumb-item">Primary Email</li>
											<li class="breadcrumb-item">Agreements</li>
											<li class="breadcrumb-item">HOA Fact Sheet</li>
											<li class="breadcrumb-item"><strong style='color: black;'>Disclosures</strong></li>

										</ol>

									</div>

								</div>

							</div>

							<br>

                            <div class='row'>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <center><h3 class='h3'>Community Communications</h3></center>

                                </div>

                            </div>

                            <br>

							<div class='row'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<div class='container module-gray' style="color: black;">

										<?php

											$row = pg_fetch_assoc(pg_query("SELECT * FROM community_disclosures WHERE community_id=$community_id AND type_id=15"));

											$notes = $row['notes'];
											$document_id = $row['document_id'];
											$changed_this_year = $row['changed_this_year'];

											$row = pg_fetch_assoc(pg_query("SELECT * FROM community_disclosure_type WHERE id=15"));
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

										?>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Disclosure Name :</strong> <?php echo $disclosure_name; ?>

											</div>

										</div>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Changed this year :</strong> <?php echo $changed_this_year; ?>

											</div>

										</div>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Board Comments </strong> <?php echo $notes; ?>

											</div>

										</div>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Document :</strong> <?php echo $document; ?>

											</div>

										</div>

										<br>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive'>

									<table class='table table-striped' style="color: black;">

										<thead>
											
											<th>Person Name</th>
											<th>Event</th>
											<th>Phone Notification</th>
											<th>Email Notification</th>
											<th>Create Date</th>

										</thead>

										<tbody>
											
											<?php

												$result = pg_query("SELECT * FROM community_comms WHERE hoa_id=$hoa_id");

												while ($row = pg_fetch_assoc($result)) 
												{

													$person_id = $row['person_id'];
													$event_type_id = $row['event_type_id'];
													$create_date = $row['create_date'];
													$phone = $row['phone'];
													$email = $row['email'];


													$row1 = pg_fetch_assoc(pg_query("SELECT * FROM person WHERE id=$person_id"));
													$pname = $row1['fname'];
													$pname .= " ";
													$pname .= $row1['lname'];

													$row1 = pg_fetch_assoc(pg_query("SELECT * FROM event_type WHERE event_type_id=$event_type_id"));
													$event_type_name = $row1['event_type_name'];
													$event_header = $row1['header'];

													if($phone == 't')
														$phone = 'Sent';
													else
														$phone = 'Not Sent';

													if($email == 't')
														$email = 'Sent';
													else
														$email = 'Not Sent';

													if($create_date != '')
														$create_date = date('m-d-Y', strtotime($create_date));

													echo "<tr><td>$pname</td><td>$event_header - $event_type_name</td><td>$phone</td><td>$email</td><td>$create_date</td></tr>";

												}

											?>

										</tbody>

									</table>

								</div>

							</div>

                            <br>

                            <div class='row'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <form method='POST' >

                                        <div class='row'>

                                            <label><strong>Select notification type</strong></label>

                                        </div>

                                        <div class='row' style='color: black;'>

                                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12'>

                                                <input type='radio' name='notification_type' id='notification_type_email' value='Email'> <strong>Email Only</strong>

                                            </div>

                                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12'>

                                                <input type='radio' name='notification_type' id='notification_type_phone' value='Phone'> <strong>Phone Only</strong>

                                            </div>

                                            <div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12'>

                                                <input type='radio' name='notification_type' id='notification_type_both' value='both' selected> <strong>Both Email &amp; Phone</strong>

                                            </div>

                                        </div>

                                        <br>

                                        <div class='row'>

                                            <label><strong>Send notification to</strong></label>

                                        </div>

                                        <div class='row' style='color: black;'>
                                            
                                            <?php

                                                $result = pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id");

                                                while($row = pg_fetch_assoc($result))
                                                {

                                                    $person_name = $row['fname'];
                                                    $person_name .= " ";
                                                    $person_name .= $row['lname'];

                                                    echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12'><input type='checkbox' name='notification_person' value='$person_name'> <strong>$person_name</strong></div>";

                                                }

                                            ?>

                                        </div>
                                        
                                    </form>

                                </div>

                            </div>

							<div class='row'>

								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

											<hr class='small'>

											<div class='row'>
										
												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

													<button id='disclosure8_back' name='disclosure8_back' class='btn btn-warning btn-xs'><i class='fa fa-arrow-left'></i> Back</button>

												</div>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

													<!--button id='disclosure8_continue' name='disclosure8_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button-->

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

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>