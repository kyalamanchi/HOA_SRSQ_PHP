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
								
								<h1 class="h5">Community Assets</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container-fluid">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<div class='panel-group' id='accordion'>
										
								<?php

									$result = pg_query("SELECT asset_category_id, count(*), sum(ideal_balance) AS ib, sum(current_balance) AS cb FROM community_assets WHERE community_id=$community_id GROUP BY asset_category_id");

									while($row = pg_fetch_assoc($result))
									{

										$category_id = $row['asset_category_id'];
	                            		$count = $row['count'];
	                            		$ib = $row['ib'];
	                            		$cb = $row['cb'];
			
	                            		$row1 = pg_fetch_assoc(pg_query("SELECT * FROM asset_category WHERE id=$category_id"));
	                            		$asset_category = $row1['name'];

										echo "

										<div class='card'>
													
											<div class='card-header'>

												<a data-toggle='collapse' data-parent='#accordion' href='#collapse_$category_id' aria-expanded='false'>

													<div class='row'>

													<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'><strong>$asset_category</strong> - $count</div>
	                                        		<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'><strong>Ideal Balance</strong> - $$ib</div>
	                                        		<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'><strong>Current Balance</strong> - $$cb</div>

	                                        		</div>

												</a>

											</div>
												
											<div class='collapse' id='collapse_$category_id'>
														
												<div class='card-block'>
															
													<table class='table table-responsive' style='color: black;'>

														<thead>

															<th>Sub Category</th>
	                                        				<th>UL</th>
	                                        				<th>Reusable L</th>
	                                        				<th>Minimum Unit Cost</th>
	                                        				<th>Average Unit Cost</th>
	                                        				<th>Maximum Unit Cost</th>
	                                        				<th>Asset Placement Date</th>
	                                        				<th>Ideal Balance</th>
	                                        				<th>Current Balance</th>
	                                        				<th>Monthly Contribution</th>
	                                        				<th>Quantity</th>
	                                        				<th>Repair Type</th>
	                                        				<th>Units Of Measure</th>

														</thead>

														<tbody>";

															$res1 = pg_query("SELECT * FROM community_assets WHERE community_id=$community_id AND asset_category_id=$category_id");

															while ($row1 = pg_fetch_assoc($res1)) 
	                                        				{

	                                          					$asset_sub_category = $row1['asset_subcategory_id'];
	                                          					$asset_component = $row1['asset_component_id'];
	                                          					$ul = $row1['ul'];
	                                          					$rul = $row1['rul'];
	                                          					$avg_unit_cost = $row1['avg_unit_cost'];
	                                          					$asset_placement_date = $row1['asset_placement_date'];
	                                          					$ideal_balance = $row1['ideal_balance'];
	                                          					$current_balance = $row1['current_balance'];
	                                          					$monthly_contributions = $row1['monthly_contributions'];
	                                          					$quantity = $row1['quantity'];
	                                          					$community_repair_type = $row1['community_repair_type_id'];
	                                          					$community_uom = $row1['community_uom_id'];
	                                          					$min_unit_cost = $row1['min_unit_cost'];
	                                          					$max_unit_cost = $row1['max_unit_cost'];

	                                          					if($asset_sub_category != "")
	                                          					{

	                                            					$row2 = pg_fetch_assoc(pg_query("SELECT * FROM asset_subcategory WHERE id=$asset_sub_category"));
	                                            					$asset_sub_category = $row2['name'];
	                                            
	                                          					}

	                                          					if($community_repair_type != "")
	                                          					{

	                                            					$row2 = pg_fetch_assoc(pg_query("SELECT * FROM community_repair_type WHERE id=$community_repair_type"));
	                                            					$community_repair_type = $row2['name'];
	                                            
	                                          					}

	                                          					if($community_uom != "")
	                                          					{

	                                            					$row2 = pg_fetch_assoc(pg_query("SELECT * FROM community_uom WHERE id=$community_uom"));
	                                            					$community_uom = $row2['name'];
	                                            
	                                          					}

	                                          					if($asset_placement_date != "")
	                                            					$asset_placement_date = date('m-d-Y', strtotime($asset_placement_date));

	                                            				if($min_unit_cost != "")
	                                            					$min_unit_cost = "$ ".$min_unit_cost;

	                                            				if($max_unit_cost != "")
	                                            					$max_unit_cost = "$ ".$max_unit_cost;

	                                          					echo "<tr><td>$asset_sub_category</td><td>$ul</td><td>$rul</td><td>$min_unit_cost</td><td>$ $avg_unit_cost</td><td>$max_unit_cost</td><td>$asset_placement_date</td><td>$ $ideal_balance</td><td>$ $current_balance</td><td>$ $monthly_contributions</td><td>$quantity</td><td>$community_repair_type</td><td>$community_uom</td></tr>";

	                                        				}

														echo "

														</tbody>

													</table>
														
												</div>
													
											</div>
												
										</div>

										";

									}

								?>
									
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
	        	
	        	$("#example1").DataTable({ "pageLength": 50, "order": [[ 1, "asc"]] });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>