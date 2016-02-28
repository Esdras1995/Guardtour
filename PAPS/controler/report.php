<?php 
  
  require_once("../model/session.php");
  require_once('../model/models.php');
  $controllerCalled = 1;
  $_SESSION['page'] = "report";
  
  $report = new Model();
  $tours = new Tours();
  
  $list = $report->_list("tours", "*");
  $listTours = $tours->_list("tours", "*");

  $toursKeys = array();

if(!empty($listTours))
  foreach ($listTours[0] as $key => $value) {
  	$toursKeys[] = $key;  
  }

  $mention = $tours->getMention("09:00:00", 1);
  
  include("../vue/report.php");

 ?>