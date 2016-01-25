<?php 
	
  require_once("../model/session.php");
  
  require_once("../model/authentification.php");

  $auth_user = new User();
  
  
  $user_id = $_SESSION['user_session'];
  
  $userRow=$auth_user->getUserRow($user_id);
  
  include("../vue/report.php");

 ?>