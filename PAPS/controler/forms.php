<?php 
	require_once("../model/session.php");
	require_once('../model/models.php');

  	// $post = new Post();
  	$guard = new Guard();
  	// $guardTours = new GuardTours();
  	$tours = new Tours();
    $user = new User();
    $model = new Model();
    $error = "";


/* Not set up */
  if(isset($_GET['tours'])){

    if(strip_tags(htmlspecialchars($_GET["tours"])) === "add"){

      $date_tour = securite_bdd(strip_tags($_POST['date_tour']));
      $qrcode = securite_bdd(strip_tags($_POST['qrcode']));
      $description = securite_bdd(strip_tags($_POST['description']));

      $heure = securite_bdd(strip_tags($_POST['heure']));
      $uid = securite_bdd(strip_tags($_POST['uid']));

      $guard_id = $guard->getId(array('uid' => $uid));
      $guard_tours_id = $getId(array('guard_id' => $guard_id));   
      
      $mention = $tours->getMention($heure, $guard_tours_id);
    }

  }
/* EndComment */

	if(isset($_GET["page"])){

    $page = strip_tags(htmlspecialchars($_GET["page"]));

    if($page === "Post"){
      # code...

      if(isset($_POST['register'])){
        
        $contact = null;

      	$name = securite_bdd(strip_tags($_POST['name']));
      	$adress = securite_bdd(strip_tags($_POST['address']));
      	$contact = securite_bdd(strip_tags($_POST['contact']));

      	$arrayPost = array('nom'=>$name, 'adress'=>$adress, 'contact'=>$contact);
      	$model->add("poste", $arrayPost);
      }

      include("../vue/register_post.php");
      
    }elseif ($page === "Guard") {
      # code...

      if(isset($_POST['register'])){

        $firstname = securite_bdd(strip_tags($_POST['firstname']));
        $lastname = securite_bdd(strip_tags($_POST['lastname']));
        $email = securite_bdd(strip_tags($_POST['email']));
        $uid = securite_bdd(strip_tags($_POST['uid']));
        $phone = securite_bdd(strip_tags($_POST['phone']));
        $nif = securite_bdd(strip_tags($_POST['nif']));

        $arrayPost = array('nom'=>$lastname, 'prenom'=>$firstname, 'email'=>$email, 'uid'=>$uid, 'phone'=>$phone, 'nif'=>$nif);
        $model->add("guard", $arrayPost);
      }

      include("../vue/register_guard.php");
    
    }elseif ($page === "Guard tours") {
      # code...

      include("../vue/register_guardTours.php");

    }elseif ($page === "Tours") {
      # code...
      
	    include("../vue/register_tours.php");      

    }elseif ($page === "Users") {
      # code...

      if(isset($_POST['register'])){

        $firstname = securite_bdd(strip_tags($_POST['firstname']));
        $lastname = securite_bdd(strip_tags($_POST['lastname']));
        $email = securite_bdd(strip_tags($_POST['email']));
        $username = securite_bdd(strip_tags($_POST['username']));
        $password = securite_bdd(strip_tags($_POST['password']));

        $password = md5($password);

        $arrayPost = array('nom'=>$lastname, 'prenom'=>$firstname, 'email'=>$email, 'username'=>$username, 'password'=>$password);
        
        if(!$user->exist($username, $email))
            $user->add("admin", $arrayPost);
        
        else
          $error = "Username or email already exist. please check  the list users";

      }

      include("../vue/register_users.php"); 
    }else{
        header("Location: error.php");
    }
  
  }else{
    header("Location: error.php");
  }
  

	function securite_bdd($string)
	{
	    // On regarde si le type de string est un nombre entier (int)
	    if(ctype_digit($string))
	    {
	        $string = intval($string);
	    }
	    // Pour tous les autres types
	    else
	    {
	        $string = htmlspecialchars($string);
	        $string = addcslashes($string, '%_');
	    }

	    return $string;
	}
 ?>