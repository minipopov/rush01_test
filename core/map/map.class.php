<?php
/**
 * Class de gestion de la map
 */
class Map
{
	const	CASE_WIDTH = 1500 / 150;
	const	CASE_HEIGHT = 1000 / 100;

	public	$cases = [];
	private $_idGame;
	private $_model;

	function __construct($idGame, $model)
	{
		$this->_id_game = $idGame;
		$this->_model = $model;
	}

	public function render(&$ships, &$rocks)
	{
		for ($line=0; $line < 100; $line++)
			for ($col=0; $col < 150; $col++)
				$this->cases[$line][$col] = new Mapcase();
		$this->initColliderRocks($rocks);
		$this->initColliderShips($ships);
		$this->makeShot();
		return $this->__toHtml($ships);
	}

	public function makeShot()
	{
		$shots = $this->_model->select("shots", NULL, [
			"id_game"	=>	$this->_id_game
		]);
		foreach ($shots as $key => $value)
			$this->applyShot($value);
		$this->_model->delete("shots", ["id_game" => $this->_id_game]);
	}

	public function applyShot($shot)
	{
		$shot["traj_x"] = intval($shot["traj_x"]);
		$shot["traj_y"] = intval($shot["traj_y"]);
		$shot["x"] = intval($shot["x"]);
		$shot["y"] = intval($shot["y"]);
		while ($shot["porte"] > 0 && $shot["y"] > 0 && $shot["y"] < 100
			&& $shot["x"] > 0 && $shot["x"] < 150)
		{
			$obj = $this->cases[$shot["y"]][$shot["x"]]->getRef();
			if ($obj != NULL)
			{
				if ($obj->onShoot($shot))
					$obj->destroy = true;
				else
					$this->cases[$shot["y"] - $shot["traj_y"]][$shot["x"] - $shot["traj_x"]]->explo = true;
				$obj->update();
				return ;
			}
			$shot["x"] += $shot["traj_x"];
			$shot["y"] += $shot["traj_y"];
			$shot["porte"]--;
		}
		if ($shot["y"] > 0 && $shot["y"] < 100
			&& $shot["x"] > 0 && $shot["x"] < 150)
			$this->cases[$shot["y"]][$shot["x"]]->explo = true;
	}

	public function initColliderRocks(&$rocks)
	{
		foreach ($rocks as $key => $value)
			$value->exportCollider($this->cases);
	}

	public function initColliderShips(&$ships)
	{
		foreach ($ships as $key => $value) {
			$value->exportCollider($this->cases);
		}
	}

	public function renderShips(&$ships)
	{
		foreach ($ships as $key => $value)
			$this->cases[$value->y][$value->x]->setRef($value);
	}

	public function __toHtml(&$ships)
	{
		$html = "<table class='map'>";
		for ($line=0; $line < 100; $line++)
		{
			$html .= "<tr>";
			for ($col=0; $col < 150; $col++)
				$html .= $this->cases[$line][$col];
			$html .= "</tr>";
		}
		$html .= "</table>";
		foreach ($ships as $key => $value)
			$html .= strval($value);
		return ($html);
	}

	public function renderShip($html, &$ships)
	{
		foreach ($ships as $key => $value)
		{
			$html .= $value;
		}
		return ($html);
	}
}
