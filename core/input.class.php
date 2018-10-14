<?php
/**
 * Class recevant les formulaires GET et POST
 * ET effectue les operations necessaires dans la bdd
 */
class Input
{
	public static	$error = false;

	private $_data;
	private $_model;
	private $gameId;
	private $_master;

	function __construct($master, $model, $gameId)
	{
		$this->_model = $model;
		$this->gameId = $gameId;
		$this->_data = new stdClass();
		$this->_master = $master;
		if ($_POST)
			foreach ($_POST as $key => $value)
				$this->_data->$key = $value;
		if ($_GET)
			foreach ($_GET as $key => $value)
				$this->_data->$key = $value;
		if (isset($this->_data->action) && isset($this->_data->id_game))
		{
			$this->dispatch($this->_data->action, $this->_data);
		}
	}

	public function dispatch($event, $data)
	{
		$info = $this->_model->selectFirst("games", NULL, ["id"=>$data->id_game]);
		if (!$info)
			throw new \Exception("Error Request Game ".$data->id_game, 1);
		$ship = $this->_master->GetShipInstance($data->id_ship);
		if (!$ship)
		{
			if (Input::$error)
				throw new \Exception("Input :: Error Request Ship ".$this->_master->current_ship, 1);
			else
				return ;
		}
		if ($event != 'pick' && ($info["id"] != $ship->id_game || $info["current_player"] != $ship->id_owner))
			return ;
		switch ($event)
		{
			case 'none':
				if ($ship->available && $info["id"] == $ship->id_game && $info["current_player"] == $ship->id_owner)
				{
					$this->_model->update("games", [
						"action"			=>	"dice",
						"current_ship"		=>	$ship->id
					],[
						"id"				=>	$data->id_game
					]);
				}
				break;
			case 'rotate':
				$controller = new MoveController($ship, $this->_model);
				$controller->rotate($ship, $data);
				break;
			case 'dice':
				$controller = new DiceController($ship, $this->_model);
				$controller->throwdice($ship);
				break;
			case 'enddice':
				break;
			case 'move':
				$controller = new MoveController($ship, $this->_model);
				$controller->move($ship, $data);
				break;
			case 'endmove':
				$ship->available = 0;
				$ship->update();
				$this->_model->update("games", [
					"action"			=>	"none",
					"current_ship"		=>	0
				],[
					"id"				=>	$data->id_game
				]);
				break;
			case 'fire':
				$shot_controller = new ShotController($this->_model);
				$shot_controller->shoot($ship);
				break;
			case 'usepp':
				$pp_control = new PPController($this->_model);
				$pp_control->modifypp($ship, $data);
				break;
			case 'endpp':
				if ($info["id"] == $ship->id_game && $info["current_player"] == $ship->id_owner)
				{
					$this->_model->update("games", [
						"action"			=>	"action",
						"current_ship"		=>	$ship->id
					],[
						"id"				=>	$data->id_game
					]);
				}
				break;
			default:
				break;
		}
		// echo "dispatch event";
	}
}
