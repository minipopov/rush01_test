<?php
$ship = $master->GetShipInstance();
?>

<div class="panel container-fluid">
	<h5 class="text-center">Phase de selection</h5>
	<p>
		<?php
			$player = $master->model->selectFirst("players", NULL, [
				"id"	=>	$master->current_player
			]);
			$availableShip = $master->model->select("ships", NULL, [
				"id_owner"	=>	$master->current_player,
				"available"	=>	1,
				"id_game"	=>	$master->id_game
			]);
		?>
		Joueur <?php echo $player["login"]; ?>
		<?php foreach ($availableShip as $key => $value): ?>
			<p>
				<a href="/?action=none&id_ship=<?php echo $value["id"]; ?>&id_game=<?php echo $master->id_game; ?>">
					<?php
					switch ($value["type"]) {
						case 0:
							echo "Anaconda";
							break;
						case 1:
							echo "Clipper";
							break;
						case 2:
							echo "Destroyer";
							break;
						case 3:
							echo "Falcon";
							break;
						case 4:
							echo "Python";
							break;
						case 5:
							echo "Unknown";
							break;
						default:
							echo "Error type vaisseau";
							break;
					}
					?>
				</a>
			</p>
		<?php endforeach; ?>
	</p>
</div>
<?php
