<?php

require_once("Database.php");
require_once 'dbconfig.php';

/* function to build SQL UPDATE string */
// function build_sql_update($table, $data, $where)
// {
    // $cols = array();

    // foreach($data as $key=>$val) {
    //     $cols[] = "$key = '$val'";
    // }
//     $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";
 
//     return($sql);
// }


/**
* 
*/

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



	public function remove($table, $data, $where){}

	

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
		// try
		// 	{	
				
		// 		if($data == "*")
		// 			$stmt = $this->conn->prepare("SELECT * FROM $table");
				
		// 		else
		// 			$stmt = $this->conn->prepare("SELECT " . implode(', ', $cols) . " FROM poste");

		// 		$stmt->execute();
		// 		$listpost=$stmt->fetchAll(PDO::FETCH_ASSOC);
				
		// 		return $listpost;
		// 	}
		// 	catch(PDOException $e)
		// 	{
		// 		echo $e->getMessage();
		// 	}
	// }
}


class Post extends Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

}


class Guard extends Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}
}


class Tours extends Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

}


class GuardTours extends Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}
}






















?>