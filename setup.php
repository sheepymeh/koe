<?php
	require 'config.php';
	function mkdir_not_exists($path) {
		if (!file_exists($path)) mkdir($path, 0777, true);
	}
	$paths = [
		'verify',
		'../samples',
		'../rejects'
	];
	foreach ($paths as $path) {
		mkdir_not_exists($path);
		foreach ($CONFIG['wordlist'] as $word) mkdir_not_exists("$path/$word");
	}
?>