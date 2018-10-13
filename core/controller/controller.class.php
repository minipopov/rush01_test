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
}
