<?php
	include_once('lib/funcs.php');
	include_once('a/conf.php');
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $conf['siteName']; ?></title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="lib/semantic-ui/semantic.min.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="lib/semantic-ui/semantic.min.css">
	</head>
	<body>

		<div class="ui menu">
		<div class="header item">
			<?php echo $conf['siteName']; ?>
		</div>
		<div class="right menu">
			<div class="item">
				<a class="ui primary button" href="a">Admin</a>
			</div>
		</div>
		</div>

		<div class="ui text container">
			<div class="ui middle aligned divided list">

<?php
	if ($handle = opendir('.')) {
		while (false !== ($entry = readdir($handle))) {
			if (substr($entry, 0, 1) != "." && substr($entry, -4) != ".php" && $entry != "a" && $entry != "lib") {
				echo '<div class="item">';
				echo '<div class="right floated content"><a class="ui button" href="' . $entry . '">Download</a></div>';
				echo '<i class="icon file ';
				$ext = pathinfo($entry, PATHINFO_EXTENSION);
				if (array_key_exists($ext, $fileicons)) {
					echo $fileicons[$ext];
				} else {
					echo $fileicons['default'];
				}
				echo ' outline big left floated"></i> ';
				echo '<div class="content">'; 
				echo '<div class="header"><a href="' . $entry . '">' . $entry . '</a></div>';
				echo '<div class="description">' . formatbytes(filesize($entry), 1) . '</div>';
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