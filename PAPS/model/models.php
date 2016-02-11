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

			echo $stmt->rowCount();
			
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
}


class Guard extends Model
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
}


class Tours extends Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function getMention($heure, $guard_tours_id){
		
		$guard_tours = new GuardTours();

		$guard_tours->dynamicSelect("id = ?", array($guard_tours_id), "intervale, intervale_limit, commence_a, termine_a");

		return $guard_tours;
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

	public function dynamicSelect($where, $value, $element){
		try
		{
			$stmt = $this->conn->prepare("SELECT $element FROM guardtours WHERE $where");
			$stmt->execute($value);

			$selected=$stmt->fetch(PDO::FETCH_ASSOC);

			return $selected;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}





















?>