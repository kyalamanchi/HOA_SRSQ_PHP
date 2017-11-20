<?php

	include 'password.php';

	$password = $_POST['set_password'];

	$password = password_hash($confirm_password, PASSWORD_BCRYPT);

	echo $password;

?>