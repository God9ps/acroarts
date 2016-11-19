<?php
class BDMySQL {
	var $conn;
	function ligarBD($nomebd, $user, $pass, $server) {
		try {
			$this->conn = new PDO("mysql:host=$server;dbname=$nomebd", $user, $pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			//$this->conn = new PDO("mysql:host=$server;dbname=$nomebd", $user, $pass);
			//$this->conn->exec("SET NAMES 'utf8';");
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			echo "<br>" . $e->getMessage();
		}


//		$this->conn = mysql_connect ( $server, $user, $pass );
//		if ($this->conn < 0) {
//			return - 1;
//		}
//		if (mysql_select_db ( $nomebd, $this->conn ) == false) {
//			return - 1;
//		}
	}
	
	function executarSQL($sql_command) {
		/*mysql_query("SET character_set_results = 'utf8',
                 character_set_client = 'utf8',
                 character_set_connection = 'utf8',
                 character_set_database = 'utf8',
                 character_set_server = 'utf8'");*/
		/*mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
        mysql_query("SET time_zone='-01:00';");*/
		/*$resultado = mysql_query ( $sql_command, $this->conn );*/
		$resultado=$this->conn->query($sql_command);
		return $resultado;
	}

	function executarSQL_T($sql_command) {
		try {
			$this->conn->beginTransaction();
			$this->conn->exec($sql_command);
			$this->conn->commit();
			return true;
		}
		catch(PDOException $e)
		{
			// roll back the transaction if something failed
			$this->conn->rollback();
			echo "Error: " . $e->getMessage();
		}
	}

	function executarSQLWithID($sql_command) {
		$resultado=$this->conn->query($sql_command);
		if($resultado)
			return $this->conn->lastInsertId();
		else
			return false;
	}

	function executarSQL_T_WithID($sql_command) {
		try {
			$this->conn->beginTransaction();
			$this->conn->exec($sql_command);
			$this->conn->commit();
			return $this->conn->lastInsertId();
		}
		catch(PDOException $e)
		{
			// roll back the transaction if something failed
			$this->conn->rollback();
			echo "Error: " . $e->getMessage();
		}
	}
	
	/*function numero_tuplos($tabela) {
		$tuplos = 0;
		$rs = $this->executarSQL ( "SELECT * FROM $tabela" );
		while ( mysql_fetch_row ( $rs ) ) {
			$tuplos ++;
		}
		return $tuplos;
	}*/
	
	function fecharBD() {
		//mysql_close ( $this->conn );
        $this->conn=null;
	}
}

?>