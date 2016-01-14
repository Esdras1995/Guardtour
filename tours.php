<?php
  
  require_once("PostService.php");
  
  $test = new PostService();

  if(isset($_GET['uid'])){
  	$qrcode = $_GET['qrcode'];
  	$description = $_GET['description'];
  	$uid = $_GET['uid'];

  	if($test->insertTours("12/03/2016", $qrcode, $description, "1")){
		echo "Yes";
		return true;    
  	}
  	else{

  		echo "No";
  		return false;
  	}
  }

?>