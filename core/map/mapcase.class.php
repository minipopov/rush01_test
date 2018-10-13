<?php
/**
 * Mapcase
 */
class Mapcase
{
	public $obj = NULL;

	function __construct()
	{}

	public function setRef(&$ref)
	{
		$this->obj = $ref;
	}

	public function __toString()
	{
		if ($this->obj == NULL)
			return "<td></td>";
		else
		{
			$class = get_class($this->obj);
			if ($class == "Rock")
				return strval($this->obj);
			else if ($class = "Ship" && Ship::$debug == true)
			{
				return sprintf("<td class=\"collider\"></td>");
			}
			else
				return "<td></td>";
		}
	}
}
