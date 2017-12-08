<?php

	session_start();

	$community_id = $_SESSTION['hoa_community_id'];

	$to = $_POST['mail_email'];
	$body = nl2br($_POST['mail_body']);
	$subject = $_POST['mail_subject'];
	$token = $_POST['token'];

	echo "<br>".$to."<br><br>".$subject."<br><br>".$body."<br><br>".$token;

?>