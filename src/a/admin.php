<?php
	include_once('../lib/funcs.php');

	$uploadMessage = false;
	$urlMessage = false;
	$nameMessage = false;
	if ($_SESSION['loggedIn']) {
		if (isset($_FILES['dataupload'])) {
			if(move_uploaded_file($_FILES['dataupload']['tmp_name'], "../" . basename($_FILES['dataupload']['name']))) {
				$uploadMessage = basename($_FILES['dataupload']['name']) . " successfully uploaded.";
			} else {
				$uploadMessage = "Upload failed.";
			}
		} else if (isset($_POST['dataurl'])) {
			$url = $_POST["dataurl"];
			if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
				$filename = explode("/", $url);
				$filename = end($filename);
				if (file_put_contents('../' . $filename, file_get_contents($url))) {
					$urlMessage = $filename . " sucessfully uploaded.";
				} else {
					unlink($filename);
					$urlMessage = "Upload failed.";
				}
			} else {
				$urlMessage = "Invalid URL.";
			}
		} elseif (isset($_POST['newSiteName'])) {
			$newName = $_POST['newSiteName'];
			if ($newName != "") {
				$conf["siteName"] = $newName;
				saveConf();
				$nameMessage = "Name succesfully updated.";
			} else {
				$nameMessage = "Name cannot be blank.";
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
		<title><?php echo $conf['siteName']; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="../lib/semantic-ui/semantic.min.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="../lib/semantic-ui/semantic.min.css">
	</head>
	<body>

		<div class="ui menu">
		<div class="header item">
			<?php echo $conf['siteName']; ?>
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

			<h1 class="ui header">		<!-- UPLOAD -->
				Upload
			</h1>

			<form class="ui fluid input" method="post" enctype="multipart/form-data">
				<input type="file" name="dataupload">
				<button class="ui button">Upload</button>
			</form>

			<?php
				if ($uploadMessage) {
					echo '<div class="ui message">' . $uploadMessage . '</div>';
				}
			?>

			<h1 class="ui header">		<!-- SIDELOAD -->
				Sideload
			</h1>

			<form class="ui fluid input" method="post" enctype="multipart/form-data">
				<input type="text" name="dataurl" placeholder="Enter URL...">
				<button class="ui button">Sideload</button>
			</form>

			<?php
				if ($urlMessage) {
					echo '<div class="ui message">' . $urlMessage . '</div>';
				}
			?>

			<h1 class="ui header">		<!-- SITE NAME -->
				Site Name
			</h1>

			<form class="ui fluid input" method="post" enctype="multipart/form-data">
				<input type="text" name="newSiteName" placeholder="Site name" value="<?php echo $conf['siteName']; ?>">
				<button class="ui button">Update</button>
			</form>

			<?php
				if ($nameMessage) {
					echo '<div class="ui message">' . $nameMessage . '</div>';
				}
			?>

			<h1 class="ui header">		<!-- FILES -->
				Files
			</h1>

			<div class="ui middle aligned divided list">

				<?php
					if ($handle = opendir('../')) {
						while (false !== ($entry = readdir($handle))) {
							if (substr($entry, 0, 1) != "." && substr($entry, -4) != ".php" && $entry != "a" && $entry != "lib") {
								echo '<div class="item">';
								echo '<div class="right floated content"><a class="ui red button" href="delete.php?f=' . $entry . '">Delete</a></div>';
								echo '<i class="icon file ';
								$ext = pathinfo('../' . $entry, PATHINFO_EXTENSION);
								if (array_key_exists($ext, $fileicons)) {
									echo $fileicons[$ext];
								} else {
									echo $fileicons['default'];
								}
								echo ' outline big left floated"></i> ';
								echo '<div class="content">'; 
								echo '<div class="header"><a href="../' . $entry . '">' . $entry . '</a></div>';
								echo '<div class="description">' . formatbytes(filesize('../' . $entry), 1) . '</div>';
								echo '</div></div>';
							}
						}
						closedir($handle);
					}
				?>

			</div>

		</div>
	</body>
</html>