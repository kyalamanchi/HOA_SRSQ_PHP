<?php
	
	ini_set("session.save_path","/var/www/html/session/");
	
	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	if(!$_SESSION['hoa_username'])
		header("Location: logout.php");

	$mode = $_SESSION['hoa_mode'];

?>

<!DOCTYPE html>

<html lang='en'>

	<head>

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

	</head>

	<body>

		<div class='layout'>

			<!-- Header-->
			<?php if($mode == 1) include "boardHeader.php"; else include 'residentHeader.php'; ?>

			<div class="wrapper">

				<!-- Page Header -->
				<section class="module-page-title">
					
					<div class="container">
							
						<div class="row-page-title">
							
							<div class="page-title-captions">
								
								<h1 class="h5">Document Preview</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<?php
	
								if($_GET['cid'] == 1)
								{
									
									$accessToken = '0gTJRfMcSHAAAAAAAAAADNfolm5IYvkINbXQpejgF8X2Hoy_6kXOlJemzq1a-588';

								}
								else if($_GET['cid'] == 2)
								{
									
									$accessToken = 'QwUjEm5GAkAAAAAAAAAAN-KemUHI72QOlDsQxtH6H9JlRixSoi1fqq7D7BCHrNFm';

								}

								$path = $_GET['path'];
								$description = $_GET['desc'];
								$doc_id = $_GET['doc_id'];

								$url = 'https://content.dropboxapi.com/2/files/download';
								$ch = curl_init($url);
								
								curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
								curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$accessToken,'Dropbox-API-Arg: {"path": "'.$path.'"}'));
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
								
								$response = curl_exec($ch);

								if (strpos( json_decode($response), 'error_summary') !== false) 
								{
							    	
							    	echo '<br><br><br><br><br><center><h3>There was an error opening this document. This file cannot be found.</h3></center>';

								}
								else if (strpos( ($response), 'pdf') !== false  )
								{

									header('Content-type: application/pdf'); 
									header('Content-Disposition: inline; filename="'.$description.'.pdf"'); 
									echo $response;

								}
								else
								{

									$fileContent = $response;
									$url = 'https://api.dropboxapi.com/2/files/alpha/get_metadata';
									$ch = curl_init($url);
									
									curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
									curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$accessToken,'Content-Type:application/json'));
									curl_setopt($ch, CURLOPT_POSTFIELDS, '{  "path": "'.$path.'", "include_media_info": true, "include_deleted": false, }' ); 
									
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
									
									$res = curl_exec($ch);
									$name = (json_decode($res)->name);
									$name = explode(".", $name);
									$val = uniqid();
									$name = $name[0].$val.$name[1];
									
									file_put_contents($name, $fileContent);
									
									header('Content-Description: File Transfer');
								    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
								    header("Content-Disposition: attachment; filename=\"".basename($name)."\"");
								    header("Content-Transfer-Encoding: binary");
								    header("Expires: 0");
								    header("Pragma: public");
								    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
								    header('Content-Length: ' . filesize($name)); 
								    
								    ob_clean();
								    
								    flush();
								    
								    readfile($name);
									
									unlink($name);

									$result = pg_query("UPDATE document_management SET is_active='f' WHERE document_id=$doc_id");
									
									echo "<br /><br /><br /><br /><div class='row'><div class='col-xl-3 col-lg-3 col-md-2 col-sm-1 col-xs-1'> </div><div class='col-xl-6 col-lg-6 col-md-8 col-sm-10 col-xs-10'><div class='alert alert-danger'><center><br /><strong style='font-size: 15pt;'>Sorry!</strong><br /><br />File cannot be opened.<br /><br /></center></div></div></div>";

								}

							?>

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

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>