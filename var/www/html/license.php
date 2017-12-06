<html lang='en'>

	<head>
</head>
<body>
<?php	
	pg_connect("host=hoaprodprivate.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=HOApgtest user=root password=hPKzMK^5cJg5");

	$query = "SELECT legal_name FROM community_infi WHERE community_id = 1;
	$result = pg_query($query);	
	$num_row = pg_num_rows($result);
	
	echo $num_row;
?>
<form method='POST' action='license_check.php'>

										<div class='form-group'>

											<input class='form-control form-control-lg' name='license_plate' id='license_plate' type='text' placeholder='License' required>

										</div>

										<div class='form-group'>

											<button class='btn btn-block btn-lg btn-round btn-success' type='submit'><i class='fa fa-sign-in'></i> Check License</button>

										</div>

									</form>
</body>								