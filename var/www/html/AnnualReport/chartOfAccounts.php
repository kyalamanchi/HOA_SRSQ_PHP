<?php
	
	session_start();

include 'includes/dbconn.php';
	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header('Location: logout.php');

	$email = $_SESSION['hoa_alchemy_email'];
	$hoa_id = $_SESSION['hoa_alchemy_hoa_id'];
	$home_id = $_SESSION['hoa_alchemy_home_id'];
	$user_id = $_SESSION['hoa_alchemy_user_id'];
	$username = $_SESSION['hoa_alchemy_username'];
	$community_id = $_SESSION['hoa_alchemy_community_id'];
	$community_code = $_SESSION['hoa_alchemy_community_code'];
	$community_name = $_SESSION['hoa_alchemy_community_name'];

?>

<!DOCTYPE html>

<html lang='en'>

	<head>

		<?php

include 'includes/dbconn.php';
			$today = date('Y-m-d');

		?>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>

		<title><?php echo $community_code; ?> - Annual Report</title>

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

		<style type="text/css">
			
			body {
  				background: #ecf0f1;
			}

			.loader {
  				width: 50px;
  				height: 30px;
  				position: absolute;
  				left: 50%;
  				top: 50%;
  				transform: translate(-50%, -50%);
			}
			.loader:after {
  				position: absolute;
  				content: "Loading";
  				bottom: -40px;
  				left: -2px;
  				text-transform: uppercase;
  				font-family: "Arial";
  				font-weight: bold;
  				font-size: 12px;
			}

			.loader > .line {
  				background-color: #333;
  				width: 6px;
  				height: 100%;
  				text-align: center;
  				display: inline-block;
  
  				animation: stretch 1.2s infinite ease-in-out;
			}

			.line.one {
			  	background-color: #2ecc71; 
			}

			.line.two {
			  	animation-delay:  -1.1s;
			  	background-color:#3498db;
			}
			.line.three {
			  	animation-delay:  -1.0s;
			  	background-color:#9b59b6;
			}
			.line.four {
			  	animation-delay:  -0.9s;
			   	background-color: #e67e22;
			}
			.line.five {
			  	animation-delay:  -0.8s;
			  	background-color: #e74c3c;
			}

			@keyframes stretch {
			  	0%, 40%, 100% { transform: scaleY(0.4); }
			  	20% {transform: scaleY(1.0);}
			}

		</style>

		<div class="loader">
  			
  			<div class="line one"></div>
  			<div class="line two"></div>
  			<div class="line three"></div>
  			<div class="line four"></div>
  			<div class="line five"></div>
		
		</div>

		<div class='layout'>

			<div class="wrapper">

				<!-- Page Header -->
				<section class="module-page-title p-t-0">
					
					<div class="container">
							
						<div class="row-page-title">
							
							<div class="page-title-captions">
								
								<br><h1 class="h5">Chart Of Accounts</h1>
							
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