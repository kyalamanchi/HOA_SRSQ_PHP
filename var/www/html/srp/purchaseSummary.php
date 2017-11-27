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
								
								<h1 class="h5">Purchase Summary</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container-fluid">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<table class="table table-striped" id="example1" style="color: black;">
  
  								<thead>
        
							        <th>Date</th>
							        <th>Payment Type</th>
							        <th>Reference Number</th>
							        <th>Payee</th>
							        <th>Category</th>
							        <th>Total</th>
							        <th>ATTACHMENT</th>

    							</thead>

    							<tbody>
            						
            						<?php
            
            							setlocale(LC_MONETARY, 'en_US');

            							date_default_timezone_set('America/Los_Angeles');
            							$ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/query');
            							curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'POST');
            							curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json','Content-Type:application/text','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1509541160",oauth_nonce="4u2GbsqN86U",oauth_version="1.0",oauth_signature="OOpV7UMNAkRACPJjJ2SU%2FzidANE%3D"'));
            							curl_setopt($ch, CURLOPT_POSTFIELDS, "select * from purchase MAXRESULTS 1000");
            							curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            
            							$result = curl_exec($ch);
            							$result =  json_decode($result);
            							
            							if ( isset($_GET['id']) ){
            
            								foreach ($result->QueryResponse->Purchase as $purchase) {
                
                								$name = "";
                	
                								foreach ($purchase->Line as $accountData) {
                    
                    								if ( $name != "" )
                    									$name = $name."<br>".$accountData->AccountBasedExpenseLineDetail->AccountRef->name;
                    								else 
                    								{
                        								
                        								$name = $accountData->AccountBasedExpenseLineDetail->AccountRef->name;

                    								}
                								}

                								if ( $purchase->EntityRef->name == $_GET['id'] ) {
                
                									echo '<tr><td>'.date('Y-m-d',strtotime($purchase->MetaData->CreateTime)).'</td><td>'.$Purchase->PaymentType.'</td><td>'.$purchase->DocNumber.'</td><td>'.$purchase->EntityRef->name.'</td><td>'.$name.'</td><td><a onClick="a(this);" style="cursor: pointer; cursor: hand;" id="'.$purchase->Id.'">'.money_format('%#10n',  $purchase->TotalAmt).'</a></td><td>';
                        
                        							$query = "SELECT *  FROM qb_purchase_attchments WHERE COMMUNITY_ID = 2 AND purchase_id=".$purchase->Id;
                        							$queryResult = pg_query($query);
                        							$name = "";
                        							$count  =0;
                        
                        							while ($row = pg_fetch_assoc($queryResult)) {
                            							
                            							$count  = $count + 1;
                            							$name =  $row['attachment_name'];
                        
                        							}
                        
                        							if ( $name == "" ){
                            							
                            							echo "No attachment(s) found.";
                        
                        							}
                        
                        							else if ( $count > 1) {
                             
                             							echo '<a onClick="a(this);" style="cursor: pointer; cursor: hand;" id="'.$purchase->Id.'">'.$count." attachments found".'</a>';
                        
                        							}
                        
                        							else {
                            
                            							echo '<a onClick="a(this);" style="cursor: pointer; cursor: hand;" id="'.$purchase->Id.'">'.$count." attachment found".'</a>';
                        
                        							}
                
                									echo '</td>';
                									echo '</tr>';
                								
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
		<script src='http://maps.googleapis.com/maps/api/js?key=AIzaSyA0rANX07hh6ASNKdBr4mZH0KZSqbHYc3Q'></script>
		<script src='assets/js/plugins.min.js'></script>
		<script src='assets/js/custom.min.js'></script>
		<!-- Datatable -->
		<script src='//code.jquery.com/jquery-1.12.4.js'></script>
		<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>

		<script>
      	
	      	$(function () {
	        	
	        	$("#example1").DataTable({ "paging":   false, "pageLength": 500, "info":     false });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>