<?php
/**
 * Python
 */
class Python extends Ship
{
	public $size = [Map::CASE_WIDTH * 9, Map::CASE_HEIGHT * 5];
	public $height = 5;
	public $width = 9;
	public $type = 4;
	public $texture = "/img/ships/python.png";
	public $collider = [
		[0,1,1,1,0,0,0,0,0],
		[0,1,1,1,1,1,1,1,0],
		[1,1,1,1,1,1,1,1,1],
		[0,1,1,1,1,1,1,1,0],
		[0,1,1,1,0,0,0,0,0]
	];
}
