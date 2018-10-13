<?php
/**
 * Class de gestion de la database
 */
class Model
{
	private $_link = NULL;
	private $_ip = "127.0.0.1";
	private $_port = 3306;
	private $_dbname = "db_warhammer";
	private $_login = "rush01";
	private $_pass = "rush01";

	function __construct()
	{
		$this->_link = mysqli_connect($this->_ip, $this->_login, $this->_pass, $this->_dbname);
		if (!$this->_link)
			die('Erreur de connexion (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
	}

	/*
	 * Met a jour des informations dans la bdd
	 * db_update($link, $table, $fields, $value)
	 *	@link	=>	object mysqli
	 *	@table	=>	nom de la table
	 *	@valeur	=>	Tableau associatif de clef valeur. Clef == Nom du champ, Value == sa valeur
	 *	@cond	=>	Tableau associatif de clef valeur. Clef == Nom du champ, Value == sa valeur
	 *
	 *	@return	True/false
	 */
	function    db_update($table, $value, $cond)
	{
		$this->db_format_cond($value, $arr, $arrval);
		$arr = implode(",", $arr);
		$this->db_format_cond($cond, $arr2, $arrval2);
	    $arr2 = implode(" AND ", $arr2);
	    $condtype = $this->db_cond_type($value) . $this->db_cond_type($cond);
	    $requ = "UPDATE $table SET $arr WHERE $arr2";
	    $prequ = mysqli_prepare($this->_link, $requ);
	    if ($prequ === False)
	    {
	        echo "Mysqli error : $requ";
			die();
	    }
	    $concat = array_values($value);
	    foreach ($cond as $val)
	        $concat[] = $val;
	    mysqli_stmt_bind_param($prequ, $condtype, ...$concat);
	    $ret = FALSE;
	    if (mysqli_stmt_execute($prequ) == TRUE)
	    {
	        $ret = TRUE;
	        mysqli_stmt_close($prequ);
	    }
		return ($ret);
	}

	/*
	 * Retourne un tableau de valeur
	 * db_select($link, $table, $fields, $value)
	 *	@link	=>	object mysqli
	 *	@table	=>	nom de la table
	 *	@fields	=>	Simple tableau de string contenant les champs de la database a selectionner. NULL <=> *
	 *	@cond	=>	Tableau associatif de clef valeur. Clef == Nom du champ, Value == sa valeur
	 *
	 *	@return	array
	 */

	public function select($table, $field = NULL, $cond = NULL, $opt = "")
	{
		if ($field === NULL)
	        $data = "*";
	    else
	        $data = implode(",", $field);
	    $requ = "SELECT $data FROM `$table`";
	    if ($cond !== NULL)
	    {
	        $arr = [];
	        $arrval = [];
	        $condtype = $this->db_cond_type($cond);
	        $this->db_format_cond($cond, $arr, $arrval);
	        $arr = implode(" AND ", $arr);
	        $requ .= " WHERE $arr";
	    }
		if ($opt != "")
			$requ .= " $opt";
	    $prequ = mysqli_prepare($this->_link, $requ);
	    if ($prequ === False)
	    {
	        echo "Mysqli error : $requ";
			die();
	    }
	    if ($cond !== NULL)
			mysqli_stmt_bind_param($prequ, $condtype, ...$arrval);
	    $ret = [];
	    if (mysqli_stmt_execute($prequ) == TRUE)
	    {
	        $res = mysqli_stmt_get_result($prequ);
	        while (($row = mysqli_fetch_assoc($res))) {
	            $ret[] = $row;
	        }
	        mysqli_stmt_close($prequ);
		}
		return ($ret);
	}

	public function selectFirst($table, $field = NULL, $cond = NULL, $opt = "")
	{
		$ret = $this->select($table, $field, $cond, $opt);
		if ($ret != NULL)
			return $ret[0];
		return (NULL);
	}

	/*
	 * Supprime une entree dans la bdd
	 * db_delete($link, $table, $value)
	 *	@link	=>	object mysqli
	 *	@table	=>	nom de la table
	 *	@value	=>	Tableau associatif ["nom du champ"	=>	valeur,....]
	 *
	 *	@return	true/false
	 */
	function    delete($table, $cond = NULL)
	{
	    $requ = "DELETE FROM `$table`";
	    if ($cond !== NULL)
	    {
	        $arr = [];
	        $arrval = [];
	        $condtype = $this->db_cond_type($cond);
	        $this->db_format_cond($cond, $arr, $arrval);
	        $arr = implode(" AND ", $arr);
	        $requ .= " WHERE $arr";
	    }
	    $prequ = mysqli_prepare($this->_link, $requ);
	    if ($prequ === False)
	    {
	        echo "Mysqli error : $requ";
			die();
	    }
	    if ($cond !== NULL)
			mysqli_stmt_bind_param($prequ, $condtype, ...$arrval);
	    $ret = false;
	    if (mysqli_stmt_execute($prequ) == TRUE)
	        $ret = true;
	    return ($ret);
	}

	/*
	 * Ajoute une entree dans la bdd
	 * db_add($link, $table, $value)
	 *	@table	=>	nom de la table
	 *	@value	=>	Tableau associatif ["nom du champ"	=>	valeur,....]
	 *
	 *	@return True/false
	 */
	function    add($table, $value)
	{
	    $strkey = implode(",", array_keys($value));
	    $tab = [];
	    foreach ($value as $val)
	        $tab[] = "?";
	    $condtype = $this->db_cond_type($value);
	    $value = array_values($value);
	    $tab = implode(",", $tab);
	    $requ = "INSERT INTO `$table` ($strkey) VALUES ($tab)";
	    $prequ = mysqli_prepare($this->_link, $requ);
	    if ($prequ === False)
	    {
	        echo "Mysqli error : $requ";
			die();
	    }
		if ($value !== NULL)
	        mysqli_stmt_bind_param($prequ, $condtype, ...$value);
	    $ret = false;
	    if (mysqli_stmt_execute($prequ) == TRUE)
	        $ret = true;
	    return ($ret);
	}

	private function db_format_cond($cond, &$arr, &$arrval)
	{
	    $arr = [];
	    $arrval = [];
	    foreach ($cond as $k => $v)
	    {
	        $arr[] = "$k = ?";
	        $arrval[] = $v;
	    }
	}
	private function db_cond_type($cond)
	{
	    $ret = "";
	    foreach ($cond as $k => $v)
	    {
	        if (is_string($v))
	            $ret .= "s";
	        else if (is_numeric($v))
	            $ret .= "i";
	    }
	    return ($ret);
	}
}
