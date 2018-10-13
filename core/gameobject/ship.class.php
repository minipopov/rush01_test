<?php
/**
 * Ship
 */
abstract class Ship implements Igameobject, Imove, Ishot, Icollider
{
	public static $debug = False;

	const	RIGHT = 0;
	const	TOP = 1;
	const	LEFT = 2;
	const	BOTTOM = 3;

	public $x;
	public $y;
	public $dir;
	public $type;

	function __construct($data)
	{
		$this->x = $data["x"];
		$this->y = $data["y"];
		$this->dir = $data["direction"];
		$this->type = $data["type"];
		$this->collider = Matrice::shipTransform($this);
	}

	public function exportCollider(&$cases)
	{
		for ($line=0; $line < $this->height; $line++)
			for ($col=0; $col < $this->width; $col++)
				if ($this->collider[$line][$col] == 1)
					$cases[$this->y + $line][$this->x + $col]->setRef($this);
	}

	public function onCollider($gameobject)
	{

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
					$this->texture
				);
				break;
			case Ship::TOP:
				$dec = 0;
				if ($this->height != $this->width)
					$dec = $this->size[1] / 2;
				return sprintf("
					<img class=\"ship ship-top\" style=\"width:%dpx; height:%dpx; top:%dpx; left:0px;\" src=\"%s\" />",
					$this->size[0],
					$this->size[1],
					($this->y * Map::CASE_HEIGHT) + $dec,
					$this->texture
				);
				break ;
			case Ship::LEFT:
				return sprintf("
					<img class=\"ship ship-left\" style=\"width:%dpx; height:%dpx; top:%dpx; left:0px;\" src=\"%s\" />",
					$this->size[0],
					$this->size[1],
					($this->y * Map::CASE_HEIGHT),
					$this->texture
				);
				break ;
			case Ship::BOTTOM:
				$dec = 0;
				if ($this->height != $this->width)
					$dec = $this->size[1] / 2;
				return sprintf("
					<img class=\"ship ship-bottom\" style=\"width:%dpx; height:%dpx; top:%dpx; left:0px;\" src=\"%s\" />",
					$this->size[0],
					$this->size[1],
					($this->y * Map::CASE_HEIGHT) + $dec,
					$this->texture
				);
				break ;
			default:
				throw new \Exception("Ship Unknown direction ", 1);
				break;
		}

	}
}
