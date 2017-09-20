<!DOCTYPE html>
<html>

	<head>

		<title>Log In Page</title>

	</head>

	<body>

		<?php

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	include 'password.php';

	$login_email = $_POST['login_email'];
	$login_password = $_POST['login_password'];

	$result = pg_query("SELECT * FROM usr WHERE email='$login_email'");

	$users = pg_num_rows($result);

	if($users)
	{

	}
	else
	{

		echo "<div class='alert alert-danger'><strong>Invalid user!</strong> Please check the email and try again.</div>";
	}

?>

	</body>

</html>