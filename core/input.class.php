<?php
/**
 * Class recevant les formulaires GET et POST
 * ET effectue les operations necessaires dans la bdd
 */
class Input
{
	private $_data;

	function __construct()
	{
		$this->_data = new stdClass();
		if ($_POST)
		{
			foreach ($_POST as $key => $value) {
				$this->_data->$key = $value;
			}
		}
		if ($_GET)
		{
			foreach ($_GET as $key => $value) {
				$this->_data->$key = $value;
			}
		}
		$this->dispatch();
	}

	public function dispatch()
	{
		// echo "dispatch event";
	}
}
