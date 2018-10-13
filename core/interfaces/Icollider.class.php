<?php

/**
 * ICollider
 */
interface Icollider
{
	public function exportCollider(&$cases);
	public function onCollider($gameobject);
}
