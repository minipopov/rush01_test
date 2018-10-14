<?php
/**
 * Object responsable du mouvement dans la map
 */
class MoveController extends Controller
{
	public function rotate($gameobject, $data)
	{
		if ($this->is_implements($gameobject, "Imove"))
		{
			$this->default($data->w, 0);
			$data->w = intval($data->w);
			$gameobject->direction += $data->w;
			$gameobject->direction %= 4;
			if ($gameobject->direction < 0)
				$gameobject->direction += 4;
			$gameobject->update();
		}
		else
			throw new \Exception("Object does'nt not implement move interface", 1);
	}

	public function move($gameobject, $data)
	{
		if ($this->is_implements($gameobject, "Imove"))
		{
			$this->default($data->x, 0);
			$data->x = intval($data->x);
			$data->y = intval($data->y);
			$gameobject->x += $data->x;
			$gameobject->y += $data->y;
			$gameobject->update();
		}
		else
			throw new \Exception("Object does'nt not implement move interface", 1);
	}
}
