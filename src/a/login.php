<?php
	$salt = '8TTugPL0QRqq';
	$passHash = '424e33041896d97720edaf87f0abdadb6eb383444867102b8ab70c7aed7d7e58';

	if (isset($_POST['pass']) && hash("sha256", $_POST['pass'] . $salt) == $passHash ) {
		$_SESSION['loggedIn'] = true;
		
		include_once('upload.php');
		die();
	} elseif (isset($_POST['pass'])) {
		$loginFailed = true;
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Simple Upload Site</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="../lib/semantic-ui/semantic.min.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="../lib/semantic-ui/semantic.min.css">
		<link rel="stylesheet" type="text/css" href="../lib/font-awesome/css/font-awesome.min.css">
	</head>
	<body>

		<div class="ui menu">
		<div class="header item">
			Simple Upload Site
		</div>
		<div class="right menu">
			<div class="item">
				<a class="ui primary button" href="../">Files</a>
			</div>
		</div>
		</div>

		<div class="ui text container">

			<br />

			<h1 class="ui center aligned header">
				Login
			</h1>
			
			<br />
			<br />
			<br />

<?php
	if ($loginFailed) {
		echo '<div class="ui warning message">Login failed</div>';
	}
?>

			<form class="ui fluid action input" method="post">
				<input type="password" placeholder="Password..." name="pass" autofocus>
				<button class="ui button">Login</button>
			</form>
		
		</div>
	</body>
</html>