<?php
/*
Put next code in setup file and include before this file. Or only uncoment this an set the vars..
define('DB_HOST', '');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');
*/
class db{
	private $dbhost;
	private $dbuser;
	private $dbpass;
	private $dbname;
	private $conn;

/*Constructor*/
	function __construct($dbuser = DB_USER, $dbpass = DB_PASS, $dbname = DB_NAME, $dbhost = DB_HOST){
		$this->dbhost = $dbhost;
		$this->dbuser = $dbuser;
		$this->dbpass = $dbpass;
		$this->dbname = $dbname;
	}

/*Make connection to database*/
	public function sql_open(){

		$this->conn = @mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass,$this->dbname); 
		
		if (mysqli_connect_errno())
		{
			array_push($GLOBALS["error"],mysqli_connect_errno().' - '.mysqli_connect_error().' Check Database Connections in config.php ;) </p>');
		}else{
			mysqli_set_charset($this->conn,"utf8"); //Quita el problema de los acentos.
		}
	}

/*WARNING!! Insecure Query, be carefull,.
Return: array*/
	public function sql_query_read($query){
		$valores = array();
		$result = @mysqli_query($this->conn,$query);
		if (!$result) {
			array_push($GLOBALS["error"],'<p>Error sql_query_read '.$query.'</p>');
		}else{
			$num_rows= mysqli_num_rows($result);
			for($i=0;$i<$num_rows;$i++){
				$row = mysqli_fetch_assoc($result);
				array_push($valores, $row);
			}
		}
		return $valores;
	}

/*WARNING!! Insecure Query, be carefull..
Return: boolean
*/
	public function sql_query_execute($sql){
		if ($sql)
		{
			$result=@mysqli_query($this->conn,$sql);
		}
		 if (!$result) {
			array_push($GLOBALS["error"], '<p>Error sql_query_execute '.$sql.'</p>');
			return false;
		}else{    
			return true;
		}
	}

//Get last reg id (from primary key)
//Return: id from current insert reg.
	public function sql_id(){
		return mysqli_insert_id($this->conn);
	}

//Close current connection
	public function sql_close(){
		@mysqli_close($this->conn);   
	}

//Clean input value..Use this.
	public function sql_escape($value){
		return mysqli_real_escape_string($this->conn,$value);
	}

/*-------------------------------------------Your Custom Class INI
//------------*******Code********
//-------------------------------------------Your Custom Class END
*/
}
