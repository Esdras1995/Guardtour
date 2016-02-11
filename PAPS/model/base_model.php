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



	public function remove($table, $data){
		try {

		    $stmt = $this->conn->prepare("DELETE FROM $table WHERE id IN (" . implode(', ', $data).")");
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
			
			$stmt = $this->conn->prepare("SELECT " . $data . " FROM $table");
			$stmt->execute();
			$listpost = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			return $listpost;

		}catch(PDOException $e){

			echo $e->getMessage();
		}

	}
}






?>