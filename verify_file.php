<?php
	// this whole setup leads to a race condition, but i think it's fine for now
	require 'config.php';
	shuffle($CONFIG['wordlist']);
	$recordings = False;
	foreach ($CONFIG['wordlist'] as $word) {
		$recordings = array_slice(scandir("verify/{$word}"), 2);
		if ($recordings) break;
	}
	if ($recordings) echo 'verify/', $word, '/', $recordings[random_int(0, count($recordings) - 1)];
	else echo 'ERR - No more recordings';
?>