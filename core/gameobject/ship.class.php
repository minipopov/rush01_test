<?php
/**
 * Ship
 */
abstract class Ship implements Igameobject, Imove, Ishot, Icollider, Ipp
{
	public static $debug = False;

	const	RIGHT = 0;
	const	TOP = 1;
	const	LEFT = 2;
	const	BOTTOM = 3;

	public $id;
	public $x;
	public $y;
	public $direction;
	public $type;
	public $master;
	public $pp;

	function __construct($master, $data)
	{
		$this->master = $master;
		$this->id = $data["id"];
		foreach ($data as $key => $value) {
			$this->$key = $value;
		}
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

	public function getPPState()
	{
		return [
			'hull'	=>	$this->hull,
			'shield'	=>	$this->shield,
			'move'	=>	$this->move,
			'power'	=>	$this->power
		];
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
		$this->master->model->update("ships", [
			"x"			=>	$this->x,
			"y"			=>	$this->y,
			"direction"	=>	$this->direction,
			"dice"		=>	$this->dice,
			"pp"		=>	$this->pp,
			"hull"		=>	$this->hull,
			"move"		=>	$this->move,
			"shield"	=>	$this->shield,
			"power"		=>	$this->power,
			"shoot"		=>	$this->shoot,
			"available"	=>	$this->available,
			"has_shoot"	=>	$this->has_shoot
		],[
			"id"	=>	$this->id
		]);
	}

	public function __toString()
	{
		switch ($this->direction)
		{
			case Ship::RIGHT:
				return sprintf("<a href='/?action=%s&id_ship=%d&id_game=%d'>
					<img class=\"ship ship-right\" style=\"width:%dpx; height:%dpx; top:%dpx; left:%dpx;\" src=\"%s\" />
					</a>",
					$this->master->action,
					$this->id,
					$this->master->id_game,
					$this->size[0],
					$this->size[1],
					($this->y * Map::CASE_HEIGHT),
					($this->x * Map::CASE_WIDTH),
					$this->texture
				);
				break;
			case Ship::TOP:
				$dec = 0;
				if ($this->height != $this->width)
					$dec = $this->size[1] / 2;
				return sprintf("<a href='/?action=%s&id_ship=%d&id_game=%d'>
					<img class=\"ship ship-top\" style=\"width:%dpx; height:%dpx; top:%dpx; left:%dpx;\" src=\"%s\" />
					</a>",
					$this->master->action,
					$this->id,
					$this->master->id_game,
					$this->size[0],
					$this->size[1],
					($this->y * Map::CASE_HEIGHT) + $dec,
					($this->x * Map::CASE_WIDTH),
					$this->texture
				);
				break ;
			case Ship::LEFT:
				return sprintf("<a href='/?action=%s&id_ship=%d&id_game=%d'>
					<img class=\"ship ship-left\" style=\"width:%dpx; height:%dpx; top:%dpx; left:%dpx;\" src=\"%s\" />
					</a>",
					$this->master->action,
					$this->id,
					$this->master->id_game,
					$this->size[0],
					$this->size[1],
					($this->y * Map::CASE_HEIGHT),
					($this->x * Map::CASE_WIDTH),
					$this->texture
				);
				break ;
			case Ship::BOTTOM:
				$dec = 0;
				if ($this->height != $this->width)
					$dec = $this->size[1] / 2;
				return sprintf("<a href='/?action=%s&id_ship=%d&id_game=%d'>
					<img class=\"ship ship-bottom\" style=\"width:%dpx; height:%dpx; top:%dpx; left:%dpx;\" src=\"%s\" />
					</a>",
					$this->master->action,
					$this->id,
					$this->master->id_game,
					$this->size[0],
					$this->size[1],
					($this->y * Map::CASE_HEIGHT) + $dec,
					($this->x * Map::CASE_WIDTH),
					$this->texture
				);
				break ;
			default:
				throw new \Exception("Ship Unknown direction ", 1);
				break;
		}

	}
}
