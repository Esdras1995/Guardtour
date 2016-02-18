<?php

	require_once 'dbconfig.php';

	/**
	* e0504fd1d65f789b
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

		public function redirect($url){
			header("Location: $url");
		}

		public function insertTours($date_tour, $qrcode, $description, $uid){
			try{

				$guard_id = $this->getGuardId($uid);

				if($guard_id == -1)
					return false;

				$stmt = $this->conn->prepare("INSERT INTO tours(date_tour, qrcode, description, guard_id) 
			                                               VALUES(:date_tour, :qrcode, :description, :guard_id)");

				$stmt->bindparam(":date_tour", $date_tour);
				$stmt->bindparam(":qrcode", $qrcode);
				$stmt->bindparam(":description", $description);
				$stmt->bindparam(":guard_id", $guard_id);
					
				$stmt->execute();	
				
				// $mention = $this->getMention($date_tour, $guard_id);
				// $tours_id = $this->getToursId($date_tour);

				// $this->registerReport($mention, $tours_id);

				return $stmt;
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}

		public function listTours(){
			try
			{
				$stmt = $this->conn->prepare("SELECT * FROM tours");
				$stmt->execute();
				$listtours=$stmt->fetchAll(PDO::FETCH_ASSOC);
				
				return $listtours;
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}

		}

		public function getMention($date_tour, $guard_id){
			
			$dt = new DateTime($date_tour);

			// $date = $dt->format('m/d/Y');
			$time = $dt->format('H:i:s');
			echo "Time tours: ".$time."<br/>";
			$arrayGuardTools = $this->getGuardTools($guard_id);
			

			$intervale = $arrayGuardTools["intervale"];
			$openAt = $arrayGuardTools["openAt"];
			$closeAt = $arrayGuardTools["closeAt"];

			if($openAt > $closeAt){
				$closeAt = $this->sumTime($closeAt, "12:00:00");

				echo "diff: ".$closeAt;
			}

		}

		public function sumTime($t1, $t2){
			
			$t1 = strtotime($t1)-strtotime("00:00:00");
			$result = date("H:i:s", strtotime($t2)+$t1);

			return $result;			
		}

		public function diffTime($t1, $t2){

			$t2 = strtotime($t2)-strtotime("00:00:00");
			$result = date("H:i:s", strtotime($t1)-$t2);

			return $result;			
		}

		public function getToursId($date_tour){

		}

		public function getGuardTools($guard_id){
			try
			{
				$stmt = $this->conn->prepare("SELECT intervale, openAt, closeAt FROM guardtours WHERE guard_id=:guard_id");
				$stmt->execute(array(':guard_id'=>$guard_id));
				$arrayGuardTools=$stmt->fetch(PDO::FETCH_ASSOC);
				
				return $arrayGuardTools;
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}

		public function registerReport($mention, $tours_id){
			try{

				$stmt = $this->conn->prepare("INSERT INTO report(mention, tours_id) 
			                                               VALUES(:mention, :tours_id)");

				$stmt->bindparam(":mention", $mention);
				$stmt->bindparam(":tours_id", $tours_id);
					
				$stmt->execute();	
				
				return $stmt;
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}

		public function getPostId($address){
			try
			{
				$stmt = $this->conn->prepare("SELECT id FROM poste WHERE adress=:address");
				$stmt->execute(array(':address'=>$address));
				$addressRow=$stmt->fetch(PDO::FETCH_ASSOC);
				
				if($stmt->rowCount() == 1)
				{
					//if(password_verify($upass, $userRow['password']))
					$id = $addressRow['id'];
					
					return $id;
				
				}else{
					
					return -1;
				}
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}

		public function getGuardUid($id){
			try
			{
				$stmt = $this->conn->prepare("SELECT uid FROM guard WHERE id=:id");
				$stmt->execute(array(':id'=>$id));
				$idRow=$stmt->fetch(PDO::FETCH_ASSOC);
				
				// echo $id." ------ ";
				if($stmt->rowCount() >= 1)
				{
					//if(password_verify($upass, $userRow['password']))
					$uid = $idRow['uid'];
					
					return $uid;
				
				}else{
					
					return -1;
				}
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}

		public function getGuardId($uid){
			try
			{
				$stmt = $this->conn->prepare("SELECT id FROM guard WHERE uid=:uid");
				$stmt->execute(array(':uid'=>$uid));
				$uidRow=$stmt->fetch(PDO::FETCH_ASSOC);
				
				if($stmt->rowCount() == 1)
				{
					//if(password_verify($upass, $userRow['password']))
					$id = $uidRow['id'];
					
					return $id;
				
				}else{
					
					return -1;
				}
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}

		public function listGuard(){
			try
			{
				$stmt = $this->conn->prepare("SELECT * FROM guard");
				$stmt->execute();
				$listguard=$stmt->fetchAll(PDO::FETCH_ASSOC);
				
				return $listguard;
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}	
		}

		public function listPost(){
			try
			{
				$stmt = $this->conn->prepare("SELECT * FROM poste");
				$stmt->execute();
				$listpost=$stmt->fetchAll(PDO::FETCH_ASSOC);
				
				return $listpost;
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}	
		}

		public function registerTools($heure, $intervale, $debut, $fin, $guard_id, $post_id){
			try{

				// $guard_id = $this->getGuardId($uid);
				// $post_id = $this->getPostId($address);

				// if($guard_id == -1 || $post_id == -1)
				// 	return false;
				$stmt = $this->conn->prepare("INSERT INTO guardtours(heure, intervale, openAt, closeAt, guard_id, poste_id) 
			                                               VALUES(:heure, :intervale, :debut, :fin, :guard_id, :post_id)");

				$stmt->bindparam(":heure", $heure);
				$stmt->bindparam(":intervale", $intervale);
				$stmt->bindparam(":debut", $debut);
				$stmt->bindparam(":fin", $fin);
				$stmt->bindparam(":guard_id", $guard_id);
				$stmt->bindparam(":post_id", $post_id);
					
				$stmt->execute();	
				
				return $stmt;
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}

		
	}

?>