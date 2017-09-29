<!DOCTYPE html>

<html lang='en'>

	<head>

		<?php

			session_start();

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

		<div class="wrapper">

			<!-- Header-->
			<?php include "boardHeader.php"; ?>

			<!-- Page Header -->
			<section class="module-page-title">
				
				<div class="container">
						
					<div class="row-page-title">
						
						<div class="page-title-captions">
							
							<h1 class="h5">Community Campaigns</h1>
						
						</div>
					
					</div>
					
				</div>
			
			</section>

			<!-- Content -->
			<section class="module">
					
				<div class="container-fluid">
						
					<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
					
						<!--table id='example1' class='table table-striped'  style='color: black;'>

							<thead>
								
								<th></th>
								<th>HOA ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Home ID</th>
								<th>Living In</th>
								<th>Balance</th>

							</thead>

							<tbody>
								
								<?php

									/*$result = pg_query("SELECT * FROM homeid WHERE community_id=$community_id");

									while($row = pg_fetch_assoc($result))
									{

										$home_id = $row['home_id'];
										$address = $row['address1'];
										$living_status = $row['living_status'];

										$row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE home_id=$home_id AND valid_until>='$today'"));

										$name = $row1['firstname'];
										$name .= " ";
										$name .= $row1['lastname'];
										$hoa_id = $row1['hoa_id'];
										$email = $row1['email'];
										$cell_no = $row1['cell_no'];

										$row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE home_id=$home_id AND hoa_id=$hoa_id"));

										$charges = $row1['sum'];

										$row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE home_id=$home_id AND hoa_id=$hoa_id AND payment_status_id=1"));

										$payments = $row1['sum'];

										if($payments == "")
											$payments = 0.0;

										$balance = $charges - $payments;
										$balance = "$ ".$balance;

										$reminders = pg_num_rows(pg_query("SELECT * FROM reminders WHERE home_id=$home_id AND hoa_id=$hoa_id AND due_date>='$today'"));

										//$row1 = pg_fetch_assoc(pg_query("SELECT * FROM current_year_payments_processed WHERE community_id=$community_id AND hoa_id=$hoa_id AND home_id=$home_id AND year=$year"));

										//$m[1] = $row1['m1_pmt_processed'];
                          				//$m[2] = $row1['m2_pmt_processed'];
                          				//$m[3] = $row1['m3_pmt_processed'];
                          				//$m[4] = $row1['m4_pmt_processed'];
                          				//$m[5] = $row1['m5_pmt_processed'];
                          				//$m[6] = $row1['m6_pmt_processed'];
                          				//$m[7] = $row1['m7_pmt_processed'];
                          				//$m[8] = $row1['m8_pmt_processed'];
                          				//$m[9] = $row1['m9_pmt_processed'];
                         				//$m[10] = $row1['m10_pmt_processed'];
                          				//$m[11] = $row1['m11_pmt_processed'];
                          				//$m[12] = $row1['m12_pmt_processed'];

                          				//for ($i = 1; $i <= 12; $i++)
                          				//{
                            
                            			//	if($m[$i] == 't')
                              			//		$m[$i] = "<center style='color: green;'><i class='fa fa-check-square'></i></center>";
                            			//	else
                              			//		$m[$i] = "<center style='color: orange;'><i class='fa fa-square-o'></i></center>";

                          				//}

                          				//echo "<tr><td><a href='processPayment2.php?hoa_id=$hoa_id&home_id=$home_id&name=$name' style='color: blue;'>$name<br>($hoa_id)</td><td><a href='processPayment2.php?hoa_id=$hoa_id&home_id=$home_id&name=$name' style='color: blue;'>$address<br>($home_id)</td><td>$m[1]</td><td>$m[2]</td><td>$m[3]</td><td>$m[4]</td><td>$m[5]</td><td>$m[6]</td><td>$m[7]</td><td>$m[8]</td><td>$m[9]</td><td>$m[10]</td><td>$m[11]</td><td>$m[12]</td></tr>";

                          				echo "<tr><td>";

                          				if($reminders == 0)
                          					echo "<center><a title='Set Reminder' style='color: green;'><i class='fa fa-bell'></i></a></center>";
                          				else
                          					echo "<center><a title='Edit Reminder' style='color: orange;'><i class='fa fa-bell'></i></a></center>";

                          				echo"</td><td>$hoa_id</td><td>$name</td><td>$email</td><td>$cell_no</td><td>$home_id</td><td>$address</td><td>$balance</td></tr>";

									}*/

								?>

							</tbody>
							
						</table-->

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
              
              					$opens = $key['opens'];
              					$clicks = $key['clicks'];
              					$openrate = sprintf("%.2f",floatval($opens['open_rate']*100.0));
              					$clickrate = sprintf("%.2f",floatval($clicks['click_rate']*100.0) );
              					$date = date("U",strtotime($key['send_time']));
              					$date = date('Y-m-d H:i:s', $date);
              					$url = "#";
              
              					echo '<a class="list-group-item">
                						
                						<h4 class="list-group-item-heading" style="color: #3FC2D9;font-size: 25px;">'.$key['settings']['title'].'</h4>
                						
                						<br>
                						
                						<!--p class="list-group-item-text" style="font-size: 19px;"><b>Sent On  </b>'.date('m-d-y', strtotime($date)).'&nbsp;&nbsp;&nbsp;<b>Emails Sent</b> '.$key['emails_sent'].'&nbsp;&nbsp;&nbsp;<b>Open Rate </b>'.$openrate.'%&nbsp;&nbsp;&nbsp;<b>Click Rate</b> '.$clickrate.'%</p-->
              						</a>';

            				}

						?>

					</div>

				</div>

			</section>

			<!-- Footer-->
			<?php include 'footer.php'; ?>

			<a class='scroll-top' href='#top'><i class='fa fa-angle-up'></i></a>

		</div>

		<!-- Scripts-->
		<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js'></script>
		<script src='assets/bootstrap/js/bootstrap.min.js'></script>
		<script src='http://maps.googleapis.com/maps/api/js?key=AIzaSyA0rANX07hh6ASNKdBr4mZH0KZSqbHYc3Q'></script>
		<script src='assets/js/plugins.min.js'></script>
		<script src='assets/js/custom.min.js'></script>
		<!-- Datatable -->
		<script src='//code.jquery.com/jquery-1.12.4.js'></script>
		<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>

		<script>
      	
	      	$(function () {
	        	
	        	$("#example1").DataTable({ "pageLength": 50, "order": [[ 1, "asc"]] });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>