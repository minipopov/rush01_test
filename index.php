<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="/style/style.css">
		<title></title>
	</head>
	<body>
		<div class="main-grid">
			<div class="">
			<?php
			include_once "includes.php";
			// Ship::$debug = true;
			$master = new Master(1);

			echo $master->execRender();
			?>
			</div>
			<div>
				<div class="sidebar"></div>
				<?php
					switch ($master->action) {
						case 'dice':
							include_once "dice_panel.php";
							break;
						case 'action':
							include_once "action_panel.php";
							break;
						default:
							include_once "pick_panel.php";
							break;
					}
				?>
			</div>
		</div>
	</body>
</html>
