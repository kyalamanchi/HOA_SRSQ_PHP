<?php
	
	ini_set("session.save_path","/var/www/html/session/");

	session_start();
    session_unset();
    session_destroy();
    session_write_close();
    //setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);

	header('Location: https://hoaboardtime.com/');
	
?>