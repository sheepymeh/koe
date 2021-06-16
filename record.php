<?php require 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<title><?php echo $CONFIG['name']; ?></title>
	<link href='https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
	<link href='assets/common.css' rel='stylesheet'>
</head>
<body>
	<header class='text-blue'>
		<h2><?php echo $CONFIG['name']; ?></h2>
		<?php echo $CONFIG['desc']; ?>
	</header>
	<main>
		<span id='word-prompt'>Say the word</span>
		<h1 class='text-blue'></h1>
	</main>
	<div id='record-button' class='button gradient gradient-blue'>
		<span class='material-icons icon-filled text-blue'>mic</span>
		<span id='record-prompt'>Hold to Record</span>
	</div>
	<script src='assets/record.js'></script>
</body>
</html>