<?php
/**
 * Class permettant d'utiliser un gameobject pour tirer
 */
class ShotController extends Controller
{
	public function __construct($model)
	{
		parent::__construct($model);
	}

	private function getTrajectory($dir)
	{
		switch ($dir) {
			case Ship::RIGHT:
				return [1,0];
				break;
			case Ship::TOP:
				return [0,-1];
				break;
			case Ship::LEFT:
				return [-1,0];
				break;
			case Ship::BOTTOM:
				return [0,1];
				break;
			default:
				throw new \Exception("Error Trajector Request", 1);
				break;
		}
	}

	public function shoot($gameobject)
	{
		if ($this->is_implements($gameobject, "Ishoot"))
		{
			$traj = $this->getTrajectory($gameobject->direction);
			$collider = $gameobject->collider;
			for ($line=0; $line < $gameobject->height; $line++)
			{
				for ($col=0; $col < $gameobject->width; $col++)
				{
					if ($collider[$line][$col] == 2)
					{
						$this->_model->add("shots", [
							"id_game"	=>	$gameobject->id_game,
							"y"			=>	$gameobject->y + $line,
							"x"			=>	$gameobject->x + $col,
							"traj_x"	=>	$traj[0],
							"traj_y"	=>	$traj[1],
							"dmg"		=>	$gameobject->dmg_weapon,
							"porte"		=>	$gameobject->porte_weapon
						]);
					}
				}
			}
			$this->has_shoot = 1;
			$gameobject->update();
		}
		else
			throw new \Exception("Object does'nt not implement move interface", 1);
	}

}
