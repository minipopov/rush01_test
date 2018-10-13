<?php
abstract class Matrice
{
	public function rot90($matrix)
	{
		$newMat = array();
		foreach($matrix as $line){
			foreach($line as $k => $v) {
				if(!isset($newMat[$k]))
					$newMat[$k] = array();
				array_unshift($newMat[$k],$v);
			}
		}
		return $newMat;
	}

	public function rot180($matrice)
	{
		$newMat = array();
		$i = 0;
		for ($line= count($matrice) - 1; $line > -1 ; $line--) {
			$newMat[$i] = array_reverse($matrice[$line]);
			$i++;
		}
		return ($newMat);
	}

	public function rot270($mat)
	{
		$newMat = array();
		foreach ($mat as $line) {
			$line = array_reverse($line);
			foreach ($line as $key => $c) {
				$newMat[$key][] = $c;
			}
		}
		return ($newMat);
	}

	public function shipTransform($ship)
	{
		$orientation = $ship->dir;
		$mat = $ship->collider;
		if ($orientation == Ship::TOP)
		{
			$add = count($mat[0]) / 2;
			$mat = Matrice::rot270($mat);
			$add2 = $add - count($mat[0]) / 2;
			$tmp = $ship->width;
			$ship->width = $ship->height + $add2;
			$ship->height = $tmp;
			foreach ($mat as $k => $line)
				array_unshift($mat[$k], ...array_fill(0, $add2, 0));
			return $mat;
		}
		else if ($orientation == Ship::BOTTOM)
		{
			$add = count($mat[0]) / 2;
			$mat = Matrice::rot90($mat);
			$add2 = $add - count($mat[0]) / 2;
			$tmp = $ship->width;
			$ship->width = $ship->height + $add2;
			$ship->height = $tmp;
			foreach ($mat as $k => $line)
				array_unshift($mat[$k], ...array_fill(0, $add2, 0));
			return $mat;
		}
		else if ($orientation == Ship::LEFT)
			return Matrice::rot180($mat);
		else
			return ($mat);
	}
}
