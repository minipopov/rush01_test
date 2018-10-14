<?php
/**
 * Anaconda
 */
class Anaconda extends Ship
{
	public $base = [
		"pp"		=>	50,
		"hull"		=>	50,
		"shield"	=>	20,
		"power"		=>	0,
		"shoot"		=>	1,
		"has_shoot"	=>	0,
	];

	public $size = [Map::CASE_WIDTH * 11, Map::CASE_HEIGHT * 5];
	public $height = 5;
	public $width = 11;
	public $type = 0;
	public $texture = "/img/ships/anaconda.png";
	public $collider = [
		[0,1,1,1,1,1,1,0,0,0,0],
		[1,1,1,1,1,1,1,1,1,1,0],
		[1,1,1,1,1,1,1,1,1,1,1],
		[1,1,1,1,1,1,1,1,1,1,0],
		[0,1,1,1,1,1,1,0,0,0,0]
	];
}
