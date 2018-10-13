<?php
/**
 * Class de gestion de la map
 */
class Map
{
	const	CASE_WIDTH = 15;

	private $_idGame;
	private $_model;

	function __construct($idGame)
	{
		$this->_id_game = $idGame;
	}

	public function render(&$ships, &$rocks)
	{
		$html = "<table class='map'>";
		for ($line=0; $line < 100; $line++)
		{
			$html .= "<tr>";
			for ($col=0; $col < 150; $col++)
			{
				if (isset($rocks[$line][$col]) && $rocks[$line][$col] != NULL)
					$html .= $rocks[$line][$col];
				else
					$html .= "<td></td>";
			}
			$html .= "</tr>";
		}
		$html .= "</table>";
		return $this->renderShip($html, $ships);
	}

	public function renderShip($html, &$ships)
	{
		foreach ($ships as $key => $value)
		{
			// var_dump($value);
			$html .= $value;
		}
		return ($html);
	}
}
