<?php
	session_start();
	
	if ($_SESSION['loggedIn']) {
		include_once('upload.php');
	} else {
		include_once('login.php');
	}
?>