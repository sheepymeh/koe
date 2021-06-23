<?php
	require 'config.php';
	if (empty($_FILES['audio']) || $_FILES['audio']['size'] > 35000 || empty($_POST['word']) || !in_array($_POST['word'], $CONFIG['wordlist'])) {
		header('HTTP/1.1 401 Bad Request');
		exit;
	}
	$status = 1;
	$out = [];
	$filename = $_POST['word'] . '/' . hash_hmac('md5', time() . random_int(0, 10000), $CONFIG['hmac']);
	move_uploaded_file($_FILES['audio']['tmp_name'], "verify/{$filename}");
	exec("ffmpeg -i verify/{$filename} verify/{$filename}.mp3", $out, $status);
	unlink("verify/{$filename}");
	if ($status != 0) header('HTTP/1.1 401 Bad Request');
?>
