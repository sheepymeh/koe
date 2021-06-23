<?php
	$CONFIG['name'] = 'Koe';
	$CONFIG['desc'] = 'Platform for Voice Data Aggregation';
	$CONFIG['longdesc'] = '';
	$CONFIG['wordlist'] = [];
	$CONFIG['hmac'] = '';
	if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
		header('Content-type: application/json');
		echo json_encode($CONFIG['wordlist']);
	}
?>
