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
								
								<h1 class="h5">Purchase Summary Details</h1>
							
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