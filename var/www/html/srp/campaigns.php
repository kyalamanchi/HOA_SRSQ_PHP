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
			<?php include "boardHeader.php"; ?>
		
			<div class="wrapper">

				<!-- Page Header -->
				<section class="module-page-title">
					
					<div class="container">
							
						<div class="row-page-title">
							
							<div class="page-title-captions">
								
								<h1 class="h5">Community Campaigns - Mailchimp</h1>
							
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
									
									<th>Send Time</th>
									<th>Campaign Title</th>
									<th>Emails Sent</th>
									<th>Opens</th>
									<th>Clicks</th>

								</thead>

								<tbody>
									
									<?php

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
			            				{

			            					$send_time = $key['send_time'];
											
											if($send_time != '')
												$send_time = date('m-d-Y', strtotime($send_time));

			              					echo "<tr><td>".$send_time."</td><td>".$key['settings']['title']."</td><td>".$key['emails_sent']."</td><td>".$key['report_summary']['opens']."</td><td>".$key['report_summary']['clicks']."</td></tr>";

			            				}

									?>

								</tbody>
								
							</table>

						</div>

					</div>

				</section>

				<!-- Page Header -->
				<section class="module-page-title p-t-0">
					
					<div class="container">
							
						<div class="row-page-title">
							
							<div class="page-title-captions">
								
								<h1 class="h5"><br>Community Campaigns - Mandrill</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container-fluid">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<table id='example2' class='table table-striped'  style='color: black;'>

								<thead>
									
									<th>Send Time</th>
									<th>Campaign Title</th>
									<th>Emails Sent</th>
									<th>Opens</th>
									<th>Clicks</th>

								</thead>

								<tbody>
									
									

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
	        	
	        	$("#example1").DataTable({ "pageLength": 50, "order": [[ 0, "asc"]] });

	        	$("#example2").DataTable({ "pageLength": 50, "order": [[ 0, "asc"]] });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>