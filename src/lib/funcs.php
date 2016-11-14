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