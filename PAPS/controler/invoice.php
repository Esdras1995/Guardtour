<?php 
  require_once("../model/session.php");
  require_once('../model/models.php');
  $controllerCalled = 1;

  $report = new Model();
  $listReport = "";
  
  if(isset($_POST['id'])){
    $_SESSION["report-list"] = array("id"=>'', "key"=>'');
    $_SESSION["report-list"]['id'] = json_decode($_POST['id'], true);
    $_SESSION["report-list"]['key'] = json_decode($_POST['key'], true);
  }

  if(!empty($_SESSION["report-list"]['id']) && !empty($_SESSION["report-list"]['key']))
    $listReport = $report->dynamicSelectAll("tours", "id IN(".implode(',', $_SESSION["report-list"]['id']).")", implode(',', $_SESSION["report-list"]['key']));
  
  include("../vue/invoice.php");
 ?>