<?php 
	
	require_once('post_model.php');

  	$post = new Post();
  	$guard = new Guard();
  	$guardTours = new GuardTours();
  	$tours = new Tours();

	$currentPage = "";

	if(isset($_GET["page"])){

    $page = strip_tags(htmlspecialchars($_GET["page"]));

    if($page === "post"){
      # code...

      if(isset($_POST['register'])){

      	$name = securite_bdd(strip_tags($_POST['name']));
      	$adress = securite_bdd(strip_tags($_POST['address']));
      	$contact = securite_bdd(strip_tags($_POST['contact']));

      	$arrayPost = array('nom'=>$name, 'adress'=>$adress, 'contact'=>$contact);
      	$post->add("poste", $arrayPost);
      }
      $currentPage = "post";
      include("../vue/register_post.php");
      
    }elseif ($page === "guard") {
      # code...
      $currentPage = "guard";
      include("../vue/register_guard.php");
    
    }elseif ($page === "guardTours") {
      # code...
      $currentPage = "guardTours";
      include("../vue/register_guardTours.php");

    }elseif ($page === "tours") {
      # code...
      $currentPage = "tours";
	  include("../vue/register_tours.php");      

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
	        $string = mysql_real_escape_string($string);
	        $string = addcslashes($string, '%_');
	    }

	    return $string;
	}
 ?>