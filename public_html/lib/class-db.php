<?php

class MySql_DB
{
	private $Debug = true;
	private $rc = null;
	private $charset = 'utf8';
	var $alertEmail = '';
	var $alertFile  = '';

	//function Connect(){
	function __construct($HOST, $DB_NAME, $DB_USER, $DB_PASS, $debug = true, $charset = '')
	{
		if ($debug) $this->Debug = $debug;

		//richiesta connessione
		//$connessione = @mysql_connect($HOST, $DB_USER, $DB_PASS, true); 

		$connessione = @mysqli_connect($HOST, $DB_USER, $DB_PASS, $DB_NAME);

		if (!$connessione)
			die($this->db_error('Database not available'));

		//selezione del database
		//@mysql_select_db($DB_NAME, $connessione);
		//if(mysql_error($connessione))
		//	return $this->db_error(mysql_error($connessione));

		$this->rc = $connessione;

		if ($charset) {
			$this->charset = $charset;
			$this->charsetDB();
		}

		//$this->Query('SET time_zone = "Europe/Rome"');
	}

	private function charsetDB()
	{
		$this->Query("SET NAMES " . $this->charset);
	}

	//query sulla tabella 
	function Query($sql)
	{
		$res = @mysqli_query($this->rc, $sql);
		if (mysqli_error($this->rc))
			return $this->db_error(mysqli_error($this->rc), $sql);

		return $res;
	}

	//estrazione di un record
	function FetchRow($sql)
	{
		$rows = @mysqli_fetch_row($sql);
		if (mysqli_error($this->rc))
			return $this->db_error(mysqli_error($this->rc), $sql);

		return $rows;
	}

	//conteggio dei records
	function FetchNum($sql)
	{
		$num = @mysqli_num_rows($sql);
		if (mysqli_error($this->rc))
			return $this->db_error(mysqli_error($this->rc), $sql);

		return $num;
	}

	//estrazione dei records 
	function FetchArray($sql)
	{
		$array = @mysqli_fetch_array($sql);
		if (mysqli_error($this->rc))
			return $this->db_error(mysqli_error($this->rc), $sql);

		return $array;
	}

	//estrazione dei records  
	function FetchAssoc($sql)
	{
		$array = @mysqli_fetch_assoc($sql);
		if (mysqli_error($this->rc))
			return $this->db_error(mysqli_error($this->rc), $sql);

		return $array;
	}

	function FetchObject($sql)
	{
		$objdata = @mysqli_fetch_object($sql);
		if (mysqli_error($this->rc))
			return $this->db_error(mysqli_error($this->rc), $sql);

		return $objdata;
	}

	//ultimo id inserito
	function LastId()
	{
		$id = @mysqli_insert_id($this->rc);
		if (mysqli_error($this->rc))
			return $this->db_error(mysqli_error($this->rc));

		return $id;
	}

	function NumRows($sql)
	{
		$n = @mysqli_num_rows($sql);
		if (mysqli_error($this->rc))
			return $this->db_error(mysqli_error($this->rc));

		return $n;
	}

	function EmptyMem($result)
	{
		@mysqli_free_result($result);
		if (mysqli_error($this->rc))
			return $this->db_error(mysqli_error($this->rc));

		return TRUE;
	}


	function CycleArray($sql)
	{
		$x = 0;
		while ($dati = @mysqli_fetch_assoc($sql)) {
			$array[0][$x] = $dati['id'];
			$array[1][$x] = $dati['nome'];
			$x++;
		}
		if (mysqli_error($this->rc))
			return $this->db_error(mysqli_error($this->rc), $sql);

		return $array;
	}

	function CycleField($sql)
	{
		$x = 0;
		while ($dati = @mysqli_fetch_assoc($sql)) {
			$array[$x] = $dati['nome'];
			$x++;
		}
		if (mysqli_error($this->rc))
			return $this->db_error(mysqli_error($this->rc), $sql);

		return $array;
	}

	function CycleAssochId($sql)
	{

		while ($dati = @mysqli_fetch_assoc($sql)) {
			$array[$dati['id']] = $dati['nome'];
		}
		if (mysqli_error($this->rc))
			return $this->db_error(mysqli_error($this->rc), $sql);

		return $array;
	}


	function CycleAssoch($sql)
	{
		$x = 0;
		$field = @mysqli_num_fields($sql);

		while ($dati = @mysqli_fetch_assoc($sql)) {
			for ($k = 0; $k < $field; $k++)
				$array[$x][mysqli_fetch_field_direct($sql, $k)] = $dati[mysqli_fetch_field_direct($sql, $k)];

			$x++;
		}
		if (mysqli_error($this->rc))
			return $this->db_error(mysqli_error($this->rc), $sql);

		return $array;
	}

	function GetPagination($query, $pagina, $quanti)
	{
		$sql = $this->Query($query);
		$array['tot']         = $this->NumRows($sql);
		$array['start']       = 1; #($pagina - 1) * $quanti ;
		$array['last_page']   = ceil($array['tot']  / $quanti);
		$array['quanti']      = $quanti;
		return $array;
	}



	//estrae direttamente il valore di un campo
	function SingleField($field, $table, $where)
	{
		$query = $this->Query("SELECT " . $field . " FROM " . $table . " " . $where);
		$field = $this->FetchRow($query);
		$this->EmptyMem($query);

		return $field[0];
	}

	function escapeString($value)
	{
		return mysqli_real_escape_string($this->rc, $value);
	}

	//visualizza errori
	function db_error($msg, $query = "")
	{
		if ($this->Debug)
			die($msg . "\n\n" . $query);
		else
			return FALSE;
	}

	//chiusura della connessione
	function Close()
	{
		@mysqli_close($this->rc);
	}

	//function Close(){
	function __destruct()
	{
		$this->Close();
	}


	function debugEmail($file)
	{

		if ($this->alertEmail != '') {
			$this->alertFile = $file;
			//mail("djamal@archynet.it", "ERRORE OPERAZIONE FILE", ": FILE :  \n" . $this->alertFile . " \n QUERY: \n" . $this->alertEmail . "\n ", "From:debug@mediawebsms.com", "");
		}
	}
}
