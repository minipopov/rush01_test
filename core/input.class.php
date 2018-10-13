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
			foreach ($_POST as $key => $value)
				$this->_data->$key = $value;
		if ($_GET)
			foreach ($_GET as $key => $value)
				$this->_data->$key = $value;
		if (isset($this->_data->_action))
			$this->dispatch($this->_data->_action, $this->_data);
	}

	public function dispatch($event, $data)
	{
		switch ($event)
		{
			case 'move':
				break;
			case 'shoot':
				break;
			case 'pp':
				break;
			default:
				break;
		}
		// echo "dispatch event";
	}
}
