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
			$year = date('Y');

			if($mode == 2)
				header('Location: residentDashboard.php');

			$hoa_id = base64_decode($_GET['hoa_id']);
			$home_id = base64_decode($_GET['home_id']);
			$name = base64_decode($_GET['name']);

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

			<div class='wrapper'>

				<!-- Page Header -->
				<section class='module-page-title'>
					
					<div class='container'>
							
						<div class='row-page-title'>
							
							<div class='page-title-captions'>
								
								<h1 class='h5'>User Dashboard <small>- <?php echo $name; ?></small></h1>
							
							</div>

							<div class="page-title-secondary">
								
								<ol class="breadcrumb">
									
									<li class="breadcrumb-item"><i class='fa fa-street-view'></i> Users</li>
									<li class="breadcrumb-item active">User Dashboard</li>

								</ol>

							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class='module'>
						
					<div class='container-fluid'>
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
								
								<!-- Tabs-->
								<ul class='nav nav-tabs' style="color: black;">
									
									<li class='nav-item'><a class='nav-link active' href='#tab-1' data-toggle='tab'>Owner &amp; Home</a></li>
									<li class='nav-item'><a class='nav-link' href='#tab-2' data-toggle='tab'>Account Statement</a></li>
									<li class='nav-item'><a class='nav-link' href='#tab-3' data-toggle='tab'>Agreements</a></li>
									<li class='nav-item'><a class='nav-link' href='#tab-4' data-toggle='tab'>Communication</a></li>
									<li class='nav-item'><a class='nav-link' href='#tab-5' data-toggle='tab'>Documents</a></li>
									<li class='nav-item'><a class='nav-link' href='#tab-6' data-toggle='tab'>Inspections</a></li>
									<li class='nav-item'><a class='nav-link' href='#tab-7' data-toggle='tab'>Payments</a></li>
									<li class='nav-item'><a class='nav-link' href='#tab-8' data-toggle='tab'>Statements Mailed</a></li>

								</ul>

								<div class='tab-content'>
									
									<div class='tab-pane in active' id='tab-1'>
										
										<div class='special-heading m-b-40'>
									
											<h4>Owner Details</h4>
								
										</div>
								
										<div class='container'>

											<div class='row table-responsive'>

												<table class='table table-bordered' style='color: black;'>
													
													<thead>
														
														<th>Name</th>
														<th>HOA ID</th>
														<th>Resident Since</th>
														<th>Role</th>
														<th>Email</th>
														<th>Phone</th>
														<th></th>

													</thead>

													<tbody>

														<?php 

															$row = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id AND home_id=$home_id"));

															$firstname = $row['firstname'];
															$lastname .= $row['lastname'];
															$name = $firstname;
															$name .= " ";
															$name .= $lastname;
															$resident_since = $row['valid_from'];
															$resident_until = $row['valid_until'];
															$role = $row['role_type_id'];
															$email = $row['email'];
															$cell_no = $row['cell_no'];

															$row = pg_fetch_assoc(pg_query("SELECT * FROM role_type WHERE role_type_id=$role"));
															$role = $row['name'];

															echo "
											
															<div class='modal fade' id='modal_edit_hoaid'>

																<div class='modal-dialog modal-lg'>

																	<div class='modal-content'>

																		<div class='modal-header'>

																			<h4 class='h4'>Owner Details</h4>
																			<button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>

																		</div>

																		<div class='modal-body'>

																			<div class='container' style='color: black;'>

																				<form method='POST' action='userDashboardEditHOAID.php'>
																				
																					<div class='row'>

																						<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

																							<label><strong>First Name</strong></label><br>
																							<input class='form-control' type='text' name='edit_firstname' id='edit_firstname' value='$firstname' required>

																						</div>

																						<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

																							<label><strong>Last Name</strong></label><br>
																							<input class='form-control' type='text' name='edit_lastname' id='edit_lastname' value='$lastname' required>

																						</div>

																					</div>

																					<br>

																					<div class='row'>

																						<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

																							<label><strong>Email</strong></label><br>
																							<input class='form-control' type='email' name='edit_email' id='edit_email' value='$email' required>

																						</div>

																						<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

																							<label><strong>Phone</strong></label><br>
																							<input class='form-control' type='number' name='edit_cell_no' id='edit_cell_no' value='$cell_no' required>

																						</div>

																					</div>

																					<br>

																					<div class='row'>

																						<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

																							<label><strong>Resident Since</strong></label><br>
																							<input class='form-control' type='date' name='edit_valid_from' id='edit_valid_from' value='$resident_since' required>

																						</div>

																						<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

																							<label><strong>Resident Until</strong></label><br>
																							<input class='form-control' type='date' name='edit_valid_until' id='edit_valid_until' value='$resident_until' required>

																							<input type='hidden' name='hoa_id' id='hoa_id' value='$hoa_id'>
																							<input type='hidden' name='home_id' id='home_id' value='$home_id'>
																							<input type='hidden' name='name' id='name' value='$name'>

																						</div>

																					</div>

																					<br>

																					<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

																						<center>

																							<button class='btn btn-info btn-xs' type='submit'>Update</button>

																						</center>

																					</div>

																				</form>

						                                          			</div>

																		</div>

																	</div>

																</div>

															</div>

															";

															echo "<tr><td>$name</td><td>$hoa_id</td><td>$resident_since</td><td>$role</td><td>$email</td><td>$cell_no</td><td><button class='btn btn-link btn-xs' type='button' data-toggle='modal' data-target='#modal_edit_hoaid'>Edit</button></td></tr>";

														?>
														
													</tbody>

												</table>

											</div>

										</div>

										<div class='special-heading m-b-40'>
									
											<h4><br><br>Home Details</h4>
								
										</div>
								
										<div class='container'>

											<div class='row table-responsive'>

												<table class='table table-bordered' style='color: black;'>
													
													<thead>
														
														<th>Living In</th>
														<th>Home ID</th>
														<th>Living Status</th>
														<th>Lot</th>
														<th>Mailing Address</th>
														<th></th>

													</thead>

													<tbody>

														<?php 

															$row = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));

															$living_in = $row['address1'];
															$living_status = $row['living_status'];
															$lot = $row['lot'];

															if($living_status == 't')
															{

																$mailing_address = $row['address1'];
																$mailing_city = $row['city_id'];
																$mailing_state = $row['state_id'];
																$mailing_zip = $row['zip_id'];

															}
															else
															{

																$row = pg_fetch_assoc(pg_query("SELECT * FROM home_mailing_address WHERE home_id=$home_id"));

																$mailing_address = $row['address1'];
																$mailing_city = $row['city_id'];
																$mailing_state = $row['state_id'];
																$mailing_zip = $row['zip_id'];

															}

															$row = pg_fetch_assoc(pg_query("SELECT * FROM city WHERE city_id=$mailing_city"));
															$mailing_city = $row['city_name'];

															$row = pg_fetch_assoc(pg_query("SELECT * FROM state WHERE state_id=$mailing_state"));
															$mailing_state = $row['state_code'];

															$row = pg_fetch_assoc(pg_query("SELECT * FROM zip WHERE zip_id=$mailing_zip"));
															$mailing_zip = $row['zip_code'];

															$row = pg_fetch_assoc(pg_query("SELECT * FROM role_type WHERE role_type_id=$role"));
															$role = $row['name'];

															if($living_status == 't')
																$living_status = "Living";
															else
																$living_status = "Rented";

															echo "
											
															<div class='modal fade' id='modal_edit_mailing_address'>

																<div class='modal-dialog modal-lg'>

																	<div class='modal-content'>

																		<div class='modal-header'>

																			<h4 class='h4'>Home Details</h4>
																			<button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>

																		</div>

																		<div class='modal-body'>

																			<div class='container' style='color: black; background-color: gray;'>

																				<br>

																				<form method='POST' action='userDashboardEditLot.php'>
																				
																					<div class='row text-center'>

																						<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

																							<label><strong>Lot</strong></label><br>

																						</div>

																						<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

																							<input class='form-control' type='number' name='edit_lot' id='edit_lot' required value='$lot'>

																							<input type='hidden' name='hoa_id' id='hoa_id' value='$hoa_id'>
																							<input type='hidden' name='home_id' id='home_id' value='$home_id'>
																							<input type='hidden' name='name' id='name' value='$name'>

																						</div>

																					</div>

																					<br>

																					<div class='row'>

																						<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

																							<center>

																								<button class='btn btn-info btn-xs' type='submit'>Update Lot</button>

																							</center>

																						</div>

																					</div>

																				</form>

																				<br>

						                                          			</div>

						                                          			<br>

						                                          			<div class='container' style='color: black;'>

																				<!--form method='POST' action='userDashboardEditLivingStatus.php'>
																				
																					<div class='row'>

																						<div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center'>

																							<label><strong>Living Status</strong></label><br>

																						</div>

																						<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

																							<input type='radio'";

																							if($living_status == 'Living')
																								echo " checked";

																							echo " name='living_status' id='living_status' value='Living'> Living

																						</div>

																						<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

																							<input type='radio'";

																							if($living_status == 'Rented')
																								echo " checked";

																							echo " name='living_status' id='living_status' value='Rented'> Rented

																						</div>

																					</div>

																					<div class='row' id='mailing_address_csz'>

																						<div class='row'>

																							<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

																								<label><strong>Address</strong></label>

																							</div>

																							<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

																								<input class='form-control' type='text' name='edit_mailing_address' id='edit_mailing_address' placeholder='Ex : 1111 Example St'>

																							</div>

																						</div>

																					</div>

																					<div class='row text-center'>

																						<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

																							<!--button class='btn btn-info btn-xs' type='submit'>Update Living Status</button-->

																						</div>

																					</div>

																				</form-->

						                                          			</div>

																		</div>

																	</div>

																</div>

															</div>

															";

															echo "<tr><td>$living_in</td><td>$home_id</td><td>$living_status</td><td>$lot</td><td>$mailing_address, $mailing_city, $mailing_state $mailing_zip</td><td><button class='btn btn-link btn-xs' type='button' data-toggle='modal' data-target='#modal_edit_mailing_address'>Edit</button></td></tr>";

														?>
														
													</tbody>

												</table>

											</div>

										</div>

										<div class='special-heading m-b-40'>
									
											<h4><br><br>Persons</h4>
								
										</div>
								
										<div class='container'>

											<div class='row table-responsive'>

												<table class='table table-bordered' style='color: black;'>
													
													<thead>
														
														<th>Name</th>
														<th>Home</th>
														<th>Role</th>
														<th>Relationship</th>
														<th>Email</th>
														<th>Phone</th>

													</thead>

													<tbody>

														<?php 

															$result = pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id AND home_id=$home_id AND is_active='t'");

															$person_emails = array();
															$i = 0;

															while($row = pg_fetch_assoc($result))
															{
																
																$name = $row['fname'];
																$name .= " ";
																$name .= $row['lname'];
																$role_type = $row['role_type_id'];
																$relationship = $row['relationship_id'];
																$email = $row['email'];
																$cell_no = $row['cell_no'];

																$cell_no = base64_decode($cell_no);

																$person_emails[$i] = $email;
																$i++;

																$row = pg_fetch_assoc(pg_query("SELECT * FROM role_type WHERE role_type_id=$role_type"));
																$role_type = $row['name'];

																$row = pg_fetch_assoc(pg_query("SELECT * FROM relationship WHERE id=$relationship"));
																$relationship = $row['name'];

																$row = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));
																$home = $row['address1'];

																echo "<tr><td>$name</td><td>$home</td><td>$role_type</td><td>$relationship</td><td>$email</td><td>$cell_no</td></tr>";

															}
														?>
														
													</tbody>

												</table>

											</div>

										</div>

									</div>

									<div class='tab-pane' id='tab-2'>
										
										<div class='special-heading m-b-40'>
									
											<h4>Account Statement</h4>
								
										</div>

										<div class='container'>

											<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive'>

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

									</div>

									<div class='tab-pane' id='tab-3'>
										
										<div class='special-heading m-b-40'>
									
											<h4>Pending Agreements</h4>
								
										</div>

										<div class='container'>

											<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive'>

												<table id='pendingAgreements' class='table table-striped' style='color: black;'>
													
													<thead>

														<th>Agreement</th>
														<th>Email</th>
														<th>Create Date</th>
														<th>Send Date</th>
														<th>Last Updated</th>
														
													</thead>

													<tbody>

														<?php 

															$result = pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND board_cancel_requested='f' AND is_board_document='f' AND agreement_status='OUT_FOR_SIGNATURE'");

		                        							while($row = pg_fetch_assoc($result))
		                        							{

		                          								$id = $row['id'];
		                          								$document_to = $row['document_to'];
		                          								$create_date = $row['create_date'];
		                          								$send_date = $row['send_date'];
		                          								$agreement_name = $row['agreement_name'];
		                          								$last_updated = $row['last_updated'];
                          										$esign_url = $row['esign_url'];
		                          								$agreement_id = $row['agreement_id'];

		                          								if($create_date != "")
		                            								$create_date = date('m-d-Y', strtotime($create_date));

		                          								if($send_date != "")
		                            								$send_date = date('m-d-Y', strtotime($send_date));

		                          								if($last_updated != "")
		                            								$last_updated = date('m-d-Y', strtotime($last_updated));

		                          								for($k = 0; $k < $i; $k++)
		                          								{
		                          				
		                          									if($person_emails[$k] == $document_to)
		                          										echo "<tr><td><a title='Click to sign agreement' target='_blank' href='$esign_url'>$agreement_name</a></td><td>$document_to</td><td>$create_date</td><td>$send_date</td><td>$last_updated</td></tr>";

		                          								}

		                        							}

		                      							?>
														
													</tbody>

												</table>

											</div>

										</div>

										<div class='special-heading m-b-40'>
									
											<h4><br><br>Signed Agreements</h4>
								
										</div>

										<div class='container'>

											<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive'>

												<table id='signedAgreements' class='table table-striped' style='color: black;'>
													
													<thead>

														<th>Agreement</th>
														<th>Email</th>
														<th>Create Date</th>
														<th>Send Date</th>
														<th>Last Updated</th>
														
													</thead>

													<tbody>

														<?php 

															$result = pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND board_cancel_requested='f' AND is_board_document='f' AND agreement_status='SIGNED'");

		                        							while($row = pg_fetch_assoc($result))
		                        							{

		                          								$id = $row['id'];
		                          								$document_to = $row['document_to'];
		                          								$create_date = $row['create_date'];
		                          								$send_date = $row['send_date'];
		                          								$agreement_name = $row['agreement_name'];
		                          								$last_updated = $row['last_updated'];
		                          								$agreement_id = $row['agreement_id'];

		                          								if($create_date != "")
		                            								$create_date = date('m-d-Y', strtotime($create_date));

		                          								if($send_date != "")
		                            								$send_date = date('m-d-Y', strtotime($send_date));

		                          								if($last_updated != "")
		                            								$last_updated = date('m-d-Y', strtotime($last_updated));

		                          								for($k = 0; $k < $i; $k++)
		                          								{
		                          				
		                          									if($person_emails[$k] == $document_to)
		                          										echo "<tr><td><a title='Click to sign agreement' target='_blank' href='esignPreview.php?id=$agreement_id'>$agreement_name</a></td><td>$document_to</td><td>$create_date</td><td>$send_date</td><td>$last_updated</td></tr>";

		                          								}

		                        							}

		                      							?>
														
													</tbody>

												</table>

											</div>

										</div>

									</div>

									<div class='tab-pane' id='tab-4'>
										
										<div class='special-heading m-b-40'>
									
											<h4>Communication Info</h4>
						
										</div>

										<div class='container'>

											<div class='row'>

												

											</div>

										</div>

									</div>

									<div class='tab-pane' id='tab-5'>
										
										<div class='special-heading m-b-40'>
									
											<h4>User Documents</h4>
						
										</div>

										<div class='container'>

											<div class='row'>



											</div>

										</div>

									</div>

									<div class='tab-pane' id='tab-6'>
										
										<div class='special-heading m-b-40'>
									
											<h4>Inspection Notices</h4>
						
										</div>

										<div class='container'>

											<div class='row'>

												

											</div>

										</div>

									</div>

									<div class='tab-pane' id='tab-7'>
										
										<div class='special-heading m-b-40'>
									
											<h4>Payment Details</h4>
						
										</div>

										<div class='container'>

											<div class='row'>

												

											</div>

										</div>

										<div class='special-heading m-b-40'>
									
											<h4>Current Year Payments Processed</h4>
						
										</div>

										<div class='container'>

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
														<th></th>

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

                                      						echo "
											
															<div class='modal fade' id='modal_edit_cypp'>

																<div class='modal-dialog modal-lg'>

																	<div class='modal-content'>

																		<div class='modal-header'>

																			<h4 class='h4'>Current Year Payments Processed - $year</h4>
																			<button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>

																		</div>

																		<div class='modal-body'>

																			<div class='container' style='color: black;'>

																				<form method='POST' action='userDashboardEditCYPP.php'>
																				
																					<div class='row'>

																						<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																							<input type='checkbox' value='January' name='month[]' id='month'";

																							if($m1 == 't')
																								echo " checked ";

																							echo "> <strong>January</strong>

																						</div>

																						<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																							<input type='checkbox' value='February' name='month[]' id='month'";

																							if($m2 == 't')
																								echo " checked ";

																							echo "> <strong>February</strong>

																						</div>

																						<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																							<input type='checkbox' value='March' name='month[]' id='month'";

																							if($m3 == 't')
																								echo " checked ";

																							echo "> <strong>March</strong>

																						</div>

																						<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																							<input type='checkbox' value='April' name='month[]' id='month'";

																							if($m4 == 't')
																								echo " checked ";

																							echo "> <strong>April</strong>

																						</div>

																						<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																							<input type='checkbox' value='May' name='month[]' id='month'";

																							if($m5 == 't')
																								echo " checked ";

																							echo "> <strong>May</strong>

																						</div>

																						<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																							<input type='checkbox' value='June' name='month[]' id='month'";

																							if($m6 == 't')
																								echo " checked ";

																							echo "> <strong>June</strong>

																						</div>

																						<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																							<input type='checkbox' value='July' name='month[]' id='month'";

																							if($m7 == 't')
																								echo " checked ";

																							echo "> <strong>July</strong>

																						</div>

																						<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																							<input type='checkbox' value='August' name='month[]' id='month'";

																							if($m8 == 't')
																								echo " checked ";

																							echo "> <strong>August</strong>

																						</div>

																						<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																							<input type='checkbox' value='September' name='month[]' id='month'";

																							if($m9 == 't')
																								echo " checked ";

																							echo "> <strong>September</strong>

																						</div>

																						<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																							<input type='checkbox' value='October' name='month[]' id='month'";

																							if($m10 == 't')
																								echo " checked ";

																							echo "> <strong>October</strong>

																						</div>

																						<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																							<input type='checkbox' value='November' name='month[]' id='month'";

																							if($m11 == 't')
																								echo " checked ";

																							echo "> <strong>November</strong>

																						</div>

																						<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																							<input type='checkbox' value='December' name='month[]' id='month'";

																							if($m12 == 't')
																								echo " checked ";

																							echo "> <strong>December</strong>

																						</div>

																						<input type='hidden' name='hoa_id' id='hoa_id' value='$hoa_id'>
																						<input type='hidden' name='home_id' id='home_id' value='$home_id'>
																						<input type='hidden' name='name' id='name' value='$name'>

																					</div>

																					<br>

																					<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

																						<center>

																							<button class='btn btn-info btn-xs' type='submit'>Update</button>

																						</center>

																					</div>

																				</form>

						                                          			</div>

																		</div>

																	</div>

																</div>

															</div>

															";

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

                                    						echo "<tr><td>$year</td><td>$m1</td><td>$m2</td><td>$m3</td><td>$m4</td><td>$m5</td><td>$m6</td><td>$m7</td><td>$m8</td><td>$m9</td><td>$m10</td><td>$m11</td><td>$m12</td><td><center><button class='btn btn-link btn-xs' type='button' data-toggle='modal' data-target='#modal_edit_cypp'>Edit</button></center></td></tr>";

														?>
														
													</tbody>

												</table>

											</div>

										</div>

										<br>

										<div class='special-heading m-b-40'>
									
											<h4>Forte Transactions</h4>
						
										</div>

										<div class='container'>

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

									</div>

									<div class='tab-pane' id='tab-8'>
										
										<div class='special-heading m-b-40'>
									
											<h4>Statements Mailed</h4>
						
										</div>

										<div class='container'>

											<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

												<table id='example2' class='table table-striped' style='color: black;'>

													<thead>
														
														<th>Date Sent</th>
														<th>Total Due</th>
														<th>Statement File</th>
														<th>Statement Type</th>
														<th>Notification Type</th>

													</thead>

													<tbody>
														
														<?php 

                                							$result = pg_query("SELECT * FROM community_statements_mailed WHERE home_id=$home_id AND hoa_id=$hoa_id");

                                							while ($row = pg_fetch_assoc($result)) 
                                							{
                                  								
                                  								$date_sent = $row['date_sent'];
                                  								$total_due = $row['total_due'];
                                  								$statement_file = $row['statement_file'];
                                  								$statement_type = $row['statement_type'];
                                  								$notification_type = $row['notification_type'];

                                  								if($total_due != "")
                                    								$total_due = "$ ".$total_due;

                                  								if($date_sent != "")
                                    								$date_sent = date("m-d-Y", strtotime($date_sent));

                                  								$row1 = pg_fetch_assoc(pg_query("SELECT * FROM notification_mode WHERE notification_mode_id=$notification_type"));
                                  								$notification_type = $row1['notification_mode_type'];

                                  								echo "<tr><td>$date_sent</td><td>$total_due</td><td>$statement_file</td><td>$statement_type</td><td>$notification_type</td></tr>";
                                							
                                							}
                              
                              							?>

													</tbody>
													
												</table>

											</div>

										</div>

									</div>

								</div>

							</div>

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
	        	
	        	$("#example1").DataTable({ "pageLength": 50 });

	        	$("#example2").DataTable({ "pageLength": 50 });

	        	$("#pendingAgreements").DataTable({ "pageLength": 50 });

	        	$("#signedAgreements").DataTable({ "pageLength": 50 });

	        	$("#example3").DataTable({ "pageLength": 50, "order": [[0, "desc"]] });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>