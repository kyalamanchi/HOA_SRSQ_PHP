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
			{	

				$hoa_id = $_SESSION['hoa_hoa_id'];
				$home_id = $_SESSION['hoa_home_id'];

			}

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
								
								<h1 class="h5">View Reminders</h1>
							
							</div>

							<?php

							if($mode == 1)
								echo "

								<div class='page-title-secondary'>
									
									<ol class='breadcrumb'>
										
										<li class='breadcrumb-item'><i class='fa fa-users'></i> Board</li>
										<li class='breadcrumb-item active'>View Reminder</li>

									</ol>

								</div>

								";

							?>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container-fluid">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<table id='example1' class='table' style="color: black;">
										
								<thead>
											
									<th>Open Date</th>
			                        <th>Due Date</th>
			                        <th>Date Updated</th>
			                        <?php 

			                        	if($mode == 1)
			                        		echo "<th>Assigned To</th><th>Living In</th>";

			                        ?>
			                        <th>Reminder Type</th>
			                        <th>Comment</th>
			                        <th>Vendor Assigned</th>

			                        <?php

			                        	if($mode == 1)
			                        		echo "<th>Edit</th><th>Close</th>";
			                       	?>

								</thead>

								<tbody>
											
									<?php 

										if($mode == 1)
										{

											$result = pg_query("SELECT * FROM reminders WHERE community_id=$community_id");

			                        		while($row = pg_fetch_assoc($result))
			                        		{

			                          			$ridf = $row['id'];
                            					$hoa_id = $row['hoa_id'];
			                          			$home_id = $row['home_id'];
			                          			$open_date = $row['open_date'];
			                          			$due_date = $row['due_date'];
			                          			$update_date = $row['update_date'];
			                          			$comments = $row['comments'];
			                          			$vendor_assigned = $row['vendor_assigned'];
			                          			$reminder_type = $row['reminder_type_id'];

			                          			$row1 = pg_fetch_assoc(pg_query("SELECT * FROM reminder_type WHERE id=$reminder_type"));
			                          			$reminder_type = $row1['reminder_type'];

			                          			$row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));
			                          			$assigned_to = $row1['firstname'];
			                          			$assigned_to .= " ";
			                          			$assigned_to .= $row1['lastname'];

			                          			$row1 = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));
			                          			$living_in = $row1['address1'];

			                          			if($vendor_assigned != '')
			                          			{

			                          				$row1 = pg_fetch_assoc(pg_query("SELECT * FROM vendor_master WHERE vendor_id=$vendor_assigned"));
			                          				$vendor_assigned = $row1['vendor_name'];

			                          			}

			                          			if($open_date != '')
			                          				$open_date = date('m-d-Y', strtotime($open_date));

			                          			if($due_date < $today) 
						                        	$ddtm = 't';
						                        else
						                        	$ddtm = 'f';

			                          			if($due_date != '')
			                          				$due_date = date('m-d-Y', strtotime($due_date));

			                          			if($update_date != '')
			                          				$update_date = date('m-d-Y', strtotime($update_date));

						                        if($ddtm == 't') 
						                        	echo "<tr class='text-muted'><td>$open_date</td><td>$due_date</td><td>$update_date</td><td>$assigned_to ($hoa_id)</td><td>$living_in ($home_id)</td><td>$reminder_type</td><td>$comments</td><td>$vendor_assigned</td><td></td><td></td></tr>";
						                        else
						                        {	

						                        	echo "
											
													<div class='modal fade' id='edit_reminder_$rid'>

														<div class='modal-dialog modal-lg'>

															<div class='modal-content'>

																<div class='modal-header'>

																	<h4>Edit Reminder - <strong>$assigned_to</strong></h4>
																	<button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>

																</div>

																<div class='modal-body'>

																	<div class='container' style='color: black;'>

																		<form action='editReminder.php' method='POST'>

																			<div class='row container-fluid'>

																				<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																					<label>Open Date</label>
																					<br>
																					<input class='form-control' type='date' readonly value='$open_date'>

																				</div>

																				<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																					<label>Due Date</label>
																					<br>
																					<input class='form-control' type='date' value='$due_date' name='edit_due_date' id='edit_due_date' required>

																				</div>

																			</div>

																			<div class='row container-fluid'>

																				<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																					<label>Reminder Type</label>
																					<br>
																					<select class='form-control' type='date' name='edit_reminder_type' id='edit_reminder_type' required>

                                              											<option value='' selected disabled>Select Reminder Type</option>";
																						
																						$ree = pg_query("SELECT * FROM reminder_type ORDER BY reminder_type");

                                              											while($roo = pg_fetch_assoc($ree))
                                              											{

                                                											$r_id = $roo['id'];
                                                											$r_type = $roo['reminder_type'];

                                                											echo "<option ";

                                                											if($r_type == $reminder_type)
                                                  												echo " selected ";

                                                											echo "value='$r_id'>$r_type</option>";
                                              											}

																					echo "<select>

																				</div>

																				<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>

																					<label>Vendor Assigned</label>
																					<br>
																					<select class='form-control' type='date' name='edit_vendor' id='edit_vendor'>

                                              											<option value='' selected>NONE</option>";
																						
																						$ree = pg_query("SELECT * FROM vendor_master WHERE community_id=$community_id");
											
                                              											while($roo = pg_fetch_assoc($ree))
                                              											{

											                                                $vendor_id = $roo['vendor_id'];
											                                                $vendor_name = $roo['vendor_name'];

											                                                echo "<option ";

											                                                if($vendor_name == $vendor_assigned)
											                                                  	echo " selected ";

											                                                echo "value='$vendor_id'>$vendor_name</option>";

                                              											}

																					echo "<select>

																				</div>

																			</div>

																			<div class='row container-fluid'>

																				<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

																					<label>Comment</label>
																					<br>
																					<textarea class='form-control' name='edit_comments' id='edit_comments' required>$comments</textarea>

																				</div>

																			</div>

																			<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

																				<br><br>

																				<center>

																					<input type='hidden' name='rid' id='rid' value='$rid'>
																					<button class='btn btn-info' type='submit'>Update Reminder</button>

																				</center>

																			</div>

																		</form>

																	</div>

																</div>

															</div>

														</div>

													</div>

													";

													echo "
											
													<div class='modal fade' id='close_reminder_$hoa_id'>

														<div class='modal-dialog modal-lg'>

															<div class='modal-content'>

																<div class='modal-header'>

																	<h4>Close Reminder - <strong>$assigned_to</strong></h4>
																	<button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>

																</div>

																<div class='modal-body'>

																	<div class='container' style='color: black;'>

																	</div>

																</div>

															</div>

														</div>

													</div>

													";

						                        	echo "<tr><td>$open_date</td><td>$due_date</td><td>$update_date</td><td>$assigned_to ($hoa_id)</td><td>$living_in ($home_id)</td><td>$reminder_type</td><td>$comments</td><td>$vendor_assigned</td><td><button class='btn btn-link btn-lg' type='button' data-toggle='modal' data-target='#edit_reminder_$rid'><i style='color: orange;' class='fa fa-edit'></i></button></td><td><button class='btn btn-link btn-lg' type='button' data-toggle='modal' data-target='#close_reminder_$rid'><i style='color: red;' class='fa fa-close'></i></button></td></tr>";

						                		}

			                        		}

		                        		}
		                        		else
		                        		{

		                        			$result = pg_query("SELECT * FROM reminders WHERE community_id=$community_id AND hoa_id=$hoa_id AND home_id=$home_id");

			                        		while($row = pg_fetch_assoc($result))
			                        		{

			                          			$open_date = $row['open_date'];
			                          			$due_date = $row['due_date'];
			                          			$update_date = $row['update_date'];
			                          			$comments = $row['comments'];
			                          			$vendor_assigned = $row['vendor_assigned'];
			                          			$reminder_type = $row['reminder_type_id'];

			                          			$row1 = pg_fetch_assoc(pg_query("SELECT * FROM reminder_type WHERE id=$reminder_type"));
			                          			$reminder_type = $row1['reminder_type'];

			                          			if($vendor_assigned != '')
			                          			{

			                          				$row1 = pg_fetch_assoc(pg_query("SELECT * FROM vendor_master WHERE vendor_id=$vendor_assigned"));
			                          				$vendor_assigned = $row1['vendor_name'];

			                          			}

			                          			if($open_date != '')
			                          				$open_date = date('m-d-Y', strtotime($open_date));

			                          			if($due_date < $today) 
						                        	$ddtm = 't';
						                        else
						                        	$ddtm = 'f';

			                          			if($due_date != '')
			                          				$due_date = date('m-d-Y', strtotime($due_date));

			                          			if($update_date != '')
			                          				$update_date = date('m-d-Y', strtotime($update_date));

						                        echo "<tr ";

						                        if($ddtm == 't') 
						                        	echo "class='text-muted'";

						                        echo "><td>$open_date</td><td>$due_date</td><td>$update_date</td><td>$reminder_type</td><td>$comments</td><td>$vendor_assigned</td></tr>";

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
	        	
	        	$("#example1").DataTable({ "pageLength": 50, "order": [[0, 'desc']] });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>