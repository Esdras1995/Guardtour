<?php

require_once("../model/models.php");

/**
* 
*/

class Post extends Model
{
	private $formModel;

	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function remove($table, $data){
		try {
			
			// $cols = array();

		 //    foreach($data as $key=>$val) {
		 //        $cols[] = "$key = '$val'";
		 //    }

		    $stmt = $this->conn->prepare("DELETE FROM $table WHERE id IN (" . implode(', ', $data).")");
		    $stmt->execute();

		} catch(PDOException $e){

				echo $e->getMessage();
			}
		
		return $stmt;
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