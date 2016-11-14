<?php
	if ($_SESSION['loggedIn']) {
		if (isset($_FILES['dataupload'])) {
			if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], basename($_FILES['uploadedfile']['name']))) {
				// Uploaded
			} else {
				// Failed to upload
			}
		} else if (isset($_POST["dataurl"])) {
			$url = $_POST["dataurl"]
			if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
				$filename = explode("/", $url);
				$filename = end($filename);
				if (file_put_contents($filename, file_get_contents($url))) {
					// File copy completed
				} else {
					unlink($filename);
					// File copy failed
				}
			} else {
				// Not valid URL
			}
		}
	} else {
		// Not logged in :o
		die();
	}
?>

<h1>Logged in!</h1>