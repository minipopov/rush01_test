<?php
/**
 * Clipper
 */
class Clipper extends Ship
{
	public $size = [Map::CASE_WIDTH * 11, Map::CASE_HEIGHT * 5];
	public $height = 5;
	public $width = 11;
	public $type = 1;
	public $texture = "/img/ships/clipper.png";
	public $collider = [
		[0,1,1,1,1,0,0,0,0,0,0],
		[0,1,1,1,1,1,0,0,0,0,0],
		[1,1,1,1,1,1,1,1,1,1,1],
		[0,1,1,1,1,1,0,0,0,0,0],
		[0,1,1,1,1,0,0,0,0,0,0]
	];
}
