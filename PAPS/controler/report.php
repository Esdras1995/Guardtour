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
  
  include("../vue/report.php");

 ?>