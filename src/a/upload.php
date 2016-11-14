<?php
	$uploadMessage = false;
	$urlMessage = false;
	if ($_SESSION['loggedIn']) {
		if (isset($_FILES['dataupload'])) {
			if(move_uploaded_file($_FILES['dataupload']['tmp_name'], "../" . basename($_FILES['dataupload']['name']))) {
				$uploadMessage = basename($_FILES['dataupload']['name']) . " successfully uploaded.";
			} else {
				$uploadMessage = "Upload failed.";
			}
		} else if (isset($_POST["dataurl"])) {
			$url = $_POST["dataurl"];
			if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
				$filename = explode("/", $url);
				$filename = end($filename);
				if (file_put_contents($filename, file_get_contents($url))) {
					$urlMessage = $filename . " sucessfully uploaded.";
				} else {
					unlink($filename);
					$urlMessage = "Upload failed.";
				}
			} else {
				$urlMessage = "Invalid URL.";
			}
		}
	} else {
		// Not logged in :o
		die();
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Simple Upload Site</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="../lib/semantic.min.js" type="text/javascript"></script>
		<script src="../lib/dropzone.js"></script>
		<link rel="stylesheet" type="text/css" href="../lib/semantic.min.css">
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
			<div class="item">
				<a class="ui primary button" href="logout.php">Logout</a>
			</div>
		</div>
		</div>

		<div class="ui text container">

			<h1 class="ui header">
				Upload
			</h1>

			<form class="ui input" method="post" enctype="multipart/form-data">
				<input type="file" name="dataupload">
				<button class="ui button">Upload</button>
			</form>

<?php
	if ($uploadMessage) {
		echo '<div class="ui message">' . $uploadMessage . '</div>';
	}
?>

		</div>
	</body>
</html>