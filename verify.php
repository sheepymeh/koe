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
	<header class='text-orange'>
		<h2><?php echo $CONFIG['name']; ?></h2>
		<?php echo $CONFIG['desc']; ?>
	</header>
	<main>
		<span id='word-prompt'>Listen to the recording</span>
		<div id='play-button' class='material-icons icon-filled text-orange'>play_arrow</div>
	</main>
	<div id='answer-button' class='button no-cursor gradient gradient-orange'>
		<h3>Please click on the play button.</h3>

		<div class='icon-rect text-orange disabled' data-word='falcon'>falcon</div>
		<div class='icon-rect text-orange disabled' data-word='snake'>snake</div>
		<div class='icon-rect text-orange disabled' data-word='neither'>Neither/Incomplete recording</div>
	</div>
	<script src='assets/verify.js'></script>
</body>
</html>