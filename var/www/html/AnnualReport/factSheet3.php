<?php
	
	session_start();

include 'includes/dbconn.php';
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
												<li class="nav-item"><a class="nav-link disabled" href="#tab-2" data-toggle="tab">Comms</a></li>
												<li class="nav-item"><a class="nav-link active" href="#tab-3" data-toggle="tab">Reserves</a></li>
												<li class="nav-item"><a class="nav-link disabled" href="#tab-4" data-toggle="tab">Finance</a></li>

											</ul>

											<div class="tab-content">

												<div class="tab-pane in active" id="tab-3">
												
													<div class="special-heading m-b-40">
											
														<h4><i class="fa fa-support"></i> Reserves Dashboard - 2017</h4>
										
													</div>

													<div class='container'>

														<div class='row'>

                                                            <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                                                                <div class='counter h6'>
                                      
                                                                    <?php 

                                                                        $depreciation = pg_fetch_assoc(pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id AND year=2017"));

                                                                        $depreciation = $depreciation['depreciation'];

                                                                        $depreciation = round($depreciation, 0);

                                                                        if($depreciation == '')
                                                                            echo "<div class='counter-number'>0</div>";
                                                                        else
                                                                            echo "<div class='counter-number'>$depreciation</div>";

                                                                    ?>

                                                                    <div class='counter-title'>Annual Depreciation ($)</div>

                                                                </div>

                                                            </div>

															<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                                                                <div class='counter h6'>
                                      
                                                                    <?php 

                                                                        $result = pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id AND year=2017");

                                                                        $result = pg_fetch_assoc($result);

                                                                        $isb = $result['ideal_start_bal'];
                                                                        $bb = $result['begin_bal'];
                                                                        $tu = $result['total_units'];

                                                                        $result = ($isb - $bb) / $tu;

                                                                        $result = round($result, 0);

                                                                        echo "<div class='counter-number' style='color: red'>$result</div>";

                                                                    ?>

                                                                    <div class='counter-title'>Deficit Per Home ($)</div>

                                                                </div>

                                                            </div>

                                                            <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                                                                <div class='counter h6'>

                                                                    <?php 
                                                                        
                                                                        echo "<div class='counter-number' style='color: red'>";

                                                                        echo ($result * $tu);

                                                                        echo "</div>";

                                                                    ?>

                                                                    <div class='counter-title'>Total Deficit ($)</div>

                                                                </div>

                                                            </div>

                                                            <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                                                                <div class='counter h6'>
                                      
                                                                    <?php 

                                                                        $assets = pg_num_rows(pg_query("SELECT * FROM community_assets WHERE community_id=$community_id AND year=2017"));

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

                                                                        $sum_of = pg_fetch_assoc(pg_query("SELECT sum(avg_unit_cost) FROM community_assets WHERE community_id=$community_id AND year=2017"));
                                                                        $sum_of = $sum_of['sum'];

                                                                        //$assets = $sum_of / $assets;
                                                                        $assets = round($assets, 0);

                                                                        echo "<div class='counter-number'>$sum_of</div>";

                                                                    ?>

                                                                    <div class='counter-title'>Total Assets</div>

                                                                </div>

                                                            </div>

		                        							<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

		                          								<div class='counter h6'>

		                            								<?php 

		                              									$row = pg_fetch_assoc(pg_query("SELECT sum(invoice_amount) FROM community_invoices WHERE reserve_expense='t' AND community_id=$community_id AND invoice_date>='2017-01-01' AND invoice_date<='2017-12-31'"));

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

																	<div class='counter-number' style='color: orange;'>
																		
																		<?php 

																			$row = pg_fetch_assoc(pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id AND year=2017"));

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
                                                                        
                                                                        $year = date('Y');
                                                                        $month = date('m');

		                              									$row = pg_fetch_assoc(pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id AND year=2017"));

		                              									$recommended_monthly_allocation_units = $row['rec_mthly_alloc_unit'];

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

                                                    <div class="special-heading m-b-40">
                                            
                                                        <h4><i class="fa fa-support"></i> Reserves Dashboard - 2018</h4>
                                        
                                                    </div>

                                                    <div class='container'>

                                                        <div class='row'>

                                                            <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                                                                <div class='counter h6'>
                                      
                                                                    <?php 

                                                                        $depreciation = pg_fetch_assoc(pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id AND year=2018"));

                                                                        $depreciation = $depreciation['depreciation'];

                                                                        $depreciation = round($depreciation, 0);

                                                                        if($depreciation == '')
                                                                            echo "<div class='counter-number'>0</div>";
                                                                        else
                                                                            echo "<div class='counter-number'>$depreciation</div>";

                                                                    ?>

                                                                    <div class='counter-title'>Annual Depreciation ($)</div>

                                                                </div>

                                                            </div>

                                                            <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                                                                <div class='counter h6'>
                                      
                                                                    <?php 

                                                                        $result = pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id AND year=2018");

                                                                        $result = pg_fetch_assoc($result);

                                                                        $isb = $result['ideal_start_bal'];
                                                                        $bb = $result['begin_bal'];
                                                                        $tu = $result['total_units'];

                                                                        $result = ($isb - $bb) / $tu;

                                                                        $result = round($result, 0);

                                                                        echo "<div class='counter-number' style='color: red'>$result</div>";

                                                                    ?>

                                                                    <div class='counter-title'>Deficit Per Home ($)</div>

                                                                </div>

                                                            </div>

                                                            <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                                                                <div class='counter h6'>

                                                                    <?php 
                                                                        
                                                                        echo "<div class='counter-number' style='color: red'>";

                                                                        echo ($result * $tu);

                                                                        echo "</div>";

                                                                    ?>

                                                                    <div class='counter-title'>Total Deficit ($)</div>

                                                                </div>

                                                            </div>

                                                            <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                                                                <div class='counter h6'>
                                      
                                                                    <?php 

                                                                        $assets = pg_num_rows(pg_query("SELECT * FROM community_assets WHERE community_id=$community_id AND year=2018"));

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

                                                                        $sum_of = pg_fetch_assoc(pg_query("SELECT sum(avg_unit_cost) FROM community_assets WHERE community_id=$community_id AND year=2018"));
                                                                        $sum_of = $sum_of['sum'];

                                                                        //$assets = $sum_of / $assets;
                                                                        $assets = round($assets, 0);

                                                                        echo "<div class='counter-number'>$sum_of</div>";

                                                                    ?>

                                                                    <div class='counter-title'>Total Assets</div>

                                                                </div>

                                                            </div>

                                                            <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                                                                <div class='counter h6'>

                                                                    <?php 

                                                                        $row = pg_fetch_assoc(pg_query("SELECT sum(avg_unit_cost) FROM community_assets WHERE year=2018 AND community_id=$community_id AND rul=0"));

                                                                        $repairs = $row['sum'];

                                                                        echo "<div class='counter-number'>".$repairs."</div>";

                                                                    ?>

                                                                    <div class='counter-title'>Projected Repairs ($)</div>

                                                                </div>

                                                            </div>

                                                            <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                                                                <div class='counter h6'>

                                                                    <div class='counter-number' style='color: red;'>
                                                                        
                                                                        <?php 

                                                                            $row = pg_fetch_assoc(pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id AND year=2018"));

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
                                                                        
                                                                        $year = date('Y');
                                                                        $month = date('m');

                                                                        $row = pg_fetch_assoc(pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id AND year=2018"));

                                                                        $recommended_monthly_allocation_units = $row['rec_mthly_alloc_unit'];

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