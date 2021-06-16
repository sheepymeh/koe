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
	<section><?php echo $CONFIG['longdesc']; ?></section>
	<a href='record.php' class='button gradient gradient-blue'>
		<span class='material-icons icon-filled text-blue'>mic</span>
		Record voice
	</a>
	<a href='verify.php' class='button gradient gradient-orange'>
		<span class='material-icons icon-filled text-orange'>volume_up</span>
		Verify Recordings
	</a>
</body>
</html>