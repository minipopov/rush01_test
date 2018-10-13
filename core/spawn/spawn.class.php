<?php
/**
 * Populate database when it necessary
 */
class Spawn
{
	private $_model;
	private $_id_game;

	public function __construct($model, $id_game)
	{
		$this->_model = $model;
		$this->_id_game = $id_game;
	}

	public function game($players)
	{
		$players_list = implode(",", $players);
		$this->_model->add("games", [
			"players"	=>	$players_list
		]);
		$last = $this->_model->selectFirst("games", NULL, ["players"=>$players_list], "ORDER BY id DESC LIMIT 1");
		return $last["id"];
	}

	public function ship($params)
	{
		if (!isset($params["id_game"]))
			throw new \Exception("Spawn ship need id_games", 1);
		if (!isset($params["type"]))
			throw new \Exception("Spawn ship need type", 1);
		if (!isset($params["id_owner"]))
			throw new \Exception("Spawn ship need owner", 1);
		if (!$this->_model->add("ships", $params))
			throw new \Exception("Fail to add ship", 1);
	}

	public function rock($params)
	{
		if (!isset($params["id_game"]))
			throw new \Exception("Spawn rock need id_games", 1);
		if (!isset($params["x"]))
			throw new \Exception("Spawn rock need x", 1);
		if (!isset($params["y"]))
			throw new \Exception("Spawn rock need y", 1);
		$exist = $this->_model->selectFirst("rocks", NULL, [
			"x"=>$params["x"],
			"y"=>$params["y"],
			"id_game"=>$this->_id_game
		]);
		if ($exist == NULL)
		{
			if (!$this->_model->add("rocks", $params))
				throw new \Exception("Fail to add rock", 1);
		}
	}

	public function generateRandomRocks($nb, $min, $max)
	{
		for ($i=0; $i < $nb; $i++)
		{
			$x = rand($min, $max);
			$y = rand(0, 100);
			$this->rock([
				"id_game"	=>	$this->_id_game,
				"x"			=>	$x,
				"y"			=>	$y
			]);
		}
	}
}
