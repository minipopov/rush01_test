<?php
/**
 * Maitre du jeu
 */
class Master
{
	private	$_model;		// Class gerant la bdd
	private	$_input;		// Class gerant la reception de donnees
	private	$_ships = [];	// Tableau des ships
	private	$_rocks = [];	// Tableau des rocks

	function __construct($gameId)
	{
		$model = new Model();
		$this->_input = new Input($model);
	}
}
