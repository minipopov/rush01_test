<?php
/**
 * Ship
 */
class Ship implements Igameobject, Imove, Ishot
{
	const	SHIP_TEXTURE = [
		"/img/ships/ship.png",
		"/img/ships/ship.png"
	];

	const	RIGHT = 0;
	const	TOP = 1;
	const	LEFT = 2;
	const	BOTTOM = 3;

	private $_x;
	private $_y;
	private $_dir;
	private $_type;

	function __construct($data)
	{
		$this->_x = $data["x"];
		$this->_y = $data["y"];
		$this->_dir = $data["direction"];
		$this->_type = $data["type"];
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
		switch ($this->_dir)
		{
			case Ship::RIGHT:
				return sprintf("
					<img class=\"ship ship-right\" style=\"width:100px; height:50px; top:%dpx; left:0px;\" src=\"%s\" />",
					$this->_y * Map::CASE_WIDTH,
					Ship::SHIP_TEXTURE[$this->_type]
				);
				break;
			case Ship::TOP:
				return sprintf("
					<img class=\"ship ship-top\" style=\"width:100px; height:50px; top:%dpx; left:0px;\" src=\"%s\" />",
					$this->_y * Map::CASE_WIDTH,
					Ship::SHIP_TEXTURE[$this->_type]
				);
				break ;
			case Ship::LEFT:
				return sprintf("
					<img class=\"ship ship-left\" style=\"width:100px; height:50px; top:%dpx; left:0px;\" src=\"%s\" />",
					$this->_y * Map::CASE_WIDTH,
					Ship::SHIP_TEXTURE[$this->_type]
				);
				break ;
			case Ship::BOTTOM:
				return sprintf("
					<img class=\"ship ship-bottom\" style=\"width:100px; height:50px; top:%dpx; left:0px;\" src=\"%s\" />",
					$this->_y * Map::CASE_WIDTH,
					Ship::SHIP_TEXTURE[$this->_type]
				);
				break ;
			default:
				throw new \Exception("Ship Unknown direction ", 1);
				break;
		}

	}
}
