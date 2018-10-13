<?php
/**
 * Controller parent
 */
abstract class Controller
{
	private	$_model;

	function __construct($model)
	{
		$this->_model = $model;
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
