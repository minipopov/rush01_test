<?php
$ship = $master->GetShipInstance();
?>

<div class="panel container-fluid">
	<h5 class="text-center">Action panel</h5>
	<p class="text-center">
		Nombre de points de mouvement : <?php echo $ship->move; ?><br>
		Nombre de points de bonus d'attaque : <?php echo $ship->power; ?><br>
		Nombre de points de coque : <?php echo $ship->hull; ?><br>
		Nombre de points de shield : <?php echo $ship->shield; ?><br>
	</p>

	<div class="top-line"></div>
	<div class="panel-btn">

		<!-- FIRST -->

		<form class="" action="/" method="GET">
			<p>
				<input type="hidden" name="id_game" value="<?php echo $master->id_game; ?>">
				<input type="hidden" name="id_ship" value="<?php echo $master->current_ship; ?>">
				<input type="hidden" name="w" value="1">
				<input type="hidden" name="action" value="rotate">
				<button type="submit" class="btn-img"><img src="/img/turn_left.png" alt="Monter"></button>
			</p>
		</form>
		<form class="" action="/" method="GET">
			<p>
				<input type="hidden" name="id_game" value="<?php echo $master->id_game; ?>">
				<input type="hidden" name="id_ship" value="<?php echo $master->current_ship; ?>">
				<input type="hidden" name="x" value="0">
				<input type="hidden" name="y" value="-1">
				<input type="hidden" name="action" value="move">
				<button type="submit" class="btn-img"><img src="/img/move.png" alt="Monter"></button>
			</p>
		</form>
		<form class="" action="/" method="GET">
			<p>
				<input type="hidden" name="id_game" value="<?php echo $master->id_game; ?>">
				<input type="hidden" name="id_ship" value="<?php echo $master->current_ship; ?>">
				<input type="hidden" name="w" value="-1">
				<input type="hidden" name="action" value="rotate">
				<button type="submit" class="btn-img"><img src="/img/turn_right.png" alt="Monter"></button>
			</p>
		</form>

		<!-- Second -->

		<form class="" action="/" method="GET">
			<p>
				<input type="hidden" name="id_game" value="<?php echo $master->id_game; ?>">
				<input type="hidden" name="id_ship" value="<?php echo $master->current_ship; ?>">
				<input type="hidden" name="action" value="move">
				<input type="hidden" name="x" value="-1">
				<input type="hidden" name="y" value="0">
				<button type="submit" class="btn-img"><img src="/img/move.png" style="transform: rotate(270deg)" alt="Gauche"></button>
			</p>
		</form>
		<form class="" action="/" method="GET">
			<p>
				<input type="hidden" name="id_game" value="<?php echo $master->id_game; ?>">
				<input type="hidden" name="id_ship" value="<?php echo $master->current_ship; ?>">
				<input type="hidden" name="action" value="move">
				<button type="submit" class="btn-img"><img src="/img/fire.png" style="transform: rotate(270deg)" alt="Tirer"></button>
			</p>
		</form>
		<form class="" action="/" method="GET">
			<p>
				<input type="hidden" name="id_game" value="<?php echo $master->id_game; ?>">
				<input type="hidden" name="id_ship" value="<?php echo $master->current_ship; ?>">
				<input type="hidden" name="x" value="1">
				<input type="hidden" name="y" value="0">
				<input type="hidden" name="action" value="move">
				<button type="submit" class="btn-img"><img src="/img/move.png" style="transform: rotate(90deg)" alt="Droite"></button>
			</p>
		</form>

		<!-- Last -->
		<p></p>
		<form class="" action="/" method="GET">
			<p>
				<input type="hidden" name="id_game" value="<?php echo $master->id_game; ?>">
				<input type="hidden" name="id_ship" value="<?php echo $master->current_ship; ?>">
				<input type="hidden" name="x" value="0">
				<input type="hidden" name="y" value="1">
				<input type="hidden" name="action" value="move">
				<button type="submit" class="btn-img"><img src="/img/move.png" style="transform: rotate(180deg)" alt="Descendre"></button>
			</p>
		</form>
		<p></p>
	</div>
	<form class="" action="/" method="post">
		<p style="width:100%;" class="text-align:center">
			<br>
			<br>
			<input type="hidden" name="id_game" value="<?php echo $master->id_game; ?>">
			<input type="hidden" name="id_ship" value="<?php echo $master->current_ship; ?>">
			<input type="hidden" name="action" value="endmove">
			<button type="submit" class="btn btn-info">Terminer</button>
		</p>
	</form>
</div>
<?php
