<?php
	require 'config.php';
	if (empty($_POST['word']) || empty($_POST['filename']) || (!in_array($_POST['word'], $CONFIG['wordlist']) && $_POST['word'] != 'neither')) {
		header('HTTP/1.1 401 Bad Request');
		exit;
	}
	$chosen = $_POST['word'];
	$correct = explode('/', $_POST['filename'], 3)[1];
	$filename = basename($_POST['filename']);
	if (!in_array($correct, $CONFIG['wordlist'])) {
		header('HTTP/1.1 401 Bad Request');
		exit;
	}
	rename(
		'verify/' . $correct . '/' . $filename,
		'../' . (($correct == $chosen) ? 'samples' : 'rejects') . '/' . $correct . '/' . $filename
	);
?>