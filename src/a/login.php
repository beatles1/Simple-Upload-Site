<?php
	$salt = '8TTugPL0QRqq';
	$passHash = '424e33041896d97720edaf87f0abdadb6eb383444867102b8ab70c7aed7d7e58';

	if (isset($_POST['pass']) && hash("sha256", $_POST['pass'] . $salt) == $passHash ) {
		session_start();
		$_SESSION['loggedIn'] == true;
		
		include_once('upload.php');
		die();
	}
?>

<form method="post">
	<input type="password" name="pass">
	<input type="submit">
</form>