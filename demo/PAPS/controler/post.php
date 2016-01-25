<?php 

  require_once("../model/session.php");
  
  require_once("../model/authentification.php");

  $auth_user = new User();
  
  
  $user_id = $_SESSION['user_session'];
  
  $userRow=$auth_user->getUserRow($user_id);

  $data = array('name' => 'parvez', 'age' => '26');
  $cols = array();
  
  foreach($data as $key=>$val) {
        $cols[] = "$key = '$val'";
  }

  if(isset($_GET["page"])){

  	$page = strip_tags(htmlspecialchars($_GET["page"]));

  	if($page === "post"){
  		$test = "YES";
  	
  	}elseif ($page === "guard") {
  		# code...
  	
  	}elseif ($page === "guardTours") {
  		# code...
  	
  	}elseif ($page === "tours") {
  		# code...
  	
  	}else{

  	}
  
  }

  include("../vue/post.php");

 ?>