<?php
/**
 * Ship
 */
class Ship implements Igameobject, Imove, Ishot, Icollider
{
	public static $debug = False;
	const	SHIP_TEXTURE = [
		"/img/ships/ship.png",
		"/img/ships/ship.png"
	];

	const	RIGHT = 0;
	const	TOP = 1;
	const	LEFT = 2;
	const	BOTTOM = 3;

	public $x;
	public $y;
	public $dir;
	public $type;
	private $size = [110, 50];
	public $height = 5;
	public $width = 11;
	public $collider = [
		[0,1,1,1,1,1,1,0,0,0,0],
		[1,1,1,1,1,1,1,1,1,1,0],
		[1,1,1,1,1,1,1,1,1,1,1],
		[1,1,1,1,1,1,1,1,1,1,0],
		[0,1,1,1,1,1,1,0,0,0,0]
	];

	function __construct($data)
	{
		$this->x = $data["x"];
		$this->y = $data["y"];
		$this->dir = $data["direction"];
		$this->type = $data["type"];
		$this->collider = Matrice::shipTransform($this);
		// foreach ($this->collider as $key => $value) {
		// 	foreach ($value as $k => $v) {
		// 		echo $v;
		// 	}
		// 	echo "<br>";
		// }
	}

	public function exportCollider(&$cases)
	{
		for ($line=0; $line < $this->height; $line++)
			for ($col=0; $col < $this->width; $col++)
		{
			if ($this->collider[$line][$col] == 1)
				$cases[$this->y + $line][$this->x + $col]->setRef($this);
		}
	}

	public function onCollider($gameobject)
	{
		// code...
	}

	public function getPos()
	{

	}

	public function move()
	{

	}

	public function shoot()
	{

	}

	public function update()
	{

	}

	public function __toString()
	{
		switch ($this->dir)
		{
			case Ship::RIGHT:
				return sprintf("
					<img class=\"ship ship-right\" style=\"width:%dpx; height:%dpx; top:%dpx; left:0px;\" src=\"%s\" />",
					$this->size[0],
					$this->size[1],
					$this->y * Map::CASE_HEIGHT,
					Ship::SHIP_TEXTURE[$this->type]
				);
				break;
			case Ship::TOP:
				return sprintf("
					<img class=\"ship ship-top\" style=\"width:%dpx; height:%dpx; top:%dpx; left:0px;\" src=\"%s\" />",
					$this->size[0],
					$this->size[1],
					($this->y * Map::CASE_HEIGHT) + 1 + $this->size[1] / 2,
					Ship::SHIP_TEXTURE[$this->type]
				);
				break ;
			case Ship::LEFT:
				return sprintf("
					<img class=\"ship ship-left\" style=\"width:%dpx; height:%dpx; top:%dpx; left:0px;\" src=\"%s\" />",
					$this->size[0],
					$this->size[1],
					($this->y * Map::CASE_HEIGHT),
					Ship::SHIP_TEXTURE[$this->type]
				);
				break ;
			case Ship::BOTTOM:
				return sprintf("
					<img class=\"ship ship-bottom\" style=\"width:%dpx; height:%dpx; top:%dpx; left:0px;\" src=\"%s\" />",
					$this->size[0],
					$this->size[1],
					($this->y * Map::CASE_HEIGHT) + 1 + $this->size[1] / 2,
					Ship::SHIP_TEXTURE[$this->type]
				);
				break ;
			default:
				throw new \Exception("Ship Unknown direction ", 1);
				break;
		}

	}
}
