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

	function __construct($idGame)
	{
		$this->_id_game = $idGame;
	}

	public function render(&$ships, &$rocks)
	{
		for ($line=0; $line < 100; $line++)
			for ($col=0; $col < 150; $col++)
				$this->cases[$line][$col] = new Mapcase();
		$this->initColliderRocks($rocks);
		$this->initColliderShips($ships);
		return $this->__toHtml($ships);
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
