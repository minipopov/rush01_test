<?php
/**
 * Destroyer
 */
class Destroyer extends Ship
{
	public $size = [Map::CASE_WIDTH * 11, Map::CASE_HEIGHT * 5];
	public $height = 5;
	public $width = 11;
	public $type = 2;
	public $texture = "/img/ships/destroyer.png";
	public $collider = [
		[0,0,1,1,1,0,0,0,0,0,0],
		[0,0,1,1,1,1,0,0,0,0,0],
		[1,1,1,1,1,1,1,1,1,1,1],
		[0,0,1,1,1,1,0,0,0,0,0],
		[0,0,1,1,1,1,0,0,0,0,0]
	];
}
