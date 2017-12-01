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

		?>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='Stoneridge Place At Pleasanton HOA'>
		<meta name='author' content='Geeth'>

		<title><?php echo $_SESSION['hoa_community_code']; if($mode == 1) echo " | Board Dashboard"; else if($mode == 2) echo " | Resident Dashboard"; ?></title>

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
								
								<h1 class="h5">Community Deposits</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<table id='example1' class='table' style="color: black;">
										
								<thead>
											
									<th>Fund Received On</th>
									<th>ID</th>
									<th>Net Amount</th>
									<th>Number of Transactions</th>
									<th>Status</th>
									<th>Fund Sent On</th>

								</thead>

								<tbody>
											
									<?php

										$result = pg_query("SELECT * FROM community_deposits WHERE community_id=$community_id");

										while ($row = pg_fetch_assoc($result)) 
										{
													
											$deposit_id = $row['id'];
											$funded_on = $row['effective_date'];
											$fund_sent = $row['origination_date'];
											$net_amount = $row['net_amount'];
											$number_of_transactions = $row['number_of_transactions'];
											$status = $row['status'];
											$funding_id = $row['funding_id'];

											if($funded_on != "")
												$funded_on = date('m-d-Y', strtotime($funded_on));

											if($fund_sent != "")
												$fund_sent = date('m-d-Y', strtotime($fund_sent));

											if($net_amount != "")
												$net_amount = "$ ".$net_amount;

											echo "
											
											<div class='modal fade' id='modal-1_$deposit_id'>

												<div class='modal-dialog modal-lg'>

													<div class='modal-content'>

														<div class='modal-header'>

															<h4></h4>
															<button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>

														</div>

														<div class='modal-body'>

															<div class='container' style='color: black;'>

																<div class='row text-center'>

																	";

																	if($mode == 1)
																		echo "<div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'><strong>Name<br>(HOA ID)</strong></div>
				                                          				<div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'><strong>Address<br>(Home ID)</strong></div>
				                                          				<div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'><strong>ID</strong></div>
				                                          				<div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'><strong>Status</strong></div>
				                                          				<div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'><strong>Amount</strong></div>
				                                          				<div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'><strong>Received Date</strong></div>";
			                                          				else if($mode == 2)
			                                          					echo "<div class='col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3'><strong>ID</strong></div>
				                                          				<div class='col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3'><strong>Status</strong></div>
				                                          				<div class='col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3'><strong>Amount</strong></div>
				                                          				<div class='col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3'><strong>Received Date</strong></div>";

		                                          				echo "

		                                          				</div>

		                                          				";

		                                          				$result1 = pg_query("SELECT * FROM community_funding_transactions WHERE funding_id='$funding_id' ORDER BY id");

		                                          				while($row1 = pg_fetch_assoc($result1))
						                                        {

						                                          	$id = $row1['id'];
						                                          	$transaction_id = $row1['transaction_id'];
						                                          	$funding_status = $row1['status'];
						                                          	$amount = $row1['amount'];
						                                          	$received_date = $row1['received_date'];
						                                          	$funding_hoa_id = $row1['hoa_id'];

						                                          	if($amount != '')
						                                          		$amount = "$ ".$amount;

						                                          	if($received_date != '')
						                                            	$received_date = date('m-d-Y', strtotime($received_date));

						                                          	$row11 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$funding_hoa_id"));

						                                          	$name = $row11['firstname'];
						                                          	$name .= " ";
						                                          	$name .= $row11['lastname'];
						                                          	$t_home_id = $row11['home_id'];

						                                          	$row11 = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$t_home_id"));

						                                          	$address = $row11['address1'];
						                                          	$living_status = $row11['living_status'];

						                                          	if($name != " " && $address != "")
						                                          	{
						                                            
						                                            	$name = "$name<br>($funding_hoa_id)";
						                                            	$address = "$address<br>($t_home_id)";

						                                          	}
						                                          	else
						                                          	{

						                                            	echo "

						                                            	<div style='background-color: gray;' class='modal fade' id='addHOAID_$id1_$id'>

																			<div class='modal-dialog'>

																				<div class='modal-content'>

																					<div class='modal-header table-responsive'>

						                                                    			<h4>Add Hoa ID - <strong>$id</strong></h4>
						                                                    			<button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>

						                                                  			</div>

						                                                  			<div class='modal-body'>

																						<form method='POST' action='https://hoaboardtime.com/boardEditDepositsHOAID.php'>
						                                                    
						                                                    				<center>

						                                                      					<select class='form-control select2' name='select_hoa' id='select_hoa' style='width: 100%;' required>

						                                                        					<option value='' disabled selected>Select User</option>";

						                                                        					$result000 = pg_query("SELECT * FROM homeid WHERE community_id=$community_id");

						                                                        					while($row000 = pg_fetch_assoc($result000))
						                                                        					{

						                                                          						$add_home_id = $row000['home_id'];
						                                                          						$add_address1 = $row000['address1'];
						                                                          
						                                                          						$row111 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE home_id=$add_home_id"));

						                                                          						$add_name = $row111['firstname'];
						                                                          						$add_name .= " ";
						                                                          						$add_name .= $row111['lastname'];
						                                                          						$add_hoa_id = $row111['hoa_id'];

						                                                          						echo "<option value='".$add_hoa_id."'>".$add_name." - ".$add_address1."</option>";

						                                                        					}

						                                                      					echo "</select>

						                                                      					<input type='hidden' name='current_payments_id' id='current_payments_id' value='$id'>

						                                                      					<br><br>

						                                                      					<button class='btn btn-xs btn-info' type='submit'>Update</button>

						                                                    				</center>

						                                                    			</form>

																					</div>

																				</div>

																			</div>

																		</div>

						                                            	<div class='modal fade' id='addHOAID_$id1_$id'>
						                                
						                                              		<div class='modal-dialog'>
						                                                                
						                                                		<div class='modal-content'>

						                                                  			<div class='modal-body table-responsive'>

						                                                    			<form method='POST' action='https://hoaboardtime.com/boardEditDepositsHOAID.php'>
						                                                    
						                                                    				<center>

						                                                      					<select class='form-control select2' name='select_hoa' id='select_hoa' style='width: 100%;' required>

						                                                        					<option value='' disabled selected>Select User</option>";

						                                                        					$result000 = pg_query("SELECT * FROM homeid WHERE community_id=$community_id");

						                                                        					while($row000 = pg_fetch_assoc($result000))
						                                                        					{

						                                                          						$add_home_id = $row000['home_id'];
						                                                          						$add_address1 = $row000['address1'];
						                                                          
						                                                          						$row111 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE home_id=$add_home_id"));

						                                                          						$add_name = $row111['firstname'];
						                                                          						$add_name .= " ";
						                                                          						$add_name .= $row111['lastname'];
						                                                          						$add_hoa_id = $row111['hoa_id'];

						                                                          						echo "<option value='".$add_hoa_id."'>".$add_name." - ".$add_address1."</option>";

						                                                        					}

						                                                      					echo "</select>

						                                                      					<input type='hidden' name='current_payments_id' id='current_payments_id' value='$id'>

						                                                      					<br><br>

						                                                      					<button class='btn btn-xs btn-info' type='submit'>Update</button>

						                                                    				</center>

						                                                    			</form>

						                                                  			</div>

						                                                  			<br>

						                                                		</div>
						                                              
						                                              		</div>

						                                            	</div>";//End

						                                            	$name = "<a data-toggle='modal' data-target='#addHOAID_$id1_$id' title='Add HOA ID' style='color: blue;'>N/A</a>";
						                                            	$address = "<a data-toggle='modal' data-target='#addHOAID_$id1_$id' title='Add HOA ID' style='color: blue;'>N/A</a>";

						                                          	}

						                                          	echo "<div class='row text-center";

						                                          	if($mode == 1)
						                                          	{
						                                          		if($living_status != 't')
						                                            		echo " text-red";

						                                          		echo "'><div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'>$name</div><div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'>$address</div><div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'>$id</div><div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'>$funding_status</div><div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'>$amount</div><div class='col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2'>$received_date</div></div>";
						                                      		}
						                                      		else if($mode == 2)
						                                      			echo "'><div class='col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3'>$id</div><div class='col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3'>$funding_status</div><div class='col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3'>$amount</div><div class='col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3'>$received_date</div></div>";
						                                        }

															echo "</div>

														</div>

													</div>

												</div>

											</div>

											";

											echo "<tr><td>$funded_on</td><td><button class='btn btn-link btn-lg' type='button' data-toggle='modal' data-target='#modal-1_$deposit_id'>$deposit_id</button></td><td><button class='btn btn-link btn-lg' type='button' data-toggle='modal' data-target='#modal-1_$deposit_id'>$net_amount</button></td><td><button class='btn btn-link btn-lg' type='button' data-toggle='modal' data-target='#modal-1_$deposit_id'>$number_of_transactions</button></td><td>$status</td><td>$fund_sent</td></tr>";
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
	        	
	        	$("#example1").DataTable({ "pageLength": 100, "order": [[0, 'desc']] });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>