<?php
/**
 * Maitre du jeu
 */
class Master
{
	public	$id_game;		// Id de la game
	public	$spawn;			// Class gerant le spawn
	private	$_model;		// Class gerant la bdd
	private	$_input;		// Class gerant la reception de donnees
	private	$_ships = [];	// Tableau des ships
	private	$_rocks = [];	// Tableau des rocks
	private	$_players = [];	// Tableau des players
	private	$_map;

	function __construct($gameId)
	{
		$this->id_game = $gameId;
		$this->_model = new Model();
		$this->_spawn = new Spawn($this->_model, $this->id_game);
		$this->importPlayers();
		$this->_input = new Input($this->_model, $this->_ships, $this->_rocks);
		//detection des fin de tour destruction etc...
		$this->_map = new Map($gameId);
	}

	public function spawnShip($id_owner, $type)
	{
		$this->_spawn->ship([
			"id_game"	=>	$this->id_game,
			"id_owner"	=>	$id_owner,
			"type"		=>	$type
		]);
	}

	public function	execRender()
	{
		$this->importShips();
		$this->importRocks();
		return $this->_map->render($this->_ships, $this->_rocks);
	}

	public function importShips()
	{
		$this->_ships = [];
		$ships = $this->_model->select("ships");
		foreach ($ships as $key => $value)
		{
			switch ($value["type"]) {
				case 0:
					$this->_ships[] = new Anaconda($value);
					break;
				case 1:
					$this->_ships[] = new Clipper($value);
					break;
				case 2:
					$this->_ships[] = new Destroyer($value);
					break;
				case 3:
					$this->_ships[] = new Falcon($value);
					break;
				case 4:
					$this->_ships[] = new Python($value);
					break;
				case 5:
					$this->_ships[] = new Unknown($value);
					break;
				default:
					throw new \Exception("Unknow ship id ".$value['type'], 1);
					break;
			}
		}
	}

	public function importRocks()
	{
		$this->_rocks = [];
		$rocks = $this->_model->select("rocks");
		foreach ($rocks as $key => $value)
		{
			$this->_rocks[] = new Rock($value);
		}
	}

	public function importPlayers()
	{
		$game = $this->_model->selectFirst("games", NULL, ["id"=>$this->id_game]);
		if ($game == NULL)
			throw new \Exception("Unknown game $this->id_game", 1);
		$players = explode(",", $game["players"]);
		foreach ($players as $value)
		{
			if (!$data = $this->_model->selectFirst("players", NULL, ["id"=>$value]))
				throw new \Exception("Failed to load player $value", 1);
			$this->_players[] = new Player($data);
		}
	}
}
