<?php
/**
 * Dice controller
 */
class DiceController extends Controller
{
	const MAX = 6;

	function __construct($model)
	{
		parent::__construct($model);
	}

	public function throwdice($gameobject)
	{
		if ($this->is_implements($gameobject, "Igameobject"))
		{
			$dice = $gameobject->dice;
			$add = 0;
			for ($i=0; $i < $dice; $i++) {
				$add += mt_rand(1, DiceController::MAX);
			}
			$gameobject->pp += $add;
			$gameobject->dice = 0;
			$gameobject->update();
		}
		else
			throw new \Exception("Object does'nt not implement gameobject interface", 1);
	}
}
