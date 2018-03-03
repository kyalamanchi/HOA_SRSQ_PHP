<?php 

	session_start();

	require __DIR__.'/../vendor/autoload.php';

	 if($_SESSION['hoa_community_id'] == 2)
	{
		$dropboxKey = '0t0ibm426a3zwhj';
		$dropboxSecret = 'vuxox96m6rts0lz';
		$appName = 'SRSQ';
	}

	$appInfo = new Dropbox\AppInfo($dropboxKey, $dropboxSecret);

	$csrfTokenStore = new Dropbox\ArrayEntryStore($_SESSION, 'dropbox-auth-csrf-token');

	$webAuth = new Dropbox\WebAuth($appInfo, $appName, 'http://localhost/dropbox/dropbox_finish.php', $csrfTokenStore);

	