<?php

  require_once("PostService.php");
  
  $test = new PostService();
  
  // echo $test->getMention("2016-01-14 13:51:04", "2");

  if(isset($_POST['uid']) && isset($_POST['qrcode']) && isset($_POST['description']) && isset($_POST['date_tour'])){
  	
    $uid = $_POST['uid'];
    $qrcode = $_POST['qrcode'];
  	$description = $_POST['description'];
    $datetime = $_POST['date_tour']; 

  	if($test->insertTours($datetime, $qrcode, $description, $uid)){
  		echo "Yes";
  		return true;    
  	}
  	else{

  		echo "No";
  		return false;
  	}
  }

?>