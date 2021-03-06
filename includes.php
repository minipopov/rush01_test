<?php

/*
**	interfaces
*/

include_once $_SERVER['DOCUMENT_ROOT']."/core/interfaces/Igameobject.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/interfaces/Imove.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/interfaces/Ishoot.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/interfaces/Icollider.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/interfaces/Ipp.class.php";

/*
**	Controller
*/

include_once $_SERVER['DOCUMENT_ROOT']."/core/controller/controller.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/controller/movecontroller.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/controller/ppcontroller.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/controller/dicecontroller.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/controller/shotcontroller.class.php";

include_once $_SERVER['DOCUMENT_ROOT']."/core/gameobject/rock.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/gameobject/ship.class.php";

include_once $_SERVER['DOCUMENT_ROOT']."/core/model/model.class.php";

include_once $_SERVER['DOCUMENT_ROOT']."/core/spawn/spawn.class.php";

include_once $_SERVER['DOCUMENT_ROOT']."/core/map/map.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/map/mapcase.class.php";

include_once $_SERVER['DOCUMENT_ROOT']."/core/input.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/matrice.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/player.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/master.class.php";

/*
**	Ship
*/

include_once $_SERVER['DOCUMENT_ROOT']."/core/gameobject/anaconda.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/gameobject/clipper.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/gameobject/destroyer.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/gameobject/falcon.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/gameobject/python.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/gameobject/unknown.class.php";
