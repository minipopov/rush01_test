<?php
/**
 * Unknow
 */
class Unknown extends Ship
{
	public $size = [Map::CASE_WIDTH * 7, Map::CASE_HEIGHT * 7];
	public $height = 7;
	public $width = 7;
	public $type = 5;
	public $texture = "/img/ships/unknown.png";
	public $collider = [
		[1,1,1,1,1,1,0,0],
		[1,1,1,1,1,1,1,0],
		[1,1,1,1,1,1,1,1],
		[1,1,1,1,1,1,1,1],
		[1,1,1,1,1,1,1,1],
		[1,1,1,1,1,1,0,0],
		[1,1,1,1,1,1,0,0]
	];
}
