<?php 
  require_once("../model/session.php");
  $model = new Model();

  $controllerCalled = 1;

  $guardSuccess = $model->count("tours", "mention = '#555'");
  $guardBad = $model->count("tours", "mention='#dd5826'");
  $guardWarning = $model->count("tours", "mention='#f0b518'");
  $nbGuard = $model->_count("tours");
  $list = $model->dynamicSelectAll("tours", "date_tour='".date("Y-m-d")."'", "*");
  // echo "-------------------------------------------------------------";
  // print_r($list);
  // echo "-------------------------------------------------------------";
  // echo $nbGuard;
  $pSuccess = doubleval($guardSuccess*100)/$nbGuard;
  $pWarning = doubleval($guardWarning*100)/$nbGuard;
  $pDanger = doubleval($guardBad*100)/$nbGuard;

  include("../vue/dashboard.php");

 ?>