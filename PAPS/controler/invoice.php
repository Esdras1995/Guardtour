<?php 
  require_once("../model/session.php");
  require_once('../model/models.php');
  

  $report = new Model();
  $listReport = "";
  
  if(isset($_POST['id'])){
    $_SESSION["report-list"] = array("id"=>'', "key"=>'');
    $_SESSION["report-list"]['id'] = json_decode($_POST['id'], true);
    $_SESSION["report-list"]['key'] = json_decode($_POST['key'], true);
  }

  $listReport = $report->dynamicSelectAll("tours", "id IN(".implode(',', $_SESSION["report-list"]['id']).")", implode(',', $_SESSION["report-list"]['key']));
  
  include("../vue/invoice.php");
 ?>