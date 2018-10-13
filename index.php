<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="/style/style.css">
		<title></title>
	</head>
	<body>
<?php
include_once "includes.php";

$master = new Master(1);
// Rock::$debug = True;
// Ship::$debug = True;
// 	$master->spawnShip(1, 1);
// $master->_spawn->generateRandomRocks(100, 10, 100);
echo $master->execRender();
?>
</body>
</html>
