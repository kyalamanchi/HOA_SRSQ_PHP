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
								
								<h1 class="h5">Chart Of Accounts</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<table id='example1' class='table table-striped' style="color: black;">
										
								<thead>
											
									<th>Number</th>
									<th>Name</th>
									<th>Type</th>
									<th>Detail Type</th>
									<th>Balance from Quickbooks</th>

								</thead>

								<tbody>
											
									<?php
            
            							if($community_id == 1)
            							{
            								
            								$ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145854171542/query');
            							
	            							curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'POST');
	            							curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json','Content-Type:application/text','Authorization:OAuth oauth_consumer_key="qyprd0JzDPeMNuATqXcic8hnusenW2",oauth_token="qyprdxuMeT1noFaS5g6aywjSOkFQo16WnvwigzPbxQ01LPYF",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1509536409",oauth_nonce="pDUH6TDf43O",oauth_version="1.0",oauth_signature="1x2ytAtexvMe5VKjTgrGAMCMzbA%3D"'));
	            							curl_setopt($ch, CURLOPT_POSTFIELDS, "Select * from Account");
	            							curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	            
	            							$result = curl_exec($ch);
	            							$result  = json_decode($result);

	            							foreach ($result->QueryResponse->Account as $account) 
	            							{
	                
	                							if ( $account->AcctNum )
	                							{
	                    
	                    							if($account->CurrentBalanceWithSubAccounts){echo "<tr><td>".$account->AcctNum."</td><td>".$account->AcctNum." ".$account->Name."</td><td>".$account->AccountType."</td><td>";
	                            					
	                            					$pieces = preg_split('/(?=[A-Z])/',$account->AccountSubType);
	                            					echo implode("  ", $pieces);
	                        						
	                        						echo "</td><td>";
	                            					setlocale(LC_MONETARY, 'en_US');
	                            					echo money_format('%#10n', $account->CurrentBalanceWithSubAccounts);
	                        						echo "</td></tr>";}
	                							}
	                							else 
	                							{
	                    
	                    							if($account->CurrentBalanceWithSubAccounts)
	                    							{

	                    								echo "<tr><td></td><td>".$account->Name."</td><td>".$account->AccountType."</td><td>";
	                             
		                             					$pieces = preg_split('/(?=[A-Z])/',$account->AccountSubType);
		                            					echo implode("  ", $pieces);
		                        
		                        						echo "</td><td>";
		                            					setlocale(LC_MONETARY, 'en_US');
		                                				echo money_format('%#10n', $account->CurrentBalanceWithSubAccounts);
		                              
		                        						echo "</td></tr>";

	                        						}

	                 							}

	            							}

            							}
            							else if($community_id == 2)
            							{
            								
            								$ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/query');
            							
	            							curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'POST');
	            							curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json','Content-Type:application/text','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1509390608",oauth_nonce="16yXTFEfw1H",oauth_version="1.0",oauth_signature="P%2Byoz1KCN%2FzgSMB%2B5KM7Z1PY1cM%3D"'));
	            							curl_setopt($ch, CURLOPT_POSTFIELDS, "Select * from Account");
	            							curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	            
	            							$result = curl_exec($ch);
	            							$result  = json_decode($result);

	            							foreach ($result->QueryResponse->Account as $account) 
	            							{
	                
	                							if ( $account->AcctNum )
	                							{
	                    
	                    							if($account->CurrentBalanceWithSubAccounts){echo "<tr><td>".$account->AcctNum."</td><td>".$account->AcctNum." ".$account->Name."</td><td>".$account->AccountType."</td><td>";
	                            					
	                            					$pieces = preg_split('/(?=[A-Z])/',$account->AccountSubType);
	                            					echo implode("  ", $pieces);
	                        						
	                        						echo "</td><td>";
	                            					setlocale(LC_MONETARY, 'en_US');
	                            					echo money_format('%#10n', $account->CurrentBalanceWithSubAccounts);
	                        						echo "</td></tr>";}
	                							}
	                							else 
	                							{
	                    
	                    							if($account->CurrentBalanceWithSubAccounts)
	                    							{
	                    								echo "<tr><td></td><td>".$account->Name."</td><td>".$account->AccountType."</td><td>";
	                             
		                             					$pieces = preg_split('/(?=[A-Z])/',$account->AccountSubType);
		                            					echo implode("  ", $pieces);
		                        
		                        						echo "</td><td>";
		                            					setlocale(LC_MONETARY, 'en_US');
		                                				echo money_format('%#10n', $account->CurrentBalanceWithSubAccounts);
		                              
		                        						echo "</td></tr>";

	                        						}

	                 							}

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