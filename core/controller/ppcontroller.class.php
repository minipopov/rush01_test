<?php
/**
 * Class to handle pp
 */
class PPController extends Controller
{
	public function __construct($model)
	{
		parent::__construct($model);
	}

	public function modifypp($gameobject, $data)
	{
		if ($this->is_implements($gameobject, "Ipp"))
		{
			$this->default($data->hull, 0);
			$this->default($data->shield, 0);
			$this->default($data->move, 0);
			$this->default($data->power, 0);
			$data->hull = intval($data->hull);
			$data->shied = intval($data->shield);
			$data->move = intval($data->move);
			$data->power = intval($data->power);
			$ask_use = $data->hull + $data->shield + $data->power + $data->move;
			if ($ask_use > $gameobject->pp)
				throw new \Exception("request too mush pp", 1);
			$gameobject->pp -= $ask_use;
			$gameobject->hull += $data->hull;
			$gameobject->shield += $data->shield;
			$gameobject->power += $data->power;
			$gameobject->move += $data->move;
			$gameobject->update();
		}
		else
			throw new \Exception("Object does'nt not implement move interface", 1);
	}
}
