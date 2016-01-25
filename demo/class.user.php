<?php

require_once('dbconfig.php');

class USER
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
	
	public function register($uname,$umail,$upass,$firstname,$lastname)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO admin(username,email,password,name,lastname) 
		                                               VALUES(:uname, :umail, :upass, :firstname, :lastname)");
												  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $upass);
			$stmt->bindparam(":firstname", $firstname);										  
			$stmt->bindparam(":lastname", $lastname);
				
			$stmt->execute();	
			
			return $stmt;	
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
				if($upass == $userRow['password'])
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
}

/**
* Create class for post
*/
class Post
{
	private $conn;
	
	public function __construct()
	{
		# code...

		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

    public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function registerPost($name,$address,$contact)
	{
		try
		{
			
			$stmt = $this->conn->prepare("INSERT INTO poste(nom,adress,contact) 
		                                               VALUES(:name,:address,:contact)");
												  
			$stmt->bindparam(":name", $name);
			$stmt->bindparam(":address", $address);
			$stmt->bindparam(":contact", $contact);
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}

	public function registerGuard($uid, $firstname, $lastname, $email, $phone, $nif)
	{
		try
		{
			
			$stmt = $this->conn->prepare("INSERT INTO guard(nom,prenom,uid,email,phone,nif) 
		                                               VALUES(:lastname,:firstname,:uid,:email,:phone,:nif)");
			$stmt->bindparam(":lastname", $lastname);
			$stmt->bindparam(":firstname", $firstname);
			$stmt->bindparam(":uid", $uid);
			$stmt->bindparam(":email", $email);
			$stmt->bindparam(":phone", $phone);										  
			$stmt->bindparam(":nif", $nif);
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}


	public function redirect($url)
	{
		header("Location: $url");
	}

}
?>