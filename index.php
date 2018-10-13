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
$master->spawn->spawnShip(1, 1);
// $master->spawn->generateRandomRocks(1000, 10, 100);
echo $master->execRender();
?>
</body>
</html>
