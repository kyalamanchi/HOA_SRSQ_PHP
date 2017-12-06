<!DOCTYPE html>

<html lang='en'>

	<head>

		<?php

			session_start();

			if($_SESSION['hoa_username'])
				header("Location: logout.php");

			pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

			$community_id = 2;
			$days90 = date('Y-m-d', strtotime("-90 days"));
			$today = date('Y-m-d');

			$res_dir = pg_num_rows(pg_query("SELECT * FROM member_info WHERE community_id=$community_id"));
			$email_homes = pg_num_rows(pg_query("SELECT * FROM hoaid WHERE email!='' AND community_id=$community_id"));
			$total_homes = pg_num_rows(pg_query("SELECT * FROM homeid WHERE community_id=$community_id"));
			$tenants = pg_num_rows(pg_query("SELECT * FROM home_mailing_address WHERE community_id=$community_id"));
			$newly_moved_in = pg_num_rows(pg_query("SELECT * FROM hoaid WHERE community_id=$community_id AND valid_from>='".$days90."' AND valid_from<='".date('Y-m-d')."'"));

		?>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='Stoneridge Square Association'>
		<meta name='author' content='Geeth'>

		<title>Stoneridge Square Association</title>

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

	</head>

	<body>

		<!-- Layout-->
		<div class='layout'>

			<!-- Header-->
			<header class='header header-right undefined'>

				<div class='container-fluid'>

					<div class='inner-header'>
						
						<a><h4 class='h4' style='color: green;'>STONERIDGE SQUARE ASSOCIATION</h4></a>

					</div>

					<div class='inner-navigation collapse'>

						<div class='inner-navigation-inline'>

							<div class='inner-nav'>

								<ul>

									<li><a href='index.php'><i class='fa fa-home'></i> Home</a></li>
									<li><a class='smoothscroll' href='#get_involved'><i class='fa fa-comment'></i> Get Involved</a></li>
									<li><a target='_blank' href='http://stoneridgesquare.us12.list-manage.com/subscribe?u=12a11bf64aa26b44b5b667427&id=09692e90bd'><i class='fa fa-envelope'></i> Mailing List</a></li>
									<li><a target='_blank' href='https://hoaboardtime.com/paymentPage1.php'><i class='fa fa-dollar'></i> Pay Online</a></li>
									<li><a class='smoothscroll' href='#contact'><i class='fa fa-phone'></i> Contact</a></li>
									<li><a href='login_page.php' style='color: green;'><i class='fa fa-sign-in'></i> Log In</a></li>
									<!--data-toggle='modal' data-target='#login_modal'-->
								</ul>

							</div>

						</div>

					</div>

					<!-- Mobile menu-->
					<div class='nav-toggle'>
						
						<a href='#' data-toggle='collapse' data-target='.inner-navigation'>
							
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>

						</a>

					</div>

				</div>

			</header>

			<!-- Wrapper-->
			<div class='wrapper'>

				<div class='modal fade' id='login_modal'>
					
					<div class='modal-dialog'>
						
						<div class='modal-content'>
							
							<form method='POST' action='login.php' role='form'>

							<div class='modal-header'>
								
								<h5 class='modal-title' style='color: green;'>Log In</h5>
								<button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>
							
							</div>
												
							<div class='modal-body'>
								
								<p>

									<input class='form-control' type='email' name='srp_login_email' id='srp_login_email' placeholder='Email' required>

								</p>
								
								<p>

									<input class='form-control' type='password' name='srp_login_password' id='srp_login_password' placeholder='Password' required>

								</p>
							
							</div>
							
							<div class='modal-footer'>
													
								<button class='btn btn-round btn-success btn-sm' type='submit'>Log In</button>
							
							</div>

							</form>
						
						</div>
					
					</div>
				
				</div>

				<div class='modal fade' id='payment_modal'>
					
					<div class='modal-dialog'>
						
						<div class='modal-content'>
							
							<form method='POST' action='paymentPage1.php' role='form'>

							<div class='modal-header'>
								
								<h5 class='modal-title' style='color: green;'>Select User / HOA Account Number</h5>
								<button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>
							
							</div>
												
							<div class='modal-body'>
								
								<p>

									<select required name='payment_hoa_id' id='payment_hoa_id' class='form-control'>

										<option value='' selected disabled>Select User</option>

										<?php

											$result = pg_query("SELECT * FROM hoaid WHERE community_id=$community_id AND valid_until>='$today'");

											while($row = pg_fetch_assoc($result))
											{

												$hoa_id = $row['hoa_id'];
												$name = $row['firstname'];
												$name .= " ";
												$name .= $row['lastname'];

												echo "<option value='$hoa_id'>$name</option>";

											}

										?>

									</select>

								</p>
							
							</div>
							
							<div class='modal-footer'>
													
								<button class='btn btn-round btn-success btn-sm' type='submit'>Make Payment</button>
							
							</div>

							</form>
						
						</div>
					
					</div>
				
				</div>

				<!-- Counters -->
				<section class='module module-gray p-b-0'>

					<div class='container'>

						<br>

						<div class='row'>

							<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

								<center><h3 class='h3' style='color: green;'>Payment Information - <?php echo date('F').", ".date("Y"); ?></h3></center>

							</div>

						</div>

						<br>

						<div class='row'>

							<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>

										<div><?php echo $res_dir; ?> <sup>%</sup></div>

									</div>

									<div class='counter-title'>Payments Received</div>

								</div>

							</div>

							<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>

										<div><?php echo $email_homes; ?> <sup>%</sup></div>

									</div>

									<div class='counter-title'>Members Paid</div>

								</div>

							</div>

							<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>

										<div>

											<?php 

												$ach = pg_num_rows(pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=1")); 

												echo $ach;

											?>
																				
										</div>

									</div>

									<div class='counter-title'>ACH</div>

								</div>

							</div>

							<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>

										<div>

											<?php 

												$bill_pay = pg_num_rows(pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=2")); 

												echo $bill_pay;

											?>
																				
										</div>

									</div>

									<div class='counter-title'>Bill Pay</div>

								</div>

							</div>

							<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>

										<div>

											<?php 

												$check = pg_num_rows(pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=3")); 

												echo $check;

											?>
																				
										</div>

									</div>

									<div class='counter-title'>Check</div>

								</div>

							</div>

							<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>

										<div>

											<?php 

												echo ($total_homes - ( $ach + $bill_pay + $check ) );

											?>
																				
										</div>

									</div>

									<div class='counter-title'>Others</div>

								</div>

							</div>

						</div>

						<br>

					</div>

				</section>
				<!-- Counters end -->

				<!-- Row 1 -->
				<section class='module'>

					<div class='container'>

						<div class='row'>

							<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>

										<div><?php echo $res_dir; ?></div>

									</div>

									<div class='counter-title'>Resident Directory</div>

								</div>

							</div>

							<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>

										<div><?php echo ($total_homes - $tenants); ?></div>

									</div>

									<div class='counter-title'>Owners</div>

								</div>

							</div>

							<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>

										<div><?php echo $tenants; ?></div>

									</div>

									<div class='counter-title'>Tenants</div>

								</div>

							</div>

							<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>

										<div><?php echo $newly_moved_in; ?></div>

									</div>

									<div class='counter-title'>Newly moved in</div>

								</div>

							</div>

							<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>

										<div><?php echo $email_homes; ?></div>

									</div>

									<div class='counter-title'>Email Signup</div>

								</div>

							</div>

							<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>

										<div><?php $rows = pg_num_rows(pg_query("SELECT * FROM document_management WHERE community_id=$community_id")); echo $rows; ?></div>

									</div>

									<div class='counter-title'>Community Documents</div>

								</div>

							</div>

						</div>

						<br>

					</div>

				</section>

				<!-- Row 2 -->
				<section class='module module-gray'>

					<div class='container'>

						<div class='row'>

							<div id='get_involved' class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>
								
								<div class='icon-box'>

									<div class='icon-box-title text-center'><h3 style='color: green;'>Get Involved</h3></div>

									<hr class='small'>

									<div class='icon-box-content'>
										
										<p>Here is the 2016 Strategy for our Home Owners Association, so we are well connected as a community and keep our HOA dues low. In order to accomplish these goals over the next several quarters we need volunteers and member support from the entire community.</p>
              
                  						<ul>

                    						<li> <strong style='color: black;'>-</strong> CCR Updates – Declaration of <a href='http://stoneridgesquare.org/wp-content/uploads/2016/02/Stoneridge_square_CCR.pdf' target='_blank'>CCR</a> describes the rights and obligations of the membership of the association &amp; the association to the membership. Most communities update them after the builder has left and ours are 15 years old and we have hired Hughes Gill Cochrin to update ours. Changes to CCR will start in a few weeks now and expected to complete by end of the year or early 2017.</li>
                      
                    						<li> <strong style='color: black;'>-</strong> Survey Monkey – Respond to our quarterly survey here.</li>
                      
                    						<li> <strong style='color: black;'>-</strong> Updated Website – We are in the process of re-designing our website to achieve the following goals, allow login so we members can view past board meeting minutes, insurance info. Service Requests from now on will be visible to every member for common issues.</li>
                      
                    						<li> <strong style='color: black;'>-</strong> Email Opt In List – Yes we saved $32.29 / year for Printed statements <a target='_blank' href='http://stoneridgesquare.us12.list-manage.com/subscribe?u=12a11bf64aa26b44b5b667427&id=09692e90bd'>Sign Up to Receive Annual Disclosures &amp; Meeting notices via email here</a> we have 142 emails for 143 residents so far.</li>
                      
                    						<li> <strong style='color: black;'>-</strong> ACH – Its green, secure and 97 out of your neighbors pay. If you don’t share your Bank Routing # and Bank Account # with your friends and family why are your sharing with your HOA by paying via Bill Pay / Check?</li>
                      
                    						<li> <strong style='color: black;'>-</strong> Spring and Summer Party & Fall Party – Join our summer party next Sunday by our swimming pool at 12:30 PM for Pizza, BBQ & Soft Drinks on Sept 18th.</li>

                    						<li> <strong style='color: black;'>-</strong> News Letters – <a href='https://stoneridgesquare.org/disclosures/' target='_blank'>our past updates are posed here</a>.</li>

                    						<li> <strong style='color: black;'>-</strong> Welcome New Neighbors – Create a list of Vital tel nos. and services for new neighbors and send them an email and invite them to signup to our Website and future Mobile App.</li>

                    						<li> <strong style='color: black;'>-</strong> Metrics – Create a list of metrics on how the Board of Directors should operate and provide valuable information to prospective buyers.</li>

                  						</ul>

									</div>

									<div class='icon-box-link text-center'><a target='_blank' href='https://www.dropbox.com/s/f8b0ie27loi057t/2017_Annual_Budget.pdf?dl=0'>Here is the 2017 Approved Budget</a></div>

									<br><br><br><br><br>

									<div class='icon-box-title text-center'><h3 style='color: green;'>Make A Payment</h3></div>

									<hr class='small'>

									<div class='icon-box-content'>
										
										<p>Click <strong>Pay Now</strong> to enter your payment details with the Payment gateway directly to make a One time Payment.</p>

									</div>

									<div class='icon-box-link text-center'><a target='_blank' href='https://hoaboardtime.com/paymentPage1.php'>Pay Now</a></div>

									<br><br><br><br><br>

									<div class='icon-box-title text-center'><h3 style='color: green;'>Pool Signin</h3></div>

									<hr class='small'>

									<div class='icon-box-content'>
										
										<p>Click <strong>Sign Now</strong> to sign the Stoneridge Square Association Swimming Pool rules acknowledgement and key fob registration form.</p>

									</div>

									<div class='icon-box-link text-center'><a target='_blank' href='https://secure.na1.echosign.com/public/esignWidget?wid=CBFCIBAA3AAABLblqZhAt2FV611bZ0ufERNZzJ2mVo33iDdvuobFchD-30n8lj2fsppHb6ZN9IAQXBVKKsmk*'>Sign Now</a></div>

									<br><br><br><br><br>

									<div class='icon-box-title text-center'><h3 style='color: green;'>Resale &amp; Docs</h3></div>

									<hr class='small'>

									<div class='icon-box-content'>
										
										<ul>
              
                    						<li>
                      
                      							<strong style='color: black;'>-</strong> <a href='https://www.dropbox.com/s/k4q6okz2nqe5szs/SRSQ_2017_Draft_Reserve_Study_2017.pdf?dl=0' target='_blank'>Draft Reserve Study</a>

                    						</li>

                    						<li>

                      							<strong style='color: black;'>-</strong> <a href='https://www.dropbox.com/s/jpw5mn87lzjf9zr/SRSQ_CC%26Rs_First_Draft_12-22-16.pdf?dl=0' target='_blank'>Proposed CCR</a>

                    						</li>

                    						<li>
                    
                      							<strong style='color: black;'>-</strong> <a href='https://www.dropbox.com/s/oippjvpuazmi67t/SRSQ_Bylaws_First_Draft_2-12-22-16.pdf?dl=0' target='_blank'>Upcoming Governing Docs</a>

                    						</li>

                    						<li>

                      							<strong style='color: black;'>-</strong> <a href='https://www.dropbox.com/s/t2lm7rn0cot4acy/2017_Annual_Budget.pdf?dl=0' target='_blank'>2017 Annual Budget</a>

                    						</li>

                    						<li>
                    
                      							<strong style='color: black;'>-</strong> <a href='https://www.dropbox.com/s/o7hrs8lanf4us0k/SRSQ_Voting%20%26%20Election%20Rules%2011-21-16.pdf?dl=0' target='_blank'>Current Election and Voting Rules</a>

                    						</li>

                    						<li>
                    
                      							<strong style='color: black;'>-</strong> <a href='https://www.dropbox.com/s/zs9er1e7ai78lbu/Articles%20of%20Inc.pdf?dl=0' target='_blank'>Articles of Incorporation</a>

                    						</li>

                    						<li>
                    
                      							<strong style='color: black;'>-</strong> <a href='https://www.dropbox.com/s/v5z15b028l26dlg/SRSQ_Enforcement%20Policy.pdf?dl=0' target='_blank'>Enforcement Policy</a>

                    						</li>

                    						<li>
                    
                      							<strong style='color: black;'>-</strong> <a href='https://www.dropbox.com/s/0u0uyq762vnnvr1/SRSQ_Farmers_5300_Disclosure.pdf?dl=0' target='_blank'>Insurance</a>

                    						</li>

                  						</ul>

									</div>

									<br><br><br><br><br>

									<div class='icon-box-title text-center'><h3 style='color: green;'>Contact</h3></div>

									<hr class='small'>

									<div class='icon-box-content'>
										
										<center><h4 class='h4'>PO Box 5272, Pleasanton, CA 94566</h4></center>

										<br>

										<center><h5 class='h5'><a href='https://www.stoneridgesquare.org/' target='_blank'>www.stoneridgesquare.org</a></h5></center>

									</div>

								</div>

							</div>

							<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>
								
								<div class='icon-box'>

									<div class='icon-box-title text-center'><h3 style='color: green;'>Community Info</h3></div>

									<hr class='small'>

									<div class='icon-box-content'>
										
										<table class="table table-striped table-bordered">
                    
                    						<thead>
                      
                      							<th>Type</th>
                      							<th>Information</th>

                    						</thead>

                    						<tbody>
                      
                    							<?php

                      								$result = pg_query("SELECT * FROM community_legal_table WHERE community_id=2");

                      								while ($row = pg_fetch_assoc($result)) {

                        								$type = $row['item_type'];
                        								$legal_info = $row['legal_info'];

                        								echo "<tr><td>$type</td><td>$legal_info</td></tr>";

                      								}

                    							?>

                    						</tbody>

                  						</table>

									</div>

								</div>

							</div>

						</div>

					</div>

				</section>

				<section class='module module-green'>
					
					<div class='container'>

						<div class='row'>

							<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6'>

								<aside class='widget widget_text'>
									
									<div class='textwidget'>
										
										<p><h3>Stoneridge Square Association</h3></p>

									</div>

								</aside>

							</div>

							<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6'>
								
								<aside class='widget widget_tag_cloud'>

									<div class='textwidget'>
										
										PO BOX 5272, Pleasanton, CA 94566<br />
										E-mail: <a href='mailto:billing@stoneridgesquare.org'>billing@stoneridgesquare.org</a> <br/>
										Phone: 925 399 6642

									</div>

								</aside>

							</div>

						</div>

					</div>

					<div class='footer-copyright'>

						<div class='container'>

							<div class='row'>

								<div class='col-md-12'>

									<div class='text-center'>

										<span class='copyright'>Copyright © <?php echo date('Y'); ?> - <a target='_blank' href='https://www.stoneridgesquare.org/'>Stoneridge Square Association</a> - All Rights Reserved.</span>

									</div>

								</div>

							</div>

						</div>

					</div>

				</section>

				<!-- Footer-->
				<footer id='contact' class='footer' style="background: green;">

					<div class='container'>

						<div class='row'>

							<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6'>

								<aside class='widget widget_text'>
									
									<div class='textwidget'>
										
										<p><h3>Stoneridge Square Association</h3></p>

									</div>

								</aside>

							</div>

							<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6'>
								
								<aside class='widget widget_tag_cloud'>

									<div class='textwidget'>
										
										PO BOX 5272, Pleasanton, CA 94566<br />
										E-mail: <a href='mailto:billing@stoneridgesquare.org'>billing@stoneridgesquare.org</a> <br/>
										Phone: 925 399 6642

									</div>

								</aside>

							</div>

						</div>

					</div>

					<div class='footer-copyright'>

						<div class='container'>

							<div class='row'>

								<div class='col-md-12'>

									<div class='text-center'>

										<span class='copyright'>Copyright © <?php echo date('Y'); ?> - <a target='_blank' href='https://www.stoneridgesquare.org/'>Stoneridge Square Association</a> - All Rights Reserved.</span>

									</div>

								</div>

							</div>

						</div>

					</div>

				</footer>

				<a class='scroll-top' href='#top'><i class='fa fa-angle-up'></i></a>

			</div>
			<!-- Wrapper end-->

		</div>
		<!-- Layout end-->

		<!-- Scripts-->
		<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js'></script>
		<script src='assets/bootstrap/js/bootstrap.min.js'></script>
		<script src='assets/js/plugins.min.js'></script>
		<script src='assets/js/custom.min.js'></script>

	</body>

</html>