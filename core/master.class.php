<?php
/**
 * Maitre du jeu
 */
class Master
{
	public	$id_game;			// Id de la game
	public	$spawn;				// Class gerant le spawn
	public	$action;			// Action actuel
	public	$current_ship;		// Ship actuel
	public	$current_player;	// Joueur actuel
	public	$model;			// Class gerant la bdd
	private	$_input;			// Class gerant la reception de donnees
	private	$_ships = [];		// Tableau des ships
	private	$_rocks = [];		// Tableau des rocks
	private	$_players = [];		// Tableau des players
	private	$_map;

	function __construct($gameId)
	{
		$this->id_game = $gameId;
		$this->model = new Model();
		$info = $this->model->selectFirst("games", NULL, ["id"=>$gameId]);
		foreach ($info as $key => $value) {
			$this->$key = $value;
		}
		$this->action = $info["action"];
		$this->current_ship = $info["current_ship"];
		$this->current_player = $info["current_player"];

		$this->_spawn = new Spawn($this->model, $this->id_game);
		$this->importPlayers();
		$this->_input = new Input($this, $this->model, $gameId);
		$info = $this->model->selectFirst("games", NULL, ["id"=>$gameId]);
		foreach ($info as $key => $value) {
			$this->$key = $value;
		}
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
		$ships = $this->model->select("ships");
		foreach ($ships as $key => $value)
		{
			switch ($value["type"]) {
				case 0:
					$this->_ships[] = new Anaconda($this, $value);
					break;
				case 1:
					$this->_ships[] = new Clipper($this, $value);
					break;
				case 2:
					$this->_ships[] = new Destroyer($this, $value);
					break;
				case 3:
					$this->_ships[] = new Falcon($this, $value);
					break;
				case 4:
					$this->_ships[] = new Python($this, $value);
					break;
				case 5:
					$this->_ships[] = new Unknown($this, $value);
					break;
				default:
					throw new \Exception("Unknow ship id ".$value['type'], 1);
					break;
			}
		}
	}

	public function GetShipInstance($id = NULL)
	{
		if ($id == NULL)
			$id = $this->current_ship;
		$value = $this->model->selectFirst("ships", NULL, ["id"=>$id]);
		if (!$value)
			return (NULL);
		switch ($value["type"]) {
			case 0:
				return new Anaconda($this, $value);
				break;
			case 1:
				return new Clipper($this, $value);
				break;
			case 2:
				return new Destroyer($this, $value);
				break;
			case 3:
				return new Falcon($this, $value);
				break;
			case 4:
				return new Python($this, $value);
				break;
			case 5:
				return new Unknown($this, $value);
				break;
			default:
				throw new \Exception("Unknow ship id ".$value['type'], 1);
				break;
		}
	}

	public function importRocks()
	{
		$this->_rocks = [];
		$rocks = $this->model->select("rocks");
		foreach ($rocks as $key => $value)
		{
			$this->_rocks[] = new Rock($value);
		}
	}

	public function importPlayers()
	{
		$game = $this->model->selectFirst("games", NULL, ["id"=>$this->id_game]);
		if ($game == NULL)
			throw new \Exception("Unknown game $this->id_game", 1);
		$players = explode(",", $game["players"]);
		foreach ($players as $value)
		{
			if (!$data = $this->model->selectFirst("players", NULL, ["id"=>$value]))
				throw new \Exception("Failed to load player $value", 1);
			$this->_players[] = new Player($data);
		}
	}
}
