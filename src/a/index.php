<?php
	session_start();
	include_once('conf.php');
	
	if ($_SESSION['loggedIn']) {
		include_once('admin.php');
	} else {
		include_once('login.php');
	}
?>