<?php
	$fileicons = array(
		'default' => 'fa-file-o',
		'pdf' => 'fa-file-pdf-o',
		'jpg' => 'fa-file-image-o',
		'png' => 'fa-file-image-o',
		'gif' => 'fa-file-image-o',
		'zip' => 'fa-file-archive-o',
		'7z'  => 'fa-file-archive-o',
		'mp3' => 'fa-file-audio-o',
		'wav' => 'fa-file-audio-o',
		'doc' => 'fa-file-word-o',
		'docx' => 'fa-file-word-o',
		'xls' => 'fa-file-excel-o',
		'xlxs' => 'fa-file-excel-o',
		'ppt' => 'fa-file-powerpoint-o',
		'pptx' => 'fa-file-powerpoint-o',
		'mp4' => 'fa-file-video-o',
		'avi' => 'fa-file-video-o',
	);

	function formatBytes($bytes, $precision = 2) { 
		$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

		$bytes = max($bytes, 0); 
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
		$pow = min($pow, count($units) - 1); 

		$bytes /= pow(1024, $pow);

		return round($bytes, $precision) . ' ' . $units[$pow]; 
	} 
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Simple Upload Site</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="lib/semantic.min.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="lib/semantic.min.css">
		<link rel="stylesheet" type="text/css" href="lib/font-awesome/css/font-awesome.min.css">
	</head>
	<body>

		<div class="ui menu">
		<div class="header item">
			Simple Upload Site
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
				echo '<i class="fa ';
				$ext = pathinfo($entry, PATHINFO_EXTENSION);
				if (array_key_exists($ext, $fileicons)) {
					echo $fileicons[$ext];
				} else {
					echo $fileicons['default'];
				}
				echo ' fa-2x left floated"></i> ';
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