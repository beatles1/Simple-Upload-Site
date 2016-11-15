<?php

$conf = true;

function loadConf() {
	global $conf;
	$str = file_get_contents('conf.json');
	if ($str) {
		$conf = json_decode($str, true);
	} else {
		$conf = array(
			'siteName' => 'Simple Upload Site'
		);
	}
}
loadConf();

function saveConf() {
	global $conf;
	file_put_contents('conf.json', json_encode($conf,TRUE));
}