<?php
	
	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$hoa_id = $_REQUEST['hoa_id'];
	$community_id = $_REQUEST['community_id'];
	$community_code = $_REQUEST['community_code'];
	$community_name = $_REQUEST['community_name'];

?>

<?php

								$row = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));

								$first_name = $row['firstname'];
								$last_name = $row['lastname'];
								$cell_no = $row['cell_no'];
								$ocell_no = $cell_no;

								$c = $cell_no % 100;

								if($c >= 0 && $c <= 9)
									$c = sprintf('%02d', $c);

								$i = 0;

								while($cell_no > 0)
								{

									$i++;
									$cell_no = $cell_no / 10;
									$cell_no = floor($cell_no);

								}

								$cell_no = $c;
								
								$i = $i - 2;

								for($j = 0; $j < $i; $j++)
									$cell_no = "x".$cell_no;

							?>

<!DOCTYPE html>

<html lang='en'>

	<head>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='Stoneridge Place At Pleasanton HOA'>
		<meta name='author' content='Geeth'>

		<title><?php echo $community_code; ?> - Confirm User Identity</title>

	</head>

	<body>

		<form method='POST' action='testing.php' class='ajax'>

			<div class='col-xl-6 col-lg-6 col-md-8 col-sm-10 col-xs-12 offset-xl-3 offset-lg-3 offset-md-2 offset-sm-1'>

				<center>Please enter your mobile number.</center>

			</div>

			<br>

			<div class='col-xl-4 col-lg-4 col-md-4 col-sm-8 col-xs-10 offset-xl-4 offset-lg-4 offset-md-4 offset-sm-2 offset-xs-1'>

				<input class='form-control' type='number' name='confirm_cell_no' id='confirm_cell_no' placeholder='<?php echo $cell_no; ?>'>

				<input type='hidden' name='hoa_id' id='hoa_id' value='<?php echo $hoa_id; ?>'>

			</div>

			<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

				<hr><br>

				<button class='btn btn-success btn-sm'>Continue <i class='fa fa-arrow-right'></i></button>

			</div>

		</form>

		<!-- Scripts-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src='assets/js/main.js'></script>

	</body>

</html>