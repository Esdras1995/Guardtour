<?php

	require_once 'dbconfig.php';

	/**
	* 
	*/
	class PostService
	{
		
		private $conn;
	
		public function __construct()
		{
			$database = new Database();
			$db = $database->dbConnection();
			$this->conn = $db;
	    }
		
		public function runQuery($sql)
		{
			$stmt = $this->conn->prepare($sql);
			return $stmt;
		}

		public function insertTours($date_tour, $qrcode, $description, $guard_id){
			$guard_id = 1;
			try{
				$stmt = $this->conn->prepare("INSERT INTO tours(date_tour, qrcode, description, guard_id) 
			                                               VALUES(:date_tour, :qrcode, :description, :guard_id)");

				$stmt->bindparam(":date_tour", $date_tour);
				$stmt->bindparam(":qrcode", $qrcode);
				$stmt->bindparam(":description", $description);
				$stmt->bindparam(":guard_id", $guard_id);
					
				$stmt->execute();	
				
				return $stmt;
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}	
		}

		// private function getGuardId(uid){
		// 	try
		// 	{
		// 		$stmt = $this->conn->prepare("SELECT id FROM guard WHERE uid=:uid");
		// 		$stmt->execute(array(':uid'=>$uid));
		// 		$uidRow=$stmt->fetch(PDO::FETCH_ASSOC);
				
		// 		// if($stmt->rowCount() == 1)
		// 		// {
		// 		// 	//if(password_verify($upass, $userRow['password']))
		// 		// 	if($upass == $userRow['password'])
		// 		// 	{
		// 		// 		echo "tout va bien!!!";
		// 		// 		$_SESSION['user_session'] = $userRow['id'];
		// 		// 		return true;
		// 		// 	}
		// 		// 	else
		// 		// 	{
		// 		// 		return false;
		// 		// 	}
		// 		// }
		// 	}
		// 	catch(PDOException $e)
		// 	{
		// 		echo $e->getMessage();
		// 	}
		// }
	}

?>