<?php
	$fileicons = array(
		'default' => 'outline',
		'pdf' => 'pdf',
		'jpg' => 'image',
		'png' => 'image',
		'gif' => 'image',
		'zip' => 'archive',
		'7z'  => 'archive',
		'mp3' => 'audio',
		'wav' => 'audio',
		'doc' => 'word',
		'docx' => 'word',
		'xls' => 'excel',
		'xlxs' => 'excel',
		'ppt' => 'powerpoint',
		'pptx' => 'powerpoint',
		'mp4' => 'video',
		'avi' => 'video',
		'txt' => 'text',
	);

	function formatBytes($bytes, $precision = 2) { 
		$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

		$bytes = max($bytes, 0); 
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
		$pow = min($pow, count($units) - 1); 

		$bytes /= pow(1024, $pow);

		return round($bytes, $precision) . ' ' . $units[$pow]; 
	}