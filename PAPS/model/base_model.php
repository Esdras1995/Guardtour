<?php

require_once("Database.php");
require_once 'dbconfig.php';

/**
* 
*/
class Model implements iDatabase
{
	protected $conn;
	protected $form;

	function __construct()
	{
		# code...

		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
	}



	public function update($table, $data, $where){

		try {
			
			$cols = array();

		    foreach($data as $key=>$val) {
		        $cols[] = "$key = '$val'";
		    }

		    $stmt = $this->conn->prepare("UPDATE $table SET " . implode(', ', $cols) . " WHERE $where");
		    $stmt->execute();

		} catch(PDOException $e){

				echo $e->getMessage();
			}
		
		return $stmt;
	}



	public function remove($table, $data, $where){
		try {

		    $stmt = $this->conn->prepare("DELETE FROM $table WHERE $where IN (" . implode(', ', $data).")");
		    $stmt->execute();

		} catch(PDOException $e){

				echo $e->getMessage();
			}
		
		return $stmt;
	}

	

	public function add($table, $data){

		try {
			
			$cols = array();

		    foreach($data as $key=>$val) {
		        $cols[] = "$key = '$val'";
		    }

		    $stmt = $this->conn->prepare("INSERT INTO $table SET " . implode(', ', $cols));
		    $stmt->execute();

		} catch(PDOException $e){

				echo $e->getMessage();
			}
		
		return $stmt;
	}

	public function _list($table, $data){
		try
		{	
			// if($data == "*")
			$stmt = $this->conn->prepare("SELECT " . $data . " FROM $table");
			$stmt->execute();
			$listpost = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			return $listpost;

		}catch(PDOException $e){

			echo $e->getMessage();
		}

	}

	public function dynamicSelect($table, $where, $value, $element){
		try
		{
			$stmt = $this->conn->prepare("SELECT $element FROM $table WHERE $where");
			$stmt->execute($value);

			$selected=$stmt->fetch(PDO::FETCH_ASSOC);

			return $selected;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function dynamicSelectAll($table, $where, $element){
		try
		{
			$stmt = $this->conn->prepare("SELECT $element FROM $table WHERE $where");
			$stmt->execute();

			$selected=$stmt->fetchAll(PDO::FETCH_ASSOC);

			return $selected;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}


/**
* 
*/
class Constants
{
	/* Les colonnes des tableaux de la base sont stockes ici */
	private static $KEYS_MODEL = array(
		'poste' => array('id', 'nom', 'adress', 'contact'),
		'guard' => array('id', 'nom', 'prenom', 'uid', 'photo', 'email', 'phone', 'nif'),
		'tours' => array('id', 'date_tour', 'heure', 'qrcode', 'mention', 'description', 'guardtours_id'),
		'guardtours' => array('id', 'intervale', 'intervale_limit', 'commence_a', 'termine_a', 'poste_id', 'guard_id'),
		'admin' => array('id', 'nom', 'prenom', 'username', 'email', 'password', 'date_created') 
	);

	public static function getListKey(){

		return self::$KEYS_MODEL;
	}
}






?>