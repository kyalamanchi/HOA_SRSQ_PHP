<?php
	
	ini_set("session.save_path","/var/www/html/session/");
	
	session_start();

?>

<!DOCTYPE html>

<html lang='en'>

	<head>

		<?php

			if(!$_SESSION['hoa_username'])
				header("Location: logout.php");

			pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

			$community_id = $_SESSION['hoa_community_id'];
			$mode = $_SESSION['hoa_mode'];

			$today = date('Y-m-d');

			if($mode == 2)
				header('Location: residentDashboard.php');

		?>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='Stoneridge Place At Pleasanton HOA'>
		<meta name='author' content='Geeth'>

		<title><?php echo $_SESSION['hoa_community_code']; ?> | Board Dashboard</title>

		<!-- Web Fonts-->
		<link href='https://fonts.googleapis.com/css?family=Poppins:500,600,700' rel='stylesheet'>
		<link href='https://fonts.googleapis.com/css?family=Hind:400,600,700' rel='stylesheet'>
		<link href='https://fonts.googleapis.com/css?family=Lora:400i' rel='stylesheet'>
		<!-- Bootstrap core CSS-->
		<link href='assets/bootstrap/css/bootstrap.min.css' rel='stylesheet'>
		<!-- Icon Fonts-->
		<link href='assets/css/font-awesome.min.css' rel='stylesheet'>
		<link href='assets/css/linea-arrows.css' rel='stylesheet'>
		<link href='assets/css/linea-icons.css' rel='stylesheet'>
		<!-- Plugins-->
		<link href='assets/css/magnific-popup.css' rel='stylesheet'>
		<link href='assets/css/vertical.min.css' rel='stylesheet'>
		<link href='assets/css/pace-theme-minimal.css' rel='stylesheet'>
		<link href='assets/css/animate.css' rel='stylesheet'>
		<!-- Template core CSS-->
		<link href='assets/css/template.min.css' rel='stylesheet'>
		<!-- Datatable -->
		<link rel='stylesheet' href='https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css'>

	</head>

	<body>

		<div class='layout'>

			<!-- Header-->
			<?php if($mode == 1) include "boardHeader.php"; else if($mode == 2) include "residentHeader.php"; ?>

			<div class="wrapper">

				<!-- Page Header -->
				<section class="module-page-title">
					
					<div class="container">
							
						<div class="row-page-title">
							
							<div class="page-title-captions">
								
								<h1 class="h5">Income</h1>
							
							</div>

							<div class="page-title-secondary">
								
								<ol class="breadcrumb">
									
									<li class="breadcrumb-item"><i class='fa fa-institution'></i> Community</li>
									<li class="breadcrumb-item active">Income</li>

								</ol>

							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container-fluid">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<table id='example1' class='table table-striped'  style='color: black;'>

								<thead>
									
									<th>Date</th>
                        			<th>Deposit Type</th>
                        			<th>Amount</th>
                        			<th>Confirmation</th>

								</thead>

								<tbody>
									
									<?php 

                        				if($community_id == 1)
                        				{
                          
                          					$ch  = curl_init('https://quickbooks.api.intuit.com/v3/company/123145854171542/query?minorversion=8');
                          
                          					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                          					curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Content-Type:application/text','Content-Type:application/text','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprd0JzDPeMNuATqXcic8hnusenW2",oauth_token="qyprdxuMeT1noFaS5g6aywjSOkFQo16WnvwigzPbxQ01LPYF",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1508539671",oauth_nonce="TTJKx4StAFv",oauth_version="1.0",oauth_signature="hPukL2qGZM2duER7bBV%2BZcMEtNs%3D"'));
                          					curl_setopt($ch, CURLOPT_POSTFIELDS, "SELECT * from Deposit startposition 1 maxresults 1000");
                          					curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

                          					$result = curl_exec($ch);
                          					$json_Decode = json_decode($result,TRUE);
                          					$srp_Deposits = $json_Decode['QueryResponse'];

                          					foreach ($srp_Deposits['Deposit'] as $Deposit) {
                              
                            					echo "<tr><td>".date('m-d-Y', strtotime($Deposit['TxnDate']))."</td><td>".nl2br($Deposit['DepositToAccountRef']['name'])."</td><td>$ ".nl2br($Deposit['TotalAmt'])."</td><td>".nl2br($Deposit['PrivateNote'])."</td></tr>";

                          					}

                        				}
                        				else if($community_id == 2)
                        				{
                          
                          					$ch  = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/query?minorversion=8');

                          					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                          					curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Content-Type:application/text','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1506452058",oauth_nonce="cEzWCgQy0l5",oauth_version="1.0",oauth_signature="KXtBMOAC0UjBuczxlE7tPlDyPN0%3D"'));
                          					curl_setopt($ch, CURLOPT_POSTFIELDS, "SELECT * from Deposit startposition 1 maxresults 1000");
                          					curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

                          					$result = curl_exec($ch);

                          					$json_Decode = json_decode($result,TRUE);
                          					$srp_Deposits = $json_Decode['QueryResponse'];

                          					foreach ($srp_Deposits['Deposit'] as $Deposit) {
                              
                            					echo "<tr><td>".date('m-d-Y', strtotime(nl2br($Deposit['TxnDate'])))."</td><td>".nl2br($Deposit['DepositToAccountRef']['name'])."</td><td>$ ".nl2br($Deposit['TotalAmt'])."</td><td>".nl2br($Deposit['PrivateNote'])."</td></tr>";

                          					}

                        				}

                      				?>

								</tbody>
								
							</table>

						</div>

					</div>

				</section>

				<!-- Footer-->
				<?php include 'footer.php'; ?>

				<a class='scroll-top' href='#top'><i class='fa fa-angle-up'></i></a>

			</div>

		</div>

		<!-- Scripts-->
		<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js'></script>
		<script src='assets/bootstrap/js/bootstrap.min.js'></script>
		<script src='assets/js/plugins.min.js'></script>
		<script src='assets/js/custom.min.js'></script>
		<!-- Datatable -->
		<script src='//code.jquery.com/jquery-1.12.4.js'></script>
		<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>

		<script>
      	
	      	$(function () {
	        	
	        	$("#example1").DataTable({ "pageLength": 50, "order": [] });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>