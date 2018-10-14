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
	public $destroy = False;
	public $y;
	public $master;
	public $type;

	function __construct($master, $data)
	{
		$this->master = $master;
		if (!isset($data["x"]))
			throw new \Exception("Rock error instantiate: no x", 1);
		if (!isset($data["y"]))
			throw new \Exception("Rock error instantiate: no y", 1);

		foreach ($data as $key => $value)
			$this->$key = $value;
	}

	public function exportCollider(&$cases)
	{
		$cases[$this->y][$this->x]->setRef($this);
	}

	public function onCollider($gameobject)
	{
		// code...
	}

	public function onShoot($shot)
	{
		return true;
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
		if ($this->destroy == true)
		{
			$this->master->model->delete("rocks", [
				"id"	=>	$this->id
			]);
		}
	}
}
