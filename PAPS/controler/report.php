<?php 
  
  require_once("../model/session.php");
  require_once('post_model.php');
  
  $_SESSION['page'] = "report";
  
  $report = new Report();
  $tours = new Tours();
  
  $list = $report->_list("report", "*");
  $listTours = $tours->_list("tours", "*");

  $toursKeys = array();

  foreach ($listTours[0] as $key => $value) {
  	$toursKeys[] = $key;  
  }
  
  include("../vue/report.php");

 ?>