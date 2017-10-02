<?php 
ini_set("session.save_path","/var/www/html/session/");
	session_start();

	$_SESSION['hoa_hoa_id'] = 1259;

	require __DIR__.'/../vendor/autoload.php';

	if($_SESSION['hoa_community_id'] == 1)
	{
		$dropboxKey = 'nlwoqs7bfr5tiwc';
		$dropboxSecret = '6l9cjhz6cw7ocy8';
		$appName = 'SRP';
	}
	else if($_SESSION['hoa_community_id'] == 2)
	{
		$dropboxKey = '0t0ibm426a3zwhj';
		$dropboxSecret = 'vuxox96m6rts0lz';
		$appName = 'SRSQ';
	}

	$appInfo = new Dropbox\AppInfo($dropboxKey, $dropboxSecret);

	$csrfTokenStore = new Dropbox\ArrayEntryStore($_SESSION, 'dropbox-auth-csrf-token');

	$webAuth = new Dropbox\WebAuth($appInfo, $appName, 'http://localhost/dropbox/dropbox_finish.php', $csrfTokenStore);

	