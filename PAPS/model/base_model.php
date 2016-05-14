<?php

require_once("Database.php");
require_once 'dbconfig.php';

/**
* 
*/
class Model implements iDatabase
{
	protected $conn;

	function __construct()
	{
		# code...

		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
	}

	public function query($query){
		try {
			
		    $stmt = $this->conn->prepare($query);
		    $stmt->execute();

		} catch(PDOException $e){

			echo $e->getMessage();
		}
		return $stmt;
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
		    	$val = str_replace("'", "\'", $val);
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
 
	public function getBy($table, $value, $by, $val){
		return $this->dynamicSelect($table, $by." = ?", array($val), $value)[$value];
	}

	public function count($table, $where){
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM $table WHERE $where");
			$stmt->execute();
			// $userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
			// echo "------------------------------------------";
			// echo $stmt->rowCount();
			return $stmt->rowCount();
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function _count($table){
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM $table");
			$stmt->execute();
			// $userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
			// echo "------------------------------------------";
			// echo $stmt->rowCount();
			return $stmt->rowCount();
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
		'tours' => array('id', 'date_tour', 'heure', 'qrcode', 'mention', 'photo', 'matricule','description', 'guardtours_id'),
		'guardtours' => array('id', 'intervale', 'intervale_limit', 'commence_a', 'termine_a', 'poste_id', 'guard_id'),
		'admin' => array('id', 'nom', 'prenom', 'username', 'email', 'password', 'date_created'),
		'signature' => array('id', 'nom', 'signature', 'role'),
		'report' => array('id', 'numdossier', 'liste_reporte', 'date', 'client', 'signature_id'),
		'company' => array('id', 'nom', 'adress', 'contact', 'email')
	);

	public static function getListKey(){

		return self::$KEYS_MODEL;
	}
}






?>