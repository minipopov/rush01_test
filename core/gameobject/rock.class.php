<?php
/**
 * Rock
 */
class Rock implements Igameobject
{
	const	TYPE_CLASS = [
		"stone"
	];
	private $_x;
	private $_y;
	private $_type;

	function __construct($data)
	{
		if (!isset($data["x"]))
			throw new \Exception("Rock error instantiate: no _x", 1);
		if (!isset($data["y"]))
			throw new \Exception("Rock error instantiate: no _y", 1);
		$this->_x = $data["x"];
		$this->_y = $data["y"];
		$this->_type = $data["type"];
	}

	public function __toString()
	{
		return sprintf("<td class=\"%s\"></td>", Rock::TYPE_CLASS[$this->_type]);
	}

	public function update()
	{
		// code...
	}
}
