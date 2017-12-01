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

			if($mode == 2)
			{
				
				$home_id = $_SESSION['hoa_home_id'];
				$hoa_id = $_SESSION['hoa_hoa_id'];

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
								
								<h1 class="h5"><?php if($mode == 1) echo "Community "; ?>Signed Agreements</h1>
							
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
											
									<?php if($mode == 1) echo "<th>Agreement To</th>"; ?>
			                        <th>Email</th>
			                        <th>Agreement Name</th>
			                        <th>Create Date</th>
			                        <th>Send Date</th>
			                        <th>Last Updated</th>

								</thead>

								<tbody>
											
									<?php 

										if($mode == 1)
										{
											$result = pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='SIGNED'");

			                        		while($row = pg_fetch_assoc($result))
			                        		{

			                          			$id = $row['id'];
			                          			$document_to = $row['document_to'];
			                          			$create_date = $row['create_date'];
			                          			$send_date = $row['send_date'];
			                          			$agreement_name = $row['agreement_name'];
			                          			$last_updated = $row['last_updated'];
			                          			$agreement_id = $row['agreement_id'];
			                          			$hoa_id = $row['hoa_id'];

			                          			if($create_date != "")
			                            			$create_date = date('m-d-Y', strtotime($create_date));

			                          			if($send_date != "")
			                            			$send_date = date('m-d-Y', strtotime($send_date));

			                          			if($last_updated != "")
			                            			$last_updated = date('m-d-Y', strtotime($last_updated));

			                          			if($document_to != "")
			                          			{  

			                            			echo "<tr>";
			                              
			                            			$result1 = pg_query("SELECT * FROM hoaid WHERE email='".$document_to."' OR ");

			                            			if(pg_num_rows($result1))
						                            {

						                              	$row1 = pg_fetch_assoc($result1);
						                                
						                              	$name = $row1['firstname'];
						                              	$name .= " ";
						                              	$name .= $row1['lastname'];
						                              	$hoa_id = $row1['hoa_id'];

						                              	echo "<td>".$name."<br>($hoa_id)</td>";

						                            }
						                            else if($hoa_id != "")
						                            {

						                              	$result1 = pg_query("SELECT * FROM hoaid WHERE hoa_id='".$hoa_id."'");

						                              	$row1 = pg_fetch_assoc($result1);
						                                
						                              	$name = $row1['firstname'];
						                              	$name .= " ";
						                              	$name .= $row1['lastname'];

						                              	echo "<td>".$name."<br>($hoa_id)</td>";
						                            }
						                            else
						                            {
						                              
						                              	$result1 = pg_query("SELECT * FROM vendor_master WHERE email='".$document_to."'");

						                              	if(pg_num_rows($result1))
						                              	{  

						                                	$row1 = pg_fetch_assoc($result1);

						                                	echo "<td>".$row1['vendor_name']."</td>";
				
						                              	}
						                              	else
						                              	{  

							                                echo "

							                                <div class='modal fade hmodal-success' id='addHOAId_".$id."' role='dialog'  aria-hidden='true'>
							                                
							                                  <div class='modal-dialog'>
							                                                      
							                                    <div class='modal-content'>
							                                          
							                                      <div class='modal-header'>
							                                                                  
							                                        <h4 class='modal-title'>Agreement sent to <strong>".$document_to."</strong></h4>

							                                      </div>

							                                      <div class='modal-body'>
							                                                                  
							                                        <div class='container-fluid'>

							                                          <form class='row' method='post' action='https://hoaboardtime.com/addAgreementHOAID.php'>

							                                            <div class='row container-fluid'>

							                                              <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
							                                              
							                                                <center>Select User</center>

							                                                <br>

							                                                <select class='form-control' name='select_hoa' id='select_hoa' style='width: 100%;' >

							                                                  <option value='' disabled selected>Select User</option>";

							                                                  $result000 = pg_query("SELECT * FROM hoaid WHERE community_id=$community_id ORDER BY firstname");

							                                                  while($row000 = pg_fetch_assoc($result000))
							                                                  {

							                                                    $add_hoa_id = $row000['hoa_id'];
							                                                    $name = $row000['firstname'];
							                                                    $name .= " ";
							                                                    $name .= $row000['lastname'];

							                                                    echo "<option value='".$add_hoa_id."'>".$name."</option>";
							                                                  }

							                                                echo "</select>

							                                                <input type='hidden' name='document_to' id='document_to' value='".$document_to."'>
							                                                <input type='hidden' name='id' id='id' value='".$id."'>

							                                                <br><br><center>OR</center><br><br>

							                                                <center>Select Vendor</center>

							                                                <br>
							                                                
							                                                <select class='form-control' name='select_vendor' id='select_vendor' style='width: 100%;' >

							                                                  <option value='' disabled selected>Select Vendor</option>";

							                                                  $result000 = pg_query("SELECT * FROM vendor_master WHERE community_id=$community_id ORDER BY vendor_name");

							                                                  while($row000 = pg_fetch_assoc($result000))
							                                                  {

							                                                    $add_vendor_id = $row000['vendor_id'];
							                                                    $vendor_name = $row000['vendor_name'];

							                                                    echo "<option value='".$add_vendor_id."'>".$vendor_name."</option>";
							                                                  }

							                                                echo "</select>

							                                                <br><br>

							                                                <center><input type='checkbox' name='board_document' id='board_document' value='Yes'> <label> Is board document?</label></center>

							                                                <input type='hidden' name='flag' id='flag' value='1'>

							                                              </div>

							                                            </div>

							                                            <br>

							                                            <div class='row container-fluid text-center'>
							                                              
							                                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>
							                                              	
							                                              	<button type='submit' name='submit' id='submit' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Update</button>

							                                              </div>

							                                              <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>
							                                              
							                                              	<button type='button' class='btn btn-warning btn-xs' data-dismiss='modal'><i class='fa fa-close'></i> Cancel</button>

							                                              </div>

							                                            </div>

							                                          </form>
							                                                                  
							                                        </div>

							                                      </div>

							                                    </div>
							                                    
							                                  </div>

							                                </div>

							                                ";

							                                echo "<td><a data-toggle='modal' style='color: blue;' data-target='#addHOAId_$id'>N/A</a></td>";

						                              	}
						                              
						                            }

			                            			echo "<td>$document_to</td><td><a target='_blank' href='esignPreview.php?id=$agreement_id'>$agreement_name</a></td><td>$create_date</td><td>$send_date</td><td>$last_updated</td></tr>";

			                          			}

			                        		}
		                        		}
		                        		else if($mode == 2)
		                        		{

		                        			$result = pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='SIGNED' AND document_to IN (SELECT email FROM person WHERE hoa_id=$hoa_id AND home_id=$home_id)");

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

			                            		echo "<tr><td>$document_to</td><td><a target='_blank' href='esignPreview.php?id=$agreement_id'>$agreement_name</a></td><td>$create_date</td><td>$send_date</td><td>$last_updated</td></tr>";

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
	        	
	        	$("#example1").DataTable({ "pageLength": 50 });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>