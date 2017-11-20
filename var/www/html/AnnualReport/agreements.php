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

            <!-- Page Header -->
            <section id='agreements_header' class='module-page-title'>
                                
                <div class='container'>
                                        
                    <div class='row-page-title'>
                                        
                        <div class='page-title-captions'>
                                            
                            <ol class="breadcrumb">
                                    
                                <li class="breadcrumb-item">User Details</li>
                                <li class="breadcrumb-item">Home Details</li>
                                <li class="breadcrumb-item">Email &amp; Persons</li>
                                <li class='breadcrumb-item'>SMS Notifications</li>
                                <li class="breadcrumb-item"><strong style='color: black;'>Agreements</strong></li>
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

            <!-- Page Header -->
            <section id='documents_header' class='module-page-title'>
                                
                <div class='container'>
                                        
                    <div class='row-page-title'>
                                        
                        <div class='page-title-captions'>
                                            
                            <ol class="breadcrumb">
                                    
                                <li class="breadcrumb-item">User Details</li>
                                <li class="breadcrumb-item">Home Details</li>
                                <li class="breadcrumb-item">Email &amp; Persons</li>
                                <li class='breadcrumb-item'>SMS Notifications</li>
                                <li class="breadcrumb-item">Agreements</li>
                                <li class='breadcrumb-item'><strong style='color: black;'>Documents</strong></li>
                                <li class="breadcrumb-item">Payments</li>
                                <li class="breadcrumb-item">HOA Fact Sheet</li>
                                <li class="breadcrumb-item">Disclosures</li>
                                <li class="breadcrumb-item">HOA Account</li>

                            </ol>
                                        
                        </div>
                                    
                    </div>
                                    
                </div>
                            
            </section>

            <!-- Page Header -->
            <section id='payments_header' class='module-page-title'>
                                
                <div class='container'>
                                        
                    <div class='row-page-title'>
                                        
                        <div class='page-title-captions'>
                                            
                            <ol class="breadcrumb">
                                    
                                <li class="breadcrumb-item">User Details</li>
                                <li class="breadcrumb-item">Home Details</li>
                                <li class="breadcrumb-item">Email &amp; Persons</li>
                                <li class='breadcrumb-item'>SMS Notifications</li>
                                <li class="breadcrumb-item">Agreements</li>
                                <li class='breadcrumb-item'>Documents</li>
                                <li class="breadcrumb-item"><strong style='color: black;'>Payments</strong></li>
                                <li class="breadcrumb-item">HOA Fact Sheet</li>
                                <li class="breadcrumb-item">Disclosures</li>
                                <li class="breadcrumb-item">HOA Account</li>

                            </ol>
                                        
                        </div>
                                    
                    </div>
                                    
                </div>
                            
            </section>

            <!-- Page Header -->
            <section id='hoa_fact_sheet_header' class='module-page-title'>
                                
                <div class='container'>
                                        
                    <div class='row-page-title'>
                                        
                        <div class='page-title-captions'>
                                            
                            <ol class="breadcrumb">
                                    
                                <li class="breadcrumb-item">User Details</li>
                                <li class="breadcrumb-item">Home Details</li>
                                <li class="breadcrumb-item">Email &amp; Persons</li>
                                <li class='breadcrumb-item'>SMS Notifications</li>
                                <li class="breadcrumb-item">Agreements</li>
                                <li class='breadcrumb-item'>Documents</li>
                                <li class="breadcrumb-item">Payments</li>
                                <li class="breadcrumb-item"><strong style='color: black;'>HOA Fact Sheet</strong></li>
                                <li class="breadcrumb-item">Disclosures</li>
                                <li class="breadcrumb-item">HOA Account</li>

                            </ol>
                                        
                        </div>
                                    
                    </div>
                                    
                </div>
                            
            </section>

            <!-- Page Header -->
            <section id='disclosures_header' class='module-page-title'>
                                
                <div class='container'>
                                        
                    <div class='row-page-title'>
                                        
                        <div class='page-title-captions'>
                                            
                            <ol class="breadcrumb">
                                    
                                <li class="breadcrumb-item">User Details</li>
                                <li class="breadcrumb-item">Home Details</li>
                                <li class="breadcrumb-item">Email &amp; Persons</li>
                                <li class='breadcrumb-item'>SMS Notifications</li>
                                <li class="breadcrumb-item">Agreements</li>
                                <li class='breadcrumb-item'>Documents</li>
                                <li class="breadcrumb-item">Payments</li>
                                <li class="breadcrumb-item">HOA Fact Sheet</li>
                                <li class="breadcrumb-item"><strong style='color: black;'>Disclosures</strong></li>
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

                        <div id='documents_div'>

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

                        <div id='payments_div'>

                            <div class='row'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <center><h3>Current Year Payments Processed</h3></center>

                                </div>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive'>

                                    <table class='table table-bordered' style="color: black;">

                                        <thead>
                                                        
                                            <th>Year</th>
                                            <th>Jan</th>
                                            <th>Feb</th>
                                            <th>Mar</th>
                                            <th>Apr</th>
                                            <th>May</th>
                                            <th>Jun</th>
                                            <th>Jul</th>
                                            <th>Aug</th>
                                            <th>Sep</th>
                                            <th>Oct</th>
                                            <th>Nov</th>
                                            <th>Dec</th>

                                        </thead>

                                        <tbody>

                                            <?php

                                                $row1 = pg_fetch_assoc(pg_query("SELECT * FROM current_year_payments_processed WHERE hoa_id=$hoa_id AND home_id=$home_id AND year=$year"));

                                                $m1 = $row1['m1_pmt_processed'];
                                                $m2 = $row1['m2_pmt_processed'];
                                                $m3 = $row1['m3_pmt_processed'];
                                                $m4 = $row1['m4_pmt_processed'];
                                                $m5 = $row1['m5_pmt_processed'];
                                                $m6 = $row1['m6_pmt_processed'];
                                                $m7 = $row1['m7_pmt_processed'];
                                                $m8 = $row1['m8_pmt_processed'];
                                                $m9 = $row1['m9_pmt_processed'];
                                                $m10 = $row1['m10_pmt_processed'];
                                                $m11 = $row1['m11_pmt_processed'];
                                                $m12 = $row1['m12_pmt_processed'];

                                                if($m1 == 't')
                                                    $m1 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                                else
                                                    $m1 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                                if($m2 == 't')
                                                    $m2 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                                else
                                                    $m2 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                                if($m3 == 't')
                                                    $m3 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                                else
                                                    $m3 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                                if($m4 == 't')
                                                    $m4 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                                else
                                                    $m4 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                                if($m5 == 't')
                                                    $m5 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                                else
                                                    $m5 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                                if($m6 == 't')
                                                    $m6 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                                else
                                                    $m6 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                                if($m7 == 't')
                                                    $m7 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                                else
                                                    $m7 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                                if($m8 == 't')
                                                    $m8 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                                else
                                                    $m8 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                                if($m9 == 't')
                                                    $m9 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                                else
                                                    $m9 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                                if($m10 == 't')
                                                    $m10 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                                else
                                                    $m10 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                                if($m11 == 't')
                                                    $m11 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                                else
                                                    $m11 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                                if($m12 == 't')
                                                    $m12 = "<center><i class='fa fa-check-square text-success'></i></center>";
                                                else
                                                    $m12 = "<center><i class='fa fa-square-o text-orange'></i></center>";

                                                echo "<tr><td>$year</td><td>$m1</td><td>$m2</td><td>$m3</td><td>$m4</td><td>$m5</td><td>$m6</td><td>$m7</td><td>$m8</td><td>$m9</td><td>$m10</td><td>$m11</td><td>$m12</td></tr>";

                                            ?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            <br>

                            <div class='row'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <center><h3>Account Statement</h3></center>

                                </div>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <table class='table table-striped' style='color: black;'>

                                        <thead>
                                                        
                                            <th>Month</th>
                                            <th>Document ID</th>
                                            <th>Description</th>
                                            <th>Charge</th>
                                            <th>Payment</th>
                                            <th>Total</th>

                                        </thead>

                                        <tbody>
                                                        
                                            <?php

                                                for($m = 1; $m <= 12; $m++)
                                                {

                                                    $last_date = date("Y-m-t", strtotime("$year-$m-1"));
                                  
                                                    $charges_results = pg_query("SELECT * FROM current_charges WHERE home_id=$home_id AND hoa_id=$hoa_id AND assessment_date>='$year-$m-1' AND assessment_date<='$last_date' ORDER BY assessment_date");

                                                    $payments_results = pg_query("SELECT * FROM current_payments WHERE home_id=$home_id AND hoa_id=$hoa_id AND process_date>='$year-$m-1' AND process_date<='$last_date' ORDER BY process_date");

                                                    $month_charge = 0.0;

                                                    while($charges_row = pg_fetch_assoc($charges_results))
                                                    {

                                                        $month_charge += $charges_row['amount'];
                                                        $tdate = $charges_row['assessment_date'];
                                                        $desc = $charges_row['assessment_rule_type_id'];

                                                        $r = pg_fetch_assoc(pg_query("SELECT * FROM assessment_rule_type WHERE assessment_rule_type_id=$desc"));
                                                        $desc = $r['name'];

                                                        echo "<tr><td>".date('F', strtotime($tdate))."</td><td>".$charges_row['id']."-".$charges_row['assessment_rule_type_id']."</td><td>".date("m-d-y", strtotime($tdate))."|".$desc."</td><td>$ ".$charges_row['amount']."</td><td></td><td>$ ".$month_charge."</td></tr>";

                                                    }

                                                    $month_payment = 0.0;

                                                    while($payments_row = pg_fetch_assoc($payments_results))
                                                    {

                                                        $month_payment += $payments_row['amount'];
                                                        $tdate = $payments_row['process_date'];

                                                        echo "<tr><td>".date('F', strtotime($tdate))."</td><td>".$payments_row['id']."-".$payments_row['payment_type_id']."</td><td>".date("m-d-y", strtotime($tdate))."|"."Payment Received # ".$payments_row['document_num']."</td><td></td><td>$ ".$payments_row['amount']."</td><td>$ ".$month_payment."</td></tr>";

                                                    }

                                                }

                                            ?>

                                            <tr><td></td><td></td><td><strong>Total</strong></td><td><?php $row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE home_id=$home_id AND hoa_id=$hoa_id")); $total_charges = $row['sum']; echo "<strong>$ ".$total_charges."</strong>"; ?></td><td><?php $row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE home_id=$home_id AND hoa_id=$hoa_id AND payment_status_id=1")); $total_payments = $row['sum']; if($total_payments == "") $total_payments = 0.0; echo "<strong>$ ".$total_payments."</strong>"; ?></td><td><?php $total = $total_charges - $total_payments; echo "<strong>$ ".$total."</strong>"; ?></td></tr>

                                        </tbody>
                                                    
                                    </table>

                                </div>

                            </div>

                            <br>

                            <div class='row'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <center><h3>Forte Transactions</h3></center>

                                </div>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <table id='example3' class='table table-striped' style='color: black;'>
                                                    
                                        <thead>

                                            <th>Date</th>
                                            <th>HOA ID</th>
                                            <th>Authorization Code</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                            <th>Entered By</th>
                                            <th>Action</th>
                                                        
                                        </thead>

                                        <tbody>

                                            <?php

                                                $ch = curl_init();
                                                $header = array();
                                                $header[] = 'Content-Type: application/json';
                                  
                                                if($community_id == 1)
                                                {

                                                    $header[] = "X-Forte-Auth-Organization-Id:org_335357";
                                                    $header[] = "Authorization:Basic NjYxZmM4MDdiZWI4MDNkNTRkMzk5MjUyZjZmOTg5YTY6NDJhNWU4ZmNjYjNjMWI2Yzc4N2EzOTY2NWQ4ZGMzMWQ=";
                                                                              
                                                    curl_setopt($ch, CURLOPT_URL, "https://api.forte.net/v3/organizations/org_335357/locations/loc_193771/transactions?filter=customer_id+eq+'".$hoa_id."'");

                                                }
                                                else if($community_id == 2)
                                                {
                                      
                                                    $header[] = "X-Forte-Auth-Organization-Id:org_332536";
                                                    $header[] = "Authorization:Basic ZjNkOGJhZmY1NWM2OTY4MTExNTQ2OTM3ZDU0YTU1ZGU6Zjc0NzdkNTExM2EwNzg4NTUwNmFmYzIzY2U2MmNhYWU=";
                                                                              
                                                    curl_setopt($ch, CURLOPT_URL, "https://api.forte.net/v3/organizations/org_332536/locations/loc_190785/transactions?filter=customer_id+eq+'".$hoa_id."'");
                                                                              
                                                }

                                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

                                                $result = curl_exec($ch);
                                                $obj = json_decode($result);

                                                foreach ($obj->results as $key) 
                                                {  

                                                    if($key->customer_id == $hoa_id)
                                                    {   

                                                        $forte_status = $key->status;

                                                        if($forte_status == 'funded')
                                                            echo "<tr style='color: green;'><td>".date('m-d-Y', strtotime($key->received_date))."</td><td>".$key->customer_id."</td><td>".$key->authorization_code."</td><td>".$forte_status."</td><td>$ ".$key->authorization_amount."</td><td>".$key->entered_by."</td><td>".$key->action."</td></tr>";
                                                        else if($forte_status == 'settling')
                                                            echo "<tr style='color: orange;'><td>".date('m-d-Y', strtotime($key->received_date))."</td><td>".$key->customer_id."</td><td>".$key->authorization_code."</td><td>".$forte_status."</td><td>$ ".$key->authorization_amount."</td><td>".$key->entered_by."</td><td>".$key->action."</td></tr>";
                                                        else
                                                            echo "<tr style='color: red;'><td>".date('m-d-Y', strtotime($key->received_date))."</td><td>".$key->customer_id."</td><td>".$key->authorization_code."</td><td>".$forte_status."</td><td>$ ".$key->authorization_amount."</td><td>".$key->entered_by."</td><td>".$key->action."</td></tr>";

                                                    }
                                    
                                                }
                                                                              
                                                curl_close($ch);

                                            ?>
                                                        
                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            <div class='row'>

                                <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                    <hr class='small'>

                                    <div class='row'>
                                        
                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

                                            <button class='btn btn-warning btn-xs' type='button' id='payments_back' name='payments_back'><i class='fa fa-arrow-left'></i> Back</button>

                                        </div>

                                        <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

                                            <button class='btn btn-xs btn-success' name='payments_continue' id='payments_continue'>Continue <i class='fa fa-arrow-right'></i></button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <br>

                        </div>

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

						<div id='disclosures_div'>

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

                                                    <button id='disclosures_back' name='disclosures_back' class='btn btn-warning btn-xs'><i class='fa fa-arrow-left'></i> Back</button>

                                                </div>

                                                <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

                                                    <button id='disclosures_continue' name='disclosures_continue' class='btn btn-success btn-xs'>Next <i class='fa fa-arrow-right'></i></button>

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

		<script src='assets/js/userPage5.js'></script>
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