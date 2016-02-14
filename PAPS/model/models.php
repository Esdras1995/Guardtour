<?php

require_once("../model/base_model.php");

/**
* 
*/

class User extends Model
{	

	function __construct()
	{
		# code...
		parent::__construct();
	}
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function exist($uname, $umail){
		try
		{
			$stmt = $this->conn->prepare("SELECT id FROM admin WHERE username=:uname OR email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

			// echo $stmt->rowCount();
			
			if($stmt->rowCount() >= 1)
				return true;

			return false;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
		
	public function doLogin($uname,$umail,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT id, username, email, password FROM admin WHERE username=:uname OR email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

			echo $stmt->rowCount();
			
			if($stmt->rowCount() == 1)
			{
				//if(password_verify($upass, $userRow['password']))
				if(md5($upass) == $userRow['password'])
				{
					echo "tout va bien!!!";
					$_SESSION['user_session'] = $userRow['id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}

	public function getUserRow($user_id)
	{

	  $stmt = $this->runQuery("SELECT * FROM admin WHERE id=:user_id");
	  $stmt->execute(array(":user_id"=>$user_id));
	  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	  
	  return $userRow;
	}
}
class Post extends Model
{
	private $formModel;

	function __construct()
	{
		# code...
		parent::__construct();
	}

	// public function dynamicSelect($where, $value, $element){
	// 	try
	// 	{
	// 		$stmt = $this->conn->prepare("SELECT $element FROM poste WHERE $where");
	// 		$stmt->execute($value);

	// 		$selected=$stmt->fetch(PDO::FETCH_ASSOC);

	// 		return $selected;
	// 	}
	// 	catch(PDOException $e)
	// 	{
	// 		echo $e->getMessage();
	// 	}
	// }

	public function exist($adress){
		try
		{
			$stmt = $this->conn->prepare("SELECT id FROM poste WHERE adress=:adress ");
			$stmt->execute(array(':adress'=>$adress));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() >= 1)
				return true;

			return false;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}


class Guard extends Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	// public function dynamicSelect($where, $value, $element){
	// 	try
	// 	{
	// 		$stmt = $this->conn->prepare("SELECT $element FROM guard WHERE $where");
	// 		$stmt->execute($value);

	// 		$selected=$stmt->fetch(PDO::FETCH_ASSOC);

	// 		return $selected;
	// 	}
	// 	catch(PDOException $e)
	// 	{
	// 		echo $e->getMessage();
	// 	}
	// }

	public function getId($where, $value){
		
		try
		{
			$stmt = $this->conn->prepare("SELECT id FROM guard WHERE $where");
			$stmt->execute($value);

			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

			return $userRow['id'];
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}	
}


class Tours extends Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function getMention($heure, $guard_tours_id){

		$guard_tours = new Model();

		$array = $guard_tours->dynamicSelect("guardtours", "id = ?", array($guard_tours_id), "intervale, intervale_limit, commence_a, termine_a");

		$intervale = $array['intervale'];
		$intervale_limit = $array['intervale_limit'];
		$commence_a = $array['commence_a'];
		$termine_a = $array['termine_a'];

		$diff_heure = intval(strtotime($heure)) - intval(strtotime($commence_a));
		$intervale = intval(strtotime($intervale) - strtotime("00:00:00"));

		$result = $diff_heure % $intervale;
		$intervale_limit = intval(strtotime($intervale_limit) - strtotime("00:00:00"));
		
		$a = $intervale_limit/3;
		$b = 2*$intervale_limit/3;

		echo $a." ".$b." ".$intervale_limit." <br>";

		if($a < $result && $result <= $b)
			return "#f0b518";

		elseif (2*$intervale_limit/3 < $result && $result <= $intervale_limit)
			return "#555";
		
		return "#dd5826";
	}

}


class GuardTours extends Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function getId($where, $value){
		
		try
		{
			$stmt = $this->conn->prepare("SELECT id FROM guard WHERE $where");
			$stmt->execute($value);

			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

			return $userRow['id'];
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	// public function dynamicSelect($where, $value, $element){
	// 	try
	// 	{
	// 		$stmt = $this->conn->prepare("SELECT $element FROM guardtours WHERE $where");
	// 		$stmt->execute($value);

	// 		$selected=$stmt->fetch(PDO::FETCH_ASSOC);

	// 		return $selected;
	// 	}
	// 	catch(PDOException $e)
	// 	{
	// 		echo $e->getMessage();
	// 	}
	// }
}





















?>