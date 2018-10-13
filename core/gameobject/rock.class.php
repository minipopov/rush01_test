<?php
/**
 * Rock
 */
class Rock implements Igameobject, Icollider
{
	public static $debug = False;

	const	TYPE_CLASS = [
		"stone",
		"collider"
	];

	public $x;
	public $y;
	public $type;

	function __construct($data)
	{
		if (!isset($data["x"]))
			throw new \Exception("Rock error instantiate: no x", 1);
		if (!isset($data["y"]))
			throw new \Exception("Rock error instantiate: no y", 1);
		$this->x = $data["x"];
		$this->y = $data["y"];
		$this->type = $data["type"];
	}

	public function exportCollider(&$cases)
	{
		$cases[$this->y][$this->x]->setRef($this);
	}

	public function onCollider($gameobject)
	{
		// code...
	}

	public function __toString()
	{
		if (Rock::$debug == True)
		{
			return sprintf("<td class=\"%s\"></td>", Rock::TYPE_CLASS[1]);
		}
		else
			return sprintf("<td class=\"%s\"></td>", Rock::TYPE_CLASS[$this->type]);
	}

	public function update()
	{
		// code...
	}
}
