<?php
/**
 * Class de gestion de la database
 */
class Model
{
	static private $_link = NULL;
	private $_ip = "127.0.0.1";
	private $_port = 3306;
	private $_login = "root";
	private $_pass = "root";

	function __construct()
	{
		if (!$this->_link)
		{
			// Se Connecter
		}
	}
}
