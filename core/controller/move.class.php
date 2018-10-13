<?php
/**
 * Object responsable du mouvement dans la map
 */
class Move extends Controller
{
	public function move($gameobject)
	{
		if ($this->implements($gameobject, "Imove"))
		{
			// getPos($gameobject);
			// $gameobject->move();
			// $gameobject->update();
		}
		else
			throw new \Exception("Object does'nt not implement move interface", 1);
	}
}
