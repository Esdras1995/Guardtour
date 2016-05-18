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

			//echo $stmt->rowCount();
			
			if($stmt->rowCount() == 1)
			{
				//if(password_verify($upass, $userRow['password']))
				if(md5($upass) == $userRow['password'])
				{
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


class Tours extends Model
{
	private $result;
	private $heureReception;
	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function getMention($heure, $guard_tours_id){

		$guard_tours = new Model();

		$array = $guard_tours->dynamicSelect("guardtours", "id = ?", array($guard_tours_id), "intervale, intervale_limit, commence_a, termine_a");

		if(!empty($array)){

			$intervale = $array['intervale'];
			$limit = $array['intervale_limit'];
			$hc = $array['commence_a'];
			$ht = $array['termine_a'];

			$intervale = doubleval(strtotime($intervale)-strtotime("00:00:00"))/3600;
			$diff = $this->intervaleHeure($hc, $heure);
			$nbInt = $diff/$intervale;
			$result = $intervale*($nbInt - intval($nbInt));

			$limit = doubleval(strtotime($limit) - strtotime("00:00:00"))/3600;
			
			$a = $limit/3;
			$b = 2*$limit/3;
			$this->result = $result;
			if(0 <= $result && $result <= $a)
				return "#555";

			elseif ($a < $result && $result <= $b)
				return "#f0b518";
			
			else
				return "#dd5826";
		}

		return null;
	}

	public function intervaleHeure($h1, $h2){

		if(!strtotime($h1) || !strtotime($h2))
			return null;

		else if(strtotime($h1) < strtotime($h2))
			return doubleval(strtotime($h2)-strtotime($h1))/3600;

		else
			return doubleval(strtotime("23:00:00")-strtotime($h1) + strtotime($h2)-2*strtotime("00:00:00") + strtotime("01:00:00"))/3600;
	}

	public function getIntervale($id){
		$model = new Model();
		$intervale = $model->dynamicSelect("guardtours", "guard_id = ?", array($id), "intervale")['intervale'];
		// $intervale = "00:03:00";
		return intval((strtotime($intervale)-strtotime("00:00:00")) - $this->result*3600)*1000;
	}
}

?>