<?php
$ship = $master->GetShipInstance();
?>

<div class="panel container-fluid">
	<h5 class="text-center">Dice panel</h5>
	<form class="get" action="/" method="GET">
		<p class="text-center">
			Nombre de des : <?php echo $ship->dice; ?>
			<input type="hidden" name="id_game" value="<?php echo $master->id_game; ?>">
			<input type="hidden" name="id_ship" value="<?php echo $master->current_ship; ?>">
			<input type="hidden" name="action" value="dice">
			<button type="submit" class="btn btn-danger">Lancer les des</button>
		</p>
	</form>
	<div class="top-line"></div>
	<h6 style="width:100%;" class="text-center">Nombre de PP:<?php echo $ship->pp; ?></h6>
	<form class="" action="/" method="GET">
		<div class="top-line"></div>
		<p>
			Coque actuel:<?php echo $ship->hull; ?>
			<br>
			Nombre de points dans la coque:
			<input type="number" name="hull" min=0 value="0">
		</p>
		<div class="top-line"></div>
		<p>
			Attaque actuel:<?php echo $ship->shoot; ?>
			<br>
			Nombre de points en attaque:
			<input type="number" name="power" min=0 value="0">
		</p>
		<div class="top-line"></div>
		<p>
			Shield actuel:<?php echo $ship->shield; ?>
			<br>
			Nombre de points dans le bouclier:
			<input type="number" name="shield" min=0 value="0">
		</p>
		<div class="top-line"></div>
		<p>
			Points de mouvement actuel:<?php echo $ship->move; ?>
			<br>
			Nombre de points en mouvement:
			<input type="number" name="move" min=0 value="0">
		</p>
		<p>
			<br>
			<br>
			<input type="hidden" name="id_game" value="<?php echo $master->id_game; ?>">
			<input type="hidden" name="id_ship" value="<?php echo $master->current_ship; ?>">
			<input type="hidden" name="action" value="usepp">
			<button type="submit" class="btn btn-info">Utiliser</button>
		</p>
	</form>
	<form class="" action="/" method="GET">
		<p>
			<br>
			<br>
			<input type="hidden" name="id_game" value="<?php echo $master->id_game; ?>">
			<input type="hidden" name="id_ship" value="<?php echo $master->current_ship; ?>">
			<input type="hidden" name="action" value="endpp">
			<button type="submit" class="btn btn-info">Terminer la phase</button>
		</p>
	</form>
</div>
<?php
