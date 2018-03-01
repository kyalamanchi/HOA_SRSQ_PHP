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
								
								<br><h1 class="h5">Purchase Summary Details</h1>
							
							</div>

							<div class="page-title-secondary">
								
								<ol class="breadcrumb">
									
									<li><a href='purchaseSummary.php'><i class='fa fa-arrow-left'></i> Purchase Summary</a></li>

								</ol>

							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container">
							
						<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<?php

                				setlocale(LC_MONETARY, 'en_US');
                				date_default_timezone_set('America/Los_Angeles');
               					
               					$purchaseID = $_GET['id'];
            					
            					$ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/query');
            					
            					curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'POST');
            					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json','Content-Type:application/text','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1509571171",oauth_nonce="XXAaTNNoZOx",oauth_version="1.0",oauth_signature="YqQesEYb0Fo%2FmAlv81W3UpT43bs%3D"'));
            					curl_setopt($ch, CURLOPT_POSTFIELDS, "select * from purchase where id = '".$purchaseID."'");
            					curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            
            					$result = curl_exec($ch);
            					$purchaseResult  = json_decode($result);
            					$purchaseResult  = $purchaseResult->QueryResponse->Purchase;
            					$final = $purchaseResult[0];
            
            				?>

            				<div class='row'>

            					<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

            						<label><strong><?php echo $purchaseResult[0]->EntityRef->type; ?></strong></label>
            						
            						<br>

        							<h4><?php echo $purchaseResult[0]->EntityRef->name; ?></h4>

            					</div>

            					<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

            						<label><strong>Account</strong></label>
            						
            						<br>

        							<h4><?php echo $purchaseResult[0]->AccountRef->name; ?></h4>

            					</div>

            					<div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-right'>

            						<label><strong>Amount</strong></label>
            						
            						<br>

        							<h2><?php echo money_format('%#10n',$purchaseResult[0]->TotalAmt); ?></h2>

            					</div>

            				</div>
							
							<br><br>

            				<div class='row'>

            					<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

            						<label><strong>Payment Date</strong></label>
            						
            						<br>

        							<h4><?php echo date('d F Y',strtotime($purchaseResult[0]->MetaData->CreateTime)); ?></h4>

            					</div>

            					<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

            						<label><strong>Payment Type</strong></label>
            						
            						<br>

        							<h4><?php echo $purchaseResult[0]->PaymentType; ?></h4>

            					</div>

            					<div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-right'>

            						<label><strong>Reference Number</strong></label>
            						
            						<br>

        							<h4>

	        							<?php

	        								if( $purchaseResult[0]->DocNumber )
	                							echo $purchaseResult[0]->DocNumber;
	            							else
	                							echo "<center>-</center>";

	        							?>

        							</h4>

            					</div>

            				</div>

            				<br><br>

            				<div class='row'>

            					<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive'>

	            					<table id='example1' class='table table-striped' style='color: black;'>

	            						<thead>
	            							
	            							<th>#</th>
	            							<th>Account</th>
	            							<th>Description</th>
	            							<th>Amount</th>

	            						</thead>

	            						<tbody>
	            							
	            							<?php

								                $value = 1;
								                $IDS = array();
								                
								                foreach ($purchaseResult[0]->Line as $purchase) 
								                {
								                    
								                    echo '<tr><td>'.$value.'</td><td>'.$purchase->AccountBasedExpenseLineDetail->AccountRef->name.'</td><td>'.$purchase->Description.'</td><td><style="float:right;">'.money_format('%#10n',$purchase->Amount).'</></td></tr>';

								                    $value = $value + 1;

								                }
	            
	            							?>

	            						</tbody>
	            						
	            					</table>

            					</div>

            				</div>

            				<br><br>

            				<div class='row'>

            					<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

            						<label><strong>Memo</strong></label>

            						<br>

            						<textarea class="form-control" rows="3" id="comment" style="width: 400px;" readonly="readonly"><?php print_r($final->PrivateNote); ?></textarea>

            					</div>

            					<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

            						<label><strong>Attachment(s)</strong></label>

            						<br>

            						<?php

            							$ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/query');

            							curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'POST');
            							curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json','Content-Type:application/text','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1509569266",oauth_nonce="8N0tvCVCsWK",oauth_version="1.0",oauth_signature="ZoQHffDGFCgQUgP8R5Owiix6pec%3D"'));
            							curl_setopt($ch, CURLOPT_POSTFIELDS, "Select * from Attachable where AttachableRef.EntityRef.Type = 'purchase' AND AttachableRef.EntityRef.value = '".$purchaseID."'");
            							curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

            							$result = curl_exec($ch);
            							$result  = json_decode($result);
            							$data = $result->QueryResponse;
            
            							if ( isset( $data->Attachable ) )
            							{
                
                							foreach ($data->Attachable as $attachable)
                								echo '<a target="_blank" href="'.$attachable->TempDownloadUri.'">'.$attachable->FileName.'</a><br>';

            							}
            							else
            								echo "No attachments found";

        							?>

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
	        	
	        	$("#example1").DataTable({ "pageLength": 25 });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>