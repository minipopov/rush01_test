<?php
/**
 * Mapcase
 */
class Mapcase
{
	public $obj = NULL;
	public $explo = False;

	function __construct()
	{}

	public function setRef(&$ref)
	{
		$this->obj = $ref;
	}

	public function getRef()
	{
		return ($this->obj);
	}

	public function __toString()
	{
		if ($this->obj == NULL)
		{
			if ($this->explo)
				return "<td class='boom'></td>";
			else
				return "<td></td>";
		}
		else
		{
			if ($this->explo)
				return "<td class='boom'></td>";
			$class = get_class($this->obj);
			if ($class == "Rock")
			{
				if ($this->explo)
					return "<td class='boom'></td>";
				else
					return strval($this->obj);
			}
			else if (($class = "Ship" && Ship::$debug == true)
				|| (get_parent_class($this->obj) == "Ship" && Ship::$debug == true))
				return sprintf("<td class=\"collider\"></td>");
			else
			{
				if ($this->explo)
					return sprintf("<td class=\"%s\"></td>", "boom");
				else
					return "<td></td>";
			}
		}
	}
}
