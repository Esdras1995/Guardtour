<?php 
  require_once("../model/session.php");
  $model = new Model();

  $controllerCalled = 1;

  $date = date("Y-m-d");
  $guardSuccess = $model->count("tours", "mention = '#555' AND date_tour='".$date."'");
  $guardBad = $model->count("tours", "mention='#dd5826' AND date_tour='".$date."'");
  $guardWarning = $model->count("tours", "mention='#f0b518' AND date_tour='".$date."'");
  $nbGuard = $model->count("tours",  "date_tour='".$date."'");
  $list = $model->dynamicSelectAll("tours", "date_tour='".$date."'", "*");
  
  // echo "-------------------------------------------------------------";
  // print_r($list);
  // echo "-------------------------------------------------------------";
  // echo $date;
  
  if($nbGuard != 0){
    $pSuccess = round(doubleval($guardSuccess*100)/$nbGuard, 2);
    $pWarning = round(doubleval($guardWarning*100)/$nbGuard, 2);
    $pDanger = round(doubleval($guardBad*100)/$nbGuard, 2);
  }else{
    $pSuccess = 0;
    $pWarning = 0;
    $pDanger =  0;
  }

  include("../vue/dashboard.php");

 ?>