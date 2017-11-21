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
				
				</div>

			</header>

			<div class='wrapper'>

                <!-- Page Header -->
                <section id='payments_header' class='module-page-title'>
                                    
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
                                    <li class="breadcrumb-item"><strong style='color: black;'>Payments</strong></li>
                                    <li class="breadcrumb-item">HOA Fact Sheet</li>
                                    <li class="breadcrumb-item">Disclosures</li>

                                </ol>
                                            
                            </div>
                                        
                        </div>
                                        
                    </div>
                                
                </section>

				<!-- Content -->
				<section class='module'>
						
					<div class='container'>

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
                
                $("#example3").DataTable({ "pageLength": 50, "info": false, "order": [[0, 'desc']] });

            });

        </script>

	</body>

</html>