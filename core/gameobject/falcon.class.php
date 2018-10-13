<?php
/**
 * Falcon
 */
class Falcon extends Ship
{
	public $size = [Map::CASE_WIDTH * 7, Map::CASE_HEIGHT * 3];
	public $height = 3;
	public $width = 7;
	public $type = 3;
	public $texture = "/img/ships/falcon.png";
	public $collider = [
		[0,1,1,1,1,0,0],
		[1,1,1,1,1,1,0],
		[0,1,1,1,1,0,0],
	];
}
