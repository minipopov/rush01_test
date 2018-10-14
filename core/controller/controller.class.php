<?php
/**
 * Controller parent
 */
abstract class Controller
{
	protected	$_model;

	function __construct($model)
	{
		$this->_model = $model;
	}

	protected function default(&$var, $def)
	{
		if (!isset($var) || empty($var))
			$var = $def;
	}

	protected function is_implements($object, $interface)
	{
		$arr = class_implements($object);
		foreach ($arr as $value) {
			if ($value == $interface)
				return (True);
		}
		return (False);
	}
}
